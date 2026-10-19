@php($homeAnchor = isset($article) ? route('preview.home') : '')
<a class="skip-link" href="#main">ข้ามไปเนื้อหาหลัก</a>
<div class="utility-bar">
    <div class="container utility-inner">
        <span class="official-label">สังกัดสำนักบริหารงานการศึกษาพิเศษ · กระทรวงศึกษาธิการ</span>
        <div class="utility-links">
            <a href="tel:043840099"><svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>043-840-099</a>
            <a href="mailto:ksped400@gmail.com" class="utility-email">ksped400@gmail.com</a>
            <a href="#staff-links" class="staff-link">สำหรับบุคลากร <svg class="icon" aria-hidden="true"><use href="#i-diagonal"/></svg></a>
        </div>
    </div>
</div>
<header class="site-header has-disclosures">
    <div class="container header-inner">
        <a class="brand" href="{{ route('preview.home') }}" aria-label="หน้าหลัก ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
            <img src="{{ asset('images/logo/sks-logo.png') }}" width="48" height="50" alt="">
            <span><strong>ศูนย์การศึกษาพิเศษ</strong><span class="brand-province">ประจำจังหวัดกาฬสินธุ์</span><span class="brand-en" lang="en">KALASIN SPECIAL EDUCATION CENTER</span></span>
        </a>
        <button class="menu-toggle" type="button" aria-label="เมนู" aria-expanded="false" aria-controls="main-nav" id="menu-toggle">
            <svg class="icon menu-icon" aria-hidden="true"><use href="#i-menu"/></svg>
            <svg class="icon close-icon" aria-hidden="true"><use href="#i-close"/></svg><span>เมนู</span>
        </button>
        <nav class="main-nav" id="main-nav" aria-label="เมนูหลัก">
            <a href="{{ route('preview.home') }}" @if(!isset($article)) aria-current="page" @endif>หน้าหลัก</a>
            @include('layouts.public.category-navigation', ['navCategories' => json_decode(file_get_contents(resource_path('data/category-menu-preview.json')), true), 'navPostsBase' => route('preview.posts'), 'navCurrentCategory' => null, 'navCurrentSubcategory' => null])
            <a href="{{ route('preview.events') }}">กิจกรรม</a>
            <div class="nav-disclosure"><button class="nav-trigger" type="button" aria-expanded="false" aria-controls="about-submenu" data-nav-disclosure>เกี่ยวกับเรา <svg class="icon" aria-hidden="true"><use href="#i-chevron"/></svg></button><div class="nav-disclosure-panel" id="about-submenu" hidden><a href="{{ route('preview.about', ['page' => 'history']) }}">ประวัติความเป็นมา</a><a href="{{ route('preview.about', ['page' => 'executive']) }}">ฝ่ายบริหาร</a></div></div>
            <a href="{{ route('preview.services', ['service_type' => 'service_unit']) }}">หน่วยบริการ</a>
            <a href="{{ route('preview.contact') }}">ติดต่อ</a>
        </nav>
    </div>
</header>
