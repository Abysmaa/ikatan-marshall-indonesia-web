<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicContentController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::controller(PublicContentController::class)->group(function () {
    Route::get('/about', 'about')->name('about');
    Route::get('/services', 'services')->name('services.index');
    Route::get('/services/{slug}', 'service')->name('services.show');
    Route::get('/equipment', 'equipment')->name('equipment.index');
    Route::get('/equipment/{slug}', 'equipmentItem')->name('equipment.show');
    Route::get('/events', 'events')->name('events.index');
    Route::get('/events/{slug}', 'event')->name('events.show');
    Route::get('/gallery', 'gallery')->name('gallery.index');
});

Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'show')->name('contact');
    Route::post('/contact', 'submit')->middleware('throttle:5,1')->name('contact.submit');
});

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

Route::get('/robots.txt', function () {
    return response("User-agent: *\nAllow: /\nDisallow: /admin\nSitemap: ".route('sitemap')."\n")
        ->header('Content-Type', 'text/plain; charset=UTF-8');
});
