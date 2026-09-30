<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_only_admin_users_can_access_the_admin_panel(): void
    {
        $panel = Filament::getPanel('admin');

        $this->assertTrue(User::factory()->make(['role' => 'admin'])->canAccessPanel($panel));
        $this->assertFalse(User::factory()->make(['role' => 'guest'])->canAccessPanel($panel));
    }

    public function test_guests_are_redirected_to_admin_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_admin_can_open_the_dashboard(): void
    {
        $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->get('/admin')
            ->assertOk();
    }

    public function test_only_admin_users_can_open_the_contact_inbox(): void
    {
        $this->get('/admin/contact-messages')->assertRedirect('/admin/login');

        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)
            ->get('/admin/contact-messages')
            ->assertOk();
    }
}
