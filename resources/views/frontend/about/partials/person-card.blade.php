<article class="person-card">
    <div class="person-portrait"><img src="{{ asset('images/home/executive/'.$person['image']) }}" width="{{ $person['width'] }}" height="{{ $person['height'] }}" alt="{{ $person['name'] }}" loading="lazy" decoding="async" data-image-fallback><span class="image-fallback" hidden>{{ $person['name'] }}</span></div>
    <div class="person-copy"><h3>@include('frontend.about.partials.person-name')</h3><p>{{ $person['role'] }}</p></div>
</article>
