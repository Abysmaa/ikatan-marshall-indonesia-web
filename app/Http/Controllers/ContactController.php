<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController
{
    public function show(): View
    {
        return view('pages.contact', [
            'settings' => Setting::query()->pluck('value', 'key'),
        ]);
    }

    public function submit(Request $request): RedirectResponse
    {
        if ($request->filled('website')) {
            return redirect()->route('contact');
        }

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:32'],
            'event' => ['nullable', 'string', 'max:160'],
            'message' => ['required', 'string', 'max:3000'],
            'consent' => ['accepted'],
        ]);

        ContactMessage::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'event_name' => $data['event'] ?? null,
            'message' => $data['message'],
            'consent_at' => now(),
            'status' => 'new',
        ]);

        $settings = Setting::query()->pluck('value', 'key');
        $number = preg_replace('/\D+/', '', (string) $settings->get('contact_whatsapp', ''));

        if ($number === '') {
            return redirect()->route('contact')->with('status', 'Pesan tersimpan. Tim IMI akan menindaklanjuti.');
        }

        $message = collect([
            'Halo IMI, saya ingin berdiskusi tentang dukungan marshal untuk event.',
            'Nama: '.$data['name'],
            filled($data['email'] ?? null) ? 'Email: '.$data['email'] : null,
            filled($data['phone'] ?? null) ? 'Telepon: '.$data['phone'] : null,
            filled($data['event'] ?? null) ? 'Event: '.$data['event'] : null,
            'Pesan: '.$data['message'],
        ])->filter()->implode("\n");

        return redirect()->away("https://wa.me/{$number}?text=".rawurlencode($message));
    }
}
