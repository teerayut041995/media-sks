{{-- Shared by the live homepage and its database-free design preview. --}}
@extends('layouts.public')
@section('title', 'ข่าวสาร กิจกรรม และข้อมูลศูนย์')
@section('description', 'ติดตามข่าวสาร กิจกรรม หน่วยบริการ คลังความรู้ และเอกสารจากศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์')
@section('content')
@php
    $homeUrl = $aboutPreview ? route('preview.home') : url('/');
    $postsUrl = $aboutPreview ? route('preview.posts') : url('/posts');
    $eventsUrl = $aboutPreview ? route('preview.events') : url('/events');
    $serviceUrl = $aboutPreview ? route('preview.services', ['service_type' => 'service_unit']) : url('/services?service_type=service_unit');
    $aboutUrl = $aboutPreview ? route('preview.about', ['page' => 'history']) : url('/about/history');
    $categoryUid = function ($name) use ($category_menu) {
        $item = collect($category_menu)->first(function ($entry) use ($name) { return data_get($entry, 'category_name') === $name; });
        return $item ? data_get($item, 'uid') : null;
    };
    $categoryUrl = function ($name) use ($postsUrl, $categoryUid) {
        $uid = $categoryUid($name);
        return $uid ? $postsUrl.'?'.http_build_query(['category' => $uid]) : $postsUrl;
    };
    $searchUrl = function ($parameters) use ($homeUrl) { return $homeUrl.'?'.http_build_query($parameters); };
