<a class="skip-link" href="#main">ข้ามไปเนื้อหาหลัก</a>
<div class="utility-bar"><div class="container utility-inner"><span class="official-label">สังกัดสำนักบริหารงานการศึกษาพิเศษ · กระทรวงศึกษาธิการ</span><div class="utility-links"><a href="tel:{{ preg_replace('/[^0-9+]/', '', $publicPhone) }}"><svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>{{ $publicPhone }}</a><a href="mailto:{{ $publicEmail }}" class="utility-email">{{ $publicEmail }}</a><a href="#staff-links" class="staff-link">สำหรับบุคลากร <svg class="icon" aria-hidden="true"><use href="#i-diagonal"/></svg></a></div></div></div>
<header class="site-header has-disclosures"><div class="container header-inner">
    <a class="brand" href="{{ $publicHome }}" aria-label="หน้าหลัก ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"><img src="{{ asset('images/logo/sks-logo.png') }}" width="48" height="50" alt=""><span><strong>ศูนย์การศึกษาพิเศษ</strong><span class="brand-province">ประจำจังหวัดกาฬสินธุ์</span><span class="brand-en" lang="en">KALASIN SPECIAL EDUCATION CENTER</span></span></a>
    <button class="menu-toggle" type="button" aria-label="เมนู" aria-expanded="false" aria-controls="main-nav" id="menu-toggle"><svg class="icon menu-icon" aria-hidden="true"><use href="#i-menu"/></svg><svg class="icon close-icon" aria-hidden="true"><use href="#i-close"/></svg><span>เมนู</span></button>
    <nav class="main-nav" id="main-nav" aria-label="เมนูหลัก">
        <a href="{{ $publicHome }}">หน้าหลัก</a>
        @include('layouts.public.category-navigation', ['navCategories' => $category_menu, 'navPostsBase' => $publicPosts, 'navCurrentCategory' => $category->uid ?? null, 'navCurrentSubcategory' => $sub_category->uid ?? null])
        <a href="{{ $aboutPreview ? route('preview.events') : url('/events') }}" @if($aboutPage === 'events') aria-current="page" @endif>กิจกรรม</a>
        <div class="nav-disclosure">
            <button class="nav-trigger" type="button" aria-expanded="false" aria-controls="about-submenu" data-nav-disclosure @if(in_array($aboutPage, ['history', 'executive'], true)) data-active="true" @endif>เกี่ยวกับเรา <svg class="icon" aria-hidden="true"><use href="#i-chevron"/></svg></button>
            <div class="nav-disclosure-panel" id="about-submenu" hidden><a href="{{ $aboutBase.'/history' }}" @if($aboutPage === 'history') aria-current="page" @endif>ประวัติความเป็นมา</a><a href="{{ $aboutBase.'/executive' }}" @if($aboutPage === 'executive') aria-current="page" @endif>ฝ่ายบริหาร</a></div>
        </div>
        <a href="{{ $publicService }}" @if($aboutPage === 'services' && $serviceType === 'service_unit') aria-current="page" @endif>หน่วยบริการ</a>
        <a href="{{ $publicContact }}" @if($aboutPage === 'contact') aria-current="page" @endif>ติดต่อ</a>
    </nav>
</div></header>
