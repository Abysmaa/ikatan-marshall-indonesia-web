<?php

namespace Tests\Feature;

use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoEndpointsTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_seo_endpoints_are_available_and_exclude_drafts(): void
    {
        $event = Event::create([
            'name' => 'Event Sitemap Aktif',
            'slug' => 'event-sitemap-aktif',
            'status' => true,
        ]);
        Event::create([
            'name' => 'Event Sitemap Draft',
            'slug' => 'event-sitemap-draft',
            'status' => false,
        ]);

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->assertSee(route('home'))
            ->assertSee(route('events.show', $event->slug))
            ->assertDontSee(route('events.show', 'event-sitemap-draft'));

        $this->get('/robots.txt')
            ->assertOk()
            ->assertSee('Disallow: /admin')
            ->assertSee(route('sitemap'));
    }
}
