<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use App\Models\Event;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController
{
    public function __invoke(): Response
    {
        return response()->view('sitemap', [
            'services' => Service::query()->where('status', true)->get(),
            'equipmentItems' => Equipment::query()->where('status', true)->get(),
            'events' => Event::query()->where('status', true)->get(),
        ], 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}
