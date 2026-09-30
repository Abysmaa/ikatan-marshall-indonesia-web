@extends('layouts.site')

@section('title', 'Hubungi IMI')
@section('description', 'Diskusikan kebutuhan dukungan marshal untuk event Anda bersama Ikatan Marshall Indonesia.')

@section('content')
  <section class="page-shell">
    <div class="page-kicker"><span>HUBUNGI KAMI</span><span>IKATAN MARSHALL INDONESIA</span></div>
    <div class="page-heading"><div><p class="eyebrow">#TREATWITHEMPATHY</p><h1>Mari siapkan <span>event Anda.</span></h1></div><p>Bagikan kebutuhan event; pesan disimpan untuk tindak lanjut dan dapat diteruskan ke WhatsApp.</p></div>
    @if(session('status'))<p class="form-success" role="status">{{ session('status') }}</p>@endif
    <form class="contact-form" method="post" action="{{ route('contact.submit') }}">
      @csrf
      <div class="website-field" aria-hidden="true"><label for="website">Website</label><input id="website" name="website" tabindex="-1" autocomplete="off"></div>
      <div class="form-field"><label for="name">Nama</label><input id="name" name="name" value="{{ old('name') }}" autocomplete="name" required maxlength="120">@error('name')<span class="field-error">{{ $message }}</span>@enderror</div>
      <div class="form-field"><label for="email">Email</label><input id="email" name="email" type="email" value="{{ old('email') }}" autocomplete="email" maxlength="255">@error('email')<span class="field-error">{{ $message }}</span>@enderror</div>
      <div class="form-field"><label for="phone">Nomor telepon</label><input id="phone" name="phone" type="tel" value="{{ old('phone') }}" autocomplete="tel" maxlength="32">@error('phone')<span class="field-error">{{ $message }}</span>@enderror</div>
      <div class="form-field"><label for="event">Nama / jenis event</label><input id="event" name="event" value="{{ old('event') }}" maxlength="160">@error('event')<span class="field-error">{{ $message }}</span>@enderror</div>
      <div class="form-field form-field-full"><label for="message">Kebutuhan dukungan</label><textarea id="message" name="message" rows="5" required maxlength="3000">{{ old('message') }}</textarea>@error('message')<span class="field-error">{{ $message }}</span>@enderror</div>
      <div class="form-field form-field-full consent-control"><label><input type="checkbox" name="consent" value="1" required @checked(old('consent'))> Saya setuju informasi ini disimpan oleh IMI untuk menindaklanjuti permintaan saya.</label>@error('consent')<span class="field-error">Persetujuan diperlukan untuk mengirim pesan.</span>@enderror</div>
      <button class="button button-lime form-field-full" type="submit">Lanjutkan ke WhatsApp <span aria-hidden="true">↗</span></button>
    </form>
    <p class="contact-note">Informasi kontak disimpan untuk tindak lanjut permintaan Anda.</p>
    @if($settings->get('contact_whatsapp'))<p class="contact-note">WhatsApp: {{ $settings->get('contact_whatsapp') }}</p>@else<p class="contact-note">Nomor WhatsApp resmi belum ditambahkan. Pesan dapat dilanjutkan dengan memilih kontak di WhatsApp.</p>@endif
  </section>
@endsection