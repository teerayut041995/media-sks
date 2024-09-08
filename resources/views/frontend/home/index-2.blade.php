@extends('layouts.base.master')

@section('seo')
    <title>ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</title>
    <meta name="description"
          content="เป็นสถานศึกษาที่จัดการศึกษาเพื่อเด็กพิการในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม ฟื้นฟูสมรรถภาพ และเตรียมความพร้อมเพื่อส่งต่อเด็กพิการเข้าเรียนร่วม กับนักเรียนในโรงเรียนปกติหรือโรงเรียนเฉพาะความพิการ ทุกประเภทในจังหวัดกาฬสินธุ์">

    <meta name="keywords"
          content="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์, ศูนย์การศึกษาพิเศษ, สำนักบริหารงานการศึกษาพิเศษ, บริการช่วยเหลือระยะแรกเริ่ม, การศึกษาพิเศษ">

    <meta property="og:url"
          content='{{url("")}}'/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"/>
    <meta property="og:description"
          content="เป็นสถานศึกษาที่จัดการศึกษาเพื่อเด็กพิการในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม ฟื้นฟูสมรรถภาพ และเตรียมความพร้อมเพื่อส่งต่อเด็กพิการเข้าเรียนร่วม กับนักเรียนในโรงเรียนปกติหรือโรงเรียนเฉพาะความพิการ ทุกประเภทในจังหวัดกาฬสินธุ์"/>
    <meta property="og:image" content="{{url("images/logo", env('OG_IMAGE', ''))}}" />
    <link rel="canonical" href="{{url('')}}"/>
@endsection

