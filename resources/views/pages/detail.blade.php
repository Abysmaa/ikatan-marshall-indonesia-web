@extends('layouts.site')

@section('title', $record->name)
@section('description', $description ?: $record->name.' — Ikatan Marshall Indonesia.')

@section('content')
  <article class="page-shell detail-page">
    <div class="page-kicker"><span>{{ strtoupper($kind) }}</span><span>IKATAN MARSHALL INDONESIA</span></div>
    <div class="detail-heading">
      <div><p class="eyebrow">#TREATWITHEMPATHY</p><h1>{{ $record->name }}<span>.</span></h1></div>
      @if(isset($availability))<p class="availability-label">{{ $availability }}</p>@endif
      @if($record->event_date ?? false)<p class="availability-label">{{ $record->event_date->format('d F Y') }}@if($record->location) · {{ $record->location }}@endif</p>@endif
    </div>
    <div class="detail-content">
      @if($image)
        <img class="detail-image" src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($image) }}" alt="{{ $record->name }}">
      @else
        <div class="detail-image detail-image--empty" aria-hidden="true">{{ strtoupper($kind) }}</div>
      @endif
      <div class="detail-copy">
        <p>{{ $description ?: 'Informasi lebih lanjut dapat dikonfirmasi bersama tim Ikatan Marshall Indonesia.' }}</p>
        <a class="button button-lime" href="{{ route('contact') }}">Hubungi kami <span aria-hidden="true">↗</span></a>
      </div>
    </div>
    @if(isset($record->galleries) && $record->galleries->isNotEmpty())
      <div class="detail-gallery">
        @foreach($record->galleries as $image)
          <figure><img src="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($image->image) }}" alt="{{ $image->title }}" loading="lazy"><figcaption>{{ $image->title }}</figcaption></figure>
        @endforeach
      </div>
    @endif
    <a class="underlined-link" href="{{ route($backRoute) }}">← {{ $backLabel }}</a>
  </article>
@endsection