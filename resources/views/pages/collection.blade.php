@extends('layouts.site')

@section('title', $title)
@section('description', $description)

@section('content')
  <section class="page-shell">
    <div class="page-kicker"><span>IKATAN MARSHALL INDONESIA</span><span>{{ strtoupper($kind) }}</span></div>
    <div class="page-heading">
      <div><p class="eyebrow">#TREATWITHEMPATHY</p><h1>{{ $title }}<span>.</span></h1></div>
      <p>{{ $description }}</p>
    </div>

    @if($records->isNotEmpty())
      <div class="page-grid">
        @foreach($records as $record)
          @php
            $image = $record->image ?? $record->thumbnail ?? $record->logo;
            $summary = $record->short_description ?? $record->description ?? null;
          @endphp
          <a class="page-card" href="{{ route($detailRoute, $record->slug) }}">
            @if($image)
              <img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($image) }}" alt="{{ $record->name }}" loading="lazy">
            @else
              <span class="page-card-mark" aria-hidden="true">{{ sprintf('%02d', $loop->iteration) }}</span>
            @endif
            <div class="page-card-body">
              <span class="page-card-kicker">{{ strtoupper($kind) }} / {{ sprintf('%02d', $loop->iteration) }}</span>
              <h2>{{ $record->name }}</h2>
              @if($record->event_date ?? false)<p class="page-card-meta">{{ $record->event_date->format('d.m.Y') }}@if($record->location) · {{ $record->location }}@endif</p>@endif
              @if($record->availability ?? false)<p class="page-card-meta">{{ $record->availability }}</p>@endif
              <p>{{ $summary ?: 'Hubungi IMI untuk informasi lebih lanjut.' }}</p>
              <span class="page-card-link">Lihat detail <span aria-hidden="true">↗</span></span>
            </div>
          </a>
        @endforeach
      </div>
    @else
      <p class="content-empty">{{ $kind }} belum tersedia untuk ditampilkan.</p>
    @endif
    <a class="button button-lime page-back" href="{{ route('contact') }}">Diskusikan kebutuhan event <span aria-hidden="true">↗</span></a>
  </section>
@endsection