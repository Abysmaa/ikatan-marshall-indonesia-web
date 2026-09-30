@extends('layouts.site')

@section('title', 'Galeri')
@section('description', 'Dokumentasi kegiatan lapangan Ikatan Marshall Indonesia.')

@section('content')
  <section class="page-shell">
    <div class="page-kicker"><span>GALERI</span><span>DOKUMENTASI LAPANGAN</span></div>
    <div class="page-heading"><div><p class="eyebrow">#TREATWITHEMPATHY</p><h1>Momen di <span>lapangan.</span></h1></div><p>Foto kegiatan yang sudah dikonfirmasi untuk dipublikasikan.</p></div>
    @if($galleries->isNotEmpty())
      <div class="gallery-grid gallery-page-grid">
        @foreach($galleries as $image)
          <figure class="gallery-item"><img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($image->image) }}" alt="{{ $image->title }}" loading="lazy"><figcaption>{{ $image->title }}@if($image->event) <span>{{ $image->event->name }}</span>@endif</figcaption></figure>
        @endforeach
      </div>
      {{ $galleries->links() }}
    @else
      <p class="content-empty">Galeri akan diisi setelah dokumentasi dan izin publikasi tersedia.</p>
    @endif
  </section>
@endsection