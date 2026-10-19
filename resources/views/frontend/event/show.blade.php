@extends('layouts.public')
@section('title', e($event->event_name))
@section('description', e($eventMetaDescription))
@section('content')
@php
    $eventHome = $eventPreview ? route('preview.home') : url('/');
    $eventList = $eventPreview ? route('preview.events') : url('/events');
    $mediaUrl = function ($folder, $filename) use ($eventPreview) {
        if (!$filename) return null;
        $path = $folder.'/'.basename($filename);
        return ($eventPreview || !is_file(public_path($path))) ? 'https://sks.go.th/'.$path : asset($path);
    };
    $mainImageUrl = $mediaUrl('images/image_event', $event->event_image);
    $galleryImages = $images->filter(function ($image) { return !empty($image->image_name); })->values();
    $rawDescription = preg_replace('~<(script|style)\b[^>]*>.*?</\1>~is', '', (string) $event->event_description);
    $rawDescription = preg_replace('~<br\s*/?>~i', "\n", $rawDescription);
    $rawDescription = preg_replace('~</(?:p|div|li|h[1-6])\s*>~i', "\n\n", $rawDescription);
    $description = trim(html_entity_decode(strip_tags($rawDescription), ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    $description = preg_replace("/\n{3,}/", "\n\n", $description);
    $eventDate = $event->event_date ? createDateThai($event->event_date) : null;
    $published = $event->created_at ? \Carbon\Carbon::parse($event->created_at) : null;
@endphp
<main id="main" tabindex="-1" class="event-detail-page">
    <section class="event-detail-introduction" aria-labelledby="event-detail-title">
        <div class="container">
            <nav class="breadcrumbs" aria-label="เส้นทางนำทาง"><a href="{{ $eventHome }}">หน้าหลัก</a><span aria-hidden="true">/</span><a href="{{ $eventList }}">กิจกรรม</a><span aria-hidden="true">/</span><span aria-current="page">รายละเอียดกิจกรรม</span></nav>
            <div class="event-detail-heading">
                <p class="eyebrow">ภาพกิจกรรมจากศูนย์</p>
                <h1 id="event-detail-title">{{ $event->event_name }}</h1>
                <div class="event-detail-meta" aria-label="ข้อมูลกิจกรรม">
                    @if($eventDate)<div><span>วันที่จัดกิจกรรม</span><strong>{{ $eventDate }}</strong></div>@endif
                    @if($event->event_location)<div><span>สถานที่</span><strong>{{ $event->event_location }}</strong></div>@endif
                    @if($published)<div><span>เผยแพร่เมื่อ</span><strong><time datetime="{{ $published->toDateString() }}">{{ formatDateThaiBirthday($event->created_at) }}</time></strong></div>@endif
                    @if($event->name)<div><span>เผยแพร่โดย</span><strong>{{ $event->name }}</strong></div>@endif
                </div>
            </div>
        </div>
    </section>

    @if($mainImageUrl)
        <div class="event-detail-cover-wrap"><div class="container"><figure class="event-detail-cover"><img src="{{ $mainImageUrl }}" width="1290" height="726" alt="ภาพหลักของกิจกรรม {{ $event->event_name }}" decoding="async" data-image-fallback><figcaption class="image-fallback" hidden>ภาพหลักของกิจกรรม</figcaption></figure></div></div>
    @endif

    <section class="event-detail-story" aria-labelledby="event-story-title">
        <div class="container event-detail-story-layout">
            <article class="event-detail-story-content">
                <p class="eyebrow">รายละเอียดกิจกรรม</p>
                <h2 id="event-story-title">เรื่องราวของกิจกรรม</h2>
                @if($description)<p class="event-detail-description">{{ $description }}</p>@else<p class="event-detail-description">ติดตามภาพบรรยากาศของกิจกรรมได้ด้านล่าง</p>@endif
            </article>
            <aside class="event-detail-guide" aria-label="สำรวจหน้านี้">
                <span class="event-detail-guide-label">ในหน้านี้</span>
                @if($galleryImages->isNotEmpty())<a href="#event-gallery">ชมภาพกิจกรรม <span>{{ $galleryImages->count() }} ภาพ</span><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a>@endif
                <a href="{{ $eventList }}">ดูกิจกรรมทั้งหมด <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a>
                @if($views !== null)<p>เข้าชม {{ number_format($views) }} ครั้ง</p>@endif
            </aside>
        </div>
    </section>

    @if($galleryImages->isNotEmpty())
        <section class="event-detail-gallery" id="event-gallery" tabindex="-1" aria-labelledby="event-gallery-title">
            <div class="container">
                <div class="event-detail-section-heading"><div><p class="eyebrow">บรรยากาศและความทรงจำ</p><h2 id="event-gallery-title">ภาพกิจกรรม</h2></div><span>{{ $galleryImages->count() }} ภาพ</span></div>
                <div class="event-detail-gallery-grid">
                    @foreach($galleryImages as $image)
                        @php $galleryUrl = $mediaUrl('images/image_event/more_image', $image->image_name); @endphp
                        <figure class="event-detail-photo">
                            <a href="{{ $galleryUrl }}" target="_blank" rel="noopener" data-event-gallery="{{ $loop->index }}" aria-label="ขยายภาพกิจกรรมลำดับที่ {{ $loop->iteration }} จาก {{ $galleryImages->count() }}">
                                <img src="{{ $galleryUrl }}" width="2048" height="1365" alt="ภาพกิจกรรม {{ $loop->iteration }} จาก {{ $galleryImages->count() }}: {{ $event->event_name }}" loading="lazy" decoding="async" data-image-fallback><span class="image-fallback" hidden>ภาพกิจกรรม {{ $loop->iteration }}</span>
                                <span class="event-detail-photo-index" aria-hidden="true">{{ sprintf('%02d', $loop->iteration) }}</span>
                            </a>
                        </figure>
                    @endforeach
                </div>
            </div>
        </section>
        <dialog class="event-gallery-dialog" id="event-gallery-dialog" aria-label="ดูภาพกิจกรรมขนาดเต็ม">
            <div class="event-gallery-dialog-inner">
                <div class="event-gallery-dialog-toolbar"><span id="event-gallery-position" aria-live="polite"></span><button type="button" class="event-gallery-close" data-event-gallery-close aria-label="ปิดภาพขนาดเต็ม"><svg class="icon" aria-hidden="true"><use href="#i-close"/></svg></button></div>
                <div class="event-gallery-dialog-stage"><button type="button" class="event-gallery-previous" data-event-gallery-previous aria-label="ภาพก่อนหน้า"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></button><img id="event-gallery-large-image" alt=""><button type="button" class="event-gallery-next" data-event-gallery-next aria-label="ภาพถัดไป"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></button></div>
            </div>
        </dialog>
    @endif

    <div class="container event-detail-back"><a href="{{ $eventList }}"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>กลับไปดูกิจกรรมทั้งหมด</a></div>
</main>
@endsection