@section('style')

    <style>
        .h7_about-img-video a {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .h7_about-img-video a svg {
            -webkit-transition: all 0.3s linear 0s;
            -moz-transition: all 0.3s linear 0s;
            -ms-transition: all 0.3s linear 0s;
            -o-transition: all 0.3s linear 0s;
            transition: all 0.3s linear 0s;
        }

        @media (max-width: 767px) {
            .h7_about-img-video a svg {
                width: 80px;
                height: 80px;
            }
        }

        @media only screen and (min-width: 576px) and (max-width: 767px) {
            .h7_about-img-video a svg {
                width: 100px;
                height: 100px;
            }
        }

        .h7_about-img-video a i {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font-size: 22px;
            color: var(--clr-theme-primary-6);
        }

        .h7_about-img-video a:hover svg {
            transform: rotate(180deg);
        }
    </style>
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
            <img src="{{url("template/user-panel/assets/img/banner/10/shape-1.png")}}"
                 class="h10_banner-shape-1 d-none d-xxl-block">
            <img src="{{url("template/user-panel/assets/img/banner/10/shape-2.png")}}"
                 class="h10_banner-shape-2 d-none d-xl-block">
            <img src="{{url("template/user-panel/assets/img/banner/10/shape-3.png")}}"
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

                                    <p class="h6_banner-content-text" data-animation="fadeInUp" size=""
                                       data-delay="0.7s"
                                       style="font-style: italic; font-size: 20px;">“สถานศึกษาแกนนำ
                                        ที่นำสื่อและเทคโนโลยีทางการศึกษาเพื่อพัฒนากระบวนการจัดการเรียนรู้ที่มีคุณภาพ“</p>

                                </div>

                            </div>
                            <div class="h10_banner-content-btn mb-60" align="center">

                            </div>

                            {{--                            <div class="h10_banner-content-btn mb-60">--}}
                            {{--                                <a href="{{url(env('SOCIAL_CONTACT_FACEBOOK'))}}" target="_blank"--}}
                            {{--                                   class="theme-btn theme-btn-10 theme-btn-10-white">FACEBOOK<i--}}
                            {{--                                            class="fa-light fa-arrow-right"></i></a>--}}
                            {{--                                <a href="{{url(env('SOCIAL_CONTACT_YOUTUBE'))}}" target="_blank"--}}
                            {{--                                   class="theme-btn theme-btn-10 theme-btn-10-transparent">YOUTUBE<i--}}
                            {{--                                            class="fa-light fa-arrow-right"></i></a>--}}
                            {{--                            </div>--}}
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

    {{--    <section class="h10_banner-area">--}}
    {{--        <div class="h10_single-banner bg-default" data-background="{{url("images/home/CHATMONGKOL.jpg")}}">--}}
    {{--            <img src="{{url("template/user-panel/assets/img/banner/10/shape-1.png")}}"--}}
    {{--                 class="h10_banner-shape-1 d-none d-xxl-block">--}}
    {{--            <img src="{{url("template/user-panel/assets/img/banner/10/shape-2.png")}}"--}}
    {{--                 class="h10_banner-shape-2 d-none d-xl-block">--}}
    {{--            <img src="{{url("template/user-panel/assets/img/banner/10/shape-3.png")}}"--}}
    {{--                 class="h10_banner-shape-3 d-none d-xl-block">--}}
    {{--            <div class="container">--}}
    {{--                <div class="row justify-content-between align-items-center">--}}
    {{--                    <div class="col-xxl-12 col-xl-12 col-lg-12">--}}
    {{--                        <div class="h10_banner-content mb-60 mb-lg-0">--}}
    {{--                            <div class="banner-content" align="center">--}}
    {{--                                <div class="section-area" align="center">--}}
    {{--                                    <p><br></p>--}}
    {{--                                    <p><br></p>--}}
    {{--                                    <p><br></p>--}}
    {{--                                    <p><br></p>--}}
    {{--                                    <p><br></p>--}}
    {{--                                    <a href="http://forking.moi.go.th" target="_blank"--}}
    {{--                                       class="theme-btn theme-btn-10 theme-btn-10-white">ลงนามถวายพระพร</a>--}}
    {{--                                </div>--}}

    {{--                            </div>--}}
    {{--                            <div class="h10_banner-content-btn mb-60" align="center">--}}

    {{--                            </div>--}}
    {{--                        </div>--}}

    {{--                    </div>--}}
    {{--                    <div class="col-xxl-6 col-xl-6 col-lg-6">--}}
    {{--                        --}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}

    <!-- banner area end -->

    @if($new_post)
        <!-- about area start -->
        @php
            $new_date = date_create($new_post->created_at);
            $month = date_format($new_date, 'm');
            $day = date_format($new_date, 'd');
            $year = date_format($new_date, 'Y');
        @endphp
        <section class="h6_about-area pt-120 pb-80 fix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="h6_about-img w_img h7_about-img-video">
                            <img src='{{url("images/image_post/$new_post->post_image")}}'
                                 alt="{{$new_post->post_title}}">
                            @if($new_post->post_youtube_link)
                                <a href="{{$new_post->post_youtube_link}}" class="popup-video"
                                   style="position: absolute;left: 50%; top: 50%; transform: translate(-50%, -50%);">
                                    <svg width="131" height="132" viewBox="0 0 131 132" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="65" cy="66" r="64" stroke="white" stroke-opacity="0.14"
                                                stroke-width="2"/>
                                        <path d="M65 131C100.899 131 130 101.899 130 66C130 30.1015 100.899 1 65 1"
                                              stroke="#B1040E" stroke-width="2"/>
                                    </svg>
                                    <i class="fa-solid fa-play"></i>
                                </a>
                            @endif
                            <div class="h6_about-img-content">
                                <h2>{{$day}}.{{$month}}</h2>
                                <span style="font-size: 30px;">{{$year + 543}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6">
                        <div class="h6_about-content ml-30 mb-30 mb-md-0 pb-30">
                            {{--                            <h2 class="h10_class-content-title"><span--}}
                            {{--                                        style="display: inline-block; padding: 5px 15px; position: relative; z-index: 1; color: #000; font-size: 24px; font-weight: 700; border: 1px solid #000; line-height: 1; border-radius: 4px; padding-left: 40px; margin-left: 5px;">{{$new_post->category_name}}</span>--}}
                            {{--                            </h2>--}}
                            <h3 class="h6_about-content-title set-font-thai" style="font-weight: normal;"><a
                                        href='{{url("posts/$new_post->uid")}}'>{{$new_post->post_title}}</a>
                            </h3>
                            <p class="set-font-thai">{{$new_post->post_detail}}</p>
                            <div class="event-content-meta">
                                <span class="set-font-thai"><i class="fa-thin fa-clock"></i>{{formatDateThaiBirthday($new_post->created_at)}}, {{Carbon\Carbon::parse($new_post->created_at)->diffForHumans()}}</span>
                            </div>
                            <a href='{{url("posts/$new_post->uid")}}'
                               class="h6_about-btn theme-btn theme-btn-medium theme-btn-6 set-font-thai">ดูรายละเอียด<i
                                        class="fa-light fa-arrow-up-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about area end -->
    @endif


    @foreach($events as $event)
        <!-- about area start -->
        @php
            $new_date = date_create($event->event_date);
            $month = date_format($new_date, 'm');
            $day = date_format($new_date, 'd');
            $year = date_format($new_date, 'Y');
        @endphp
        <section class="h6_about-area pt-20 pb-20 fix">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6">
                        <div class="h6_about-content ml-30 mb-30 mb-md-0 pb-30">

                            <h3 class="h6_about-content-title set-font-thai" style="font-weight: normal;"><a
                                        href='{{url("events/$event->event_slug")}}'>{{$event->event_name}}</a></h3>
                            <p class="set-font-thai">{{$event->event_description}}</p>
                            <a href='{{url("events/$event->event_slug")}}'
                               class="h6_about-btn theme-btn theme-btn-medium theme-btn-6 set-font-thai">ดูกิจกรรม<i
                                        class="fa-light fa-arrow-up-right"></i></a>
                            <a href='{{url("events")}}'
                               class="h6_about-btn theme-btn theme-btn-medium theme-btn-6 set-font-thai">ดูกิจกรรมทั้งหมด<i
                                        class="fa-light fa-arrow-up-right"></i></a>
                        </div>
                    </div>
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
                </div>
            </div>
        </section>
        <!-- about area end -->
    @endforeach

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
                                            @if ($new->post_image_thumbnail_file_name)
                                                <img src='{{url("images/image_post/thumbnail/$new->post_image_thumbnail_file_name")}}'
                                                     alt="{{$new_post->post_title}}">
                                            @else
                                                <img src='{{url("images/image_post/$new->post_image")}}'
                                                     alt="{{$new->post_title}}">
                                            @endif
                                        </div>
                                        <div class="course-content">
                                            <div class="course-content-top">
                                                {{--                                                <div class="course-top-icon"><img--}}
                                                {{--                                                            src="assets/img/course/1/v1.png" alt=""></div>--}}
                                                <div class="course-top-title">
                                                    <h6 class="set-font-thai">{{$new->category_name}}</h6>
                                                </div>

                                            </div>
                                            <h5 class="h2_blog-content-title-manual"><a
                                                        href='{{url("posts/$new->uid")}}'>{{$new->post_title}}</a>
                                            </h5>
                                            <div class="course-content-bottom">
                                                <div class="course-bottom-info">
                                                    <span class="set-font-thai"><i class="fa-thin fa-clock"></i>{{formatDateThaiBirthday($new->created_at)}}</span>
                                                </div>
                                                <div class="course-bottom-price set-font-thai">
                                                    <a href='{{url("posts/$new->uid")}}'
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
                            <p class="section-text set-font-thai" style="font-size: 18px; line-height: 1.5">
                                สังกัดสำนักบริหารงานการศึกษาพิเศษ สำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน
                                กระทรวงศึกษาธิการ ได้รับอนุมัติให้จัดตั้งเมื่อวันที่ 31 กรกฎาคม พ.ศ. 2543
                            </p>
                            <br>
                            <p class="section-text set-font-thai" style="font-size: 18px; line-height: 1.5">
                                ศูนย์การศึกษาพิเศษก่อตั้งครั้งแรกอาศัยตั้งสำนักงาน ณ โรงเรียนศึกษาพิเศษกาฬสินธุ์
                                ปัจจุบันเปลี่ยนเป็น โรงเรียนกาฬสินธุ์ปัญญานุกูล
                            </p>
                            <br>
                            <p class="section-text set-font-thai" style="font-size: 18px; line-height: 1.5">
                                และได้ย้ายสำนักงานอาคาร
                                ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ มาตั้งอยู่ เลขที่ 400 ถนนถีนานนท์
                                หมู่ที่ 1 ตำบลยางตลาด อำเภอยางตลาด จังหวัดกาฬสินธุ์ มีพื้นที่ จำนวน 7 ไร่ 3 งาน 80
                                ตารางวา
                            </p><br>
                            <p class="section-text set-font-thai" style="font-size: 18px; line-height: 1.5">
                                ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ เป็นสถานศึกษาที่จัดการศึกษาเพื่อเด็กพิการ
                                ในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม ฟื้นฟูสมรรถภาพ และเตรียมความพร้อม
                                เพื่อส่งต่อเด็กพิการเข้าเรียนร่วม
                                กับนักเรียนในโรงเรียนปกติหรือโรงเรียนเฉพาะความพิการ ทุกประเภทในจังหวัดกาฬสินธุ์
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