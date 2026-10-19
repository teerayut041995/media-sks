@extends('layouts.public')
@php
    $publicHome = $aboutPreview ? route('preview.home') : url('/');
    $publicPhone = config('public.contact_phone') ?: '043-840-099';
    $publicEmail = config('public.contact_email') ?: 'ksped400@gmail.com';
    $publicFacebook = config('public.facebook') ?: 'https://www.facebook.com/61561301892392/';
    $publicYoutube = config('public.youtube') ?: 'https://www.youtube.com/@user-kr2wd7br8w';
@endphp
@section('title', 'ช่องทางการติดต่อ')
@section('description', 'ที่อยู่ เบอร์โทรศัพท์ อีเมล แผนที่ และช่องทางติดตามศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ อำเภอยางตลาด จังหวัดกาฬสินธุ์')
@section('content')
<main id="main" tabindex="-1" class="contact-page">
    <section class="contact-introduction" aria-labelledby="contact-heading">
        <div class="container">
            <nav class="breadcrumbs" aria-label="เส้นทางนำทาง"><a href="{{ $publicHome }}">หน้าหลัก</a><span aria-hidden="true">/</span><span aria-current="page">ช่องทางการติดต่อ</span></nav>
            <div class="contact-intro-grid">
                <div class="contact-intro-copy">
                    <p class="eyebrow">พร้อมให้ข้อมูลและประสานงาน</p>
                    <h1 id="contact-heading">ช่องทางการติดต่อ</h1>
                    <p class="contact-lead">พูดคุยกับศูนย์<br><span>เริ่มต้นได้จากที่นี่</span></p>
                    <p class="contact-intro-description">ติดต่อศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ เพื่อสอบถามข้อมูลการศึกษา การให้บริการ และการประสานงานกับศูนย์</p>
                    <div class="contact-hero-actions">
                        <a class="button button-primary" href="tel:{{ preg_replace('/[^0-9+]/', '', $publicPhone) }}"><svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>โทร {{ $publicPhone }}</a>
                        <a class="button button-outline" href="#location">ดูแผนที่และการเดินทาง <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a>
                    </div>
                </div>
                <figure class="contact-hero-image"><img src="{{ asset('images/home/present/sks-present-1.JPG') }}" width="1280" height="689" alt="ทางเข้าสู่อาคารของศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์" decoding="async" fetchpriority="high"><figcaption>ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</figcaption></figure>
            </div>
        </div>
    </section>

    <section class="contact-channels" aria-labelledby="channels-title">
        <div class="container">
            <div class="contact-section-heading"><div><p class="eyebrow">ติดต่อได้โดยตรง</p><h2 id="channels-title">เลือกช่องทางที่สะดวก</h2></div><p>เบอร์โทรศัพท์ อีเมล และที่ตั้งของศูนย์</p></div>
            <div class="contact-card-grid">
                <article class="contact-card"><div class="contact-card-icon"><svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg></div><h3>โทรศัพท์</h3><p>สอบถามข้อมูลและประสานงานกับศูนย์</p><a class="contact-card-value" href="tel:{{ preg_replace('/[^0-9+]/', '', $publicPhone) }}">{{ $publicPhone }}</a><a class="contact-card-action" href="tel:{{ preg_replace('/[^0-9+]/', '', $publicPhone) }}">โทรติดต่อ <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></article>
                <article class="contact-card"><div class="contact-card-icon"><svg class="icon" aria-hidden="true"><use href="#i-mail"/></svg></div><h3>อีเมล</h3><p>ส่งรายละเอียดหรือเอกสารถึงศูนย์</p><a class="contact-card-value" href="mailto:{{ $publicEmail }}">{{ $publicEmail }}</a><a class="contact-card-action" href="mailto:{{ $publicEmail }}">เขียนอีเมล <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></article>
                <article class="contact-card"><div class="contact-card-icon"><svg class="icon" aria-hidden="true"><use href="#i-pin"/></svg></div><h3>ที่ตั้งศูนย์</h3><p class="contact-card-address">เลขที่ 400 หมู่ 1 ถนนถีนานนท์<br>ตำบลยางตลาด อำเภอยางตลาด<br>จังหวัดกาฬสินธุ์ 46120</p><a class="contact-card-action" href="#location">ดูแผนที่ <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></article>
            </div>
        </div>
    </section>

    <section class="contact-location" id="location" tabindex="-1" aria-labelledby="location-title">
        <div class="container contact-location-grid">
            <div class="contact-location-copy"><p class="eyebrow">แวะมาพบเรา</p><h2 id="location-title">ศูนย์อยู่ที่ยางตลาด<br>จังหวัดกาฬสินธุ์</h2><address>ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์<br>เลขที่ 400 หมู่ 1 ถนนถีนานนท์<br>ตำบลยางตลาด อำเภอยางตลาด<br>จังหวัดกาฬสินธุ์ 46120</address><a class="button button-primary" href="https://www.google.com/maps/dir/?api=1&amp;destination=16.4020688%2C103.3744296" target="_blank" rel="noopener noreferrer">เปิดเส้นทางใน Google Maps <svg class="icon" aria-hidden="true"><use href="#i-diagonal"/></svg></a><p class="contact-map-note">ลิงก์แผนที่จะเปิดในหน้าต่างใหม่</p></div>
            <div class="contact-map-frame"><iframe title="แผนที่ตั้งศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15309.791173811087!2d103.3744296!3d16.4020688!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3122b7e5ad27e431%3A0x991e000a770c950e!2z4Lio4Li54LiZ4Lii4LmM4LiB4Liy4Lij4Lio4Li24LiB4Lip4Liy4Lie4Li04LmA4Lio4Lip4Lib4Lij4Liw4LiI4Liz4LiI4Lix4LiH4Lir4Lin4Lix4LiU4LiB4Liy4Lis4Liq4Li04LiZ4LiY4Li44LmM!5e0!3m2!1sth!2sth!4v1710125654288!5m2!1sth!2sth" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
        </div>
    </section>

    <section class="contact-social-section" aria-labelledby="social-title"><div class="container contact-social-inner"><div><p class="eyebrow">ติดตามความเคลื่อนไหว</p><h2 id="social-title">ข่าวสารจากศูนย์</h2><p>ติดตามข่าวและกิจกรรมผ่านช่องทางออนไลน์ของศูนย์</p></div><div class="contact-social-links"><a href="{{ $publicFacebook }}" target="_blank" rel="noopener noreferrer"><svg class="icon" aria-hidden="true"><use href="#i-facebook"/></svg>Facebook <svg class="icon contact-social-arrow" aria-hidden="true"><use href="#i-diagonal"/></svg></a><a href="{{ $publicYoutube }}" target="_blank" rel="noopener noreferrer"><svg class="icon" aria-hidden="true"><use href="#i-youtube"/></svg>YouTube <svg class="icon contact-social-arrow" aria-hidden="true"><use href="#i-diagonal"/></svg></a><a href="{{ $publicHome }}"><svg class="icon" aria-hidden="true"><use href="#i-diagonal"/></svg>เว็บไซต์หลัก <svg class="icon contact-social-arrow" aria-hidden="true"><use href="#i-arrow"/></svg></a></div></div></section>
</main>
@endsection
