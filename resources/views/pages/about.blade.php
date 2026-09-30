@extends('layouts.site')

@section('title', 'Tentang IMI')
@section('description', $settings->get('about_lead', 'Profil Ikatan Marshall Indonesia dan cara kami mendukung event dengan empati.'))

@section('content')
  <section class="page-shell">
    <div class="page-kicker"><span>01 / PROFIL</span><span>IKATAN MARSHALL INDONESIA</span></div>
    <div class="page-heading">
      <div><p class="eyebrow">{{ $settings->get('tagline', '#TreatWithEmpathy') }}</p><h1>Orang-orang di balik <span>event yang lancar.</span></h1></div>
      <p>{{ $settings->get('about_lead', 'Ikatan Marshall Indonesia mendukung penyelenggaraan event melalui tim lapangan yang paham tugas, peka terhadap situasi, dan siap membantu peserta.') }}</p>
    </div>
    <div class="about-copy">
      <p>{{ $settings->get('about_description', 'Kami percaya event yang tertib bukan hanya soal alur yang tepat. Cara kita memperlakukan peserta, kru, dan sesama tim sama pentingnya.') }}</p>
      <p>Tim disiapkan sesuai kebutuhan event, dengan komunikasi yang jelas dan pelayanan yang menghargai setiap orang di lapangan.</p>
    </div>
    <div class="about-stats">
      <div><strong>{{ $servicesCount }}</strong><span>peran layanan aktif</span></div>
      <div><strong>{{ $coverageAreas->count() }}</strong><span>wilayah layanan</span></div>
      <div><strong>#</strong><span>{{ $settings->get('tagline', 'Treat With Empathy') }}</span></div>
    </div>
    <a class="button button-lime" href="{{ route('services.index') }}">Kenali layanan <span aria-hidden="true">↗</span></a>
  </section>
@endsection