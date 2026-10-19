@extends('layouts.public')
@section('title', $serviceTitle)
@section('description', $serviceTitle.' ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ เลือกดูข้อมูลและรายละเอียดการให้บริการแต่ละแห่ง')
@section('content')
@php
    $serviceHome = $servicePreview ? route('preview.home') : url('/');
    $serviceDetailBase = $servicePreview ? 'https://sks.go.th/services' : url('/services');
    $serviceCount = $services->count();
@endphp
<main id="main" tabindex="-1" class="service-list-page">
    <section class="service-list-introduction" aria-labelledby="service-list-title">
        <div class="container">
            <nav class="breadcrumbs" aria-label="เส้นทางนำทาง"><a href="{{ $serviceHome }}">หน้าหลัก</a><span aria-hidden="true">/</span><span aria-current="page">{{ $serviceTitle }}</span></nav>
            <div class="service-list-hero">
                <div class="service-list-intro-copy">
                    <p class="eyebrow">บริการจากศูนย์การศึกษาพิเศษ</p>
                    <h1 id="service-list-title">{{ $serviceTitle }}</h1>
                    @if($serviceType === 'service_unit')
                        <p class="service-list-lead">การเรียนรู้และการช่วยเหลือ<br><span>เข้าถึงได้ใกล้ชุมชน</span></p>
                        <p class="service-list-description">ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ จัดและส่งเสริมการช่วยเหลือระยะแรกเริ่ม การเตรียมความพร้อม และการส่งต่อทางการศึกษา ผ่านหน่วยบริการของศูนย์</p>
                    @else
                        <p class="service-list-lead">สำรวจข้อมูล<br><span>{{ $serviceTitle }}ของศูนย์</span></p>
                        <p class="service-list-description">เลือกดูรายละเอียดการให้บริการและกิจกรรมจากศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</p>
                    @endif
                    <a class="service-list-jump" href="#service-list-results">ดูรายการ{{ $serviceTitle }} <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a>
                </div>
                <aside class="service-list-summary" aria-label="จำนวนรายการ{{ $serviceTitle }}"><span class="service-list-count">{{ sprintf('%02d', $serviceCount) }}</span><div><p>{{ $serviceTitle }}ที่มีข้อมูล</p><span class="service-list-summary-line" aria-hidden="true"></span><p class="service-list-summary-detail">เลือกดูแต่ละแห่งเพื่ออ่านรายละเอียดเพิ่มเติม</p></div></aside>
            </div>
        </div>
    </section>

    <section class="service-list-results" id="service-list-results" tabindex="-1" aria-labelledby="service-results-title">
        <div class="container">
            <div class="service-list-section-heading"><div><p class="eyebrow">สำรวจข้อมูล</p><h2 id="service-results-title">เลือกดู{{ $serviceTitle }}</h2></div><span class="service-list-total">{{ $serviceCount }} รายการ</span></div>
            @if($serviceCount > 0)
                <div class="service-list-grid">
                    @foreach($services as $service)
                        @php
                            $serviceUrl = $serviceDetailBase.'/'.$service->uid;
                            $imageName = $service->service_image_file_name;
                            $localImagePath = $imageName ? 'images/service/thumbnail/'.$imageName : null;
                            $imageUrl = $imageName ? (($servicePreview || !is_file(public_path($localImagePath)))
                                ? 'https://sks.go.th/'.$localImagePath : asset($localImagePath)) : null;
                        @endphp
                        <article class="service-list-card">
                            <a class="service-list-media" href="{{ $serviceUrl }}" aria-label="ดูข้อมูล{{ $service->service_name }}">
                                @if($imageUrl)
                                    <img src="{{ $imageUrl }}" width="630" height="315" alt="ภาพประชาสัมพันธ์{{ $service->service_name }}" loading="lazy" decoding="async" data-image-fallback>
                                    <span class="image-fallback" hidden>{{ $service->service_name }}</span>
                                @else
                                    <span class="service-list-image-placeholder"><svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg><span>{{ $service->service_name }}</span></span>
                                @endif
                            </a>
                            <div class="service-list-card-body"><span class="service-list-index">{{ sprintf('%02d', $loop->iteration) }} / {{ sprintf('%02d', $serviceCount) }}</span><h3><a href="{{ $serviceUrl }}">{{ $service->service_name }}</a></h3><a class="service-list-card-link" href="{{ $serviceUrl }}">ดูข้อมูล{{ $service->service_name }} <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></div>
                        </article>
                    @endforeach
                </div>
            @else
                <div class="service-list-empty"><h3>ยังไม่มีข้อมูล{{ $serviceTitle }}</h3><p>โปรดกลับมาตรวจสอบอีกครั้ง หรือสอบถามศูนย์โดยตรง</p><a class="button button-outline" href="{{ $servicePreview ? route('preview.contact') : url('/contact') }}">ช่องทางการติดต่อ <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></div>
            @endif
        </div>
    </section>
</main>
@endsection
