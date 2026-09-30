<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach(['home', 'about', 'services.index', 'equipment.index', 'events.index', 'gallery.index', 'contact'] as $routeName)
    <url><loc>{{ route($routeName) }}</loc><lastmod>{{ now()->toAtomString() }}</lastmod></url>
  @endforeach
  @foreach($services as $service)
    <url><loc>{{ route('services.show', $service->slug) }}</loc><lastmod>{{ $service->updated_at->toAtomString() }}</lastmod></url>
  @endforeach
  @foreach($equipmentItems as $item)
    <url><loc>{{ route('equipment.show', $item->slug) }}</loc><lastmod>{{ $item->updated_at->toAtomString() }}</lastmod></url>
  @endforeach
  @foreach($events as $event)
    <url><loc>{{ route('events.show', $event->slug) }}</loc><lastmod>{{ $event->updated_at->toAtomString() }}</lastmod></url>
  @endforeach
</urlset>