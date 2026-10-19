<article class="news-card" data-news-card data-category="{{ $story['type'] }}" @if($isAward) hidden @endif>
    <a class="news-image-link" href="{{ $story['preview_url'] }}" tabindex="-1" aria-hidden="true">
        @if($story['thumbnail'])<img src="{{ $story['thumbnail'] }}" alt="" width="410" height="231" loading="lazy" decoding="async" data-image-fallback><span class="image-fallback" hidden>ข่าวสารจากศูนย์</span>@else<span class="image-fallback">ข่าวสารจากศูนย์</span>@endif
    </a>
    <div class="news-body">
        <div class="news-meta"><span class="category-label">{{ $story['type'] }}</span><span class="meta-dot" aria-hidden="true"></span><time datetime="{{ $story['date'] }}">{{ $story['display_date'] }}</time></div>
        <h3><a href="{{ $story['preview_url'] }}">{{ $story['title'] }}</a></h3>
        <a class="text-link news-read" href="{{ $story['preview_url'] }}" aria-label="อ่านข่าว: {{ $story['title'] }}">อ่านเรื่องราว <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a>
    </div>
</article>
