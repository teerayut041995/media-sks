@if(!empty($content['home']['banners']))
<section class="announcement-carousel" aria-label="แบนเนอร์ประกาศ" aria-roledescription="carousel" data-carousel data-interval="6000">
    <div class="carousel-stage">
        <div class="carousel-track" aria-live="off">
            @foreach($content['home']['banners'] as $banner)
                <div class="carousel-slide" style="--banner-background:{{ $banner['background'] ?? '#edf5fb' }}" role="group" aria-roledescription="slide" aria-label="{{ $loop->iteration }} จาก {{ $loop->count }}" aria-hidden="{{ $loop->first ? 'false' : 'true' }}">
                    @if(!empty($banner['url']))<a href="{{ $banner['url'] }}" tabindex="{{ $loop->first ? '0' : '-1' }}" aria-label="{{ $banner['alt'] }}">@endif
                    <img src="{{ $banner['image'] }}" alt="{{ $banner['alt'] }}" width="1920" height="640" loading="{{ $loop->first ? 'eager' : 'lazy' }}" decoding="async" @if($loop->first) fetchpriority="high" @endif draggable="false">
                    @if(!empty($banner['url']))</a>@endif
                </div>
            @endforeach
        </div>
        @if(count($content['home']['banners']) > 1)
            <div class="carousel-controls" hidden>
                <button class="carousel-control carousel-previous" type="button" data-carousel-previous aria-label="แบนเนอร์ก่อนหน้า"><svg class="icon" aria-hidden="true"><use href="#i-chevron"/></svg></button>
                <button class="carousel-control carousel-next" type="button" data-carousel-next aria-label="แบนเนอร์ถัดไป"><svg class="icon" aria-hidden="true"><use href="#i-chevron"/></svg></button>
            </div>
            <span class="screen-reader-only" role="status" data-carousel-status></span>
        @endif
    </div>
</section>
@endif
