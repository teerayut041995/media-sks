@extends('layouts.public')
@section('title', $service->service_name)
@section('description', str_limit(strip_tags($service->service_description), 155))

@section('content')
@php
    $serviceImageUrl = function ($image) {
        if (!$image || !$image->service_image_file_name) return null;
        $path = 'images/service/'.basename($image->service_image_file_name);
        return is_file(public_path($path)) ? asset($path) : 'https://sks.go.th/'.$path;
    };
    $bannerUrl = $serviceImageUrl($image_banner);
    $previewOneUrl = $serviceImageUrl($image_preview_1);
    $previewTwoUrl = $serviceImageUrl($image_preview_2);
    $servicePhone = preg_replace('/[^0-9+]/', '', (string) $service->service_contact_phone_number);
    $serviceHome = $aboutPreview ? route('preview.home') : url('/');
    $serviceListUrl = $aboutPreview ? route('preview.services', ['service_type' => $serviceType]) : url('/services?service_type='.rawurlencode($serviceType));
    $mapUrl = null;
    if (preg_match('~<iframe[^>]+src=["\']([^"\']+)~i', (string) $service->service_embed_map, $mapMatch)) {
        $candidate = html_entity_decode($mapMatch[1], ENT_QUOTES, 'UTF-8');
        $mapParts = parse_url($candidate);
        if (($mapParts['scheme'] ?? '') === 'https' && in_array(($mapParts['host'] ?? ''), ['www.google.com', 'google.com', 'maps.google.com'], true) && strpos(($mapParts['path'] ?? ''), '/maps/embed') === 0) {
            $mapUrl = $candidate;
        }
    }
