<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Ikatan Marshall Indonesia mendukung kelancaran event olahraga dan komunitas melalui tim marshal yang terkoordinasi, sigap, dan melayani dengan empati.">
  <meta name="theme-color" content="#161816">
  <meta property="og:title" content="Ikatan Marshall Indonesia | #TreatWithEmpathy">
  <meta property="og:description" content="Dukungan marshal untuk event yang bergerak dengan aman, tertib, dan penuh empati.">
  <meta property="og:type" content="website">
  <link rel="canonical" href="{{ route('home') }}">
  <title>Ikatan Marshall Indonesia | #TreatWithEmpathy</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700;800&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('styles.css') }}">
  <script src="{{ asset('script.js') }}" defer></script>
</head>
<body>
  <a class="skip-link" href="#main">Langsung ke konten</a>
  <header class="site-header">
    <a class="brand" href="#home" aria-label="IMI, kembali ke beranda">
      <span class="brand-mark" aria-hidden="true">IMI</span>
      <span class="brand-name">IKATAN MARSHALL<br>INDONESIA</span>
    </a>
    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-nav" aria-label="Buka menu">
      <span></span><span></span>
    </button>
    <nav class="primary-nav" id="primary-nav" aria-label="Navigasi utama">
      <a href="{{ route('about') }}">Tentang</a>
      <a href="{{ route('services.index') }}">Layanan</a>
      <a href="#jangkauan">Jangkauan</a>
      <a href="{{ route('equipment.index') }}">Perlengkapan</a>
      <a href="{{ route('events.index') }}">Event</a>
      <a href="{{ route('gallery.index') }}">Galeri</a>
      <a class="nav-cta" href="#kontak">Diskusikan event <span aria-hidden="true">↗</span></a>
    </nav>
  </header>

  <main id="main">
    <section class="hero" id="home" aria-labelledby="hero-title">
      <div class="hero-photo" role="img" aria-label="Pelari mengikuti event lari di jalan kota"></div>
      <div class="hero-shade"></div>
      <div class="hero-content">
        <p class="eyebrow"><span class="live-dot"></span> {{ strtoupper($settings->get('organization_name', 'Ikatan Marshall Indonesia')) }}</p>
        <h1 id="hero-title">{{ $settings->get('hero_title_first', 'EVENT BERGERAK.') }}<br><span>{{ $settings->get('hero_title_second', 'SEMUA TERJAGA.') }}</span></h1>
        <p class="hero-copy">{{ $settings->get('hero_description', 'Dukungan marshal yang sigap, terkoordinasi, dan selalu ingat bahwa setiap event adalah tentang manusia.') }}</p>
        <div class="hero-actions">
          <a class="button button-lime" href="#layanan">Kenali layanan <span aria-hidden="true">↘</span></a>
          <a class="text-link" href="#kontak">Rencanakan event bersama <span aria-hidden="true">↗</span></a>
        </div>
      </div>
      <div class="hero-side-note">#TREATWITHEMPATHY <span>—</span> SEJAK AWAL, DI SETIAP POS</div>
      <div class="hero-index"><span>01</span> / 05</div>
      <a class="scroll-cue" href="{{ route('about') }}" aria-label="Kenali Ikatan Marshall Indonesia"><span></span> GULIR UNTUK MENGENAL IMI</a>
    </section>

    <div class="signal-strip" aria-label="Nilai kerja IMI">
      <div class="signal-inner"><span>SIAP DI LAPANGAN</span><i></i><span>TERATUR DALAM KOORDINASI</span><i></i><span>HADIR DENGAN EMPATI</span><i></i><span>SIAP DI LAPANGAN</span></div>
    </div>

    <section class="intro section-wrap" id="tentang">
      <div class="section-kicker"><span>01 / TENTANG IMI</span><span>ORGANISASI • KAPABILITAS • EMPATI</span></div>
      <div class="intro-grid">
        <h2>ORANG-ORANG<br>DI BALIK <span>EVENT<br>YANG LANCAR.</span></h2>
        <div class="intro-copy">
          <p class="lead">{{ $settings->get('about_lead', 'Ikatan Marshall Indonesia mendukung penyelenggaraan event melalui tim lapangan yang paham tugas, peka terhadap situasi, dan siap membantu peserta.') }}</p>
          <p>{{ $settings->get('about_description', 'Kami percaya event yang tertib bukan hanya soal alur yang tepat. Cara kita memperlakukan peserta, kru, dan sesama tim sama pentingnya.') }} Itulah semangat <strong>{{ $settings->get('tagline', '#TreatWithEmpathy') }}</strong> yang kami bawa ke setiap penugasan.</p>
          <a class="underlined-link" href="#kontak">Ceritakan kebutuhan event Anda <span aria-hidden="true">↗</span></a>
        </div>
      </div>
      <div class="value-row">
        <div><span class="value-number">01</span><span>Koordinasi yang<br>jelas dan terstruktur</span></div>
        <div><span class="value-number">02</span><span>Tim sesuai<br>kebutuhan event</span></div>
        <div><span class="value-number">03</span><span>Pelayanan yang<br>mengutamakan empati</span></div>
        <p>BAIK DI JALUR.<br>BAIK PADA MANUSIA.</p>
      </div>
    </section>

    <section class="services section-wrap" id="layanan">
      <div class="section-kicker"><span>02 / LAYANAN</span><span>DUKUNGAN MENYELURUH DI LAPANGAN</span></div>
      <div class="section-heading">
        <h2>POSISI BERBEDA.<br><span>SATU TIM.</span></h2>
        <p>Personel dan alur dukungan disesuaikan dengan karakter, skala, serta kebutuhan setiap event.</p>
      </div>
      <div class="service-grid">
        @forelse($services as $service)
          <article class="service-item"><span class="service-no">{{ sprintf('%02d', $loop->iteration) }}</span><div><h3>{{ strtoupper($service->name) }}</h3><p>{{ $service->short_description }}</p></div><span class="service-arrow" aria-hidden="true">↗</span></article>
        @empty
          <p class="content-empty">Informasi layanan akan segera diperbarui.</p>
        @endforelse
      </div>
      @if($timingService)
        <div class="timing-band"><div class="timing-symbol" aria-hidden="true">◷</div><div><span class="eyebrow">DUKUNGAN TEKNIS EVENT</span><h3>{{ strtoupper($timingService->name) }}</h3><p>{{ $timingService->short_description }}</p></div><span class="timing-tag">TERSEDIA SESUAI KEBUTUHAN</span></div>
      @endif
    </section>

    <section class="coverage" id="jangkauan">
      <div class="coverage-image" role="img" aria-label="Suasana event olahraga outdoor"></div>
      <div class="coverage-content">
        <div class="section-kicker"><span>03 / JANGKAUAN</span><span>INDONESIA</span></div>
        <h2>DEKAT DENGAN<br><span>LOKASI ANDA.</span></h2>
        <p>Dukungan awal tersedia di sejumlah wilayah. Cakupan dan kebutuhan tim dapat dibicarakan untuk setiap event.</p>
        <div class="location-list" aria-label="Wilayah layanan awal">
          @forelse($coverageAreas as $area)
            <span>{{ $area->name }}</span>
          @empty
            <span class="content-empty">Wilayah layanan akan segera diperbarui.</span>
          @endforelse
        </div>
        <a class="button button-outline" href="#kontak">Tanyakan ketersediaan <span aria-hidden="true">↗</span></a>
      </div>
      <div class="coverage-stamp" aria-hidden="true"><span>JANGKAUAN</span><strong>{{ sprintf('%02d', $coverageAreas->count()) }}</strong><span>WILAYAH AWAL</span></div>
    </section>

    <section class="equipment section-wrap" id="perlengkapan">
      <div class="section-kicker"><span>04 / PERLENGKAPAN</span><span>SIAP MENDUKUNG KEBUTUHAN EVENT</span></div>
      <div class="section-heading equipment-heading"><h2>PERLENGKAPAN<br><span>UNTUK JALUR.</span></h2><p>Kebutuhan perlengkapan dapat dikonfirmasi bersama tim berdasarkan konsep dan skala kegiatan.</p></div>
      <div class="equipment-grid">
        @forelse($equipment as $item)
          <article class="equipment-item"><div class="equipment-art">
            @if($item->image)
              <img class="equipment-image" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($item->image) }}" alt="{{ $item->name }}" loading="lazy">
            @else
              <span class="equipment-art-mark" aria-hidden="true">{{ sprintf('%02d', $loop->iteration) }}</span>
            @endif
          </div><div class="equipment-caption"><span>{{ $item->availability }}</span><h3>{{ strtoupper($item->name) }}</h3></div></article>
        @empty
          <p class="content-empty">Daftar perlengkapan akan diperbarui setelah ketersediaannya dikonfirmasi.</p>
        @endforelse
      </div>
    </section>

    <section class="approach">
      <div class="approach-photo" role="img" aria-label="Relawan event memberikan dukungan kepada peserta"></div>
      <div class="approach-panel">
        <div class="section-kicker"><span>05 / CARA KAMI BEKERJA</span><span>PRINSIP IMI</span></div>
        <p class="approach-hash">#TREAT<br>WITH<br>EMPATHY<span>.</span></p>
        <p class="approach-copy">Sigap membaca situasi. Jelas dalam koordinasi. Tetap hangat dalam melayani.</p>
        <div class="approach-points"><span><b>01</b> Pahami kebutuhan</span><span><b>02</b> Siapkan tim bersama</span><span><b>03</b> Hadir sepanjang event</span></div>
      </div>
    </section>

    <section class="work section-wrap" id="pengalaman">
      <div class="section-kicker"><span>06 / BENTUK DUKUNGAN</span><span>FLEKSIBEL SESUAI FORMAT EVENT</span></div>
      <div class="work-heading"><h2>BERBAGAI FORMAT.<br><span>STANDAR KERJA YANG SAMA.</span></h2><p>Ruang lingkup dukungan dirancang bersama penyelenggara; setiap event punya kebutuhan dan cerita yang berbeda.</p></div>
      <div class="work-grid">
        @forelse($events as $event)
          <article class="work-card">
            @if($event->thumbnail)
              <img class="work-card-image" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($event->thumbnail) }}" alt="{{ $event->name }}" loading="lazy">
            @elseif($event->logo)
              <img class="work-card-image work-card-image--logo" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($event->logo) }}" alt="Logo {{ $event->name }}" loading="lazy">
            @else
              <div class="work-card-image work-card-image--empty" aria-hidden="true">{{ strtoupper($event->name) }}</div>
            @endif
            <div class="work-card-info"><span>{{ $event->event_date?->format('d.m.Y') ?? 'SUPPORTED EVENT' }}{{ $event->location ? ' / '.strtoupper($event->location) : '' }}</span><h3>{{ strtoupper($event->name) }}</h3><span class="card-plus" aria-hidden="true">↗</span></div>
          </article>
        @empty
          <p class="content-empty">Dokumentasi event akan ditampilkan setelah data dan izin publikasinya dikonfirmasi.</p>
        @endforelse
      </div>
      @if($events->isNotEmpty())
        <p class="work-note">Foto dan informasi event dikelola oleh tim IMI.</p>
      @endif
      <div class="collaboration-row">
        <div><span class="eyebrow">RUANG KOLABORASI</span><h3>SIAP BERGERAK BERSAMA</h3></div>
        <div class="collaboration-types">
          @forelse($partners as $partner)
            @if($partner->website_url)<a href="{{ $partner->website_url }}" target="_blank" rel="noreferrer">@endif
              @if($partner->logo)
                <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($partner->logo) }}" alt="{{ $partner->name }}" loading="lazy">
              @else
                <span>{{ $partner->name }}</span>
              @endif
            @if($partner->website_url)</a>@endif
          @empty
            <p class="content-empty">Partner resmi akan ditampilkan setelah data dan izin publikasi dikonfirmasi.</p>
          @endforelse
        </div>
      </div>
      <section class="gallery" aria-labelledby="gallery-title">
        <div class="section-kicker"><span>07 / GALERI</span><span>DOKUMENTASI LAPANGAN</span></div>
        <h2 class="gallery-title" id="gallery-title">MOMEN DI <span>LAPANGAN.</span></h2>
        <div class="gallery-grid">
          @forelse($galleries as $image)
            <figure class="gallery-item">
              <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($image->image) }}" alt="{{ $image->title }}" loading="lazy">
              <figcaption>{{ $image->title }}@if($image->event) <span>{{ $image->event->name }}</span>@endif</figcaption>
            </figure>
          @empty
            <p class="content-empty">Galeri akan diisi setelah dokumentasi dan izin publikasi tersedia.</p>
          @endforelse
        </div>
      </section>
    </section>

    <section class="contact" id="kontak">
      <div class="contact-top section-wrap">
        <div class="section-kicker"><span>07 / MULAI DISKUSI</span><span>IKATAN MARSHALL INDONESIA</span></div>
        <div class="contact-grid"><h2>EVENT ANDA.<br><span>SIAP KAMI DUKUNG.</span></h2><div><p>Bagikan gambaran event, tanggal, dan kebutuhan tim Anda. Kami akan membantu memetakan dukungan yang sesuai.</p><a class="button button-lime" href="{{ $whatsappUrl }}" target="_blank" rel="noreferrer">Mulai percakapan WhatsApp <span aria-hidden="true">↗</span></a>
          @if($settings->get('contact_phone'))<small>Telepon: {{ $settings->get('contact_phone') }}</small>@endif
          @if($settings->get('contact_email'))<small>Email: <a href="mailto:{{ $settings->get('contact_email') }}">{{ $settings->get('contact_email') }}</a></small>@endif
          @if($settings->get('contact_address'))<small>Alamat: {{ $settings->get('contact_address') }}</small>@endif
          @if(!$settings->get('contact_whatsapp'))<small>Nomor WhatsApp resmi perlu dikonfigurasi pada menu Pengaturan.</small>@endif
        </div></div>
      </div>
      <footer class="site-footer section-wrap">
        <a class="brand footer-brand" href="#home" aria-label="IMI, kembali ke atas"><span class="brand-mark" aria-hidden="true">IMI</span><span class="brand-name">IKATAN MARSHALL<br>INDONESIA</span></a>
        <p class="footer-tag">#TREATWITHEMPATHY</p>
        <div class="footer-meta"><span>© 2026 Ikatan Marshall Indonesia</span><a href="#home">Kembali ke atas ↑</a></div>
      </footer>
    </section>
  </main>
</body>
</html>