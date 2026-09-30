<?php

namespace Tests\Feature;

use App\Models\CoverageArea;
use App\Models\Equipment;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_responds_successfully(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_homepage_renders_published_content_and_hides_drafts(): void
    {
        Service::create([
            'name' => 'Layanan Aktif',
            'slug' => 'layanan-aktif',
            'short_description' => 'Deskripsi layanan aktif.',
            'sort_order' => 1,
            'status' => true,
        ]);
        Service::create([
            'name' => 'Layanan Draft',
            'slug' => 'layanan-draft',
            'short_description' => 'Tidak boleh tampil.',
            'sort_order' => 2,
            'status' => false,
        ]);
        CoverageArea::create([
            'name' => 'Area Uji',
            'slug' => 'area-uji',
            'status' => true,
        ]);
        Equipment::create([
            'name' => 'Perlengkapan Uji',
            'slug' => 'perlengkapan-uji',
            'availability' => 'Tersedia',
            'status' => true,
        ]);
        $event = Event::create([
            'name' => 'Event Terpublikasi',
            'slug' => 'event-terpublikasi',
            'status' => true,
        ]);
        Event::create([
            'name' => 'Event Draft',
            'slug' => 'event-draft',
            'status' => false,
        ]);
        Partner::create([
            'name' => 'Partner Terpublikasi',
            'status' => true,
        ]);
        Gallery::create([
            'event_id' => $event->id,
            'title' => 'Dokumentasi Terpublikasi',
            'image' => 'gallery/test.webp',
            'status' => true,
        ]);
        Setting::create([
            'key' => 'hero_title_first',
            'value' => 'JUDUL DINAMIS.',
            'type' => 'text',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('JUDUL DINAMIS.')
            ->assertSee('LAYANAN AKTIF')
            ->assertDontSee('Layanan Draft')
            ->assertSee('Area Uji')
            ->assertSee('PERLENGKAPAN UJI')
            ->assertSee('EVENT TERPUBLIKASI')
            ->assertDontSee('Event Draft')
            ->assertSee('Partner Terpublikasi')
            ->assertSee('Dokumentasi Terpublikasi');
    }
}