@endphp
<main id="main" tabindex="-1" class="service-detail-page">
    <section class="service-detail-introduction" aria-labelledby="service-detail-title">
        <div class="container">
            <nav class="breadcrumbs" aria-label="เส้นทางนำทาง"><a href="{{ $serviceHome }}">หน้าหลัก</a><span aria-hidden="true">/</span><a href="{{ $serviceListUrl }}">{{ findServiceType($serviceType) }}</a><span aria-hidden="true">/</span><span aria-current="page">{{ $service->service_name }}</span></nav>
            <div class="service-detail-hero">
                <div class="service-detail-hero-copy">
                    <p class="eyebrow">หน่วยบริการของศูนย์การศึกษาพิเศษ</p>
                    <h1 id="service-detail-title">{{ $service->service_name }}</h1>
                    <p class="service-detail-hero-lead">การเรียนรู้และการช่วยเหลือ<br><span>ใกล้บ้าน ใกล้ชุมชน</span></p>
                </div>
                <aside class="service-detail-quick-contact" aria-labelledby="service-quick-contact-title">
                    <span class="service-detail-contact-kicker">สอบถามข้อมูล</span>
                    <h2 id="service-quick-contact-title">ติดต่อ{{ $service->service_name }}</h2>
                    @if($service->service_contact_phone_number)
                        <a class="service-detail-phone" href="tel:{{ $servicePhone }}"><svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>{{ $service->service_contact_phone_number }}</a>
                    @endif
                    @if($service->service_address)<p>{{ $service->service_address }}</p>@endif
                    <a class="service-detail-contact-link" href="#service-detail-contact">ที่อยู่และช่องทางติดต่อ <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a>
                </aside>
                <div class="service-detail-overview"><p class="service-detail-description">{{ $service->service_description }}</p><a class="service-detail-text-link" href="#service-detail-mission">อ่านข้อมูลหน่วยบริการ <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></div>
            </div>
        </div>
    </section>

    @if($bannerUrl)
        <div class="service-detail-banner-wrap"><div class="container"><figure class="service-detail-banner"><img src="{{ $bannerUrl }}" alt="ภาพประชาสัมพันธ์{{ $service->service_name }}" decoding="async" data-image-fallback><figcaption class="image-fallback" hidden>ภาพประชาสัมพันธ์{{ $service->service_name }}</figcaption></figure></div></div>
    @endif

    <div class="container service-detail-content-layout">
        <aside class="page-contents service-detail-contents" aria-label="สารบัญหน่วยบริการ"><p>ในหน้านี้</p><nav aria-label="ส่วนเนื้อหา"><a href="#service-detail-mission">บทบาทและภารกิจ</a><a href="#service-detail-learning">การจัดกิจกรรม</a>@if($image_general->isNotEmpty())<a href="#service-detail-gallery">ภาพกิจกรรม</a>@endif <a href="#service-detail-contact">ติดต่อหน่วยบริการ</a></nav></aside>
        <div class="service-detail-sections">
            <section class="service-detail-section" id="service-detail-mission" tabindex="-1" aria-labelledby="service-mission-title">
                <div class="service-detail-section-heading"><p class="eyebrow">หน้าที่ของเรา</p><h2 id="service-mission-title">บทบาทหน้าที่และภารกิจ</h2></div>
                <div class="service-detail-feature">
                    <div class="service-detail-prose">@if($service->service_mission)<p>{{ $service->service_mission }}</p>@else<p>สอบถามข้อมูลภารกิจของ{{ $service->service_name }}ได้จากช่องทางการติดต่อด้านล่าง</p>@endif</div>
                    @if($previewOneUrl)<figure class="service-detail-feature-image"><img src="{{ $previewOneUrl }}" alt="บรรยากาศ{{ $service->service_name }}" loading="lazy" decoding="async" data-image-fallback><figcaption class="image-fallback" hidden>ภาพบรรยากาศ{{ $service->service_name }}</figcaption></figure>@endif
                </div>
            </section>

            <section class="service-detail-section" id="service-detail-learning" tabindex="-1" aria-labelledby="service-learning-title">
                <div class="service-detail-section-heading"><p class="eyebrow">การเรียนรู้ที่หน่วยบริการ</p><h2 id="service-learning-title">การจัดกิจกรรมการเรียนการสอน</h2></div>
                <div class="service-detail-feature service-detail-feature-reverse">
                    @if($previewTwoUrl)<figure class="service-detail-feature-image"><img src="{{ $previewTwoUrl }}" alt="กิจกรรมการเรียนการสอนของ{{ $service->service_name }}" loading="lazy" decoding="async" data-image-fallback><figcaption class="image-fallback" hidden>ภาพกิจกรรมการเรียนการสอน</figcaption></figure>@endif
                    <div class="service-detail-prose">@if($service->service_learning_activity)<p>{{ $service->service_learning_activity }}</p>@else<p>สอบถามข้อมูลกิจกรรมการเรียนการสอนของ{{ $service->service_name }}ได้จากช่องทางการติดต่อด้านล่าง</p>@endif</div>
                </div>
            </section>
        </div>
    </div>

    @if($image_general->isNotEmpty())
        <section class="service-detail-gallery-section" id="service-detail-gallery" tabindex="-1" aria-labelledby="service-gallery-title"><div class="container"><div class="service-detail-section-heading"><p class="eyebrow">ภาพจากหน่วยบริการ</p><h2 id="service-gallery-title">ภาพกิจกรรม</h2><p class="service-detail-section-caption">ชมบรรยากาศและกิจกรรมการเรียนรู้ของ{{ $service->service_name }}</p></div><div class="service-detail-gallery-grid">
            @foreach($image_general as $general)
                @php $generalUrl = $serviceImageUrl($general); @endphp
                @if($generalUrl)<figure class="service-detail-gallery-card"><a href="{{ $generalUrl }}" target="_blank" rel="noopener" aria-label="เปิดภาพเต็ม {{ $general->service_image_name ?: $service->service_name }}"><img src="{{ $generalUrl }}" alt="{{ $general->service_image_name ?: 'ภาพกิจกรรมของ'.$service->service_name }}" loading="lazy" decoding="async" data-image-fallback><span class="image-fallback" hidden>ภาพกิจกรรม</span></a><figcaption>@if($general->service_image_name)<strong>{{ $general->service_image_name }}</strong>@endif @if($general->service_image_description)<span>{{ $general->service_image_description }}</span>@endif</figcaption></figure>@endif
            @endforeach
        </div></div></section>
    @endif

    <section class="service-detail-contact-section" id="service-detail-contact" tabindex="-1" aria-labelledby="service-contact-title"><div class="container"><div class="service-detail-section-heading"><p class="eyebrow">พร้อมให้ข้อมูล</p><h2 id="service-contact-title">ติดต่อ{{ $service->service_name }}</h2></div><div class="service-detail-contact-grid">
        <div class="service-detail-address-card"><span class="service-detail-card-label">หน่วยบริการ</span><h3>{{ $service->service_name }}</h3><dl>@if($service->service_address)<div><dt>ที่อยู่</dt><dd>{{ $service->service_address }}</dd></div>@endif @if($service->service_contact_phone_number)<div><dt>โทรศัพท์</dt><dd><a href="tel:{{ $servicePhone }}">{{ $service->service_contact_phone_number }}</a></dd></div>@endif @if($service->service_contact_name)<div><dt>ผู้ติดต่อ</dt><dd>{{ $service->service_contact_name }}</dd></div>@endif</dl></div>
        <div class="service-detail-map-card">@if($mapUrl)<iframe src="{{ $mapUrl }}" title="แผนที่{{ $service->service_name }}" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>@else<div class="service-detail-map-placeholder"><svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg><p>สอบถามเส้นทางได้ที่{{ $service->service_name }}</p></div>@endif</div>
    </div><div class="service-detail-back"><a href="{{ $serviceListUrl }}"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>กลับไปดูหน่วยบริการทั้งหมด</a></div></div></section>
</main>
@endsection
