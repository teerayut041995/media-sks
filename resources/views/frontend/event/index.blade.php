@extends('layouts.public')
@section('title', 'กิจกรรม')
@section('description', 'ติดตามภาพกิจกรรม การเรียนรู้ และการมีส่วนร่วมของศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์')
@section('content')
@php
    $eventHome = $eventPreview ? route('preview.home') : url('/');
    $eventIndex = $eventPreview ? route('preview.events') : url('/events');
    $eventDetailBase = $eventPreview ? url('/preview/events') : url('/events');
    $eventSearch = $active['name'] ?? '';
    $pageNumbers = [];
    if ($events->lastPage() > 1) {
        $pageNumbers = array_unique([1, $events->currentPage() - 1, $events->currentPage(), $events->currentPage() + 1, $events->lastPage()]);
        $pageNumbers = array_values(array_filter($pageNumbers, function ($page) use ($events) { return $page >= 1 && $page <= $events->lastPage(); }));
        sort($pageNumbers);
    }
@endphp
<main id="main" tabindex="-1" class="event-list-page">
    <section class="event-list-introduction" aria-labelledby="event-list-title">
        <div class="container">
            <nav class="breadcrumbs" aria-label="เส้นทางนำทาง"><a href="{{ $eventHome }}">หน้าหลัก</a><span aria-hidden="true">/</span><span aria-current="page">กิจกรรม</span></nav>
            <div class="event-list-hero">
                <div>
                    <p class="eyebrow">เรื่องราวจากศูนย์</p>
                    <h1 id="event-list-title">กิจกรรม</h1>
                    <p class="event-list-lead">ทุกช่วงเวลาของการเรียนรู้<br><span>คือเรื่องราวที่อยากแบ่งปัน</span></p>
                    <p class="event-list-description">ติดตามภาพกิจกรรม การเรียนรู้ และการมีส่วนร่วมของนักเรียน ครอบครัว บุคลากร และชุมชนจากศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</p>
                </div>
                <div class="event-list-hero-mark" aria-hidden="true"><span>ร่วมเรียนรู้</span><svg class="icon"><use href="#i-arrow"/></svg><span>ร่วมเติบโต</span></div>
            </div>
        </div>
    </section>
    <section class="event-list-section" id="event-results" aria-labelledby="event-results-title">
        <div class="container">
            <div class="event-list-toolbar">
                <div><p class="eyebrow">บันทึกภาพกิจกรรม</p><h2 id="event-results-title">{{ $eventSearch ? 'ผลการค้นหากิจกรรม' : 'กิจกรรมล่าสุด' }}</h2><p class="event-list-result-count" role="status">{{ $eventSearch ? 'คำค้น “'.$eventSearch.'” · ' : '' }}พบ {{ number_format($events->total()) }} รายการ</p></div>
                <form class="event-list-search" action="{{ $eventIndex }}" method="get" role="search">
                    <label for="event-search">ค้นหากิจกรรม</label>
                    <div class="event-list-search-row"><input id="event-search" name="name" type="search" value="{{ $eventSearch }}" placeholder="ชื่อกิจกรรมหรือรายละเอียด" autocomplete="off"><button type="submit">ค้นหา <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></button></div>
                    @if($eventSearch)<a class="event-list-clear" href="{{ $eventIndex }}">ล้างคำค้นหา</a>@endif
                </form>
            </div>
            @if($events->count())
                <div class="event-list-grid">
                    @foreach($events as $event)
                        @php
                            $eventUrl = $eventDetailBase.'/'.rawurlencode($event->uid);
                            $imageName = !empty($event->event_image) ? basename($event->event_image) : null;
                            $imagePath = $imageName ? 'images/image_event/'.$imageName : null;
                            $imageUrl = $imagePath ? (($eventPreview || !is_file(public_path($imagePath))) ? 'https://sks.go.th/'.$imagePath : asset($imagePath)) : null;
                            $summary = trim(preg_replace('/\\s+/u', ' ', html_entity_decode(strip_tags($event->event_description ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
                            $summary = str_limit($summary, $loop->first && $events->currentPage() === 1 ? 220 : 120);
                            $published = $event->created_at ? \Carbon\Carbon::parse($event->created_at) : null;
                        @endphp
                        <article class="event-list-card {{ $loop->first && $events->currentPage() === 1 ? 'event-list-card-featured' : '' }}">
                            <a class="event-list-media" href="{{ $eventUrl }}" aria-label="อ่านกิจกรรม: {{ $event->event_name }}">
                                @if($imageUrl)<img src="{{ $imageUrl }}" width="1290" height="726" alt="ภาพกิจกรรม {{ $event->event_name }}" loading="{{ $loop->first ? 'eager' : 'lazy' }}" decoding="async" data-image-fallback><span class="event-list-image-fallback image-fallback" hidden>ภาพกิจกรรม</span>@else<span class="event-list-image-fallback">ภาพกิจกรรม</span>@endif
                            </a>
                            <div class="event-list-card-body">
                                @if($loop->first && $events->currentPage() === 1)<span class="event-list-feature-label">{{ $eventSearch ? 'กิจกรรมที่พบ' : 'กิจกรรมล่าสุด' }}</span>@endif
                                @if($published)<p class="event-list-date">เผยแพร่ <time datetime="{{ $published->toDateString() }}">{{ formatDateThaiBirthday($event->created_at) }}</time></p>@endif
                                <h3><a href="{{ $eventUrl }}">{{ $event->event_name }}</a></h3>
                                @if($summary)<p class="event-list-summary">{{ $summary }}</p>@endif
                                <a class="event-list-read" href="{{ $eventUrl }}">ดูภาพและรายละเอียด <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a>
                            </div>
                        </article>
                    @endforeach
                </div>
                @if($events->lastPage() > 1)
                    <nav class="event-list-pagination" aria-label="หน้ารายการกิจกรรม">
                        @if($events->onFirstPage())<span class="event-page-edge is-disabled" aria-disabled="true">ก่อนหน้า</span>@else<a class="event-page-edge" href="{{ $events->previousPageUrl() }}" rel="prev">ก่อนหน้า</a>@endif
                        <div class="event-page-numbers">
                            @foreach($pageNumbers as $page)
                                @if(!$loop->first && $page > $pageNumbers[$loop->index - 1] + 1)<span class="event-page-ellipsis" aria-hidden="true">…</span>@endif
                                @if($page === $events->currentPage())<span class="event-page-number is-current" aria-current="page" aria-label="หน้า {{ $page }}">{{ $page }}</span>@else<a class="event-page-number" href="{{ $events->url($page) }}" aria-label="ไปหน้า {{ $page }}">{{ $page }}</a>@endif
                            @endforeach
                        </div>
                        @if($events->hasMorePages())<a class="event-page-edge" href="{{ $events->nextPageUrl() }}" rel="next">ถัดไป</a>@else<span class="event-page-edge is-disabled" aria-disabled="true">ถัดไป</span>@endif
                    </nav>
                @endif
            @else
                <div class="event-list-empty"><h3>{{ $eventSearch ? 'ไม่พบกิจกรรมที่ตรงกับคำค้นหา' : 'ยังไม่มีกิจกรรมเผยแพร่' }}</h3><p>{{ $eventSearch ? 'ลองใช้คำค้นอื่น หรือกลับไปดูกิจกรรมทั้งหมด' : 'โปรดกลับมาตรวจสอบอีกครั้ง' }}</p>@if($eventSearch)<a class="button button-outline" href="{{ $eventIndex }}">ดูกิจกรรมทั้งหมด <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a>@endif</div>
            @endif
        </div>
    </section>
</main>
@endsection
