<?php

namespace Tests\Feature;

use App\Models\Equipment;
use App\Models\Event;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_render_active_records_and_hide_drafts(): void
    {
        Service::create([
            'name' => 'Layanan Publik',
            'slug' => 'layanan-publik',
            'description' => 'Detail layanan yang dipublikasikan.',
            'status' => true,
        ]);
        Service::create([
            'name' => 'Layanan Rahasia',
            'slug' => 'layanan-rahasia',
            'status' => false,
        ]);
        Equipment::create([
            'name' => 'Cone Layanan',
            'slug' => 'cone-layanan',
            'description' => 'Penanda rute.',
            'availability' => 'Konfirmasi ketersediaan',
            'status' => true,
        ]);
        Event::create([
            'name' => 'Event Terverifikasi',
            'slug' => 'event-terverifikasi',
            'status' => true,
        ]);
        Event::create([
            'name' => 'Event Draft',
            'slug' => 'event-draft',
            'status' => false,
        ]);

        $this->get('/about')->assertOk();
        $this->get('/services')->assertOk()->assertSee('Layanan Publik');
        $this->get('/services/layanan-publik')->assertOk()->assertSee('Detail layanan yang dipublikasikan.');
        $this->get('/services/layanan-rahasia')->assertNotFound();
        $this->get('/equipment')->assertOk()->assertSee('Cone Layanan');
        $this->get('/equipment/cone-layanan')->assertOk()->assertSee('Konfirmasi ketersediaan');
        $this->get('/events')->assertOk()->assertSee('Event Terverifikasi')->assertDontSee('Event Draft');
        $this->get('/events/event-terverifikasi')->assertOk();
        $this->get('/events/event-draft')->assertNotFound();
        $this->get('/gallery')->assertOk();
        $this->get('/contact')->assertOk();
    }
}
