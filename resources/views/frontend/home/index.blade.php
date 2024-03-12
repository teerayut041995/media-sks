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

                                    <p class="h6_banner-content-text" data-animation="fadeInUp" data-delay="0.7s" style="font-style: italic; font-size: 20px;">“สถานศึกษาแกนนำ
                                        ที่นำสื่อและเทคโนโลยีทางการศึกษาเพื่อพัฒนากระบวนการจัดการเรียนรู้ที่มีคุณภาพ“</p>
                                </div>
                            </div>

                            <div class="h10_banner-content-btn mb-60">
                                <a href="{{url(env('SOCIAL_CONTACT_FACEBOOK'))}}" target="_blank" class="theme-btn theme-btn-10 theme-btn-10-white">FACEBOOK<i
                                            class="fa-light fa-arrow-right"></i></a>
                                <a href="{{url(env('SOCIAL_CONTACT_YOUTUBE'))}}" target="_blank" class="theme-btn theme-btn-10 theme-btn-10-transparent">YOUTUBE<i
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

    <!-- event area start -->
    <section class="event-area">
        <img src="{{url("template/user-panel/assets/img/event/1/bg.jpg")}}" alt="" class="event-bg-img">
        <div class="event-wrap pt-60 pb-60">
            <div class="container">
                <div class="row align-items-center mb-3">
                    <div class="col-xl-8 col-lg-8 col-md-8">
                        <div class="event-section-area mb-20">
                            <div class="section-area">
                                <span class="section-subtitle">ติดตามข้อมูลข่าวสาร</span>
                                <h2 class="section-title mb-0">อัพเดตล่าสุด</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="event-navigation mb-30">
                            <div class="event-prev"><i class="fa-thin fa-arrow-left"></i>
                            </div>
                            <div class="event-next"><i class="fa-light fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event-active swiper pb-20">
                    <div class="swiper-wrapper">
                        @foreach($new_post as $new)
                            <div class="swiper-slide">
                                <div class="event-item">
                                    <div class="event-img">
                                        <a href='{{url("article/$new->post_slug")}}'><img
                                                    src='{{url("images/image_post/$new->post_image")}}'
                                                    alt="{{$new->post_title}}"></a>
                                    </div>
                                    <div class="event-content">
                                        <div class="event-content-meta">
                                            {{--                                        <span><i class="fa-thin fa-location-dot"></i>{{ $new->views_count }}</span>--}}
                                            <span><i class="fa-thin fa-clock"></i>{{Carbon\Carbon::parse($new->created_at)->diffForHumans()}}</span>
                                        </div>
                                        <h5 class="event-content-title"><a
                                                    href='{{url("article/$new->post_slug")}}'>{{$new->post_title}}</a>
                                        </h5>
{{--                                        <label class="h2_course-content-text">--}}
{{--                                            {{$new->post_detail}}--}}
{{--                                        </label>--}}
                                        <a href='{{url("article/$new->post_slug")}}'
                                           class="t-theme-btn theme-btn event-btn">เพิ่มเติม</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- event area end -->

    <!-- blog area start -->
    <section class="blog-area pt-20 pb-20">
        <div class="container">
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
                                <p style="font-size: 20px; font-style: italic; color: #1E1E1E; margin-bottom: 15px;">“สถานศึกษาแกนนำ
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
                            <p style="font-size: 20px; font-style: italic; color: #1E1E1E; margin-bottom: 15px;">“นักเรียนศูนย์การศึกษาพิเศษประจำจังหวัดกาฬสินธุ์ มีความสุข สนุก ร่งเริง“</p>
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
                        <img src="{{url("images/home/present/sks-present-5.JPG")}}" alt="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
                        <div class="h6_about-img-content">
                            <h2>2543</h2>
                            <span>ก่อตั้งเมื่อปี</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="about-content">
                        <div class="section-area">
                            <span class="section-subtitle">เกี่ยวกับสถานศึกษา</span>
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
@endsection