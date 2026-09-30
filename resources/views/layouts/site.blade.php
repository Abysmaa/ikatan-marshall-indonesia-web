<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="@yield('description', 'Informasi resmi Ikatan Marshall Indonesia.')">
  <meta name="theme-color" content="#ffffff">
  <meta property="og:title" content="@yield('title', 'Ikatan Marshall Indonesia') | IMI">
  <meta property="og:description" content="@yield('description', 'Informasi resmi Ikatan Marshall Indonesia.')">
  <meta property="og:type" content="website">
  <link rel="canonical" href="{{ url()->current() }}">
  <title>@yield('title', 'Ikatan Marshall Indonesia') | IMI</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700;800&family=DM+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('styles.css') }}">
  <link rel="stylesheet" href="{{ asset('pages.css') }}">
  <script src="{{ asset('script.js') }}" defer></script>
</head>
<body class="interior">
  <a class="skip-link" href="#main">Langsung ke konten</a>
  <header class="site-header">
    <a class="brand" href="{{ route('home') }}" aria-label="IMI, kembali ke beranda">
      <span class="brand-mark" aria-hidden="true">IMI</span>
      <span class="brand-name">IKATAN MARSHALL<br>INDONESIA</span>
    </a>
    <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="primary-nav" aria-label="Buka menu">
      <span></span><span></span>
    </button>
    <nav class="primary-nav" id="primary-nav" aria-label="Navigasi utama">
      <a href="{{ route('about') }}">Tentang</a>
      <a href="{{ route('services.index') }}">Layanan</a>
      <a href="{{ route('equipment.index') }}">Perlengkapan</a>
      <a href="{{ route('events.index') }}">Event</a>
      <a href="{{ route('gallery.index') }}">Galeri</a>
      <a class="nav-cta" href="{{ route('contact') }}">Hubungi kami <span aria-hidden="true">↗</span></a>
    </nav>
  </header>

  <main id="main">
    @yield('content')
  </main>

  <footer class="site-footer section-wrap">
    <a class="brand footer-brand" href="{{ route('home') }}" aria-label="IMI, kembali ke beranda">
      <span class="brand-mark" aria-hidden="true">IMI</span>
      <span class="brand-name">IKATAN MARSHALL<br>INDONESIA</span>
    </a>
    <p class="footer-tag">#TREATWITHEMPATHY</p>
    <div class="footer-meta"><span>© {{ now()->year }} Ikatan Marshall Indonesia</span><a href="{{ route('home') }}">Beranda ↑</a></div>
  </footer>
</body>
</html>