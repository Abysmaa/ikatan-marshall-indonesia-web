<?php

namespace App\Http\Controllers;

use App\Models\CoverageArea;
use App\Models\Equipment;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Contracts\View\View;

class HomeController
{
    public function __invoke(): View
    {
        $settings = Setting::query()->pluck('value', 'key');
        $whatsappNumber = preg_replace('/\D+/', '', (string) $settings->get('contact_whatsapp', ''));
        $whatsappUrl = $whatsappNumber !== ''
            ? "https://wa.me/{$whatsappNumber}"
            : 'https://wa.me/?text=Halo%20IMI%2C%20saya%20ingin%20berdiskusi%20tentang%20dukungan%20marshal%20untuk%20event.';

        return view('home', [
            'settings' => $settings,
            'whatsappUrl' => $whatsappUrl,
            'services' => Service::query()
                ->where('status', true)
                ->where('slug', '!=', 'timing-system-management')
                ->orderBy('sort_order')
                ->get(),
            'timingService' => Service::query()
                ->where('status', true)
                ->where('slug', 'timing-system-management')
                ->first(),
            'coverageAreas' => CoverageArea::query()
                ->where('status', true)
                ->orderBy('name')
                ->get(),
            'equipment' => Equipment::query()
                ->where('status', true)
                ->orderBy('sort_order')
                ->get(),
            'events' => Event::query()
                ->where('status', true)
                ->orderByDesc('event_date')
                ->orderBy('sort_order')
                ->get(),
            'partners' => Partner::query()
                ->where('status', true)
                ->orderBy('sort_order')
                ->get(),
            'galleries' => Gallery::query()
                ->with('event')
                ->where('status', true)
                ->orderBy('sort_order')
                ->limit(8)
                ->get(),
        ]);
    }
}
