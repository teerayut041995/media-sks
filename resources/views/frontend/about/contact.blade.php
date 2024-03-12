@extends('layouts.base.master')

@section('seo')
    <title>ผู้บริหารศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</title>
    <meta name="description"
          content="เป็นสถานศึกษาที่จัดการศึกษาเพื่อเด็กพิการในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม ฟื้นฟูสมรรถภาพ และเตรียมความพร้อมเพื่อส่งต่อเด็กพิการเข้าเรียนร่วม กับนักเรียนในโรงเรียนปกติหรือโรงเรียนเฉพาะความพิการ ทุกประเภทในจังหวัดกาฬสินธุ์">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
          content="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์, สำนักบริหารงานการศึกษาพิเศษ, บริการช่วยเหลือระยะแรกเริ่ม, การศึกษาพิเศษ">
    <meta name="author" content="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
    <meta name="robots" content="index, archive">
    <link rel="icon" href="{{asset('images/home/favicon.ico')}}" type="image/x-icon">
    <link rel="shortcut icon" href='{{asset('images/home/favicon.ico')}}' type="image/x-icon">

    <meta name="msapplication-TileImage" content="{{asset('template/assets/images/logo/logo.png')}}">
    <link rel="apple-touch-icon" href="{{asset('images/home/sks-logo-1.png')}}">
    <link rel="apple-touch-icon" href="{{asset('images/home/sks-logo-1.png')}}">
    <link rel="apple-touch-icon" href="{{asset('images/home/sks-logo-1.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('images/home/sks-logo-1.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/home/sks-logo-1.png')}}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{asset('images/home/sks-logo-1.png')}}">

    <meta property="og:url"
          content='{{url("/about/executive")}}'/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="ผู้บริหารศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"/>
    <meta property="og:description"
          content="เป็นสถานศึกษาที่จัดการศึกษาเพื่อเด็กพิการในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม ฟื้นฟูสมรรถภาพ และเตรียมความพร้อมเพื่อส่งต่อเด็กพิการเข้าเรียนร่วม กับนักเรียนในโรงเรียนปกติหรือโรงเรียนเฉพาะความพิการ ทุกประเภทในจังหวัดกาฬสินธุ์"/>
    <meta property="og:image" content='{{url("images/kalasin1.png")}}'/>
    <link rel="canonical" href="{{url('')}}"/>
@endsection


