@extends('layouts.base.master')

@section('seo')
    <title>ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</title>
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
          content='{{url("")}}'/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"/>
    <meta property="og:description"
          content="เป็นสถานศึกษาที่จัดการศึกษาเพื่อเด็กพิการในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม ฟื้นฟูสมรรถภาพ และเตรียมความพร้อมเพื่อส่งต่อเด็กพิการเข้าเรียนร่วม กับนักเรียนในโรงเรียนปกติหรือโรงเรียนเฉพาะความพิการ ทุกประเภทในจังหวัดกาฬสินธุ์"/>
    <meta property="og:image" content='{{url("images/kalasin1.png")}}'/>
    <link rel="canonical" href="{{url('')}}"/>
@endsection

@section('style')

@endsection

@section('content')

    <!-- banner area start -->
    {{--    <section class="h6_banner-area">--}}
    {{--        <div class="swiper banner_6_active">--}}
    {{--            <div class="swiper-wrapper">--}}
    {{--                <div class="swiper-slide">--}}
    {{--                    <div class="h6_single-banner bg-default" data-background="{{url("images/home/kalasin-3.jpg")}}">--}}
    {{--                        <div class="container">--}}
    {{--                            <div class="row align-items-center">--}}
    {{--                                <div class="col-xxl-7 col-xl-8">--}}
    {{--                                    <div class="h6_banner-content">--}}
    {{--                                        <span class="h6_banner-content-subtitle" data-animation="fadeInUp" data-delay="0.3s"><i class="fa-thin fa-graduation-cap"></i> New Journey on your varsity </span>--}}
    {{--                                        <h1 class="h6_banner-content-title" data-animation="fadeInUp" data-delay="0.5s">Welcome to Our <span>University</span> Website</h1>--}}
    {{--                                        <p class="h6_banner-content-text" data-animation="fadeInUp" data-delay="0.7s">The research paper investigates the impact of climate change on global biodiversity <br> Through a comprehensive analysis of species distribution data and climate..</p>--}}
    {{--                                        <a href="#" class="header-btn theme-btn theme-btn-medium theme-btn-6" data-animation="fadeInUp" data-delay="0.9s">Learn More<i class="fa-light fa-arrow-up-right"></i></a>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="swiper-slide">--}}
    {{--                    <div class="h6_single-banner bg-default" data-background="assets/img/banner/6/2.jpg">--}}
    {{--                        <div class="container">--}}
    {{--                            <div class="row align-items-center">--}}
    {{--                                <div class="col-xxl-7 col-xl-8">--}}
    {{--                                    <div class="h6_banner-content">--}}
    {{--                                        <span class="h6_banner-content-subtitle" data-animation="fadeInUp" data-delay="0.3s"><i class="fa-thin fa-graduation-cap"></i> New Journey on your varsity </span>--}}
    {{--                                        <h1 class="h6_banner-content-title" data-animation="fadeInUp" data-delay="0.5s">ยินดีต้อนรับ <span>University</span> Website</h1>--}}
    {{--                                        <p class="h6_banner-content-text" data-animation="fadeInUp" data-delay="0.7s">The research paper investigates the impact of climate change on global biodiversity <br> Through a comprehensive analysis of species distribution data and climate..</p>--}}
    {{--                                        <a href="#" class="header-btn theme-btn theme-btn-medium theme-btn-6" data-animation="fadeInUp" data-delay="0.9s">Learn More<i class="fa-light fa-arrow-up-right"></i></a>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="swiper-slide">--}}
    {{--                    <div class="h6_single-banner bg-default" data-background="assets/img/banner/6/3.jpg">--}}
    {{--                        <div class="container">--}}
    {{--                            <div class="row align-items-center">--}}
    {{--                                <div class="col-xxl-7 col-xl-8">--}}
    {{--                                    <div class="h6_banner-content">--}}
    {{--                                        <span class="h6_banner-content-subtitle" data-animation="fadeInUp" data-delay="0.3s"><i class="fa-thin fa-graduation-cap"></i> New Journey on your varsity </span>--}}
    {{--                                        <h1 class="h6_banner-content-title" data-animation="fadeInUp" data-delay="0.5s">Welcome to Our <span>University</span> Website</h1>--}}
    {{--                                        <p class="h6_banner-content-text" data-animation="fadeInUp" data-delay="0.7s">The research paper investigates the impact of climate change on global biodiversity <br> Through a comprehensive analysis of species distribution data and climate..</p>--}}
    {{--                                        <a href="#" class="header-btn theme-btn theme-btn-medium theme-btn-6" data-animation="fadeInUp" data-delay="0.9s">Learn More<i class="fa-light fa-arrow-up-right"></i></a>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="h6_banner-navigation">--}}
    {{--                <div class="banner_6-swiper-prev"><i class="fa-thin fa-angle-left"></i></div>--}}
    {{--                <div class="banner_6-swiper-next"><i class="fa-thin fa-angle-right"></i></div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    <!-- banner area end -->

    <!-- banner area start -->
    <section class="h10_banner-area">
        <div class="h10_single-banner bg-default" data-background="{{url("images/home/kalasin-3.jpg")}}">
            <img src="{{url("template/user-panel/assets/img/banner/10/shape-1.png")}}" alt="Not Found"
                 class="h10_banner-shape-1 d-none d-xxl-block">
            <img src="{{url("template/user-panel/assets/img/banner/10/shape-2.png")}}" alt="Not Found"
                 class="h10_banner-shape-2 d-none d-xl-block">
            <img src="{{url("template/user-panel/assets/img/banner/10/shape-3.png")}}" alt="Not Found"
                 class="h10_banner-shape-3 d-none d-xl-block">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        <div class="h10_banner-content mb-60 mb-lg-0">
                            <div class="banner-content">
                                <div class="section-area">
                                    <span class="section-subtitle" style="font-size: 20px;">Kalasin Special Education Center</span>
                                    <h1 class="h10_banner-content-title" style="text-shadow: black 0.1em 0.1em 0.2em;">
                                        ศูนย์การศึกษาพิเศษ ประจำจังหวัด<span>กาฬสินธุ์ <img
                                                    src="{{url("template/user-panel/assets/img/banner/1/line.png")}}"
                                                    alt=""></span></h1>
                                    <p class="h6_banner-content-subtitle"
                                       style="font-size: 26px; text-shadow: black 0.1em 0.1em 0.2em;">
                                        สังกัดสำนักบริหารงานการศึกษาพิเศษ สำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน
                                        กระทรวงศึกษาธิการ <br></p>

                                    <p class="h6_banner-content-text" data-animation="fadeInUp" data-delay="0.7s"
                                       style="font-style: italic; font-size: 20px;">“สถานศึกษาแกนนำ
                                        ที่นำสื่อและเทคโนโลยีทางการศึกษาเพื่อพัฒนากระบวนการจัดการเรียนรู้ที่มีคุณภาพ“</p>
                                </div>
                            </div>

                            <div class="h10_banner-content-btn mb-60">
                                <a href="{{url(env('SOCIAL_CONTACT_FACEBOOK'))}}" target="_blank"
                                   class="theme-btn theme-btn-10 theme-btn-10-white">FACEBOOK<i
                                            class="fa-light fa-arrow-right"></i></a>
                                <a href="{{url(env('SOCIAL_CONTACT_YOUTUBE'))}}" target="_blank"
                                   class="theme-btn theme-btn-10 theme-btn-10-transparent">YOUTUBE<i
                                            class="fa-light fa-arrow-right"></i></a>
                            </div>
                        </div>

                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6">

                        {{--                        <div class="h10_banner-right pl-110">--}}
                        {{--                            <img src="{{url("template/user-panel/assets/img/banner/10/shape-4.png")}}" alt="Not Found"--}}
                        {{--                                 class="h10_banner-shape-4 d-none d-md-block">--}}
                        {{--                            <img src="{{url("template/user-panel/assets/img/banner/10/shape-5.png")}}" alt="Not Found"--}}
                        {{--                                 class="h10_banner-shape-5 d-none d-md-block">--}}
                        {{--                            <img src="{{url("template/user-panel/assets/img/banner/10/shape-6.png")}}" alt="Not Found"--}}
                        {{--                                 class="h10_banner-shape-6 d-none d-md-block">--}}
                        {{--                            --}}{{--                            <div class="h10_banner-img">--}}
                        {{--                            --}}{{--                                <img src="{{url("images/home/show-1.png")}}" alt="">--}}
                        {{--                            --}}{{--                            </div>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner area end -->

    @foreach($events as $event)
        <!-- about area start -->
        @php
            $new_date = date_create($event->event_date);
            $month = date_format($new_date, 'm');
            $day = date_format($new_date, 'd');
            $year = date_format($new_date, 'Y');
        @endphp
        <section class="h6_about-area pt-120 pb-80 fix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="h6_about-img w_img">
                            <img src='{{url("images/image_event/$event->event_image")}}'
                                 alt="{{$event->event_name}}">
                            <div class="h6_about-img-content">
                                <h2>{{$day}}.{{$month}}</h2>
                                <span style="font-size: 30px;">{{$year + 543}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="h6_about-content ml-30 mb-30 mb-md-0 pb-30">

                            <h3 class="h6_about-content-title">{{$event->event_name}}</h3>
                            <p >{{$event->event_description}}</p>
                            <a href='{{url("events/$event->event_slug")}}'
                               class="h6_about-btn theme-btn theme-btn-medium theme-btn-6">ดูกิจกรรม<i
                                        class="fa-light fa-arrow-up-right"></i></a>
                            <a href='{{url("events")}}'
                               class="h6_about-btn theme-btn theme-btn-medium theme-btn-6">ดูกิจกรรมทั้งหมด<i
                                        class="fa-light fa-arrow-up-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about area end -->
    @endforeach

    @if($new_post)
        <!-- research area start -->
        <section class="h6_research-area pt-20 pb-20 fix">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-5 col-xl-6 col-lg-6">
                        <div class="h6_research-wrap mb-50">
                            <div class="h6_research-content">
                                <h3 class="h6_about-content-title">{{$new_post->post_title}}</h3>

                                <p>{{$new_post->post_detail}}</p>
                                <div class="event-content-meta">
                                    <span><i class="fa-thin fa-clock"></i>{{formatDateThaiBirthday($new_post->created_at)}}, {{Carbon\Carbon::parse($new_post->created_at)->diffForHumans()}}</span>
                                </div>
                                <a href='{{url("article/$new_post->post_slug")}}'
                                   class="h6_about-btn theme-btn theme-btn-medium theme-btn-6">ดูรายละเอียด<i
                                            class="fa-light fa-arrow-up-right"></i></a>

                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-7 col-xl-6 col-lg-6">
                        <h2 class="h10_class-content-title"><span style="display: inline-block; padding: 5px 15px; position: relative; z-index: 1; color: #000; font-size: 24px; font-weight: 700; border: 1px solid #000; line-height: 1; border-radius: 4px; padding-left: 40px; margin-left: 5px;">{{$new_post->category_name}}</span></h2>
                        <div class="h6_research-img w_img mb-50">
                            <img src='{{url("images/image_post/$new_post->post_image")}}'
                                 alt="{{$new_post->post_title}}">

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- research area end -->
    @endif



    <!-- category area start -->
    {{--    <section class="category-area pt-60 pb-20">--}}
    {{--        <div class="container">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-xl-3 col-lg-3">--}}
    {{--                    <div class="category-left pb-60">--}}
    {{--                        <div class="section-area">--}}
    {{--                            <span class="section-subtitle">ติดตามข้อมูลข่าวสาร</span>--}}
    {{--                            <h2 class="section-title mb-20">เนื้อหา<br>ยอดนิยม</h2>--}}
    {{--                        </div>--}}
    {{--                        <div class="category-navigation">--}}
    {{--                            <div class="category-prev"><i class="fa-thin fa-arrow-left"></i>--}}
    {{--                            </div>--}}
    {{--                            <div class="category-next"><i class="fa-light fa-arrow-right"></i>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-xl-9 col-lg-9">--}}
    {{--                    <div class="category-wrap">--}}
    {{--                        <div class="category-shape">--}}
    {{--                            <img src="{{url("/template/user-panel/assets/img/category/1/shape-1.png")}}" alt=""--}}
    {{--                                 class="category-shape-1">--}}
    {{--                            <img src="{{url("/template/user-panel/assets/img/category/1/shape-2.png")}}" alt=""--}}
    {{--                                 class="category-shape-2">--}}
    {{--                            <img src="{{url("/template/user-panel/assets/img/category/1/shape-3.png")}}" alt=""--}}
    {{--                                 class="category-shape-3">--}}
    {{--                            <img src="{{url("/template/user-panel/assets/img/category/1/shape-1.png")}}" alt=""--}}
    {{--                                 class="category-shape-4">--}}
    {{--                        </div>--}}
    {{--                        <div class="category-active swiper pb-60">--}}
    {{--                            <div class="swiper-wrapper">--}}
    {{--                                @foreach($popular_post as $popular)--}}
    {{--                                    <div class="swiper-slide">--}}
    {{--                                        <div class="category-item">--}}
    {{--                                            <div class="category-img">--}}
    {{--                                                <img src='{{url("images/image_post/$popular->post_image")}}'--}}
    {{--                                                     alt="{{$popular->post_title}}">--}}
    {{--                                            </div>--}}
    {{--                                            <div class="category-content cut-line">--}}
    {{--                                                <h6 class="text-line"><a href='{{url("article/$popular->post_slug")}}'>{{$popular->post_title}}</a>--}}
    {{--                                                </h6>--}}
    {{--                                            </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                @endforeach--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    <!-- category area end -->


    <!-- course area start -->
    <section class="course-area">
        <div class="container-fluid container-custom-1 p-0">
            <div class="course-wrap pt-160 pb-160">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="course-section-area">
                                <div class="section-area section-area-top">
                                    {{--                                    <span class="section-subtitle">SKS NEWS</span>--}}
                                    <h2 class="section-title mb-20">ข่าวประชาสัมพันธ์</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="h9_header-search d-none d-lg-block">
                                {{--                                <h2 class="section-title mb-20">ข่าวประชาสัมพันธ์</h2>--}}
                                <form action="" method="get">
                                    <input type="text" placeholder="ค้นหาบทความที่สนใจ" value="{{$active['name']}}"
                                           name="name">
                                    <button type="submit" class="header-search-btn">
                                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.22222 13.4444C10.6587 13.4444 13.4444 10.6587 13.4444 7.22222C13.4444 3.78578 10.6587 1 7.22222 1C3.78578 1 1 3.78578 1 7.22222C1 10.6587 3.78578 13.4444 7.22222 13.4444Z"
                                                  stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                  stroke-linejoin="round"/>
                                            <path d="M14.9995 15L11.6162 11.6167" stroke="currentColor"
                                                  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="course-inner">
                        <div class="row">
                            @foreach($posts as $new)
                                <div class="col-xxl-3 col-lg-4 col-md-6">
                                    <div class="course-item mb-30">
                                        <div class="course-img">
                                            <img src='{{url("images/image_post/$new->post_image")}}'
                                                 alt="{{$new->post_title}}">
                                        </div>
                                        <div class="course-content">
                                            <div class="course-content-top">
                                                {{--                                                <div class="course-top-icon"><img--}}
                                                {{--                                                            src="assets/img/course/1/v1.png" alt=""></div>--}}
                                                <div class="course-top-title">
                                                    <h6>{{$new->category_name}}</h6>
                                                </div>

                                            </div>
                                            <h5 class="course-content-title"><a
                                                        href='{{url("article/$new->post_slug")}}'>{{$new->post_title}}</a>
                                            </h5>
                                            <div class="course-content-bottom">
                                                <div class="course-bottom-info">
                                                    <span><i class="fa-thin fa-clock"></i>{{formatDateThaiBirthday($new->created_at)}}</span>
                                                </div>
                                                <div class="course-bottom-price">
                                                    <a href='{{url("article/$new->post_slug")}}'
                                                       class="t-theme-btn theme-btn event-btn">เพิ่มเติม</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                            {{$posts->links()}}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- blog area start -->
    <section class="blog-area pt-120 pb-20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12">

                    <div class="testimonial-section-area">
                        <div class="section-area mb-55 section-area-top">
                            <span class="section-subtitle">Information</span>
                            <h2 class="section-title mb-20">เกี่ยวกับสถานศึกษา</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="blog-wrap">
                        <div class="blog-item blog-item-h mb-30">
                            <div class="blog-img">
                                <img src="{{url("images/home/present/sks-present-7.JPG")}}"
                                     alt="วิสัยทัศน์ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
                            </div>
                            <div class="blog-content">

                                <h5 class="blog-content-title">
                                    <p style="font-size: 20px; font-style: italic; color: #1E1E1E; margin-bottom: 15px;">
                                        “ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ <br>เป็นสถานศึกษาที่มีมาตรฐาน
                                        ก้าวทันเทคโนโลยี <br>พัฒนาคุณภาพชีวิตเด็กพิการแบบองค์รวม“
                                    </p>
                                </h5>
                            </div>
                        </div>
                        <div class="blog-item blog-item-h mb-30">
                            <div class="blog-img">
                                <img src="{{url("images/home/present/sks-present-6.JPG")}}"
                                     alt="เอกลักษณ์ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
                            </div>
                            <div class="blog-content">
                                <p style="font-size: 20px; font-style: italic; color: #1E1E1E; margin-bottom: 15px;">
                                    “สถานศึกษาแกนนำ
                                    ที่นำสื่อและเทคโนโลยีทางการศึกษาเพื่อพัฒนากระบวนการจัดการเรียนรู้ที่มีคุณภาพ“</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    <div class="blog-item blog-item-v mb-30">
                        <div class="blog-img">
                            <img src="{{url("images/home/present/sks-present-8.JPG")}}"
                                 alt="อัตลักษณ์ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
                        </div>
                        <div class="blog-content">
                            <p style="font-size: 20px; font-style: italic; color: #1E1E1E; margin-bottom: 15px;">
                                “นักเรียนศูนย์การศึกษาพิเศษประจำจังหวัดกาฬสินธุ์ มีความสุข สนุก ร่งเริง“</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog area end -->

    <!-- about area start -->
    <section class="h6_about-area pt-20 pb-20 fix">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="h6_about-img w_img">
                        <img src="{{url("images/home/present/sks-present-5.JPG")}}"
                             alt="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
                        <div class="h6_about-img-content">
                            <h2>2543</h2>
                            <span>ก่อตั้งเมื่อปี</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="about-content">
                        <div class="section-area">
                            {{--                            <span class="section-subtitle">เกี่ยวกับสถานศึกษา</span>--}}
                            <h2 class="section-title mb-15">ศูนย์การศึกษาพิเศษ <br>ประจำจังหวัดกาฬสินธุ์</h2>
                            <p class="section-text">
                                สังกัดสำนักบริหารงานการศึกษาพิเศษ สำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน
                                <br>กระทรวงศึกษาธิการ ได้รับอนุมัติให้จัดตั้งเมื่อวันที่ 31 กรกฎาคม พ.ศ. 2543
                                <br>ศูนย์การศึกษาพิเศษก่อตั้งครั้งแรกอาศัยตั้งสำนักงาน ณ โรงเรียนศึกษาพิเศษกาฬสินธุ์
                                <br>ปัจจุบันเปลี่ยนเป็น โรงเรียนกาฬสินธุ์ปัญญานุกูล และได้ย้ายสำนักงานอาคาร
                                <br>ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ มาตั้งอยู่ เลขที่ 400 ถนนถีนานนท์
                                <br>หมู่ที่ 1 ตำบลยางตลาด อำเภอยางตลาด จังหวัดกาฬสินธุ์ มีพื้นที่ จำนวน 7 ไร่ 3 งาน 80
                                ตารางวา
                                <br>ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ เป็นสถานศึกษาที่จัดการศึกษาเพื่อเด็กพิการ
                                <br>ในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม ฟื้นฟูสมรรถภาพ และเตรียมความพร้อม
                                <br>เพื่อส่งต่อเด็กพิการเข้าเรียนร่วม
                                กับนักเรียนในโรงเรียนปกติหรือโรงเรียนเฉพาะความพิการ <br>ทุกประเภทในจังหวัดกาฬสินธุ์
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-text-wrap mb-15">
            <div class="about-text-ticker" id="about-text-ticker">
                <h1 class="h6_about-bottom-title">ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</h1>
            </div>
        </div>
    </section>
    <!-- about area end -->

    <!-- cta area start -->
    <div class="cta-area">
        <div class="container">
            <div class="cta-wrapper">
                <div class="row align-items-center">
                    <div class="col-xl-6 col-lg-6">
                        <div class="cta-content mb-30 mb-lg-0">
                            <span class="cta-subtitle">Social Media</span>
                            <h2 class="cta-title">ติดตามข่าวสารผ่านช่องทางออนไลน์ได้ที่</h2>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="cta-button">
                            <a href='{{url(env('SOCIAL_CONTACT_FACEBOOK'))}}' target="_blank" class="cta-btn"><i
                                        class="fa-brands fa-facebook-f"></i> Facebook</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cta area end -->
@endsection

@section('script')

@endsection