<?php

namespace App\Http\Controllers;

use App\Models\CoverageArea;
use App\Models\Equipment;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class PublicContentController
{
    public function about(): View
    {
        return view('pages.about', [
            'settings' => $this->settings(),
            'servicesCount' => Service::query()->where('status', true)->count(),
            'coverageAreas' => CoverageArea::query()->where('status', true)->orderBy('name')->get(),
        ]);
    }

    public function services(): View
    {
        return $this->collection(
            Service::query()->where('status', true)->orderBy('sort_order')->get(),
            'Layanan Marshall',
            'Pembagian peran yang jelas membantu menjaga koordinasi dan pelayanan sepanjang event.',
            'Layanan',
            'services.show',
        );
    }

    public function service(string $slug): View
    {
        $service = Service::query()->where('status', true)->where('slug', $slug)->firstOrFail();

        return view('pages.detail', [
            'record' => $service,
            'kind' => 'Layanan',
            'description' => $service->description ?: $service->short_description,
            'image' => $service->image,
            'backRoute' => 'services.index',
            'backLabel' => 'Semua layanan',
        ]);
    }

    public function equipment(): View
    {
        return $this->collection(
            Equipment::query()->where('status', true)->orderBy('sort_order')->get(),
            'Perlengkapan',
            'Perlengkapan yang dapat disiapkan akan dikonfirmasi sesuai kebutuhan dan ketersediaan event.',
            'Perlengkapan',
            'equipment.show',
        );
    }

    public function equipmentItem(string $slug): View
    {
        $item = Equipment::query()->where('status', true)->where('slug', $slug)->firstOrFail();

        return view('pages.detail', [
            'record' => $item,
            'kind' => 'Perlengkapan',
            'description' => $item->description,
            'image' => $item->image,
            'availability' => $item->availability,
            'backRoute' => 'equipment.index',
            'backLabel' => 'Semua perlengkapan',
        ]);
    }

    public function events(): View
    {
        return $this->collection(
            Event::query()->where('status', true)->orderByDesc('event_date')->orderBy('sort_order')->get(),
            'Event Didukung',
            'Dokumentasi event yang telah dikonfirmasi untuk dipublikasikan.',
            'Event',
            'events.show',
        );
    }

    public function event(string $slug): View
    {
        $event = Event::query()
            ->with(['galleries' => fn ($query) => $query->where('status', true)->orderBy('sort_order')])
            ->where('status', true)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.detail', [
            'record' => $event,
            'kind' => 'Event Didukung',
            'description' => $event->description,
            'image' => $event->thumbnail ?: $event->logo,
            'backRoute' => 'events.index',
            'backLabel' => 'Semua event',
        ]);
    }

    public function gallery(): View
    {
        $galleries = Gallery::query()
            ->with('event')
            ->where('status', true)
            ->where(fn ($query) => $query->whereNull('event_id')->orWhereHas('event', fn ($event) => $event->where('status', true)))
            ->orderBy('sort_order')
            ->paginate(24);

        return view('pages.gallery', compact('galleries'));
    }

    private function settings()
    {
        return Setting::query()->pluck('value', 'key');
    }

    private function collection(Collection $records, string $title, string $description, string $kind, string $detailRoute): View
    {
        return view('pages.collection', compact('records', 'title', 'description', 'kind', 'detailRoute'));
    }
}
