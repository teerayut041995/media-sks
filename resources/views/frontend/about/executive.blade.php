@extends('layouts.public')
@section('title', 'ฝ่ายบริหาร')
@section('description', 'รายชื่อและตำแหน่งผู้อำนวยการ รองผู้อำนวยการ และหัวหน้ากลุ่มงานของศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์')
@section('content')
<main id="main" tabindex="-1" class="about-page executive-page">
    @include('frontend.about.partials.page-navigation')
    <section class="executive-introduction"><div class="container"><nav class="breadcrumbs" aria-label="เส้นทางนำทาง"><a href="{{ $aboutPreview ? route('preview.home') : url('/') }}">หน้าหลัก</a><span aria-hidden="true">/</span><span>เกี่ยวกับเรา</span><span aria-hidden="true">/</span><span aria-current="page">ฝ่ายบริหาร</span></nav><div class="executive-intro-grid"><div><h1>ฝ่ายบริหาร</h1><p class="about-lead">ผู้บริหารและหัวหน้ากลุ่มงาน</p><p class="about-intro-description">ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</p></div><nav class="executive-jump-links" aria-label="เลือกกลุ่มฝ่ายบริหาร"><a href="#director">ผู้อำนวยการ</a><a href="#deputies">รองผู้อำนวยการ</a><a href="#team-leads">หัวหน้ากลุ่มงาน</a></nav></div></div></section>
    <div class="container executive-content">
        <section id="director" tabindex="-1" class="leadership-section" aria-labelledby="director-title"><div class="leadership-section-heading"><span class="eyebrow">ผู้นำของศูนย์</span><h2 id="director-title">ผู้อำนวยการ</h2></div>
            @foreach($about['leaders'] as $person)
                @if($person['group'] === 'director')<article class="director-card"><div class="director-portrait"><img src="{{ asset('images/home/executive/'.$person['image']) }}" width="{{ $person['width'] }}" height="{{ $person['height'] }}" alt="{{ $person['name'] }}" decoding="async" fetchpriority="high" data-image-fallback><span class="image-fallback" hidden>{{ $person['name'] }}</span></div><div class="director-copy"><span class="director-label">ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</span><h3>@include('frontend.about.partials.person-name')</h3><p>{{ $person['role'] }}</p><div class="director-rule" aria-hidden="true"></div><a class="text-link" href="{{ $aboutPreview ? route('preview.contact') : url('/contact') }}">ช่องทางติดต่อศูนย์ <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></div></article>@endif
            @endforeach
        </section>
        <section id="deputies" tabindex="-1" class="leadership-section" aria-labelledby="deputies-title"><div class="leadership-section-heading"><span class="eyebrow">ฝ่ายบริหาร</span><h2 id="deputies-title">รองผู้อำนวยการ</h2></div><div class="deputy-grid">@foreach($about['leaders'] as $person)
                @if($person['group'] === 'deputy')@include('frontend.about.partials.person-card')@endif
            @endforeach</div></section>
        <section id="team-leads" tabindex="-1" class="leadership-section" aria-labelledby="leads-title"><div class="leadership-section-heading"><span class="eyebrow">ผู้รับผิดชอบกลุ่มงาน</span><h2 id="leads-title">หัวหน้ากลุ่มงาน</h2></div><div class="team-leads-grid">@foreach($about['leaders'] as $person)
                @if($person['group'] === 'lead')@include('frontend.about.partials.person-card')@endif
            @endforeach</div></section>
        <div class="about-next-page"><div><p class="eyebrow">เรื่องราวของศูนย์</p><h2>จากจุดเริ่มต้นสู่วันนี้</h2></div><a class="button button-outline" href="{{ $aboutPreview ? route('preview.about', ['page' => 'history']) : url('/about/history') }}">อ่านประวัติความเป็นมา <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></div>
    </div>
</main>
@endsection
