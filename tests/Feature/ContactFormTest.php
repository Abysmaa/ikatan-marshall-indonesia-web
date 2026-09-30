<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_validates_and_redirects_to_configured_whatsapp(): void
    {
        Setting::create([
            'key' => 'contact_whatsapp',
            'value' => '+62 812-3456-7890',
            'type' => 'text',
        ]);

        $this->from('/contact')
            ->post('/contact', [])
            ->assertRedirect('/contact')
            ->assertSessionHasErrors(['name', 'message', 'consent']);

        $response = $this->post('/contact', [
            'name' => 'Pengunjung IMI',
            'email' => 'visitor@example.com',
            'phone' => '081234567890',
            'event' => 'Fun Run',
            'message' => 'Mohon informasi tim marshal.',
            'consent' => '1',
        ]);

        $this->assertStringStartsWith(
            'https://wa.me/6281234567890?text=',
            $response->headers->get('Location'),
        );
        $this->assertStringContainsString('Pengunjung%20IMI', $response->headers->get('Location'));
        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Pengunjung IMI',
            'email' => 'visitor@example.com',
            'event_name' => 'Fun Run',
            'status' => 'new',
        ]);
        $this->assertNotNull(ContactMessage::query()->first()->consent_at);
    }

    public function test_honeypot_submissions_are_not_stored(): void
    {
        $this->post('/contact', [
            'website' => 'https://spam.example',
        ])->assertRedirect('/contact');

        $this->assertDatabaseCount('contact_messages', 0);
    }

    public function test_message_is_saved_and_confirmed_when_whatsapp_is_not_configured(): void
    {
        $this->from('/contact')
            ->post('/contact', [
                'name' => 'Calon Klien',
                'message' => 'Saya membutuhkan marshal untuk event.',
                'consent' => '1',
            ])
            ->assertRedirect('/contact')
            ->assertSessionHas('status', 'Pesan tersimpan. Tim IMI akan menindaklanjuti.');

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Calon Klien',
            'status' => 'new',
        ]);
    }
}