@endphp
<main id="main" tabindex="-1">
    @include('frontend.preview.partials.announcement-slider')
    <section class="hero" aria-labelledby="hero-title">
        <div class="container">
            <div class="hero-intro">
                <div><h1 id="hero-title">ทุกความเคลื่อนไหวของศูนย์</h1><p class="hero-description">ติดตามข่าว กิจกรรม และข้อมูลที่เป็นประโยชน์</p></div>
                <div class="hero-search">
                    <form action="{{ $homeUrl }}#search-results" method="get" role="search">
                        <label for="site-search">ค้นหาข่าวและข้อมูลศูนย์</label>
                        <div class="search-field"><svg class="icon" aria-hidden="true"><use href="#i-search"/></svg><input id="site-search" name="q" type="search" value="{{ $query }}" maxlength="120" placeholder="ค้นหาข่าว เอกสาร หรือข้อมูลศูนย์" required><button type="submit" aria-label="ค้นหาข่าวและข้อมูลศูนย์"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></button></div>
                    </form>
                    <p class="search-suggestions">ทางลัดการค้นหา <a href="{{ $searchUrl(['q' => 'ใบสมัคร']) }}#search-results">ใบสมัคร</a><a href="{{ $searchUrl(['q' => 'หน่วยบริการ']) }}#search-results">หน่วยบริการ</a></p>
                </div>
            </div>
            @if($query !== '')
                <section class="search-results" id="search-results" aria-labelledby="results-title">
                    <div class="section-heading"><div><p class="eyebrow">ผลการค้นหา</p><h2 id="results-title" tabindex="-1">“{{ $query }}”</h2><p class="section-description">พบ {{ number_format($total) }} รายการ จากชื่อเรื่องและสรุปข้อมูล{{ $aboutPreview ? 'ในชุดต้นแบบทุกช่วงเวลา' : 'ที่เผยแพร่บนเว็บไซต์' }}</p></div><a class="text-link" href="{{ $homeUrl }}">ล้างการค้นหา <svg class="icon" aria-hidden="true"><use href="#i-close"/></svg></a></div>
                    @if($total)
                        <div class="result-list">
                            @foreach($results as $result)
                                <article class="result-row"><div><span class="category-label">{{ $result['type'] }}</span><h3><a href="{{ $result['preview_url'] }}">{{ $result['title'] }}</a></h3><p>{{ $result['summary'] }}</p>@if($result['date'])<time datetime="{{ $result['date'] }}">{{ $result['display_date'] }}</time>@endif</div><a class="round-link" href="{{ $result['preview_url'] }}" aria-label="เปิด: {{ $result['title'] }}"><svg class="icon" aria-hidden="true"><use href="#i-diagonal"/></svg></a></article>
                            @endforeach
                        </div>
                        @if($pages > 1)
                            <nav class="search-pagination" aria-label="หน้าผลการค้นหา">@if($page > 1)<a class="button button-outline" href="{{ $searchUrl(['q' => $query, 'page' => $page - 1]) }}#search-results">ก่อนหน้า</a>@endif<span>หน้า {{ $page }} จาก {{ $pages }}</span>@if($page < $pages)<a class="button button-outline" href="{{ $searchUrl(['q' => $query, 'page' => $page + 1]) }}#search-results">ถัดไป <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a>@endif</nav>
                        @endif
                    @else
                        <div class="search-empty"><svg class="icon" aria-hidden="true"><use href="#i-search"/></svg><h3>ยังไม่พบข้อมูลที่ตรงกับคำค้น</h3><p>ลองใช้คำสั้นลง เช่น “ใบสมัคร” หรือ “กิจกรรม”<br>คุณสามารถดูข่าวล่าสุด หรือสอบถามข้อมูลกับศูนย์ได้</p><a class="button button-primary" href="#news">ดูข่าวล่าสุด <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></div>
                    @endif
                </section>
            @endif
        </div>
    </section>
    <section class="news-section section-space" id="news" aria-labelledby="news-title">
        <div class="container">
            <div class="section-heading"><div><p class="eyebrow">อัปเดตจากศูนย์</p><h2 id="news-title">ข่าวสารล่าสุด<span class="heading-dot" aria-hidden="true">.</span></h2><p class="section-description">ความเคลื่อนไหว ผลงาน และความร่วมมือเพื่อพัฒนาการศึกษา</p></div><a class="text-link section-all-link" href="{{ $categoryUrl('ประชาสัมพันธ์') }}">ดูข่าวทั้งหมด <svg class="icon" aria-hidden="true"><use href="#i-diagonal"/></svg></a></div>
            @if($featured)
            <article class="featured-story" aria-labelledby="featured-title">
                <div class="featured-image">@if($featured['image'])<img src="{{ $featured['image'] }}" width="1290" height="726" alt="ภาพประกอบ {{ $featured['title'] }}" loading="lazy" decoding="async" data-image-fallback><span class="image-fallback" hidden>ข่าวเด่นจากศูนย์</span>@else<span class="image-fallback">ข่าวเด่นจากศูนย์</span>@endif</div>
                <div class="featured-content"><div class="news-meta"><span class="category-label">ข่าวเด่น · ประชาสัมพันธ์</span><span class="meta-dot" aria-hidden="true"></span><time datetime="{{ $featured['date'] }}">{{ $featured['display_date'] }}</time></div><h2 id="featured-title"><a href="{{ $featured['preview_url'] }}">{{ $featured['title'] }}</a></h2><a class="text-link featured-read" href="{{ $featured['preview_url'] }}">อ่านข่าวฉบับเต็ม <span class="round-arrow"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></span></a></div>
            </article>
            @endif
            <div class="news-toolbar"><div class="news-filters" role="group" aria-label="เลือกประเภทข่าว"><button type="button" class="filter-button" data-news-filter="all" aria-pressed="true">ข่าวประชาสัมพันธ์</button><button type="button" class="filter-button" data-news-filter="รางวัลและผลงาน" aria-pressed="false">รางวัลและผลงาน</button></div><span id="news-status" class="news-count" role="status">{{ count($latest) }} เรื่องล่าสุด</span></div>
            <div class="news-grid">@foreach($latest as $story)@include('frontend.preview.partials.news-card', ['story' => $story, 'isAward' => false])@endforeach @foreach($awards as $story)@include('frontend.preview.partials.news-card', ['story' => $story, 'isAward' => true])@endforeach</div>
            <noscript><p class="no-script-note">แสดงข่าวประชาสัมพันธ์ล่าสุด · <a href="{{ $categoryUrl('รางวัลและผลงาน') }}">ดูรางวัลและผลงาน</a></p></noscript>
        </div>
    </section>
    <section class="about-section" id="about" aria-labelledby="about-title">
        <div class="container about-grid">
            <div class="about-content"><p class="eyebrow">รู้จักศูนย์ของเรา</p><h2 id="about-title">เพราะทุกคนมีศักยภาพ<br><span>ที่จะเรียนรู้และเติบโต</span></h2><p>ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ จัดและส่งเสริมการศึกษาเพื่อเด็กพิการ ให้บริการช่วยเหลือระยะแรกเริ่ม ฟื้นฟูสมรรถภาพ และเตรียมความพร้อมเพื่อส่งต่อเข้าสู่การศึกษาอย่างเหมาะสม</p><div class="about-founding"><span class="founding-year">2543</span><span>ปีที่ก่อตั้ง<br>31 กรกฎาคม พ.ศ. 2543</span></div><a class="button button-primary" href="{{ $aboutUrl }}">รู้จักศูนย์ให้มากขึ้น <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></div>
            <figure class="about-image"><img src="{{ asset('images/kalasin1.jpg') }}" width="2048" height="1536" alt="อาคารและพื้นที่สีเขียวของศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์" loading="lazy" decoding="async"><figcaption><span class="about-caption-mark" aria-hidden="true"></span><span>พื้นที่แห่งการเรียนรู้<br><strong>ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</strong></span></figcaption></figure>
        </div>
    </section>
    <section class="events-section section-space" id="events" aria-labelledby="events-title">
        <div class="container"><div class="section-heading"><div><p class="eyebrow">เรื่องราวในรั้วศูนย์</p><h2 id="events-title">ภาพกิจกรรม<span class="heading-dot" aria-hidden="true">.</span></h2><p class="section-description">เรียนรู้ เติบโต และสร้างช่วงเวลาดี ๆ ไปด้วยกัน</p></div><a class="text-link section-all-link" href="{{ $eventsUrl }}">ดูกิจกรรมทั้งหมด <svg class="icon" aria-hidden="true"><use href="#i-diagonal"/></svg></a></div><div class="events-grid">
            @foreach($events as $event)<article class="event-card"><a href="{{ $event['preview_url'] }}" class="event-image-link" tabindex="-1" aria-hidden="true"><img src="{{ $event['image'] }}" alt="" width="1290" height="726" loading="lazy" decoding="async" data-image-fallback><span class="image-fallback" hidden>กิจกรรมของศูนย์</span></a><div class="event-body"><time class="event-date" datetime="{{ $event['date'] }}"><span>{{ (int) substr($event['date'], 8, 2) }}</span>{{ explode(' ', $event['display_date'])[1] }}<small>{{ explode(' ', $event['display_date'])[2] }}</small></time><div><h3><a href="{{ $event['preview_url'] }}">{{ $event['title'] }}</a></h3><a class="text-link" href="{{ $event['preview_url'] }}" aria-label="ดูภาพกิจกรรม: {{ $event['title'] }}">ดูภาพกิจกรรม <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></div></div></article>@endforeach
        </div></div>
    </section>
    <section class="resources-section" id="resources" aria-labelledby="resources-title">
        <div class="container"><div class="section-heading"><div><p class="eyebrow">ข้อมูลที่เป็นประโยชน์</p><h2 id="resources-title">เข้าถึงสิ่งที่คุณต้องการ</h2></div><p class="resource-intro">ข้อมูลบริการ ความรู้ และเอกสาร<br>สำหรับผู้ปกครอง ประชาชน และเครือข่าย</p></div><div class="resource-grid">
            <a class="resource-link" href="{{ $serviceUrl }}"><span class="resource-icon"><svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg></span><h3>หน่วยบริการ</h3><p>ค้นหาข้อมูลและช่องทางติดต่อ<br>หน่วยบริการของศูนย์</p><span class="text-link">ดูหน่วยบริการ <svg class="icon" aria-hidden="true"><use href="#i-diagonal"/></svg></span></a>
            <a class="resource-link" href="{{ $categoryUrl('คลังความรู้') }}"><span class="resource-icon"><svg class="icon" aria-hidden="true"><use href="#i-book"/></svg></span><h3>คลังความรู้</h3><p>ความรู้ สื่อ และแนวทาง<br>เพื่อสนับสนุนการจัดการศึกษา</p><span class="text-link">สำรวจคลังความรู้ <svg class="icon" aria-hidden="true"><use href="#i-diagonal"/></svg></span></a>
            <a class="resource-link" href="{{ $categoryUrl('ดาวน์โหลด') }}"><span class="resource-icon"><svg class="icon" aria-hidden="true"><use href="#i-file"/></svg></span><h3>เอกสารและแบบฟอร์ม</h3><p>ใบสมัครขอรับบริการ แบบคัดกรอง<br>และเอกสารที่เกี่ยวข้อง</p><span class="text-link">ดูเอกสารทั้งหมด <svg class="icon" aria-hidden="true"><use href="#i-diagonal"/></svg></span></a>
        </div>@if(!empty($documents))<div class="document-highlight"><div><svg class="icon" aria-hidden="true"><use href="#i-file"/></svg><span>เอกสารล่าสุด</span><strong>{{ $documents[0]['title'] }}</strong></div><a class="text-link" href="{{ $documents[0]['url'] }}">เปิดหน้าเอกสาร <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></div>@endif</div>
    </section>
</main>
@endsection