@section('content')

    <!-- breadcrumb area start -->
    <section class="breadcrumb-area bg-default" data-background="{{url("images/home/kalasin-3.jpg")}}">
        <img src="{{url("template/user-panel/assets/img/breadcrumb/shape-1.png")}}" alt="" class="breadcrumb-shape">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content" style="color: white;">
                        <h2 class="breadcrumb-title" style="color: white;">ผู้บริหาร</h2>
                        <div class="breadcrumb-list">
                            <a href="{{url('/')}}" style="color: white;">หน้าหลัก</a>
                            <span style="color: white;">ผู้บริหาร</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- contact area start -->
    <section class="contact-area pt-120 pb-120">
        <div class="container">
            <div class="contact-wrap">
                <div class="row">
                    <div class="col-xl-8 col-md-8">
                        <div class="h5_event-img w_img">
                            <img src="{{url("images/home/present/sks-present-1.JPG")}}" alt="">
                        </div>
{{--                        <div class="contact-content pr-80 mb-20">--}}
{{--                            <h3 class="contact-title mb-25">Send Me Message</h3>--}}
{{--                            <form action="#" class="contact-form">--}}
{{--                                <div class="row">--}}
{{--                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6">--}}
{{--                                        <div class="contact-form-input mb-30">--}}
{{--                                            <input type="text" placeholder="Your Name">--}}
{{--                                            <span class="inner-icon"><i class="fa-thin fa-user"></i></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6">--}}
{{--                                        <div class="contact-form-input mb-30">--}}
{{--                                            <input type="email" placeholder="Email Address">--}}
{{--                                            <span class="inner-icon"><i class="fa-thin fa-envelope"></i></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6">--}}
{{--                                        <div class="contact-form-input mb-30">--}}
{{--                                            <input type="text" placeholder="Your Number">--}}
{{--                                            <span class="inner-icon"><i class="fa-thin fa-phone-volume"></i></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-6 ">--}}
{{--                                        <div class="contact-form-input">--}}
{{--                                            <span class="inner-icon inner-icon-select"><i class="fa-thin fa-circle-exclamation"></i></span>--}}
{{--                                            <select name="select" class="contact-form-list has-nice-select mb-30">--}}
{{--                                                <option value="1">Select Subject</option>--}}
{{--                                                <option value="2">Art & Design</option>--}}
{{--                                                <option value="3">Graphic Design</option>--}}
{{--                                                <option value="4">Web Design</option>--}}
{{--                                                <option value="5">UX/UI Design</option>--}}
{{--                                            </select>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-12">--}}
{{--                                        <div class="contact-form-input mb-50 contact-form-textarea">--}}
{{--                                            <textarea name="message" cols="30" rows="10" placeholder="Feel free to get in touch!"></textarea>--}}
{{--                                            <span class="inner-icon"><i class="fa-thin fa-pen"></i></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-12">--}}
{{--                                        <div class="contact-form-submit mb-30">--}}
{{--                                            <div class="contact-form-btn">--}}
{{--                                                <a href="#" class="theme-btn contact-btn">Send Message</a>--}}
{{--                                            </div>--}}
{{--                                            <div class="contact-form-condition">--}}
{{--                                                <label class="condition_label">I agree that my data is collected and stored.--}}
{{--                                                    <input type="checkbox">--}}
{{--                                                    <span class="check_mark"></span>--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                    </div>
                    <div class="col-xl-4 col-md-4">
                        <div class="contact-info ml-50 mb-20">
                            <h3 class="contact-title mb-40">ช่องทางการติดต่อ</h3>
                            <div class="contact-info-item">
                                <span><i class="fa-thin fa-location-dot"></i>ที่อยู่</span>
                                <p>เลขที่ 400 หมู่ 1 ถนนถีนานนท์ ตำบลยางตลาด อำเภอยางตลาด จังหวัดกาฬสินธุ์ 46120</p>
                            </div>
                            <div class="contact-info-item">
                                <span><i class="fa-thin fa-mobile-notch"></i>เบอร์โทรศัพท์</span>
                                <a href="tel:{{env('CONTACT_PHONE_NUMBER')}}">{{env('CONTACT_PHONE_NUMBER')}}</a>
                            </div>
                            <div class="contact-info-item">
                                <span><i class="fa-thin fa-envelope"></i>อีเมล</span>
                                <a href="mailto:{{env('CONTACT_EMAIL')}}">{{env('CONTACT_EMAIL')}}</a>
                            </div>
                            <div class="contact-social">
                                <span>Social Media</span>
                                <ul>
                                    <li><a href='{{url(env('SOCIAL_CONTACT_FACEBOOK'))}}' target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
                                    <li><a href='{{url(env('SOCIAL_CONTACT_YOUTUBE'))}}' target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                                    <li><a href='{{url(env('SOCIAL_CONTACT_WEBSITE'))}}' target="_blank"><i class="fa-brands fa-dribbble"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15309.791173811087!2d103.3744296!3d16.4020688!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3122b7e5ad27e431%3A0x991e000a770c950e!2z4Lio4Li54LiZ4Lii4LmM4LiB4Liy4Lij4Lio4Li24LiB4Lip4Liy4Lie4Li04LmA4Lio4Lip4Lib4Lij4Liw4LiI4Liz4LiI4Lix4LiH4Lir4Lin4Lix4LiU4LiB4Liy4Lis4Liq4Li04LiZ4LiY4Li44LmM!5e0!3m2!1sth!2sth!4v1710125654288!5m2!1sth!2sth" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
{{--            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d147120.012062842!2d13.706000467398074!3d51.075159941942076!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1senveto!5e0!3m2!1sen!2sbd!4v1680961754336!5m2!1sen!2sbd" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>--}}
        </div>
    </section>
    <!-- contact area end -->
@endsection