<?php

namespace App\Filament\Widgets;

use App\Models\ContactMessage;
use App\Models\CoverageArea;
use App\Models\Equipment;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\Partner;
use App\Models\Service;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Layanan', Service::query()->count()),
            Stat::make('Area Layanan', CoverageArea::query()->count()),
            Stat::make('Perlengkapan', Equipment::query()->count()),
            Stat::make('Event Didukung', Event::query()->count()),
            Stat::make('Partner', Partner::query()->count()),
            Stat::make('Galeri', Gallery::query()->count()),
            Stat::make('Pesan Baru', ContactMessage::query()->where('status', 'new')->count()),
        ];
    }
}
