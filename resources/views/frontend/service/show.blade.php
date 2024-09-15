@extends('layouts.base.master')

@section('seo')
    <title>{{$service->service_name}} | ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</title>
    <meta name="description"
          content="{{$service->service_description}}">

    <meta name="keywords"
          content="{{$service->service_name}}, {{$service->service_name}} ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์, ศูนย์การศึกษาพิเศษ, สำนักบริหารงานการศึกษาพิเศษ, บริการช่วยเหลือระยะแรกเริ่ม, การศึกษาพิเศษ">

    <meta property="og:url"
          content='{{url("services/$service->uid")}}'/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{$service->service_name}} | ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"/>
    <meta property="og:description"
          content="{{$service->service_description}}"/>
    @if($image_banner)
        <meta property="og:image"
              content="{{url("images/service/thumbnail", $image_banner->service_image_file_name)}}"/>
    @else
        <meta property="og:image" content="{{url("images/logo", env('OG_IMAGE', ''))}}"/>
    @endif
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
    <section class="h6_banner-area">
        <div class="swiper banner_6_active">
            <div class="swiper-wrapper">
                @if($image_banner)
                    <div class="swiper-slide">
                        {{--                    data-background="{{url('images/banner/f2ee6827c62694d0449ca518ea3ea2aa.jpg')}}"--}}
                        <div class="h6_single-banner bg-default">
                            <img src="{{url('images/service', $image_banner->service_image_file_name)}}"
                                 style="width: 100%; position: relative; padding-top: 0px;"
                                 alt="{{$service->service_name}}">
                            <div class="container">

                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="h6_banner-navigation">
                <div class="banner_6-swiper-prev"><i class="fa-thin fa-angle-left"></i></div>
                <div class="banner_6-swiper-next"><i class="fa-thin fa-angle-right"></i></div>
            </div>
        </div>
    </section>
    <!-- banner area end -->

    <section class="blog_details-area pt-0 pb-00">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <div class="h3_testimonial-item">
                        <div class="h3_testimonial-item-content">
                            <p class="set-font-thai">{{$service->service_description}}</p>
                            <img src="{{url('template/user-panel/assets/img/testimonial/3/quote.png')}}" alt=""
                                 class="quote">
                        </div>
                    </div>
                    {{--                    <blockquote class="blog_details-quote">--}}
                    {{--                        <h3>วิสัยทัศน์</h3>--}}
                    {{--                        <p>“ศูนย์การศึกษาพิเศษประจำ จังหวัดกาฬสินธุ์ เป็นสถานศึกษาที่มีมาตรฐาน ก้าวทันเทคโนโลยี--}}
                    {{--                            พัฒนาคุณภาพชีวิตเด็กพิการแบบองค์รวม <br>ตามแนวทางปรัชญาเศรษฐกิจพอเพียง และมนุษยปรัชญา--}}
                    {{--                            ให้เป็นคนดีและมีความสุข”</p>--}}
                    {{--                    </blockquote>--}}
                </div>
            </div>
        </div>
    </section>


    <!-- about area start -->
    <section class="h6_about-area pt-0 pb-80 fix">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="h6_about-img w_img">
                        @if ($image_preview_1)
                            <img src="{{url('/images/service', $image_preview_1->service_image_file_name)}}"
                                 style="width: 100%;" alt="{{$service->service_name}}">
                        @else
                            <img src="{{url('/images/service/example.jpg')}}" style="width: 100%;">
                        @endif
                        <div class="h6_about-img-content">
                            {{--                            <h2>1913</h2>--}}
                            <span>{{$service->service_name}}</span>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="h6_about-content ml-30 mb-30 mb-md-0 pb-30">
                        <h3 class="h6_about-content-title set-font-thai">บทบาทหน้าที่/ภารกิจ</h3>
                        <p class="set-font-thai" style="font-size: 17px;">{!! nl2br($service->service_mission) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about area end -->

    <!-- research area start -->
    <section class="h6_research-area pt-0 pb-70 fix">
        <div class="container">
            <div class="row">

                <div class="col-xxl-5 col-xl-6 col-lg-6">
                    <div class="h6_research-wrap mb-50">
                        <div class="h6_research-content">
                            <h4 class="set-font-thai">การจัดกิจกรรมการเรียนการสอน</h4>
                            <p class="set-font-thai"
                               style="font-size: 17px;">{!! nl2br($service->service_learning_activity) !!}</p>
                        </div>
                        <div class="research-text-wrap mt-25">
                            <div class="research-text-ticker" id="research-text-ticker">
                                <h1 class="h6_research-bottom-text">{{$service->service_name}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7 col-xl-6 col-lg-6">
                    <div class="h6_research-img w_img mb-50">
                        @if ($image_preview_2)
                            <img src="{{url('/images/service', $image_preview_2->service_image_file_name)}}"
                                 style="width: 100%;" alt="{{$service->service_name}}">
                        @else
                            <img src="{{url('/images/service/example.jpg')}}" style="width: 100%;">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- research area end -->

    <!-- blog area start -->
    <section class="h8_blog-area pt-0 pb-0">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-8 col-lg-8 col-md-8">
{{--                    <div class="section-area-8 mb-20">--}}
{{--                        <span class="section-subtitle">Our Blogs</span>--}}
{{--                        <h2 class="section-title mb-0">Have a Look on Our News</h2>--}}
{{--                    </div>--}}
                </div>
                <div class="col-xl-4 col-lg-4 col-md-4">
                    <div class="h8_blog-navigation mb-30">
                        <div class="h8_blog-prev">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13 7H1" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 1L1 7L7 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="h8_blog-next">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 7H13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7 1L13 7L7 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-active-8 swiper pb-80 pt-30">
                <div class="swiper-wrapper">
                    @foreach($image_general as $general)
                    <div class="swiper-slide">
                        <div class="h8_blog-item">
                            <div class="h8_blog-item-img w_img">
                                <div class="innerPage_gallery-item">
                                    <div class="innerPage_gallery-img">
                                        <img src="{{url('/images/service', $general->service_image_file_name)}}" alt="">
                                    </div>
                                    <div class="innerPage_gallery-content">
                                        <a href="{{url('/images/service', $general->service_image_file_name)}}" class="popup-image"><i class="fa-thin fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="h8_blog-item-content">
                                <h4 class="h8_blog-item-content-title">{{$general->service_image_name}}</h4>
                                <p>{{$general->service_image_description}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- blog area end -->

    <section class="contact-area pt-10 pb-120">
        <div class="container">
            <div class="contact-wrap">
                <div class="row">
                    <div class="col-xl-6 col-md-6">
                        <div class="contact-info ml-50 mb-20">
                            <h3 class="contact-title mb-40">ติดต่อ{{$service->service_name}}</h3>
                            <div class="contact-info-item">
                                <span><i class="fa-thin fa-location-dot"></i>ที่อยู่</span>
                                <p>{{$service->service_address}}</p>
                            </div>
                            <div class="contact-info-item">
                                <span><i class="fa-thin fa-mobile-notch"></i>เบอร์โทรศัพท์</span>
                                <a href="tel:{{$service->service_contact_phone_number}}">{{$service->service_contact_phone_number}}</a>
                            </div>
                            <div class="contact-info-item">
                                <span><i class="fa-thin fa-envelope"></i>ชื่อผู้ติดต่อ</span>
                                <a href="javascript:void(0)">{{$service->service_contact_name}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-6">
                        <div class="contact-info ml-50 mb-20">
                            <h3 class="contact-title mb-40">ติดต่อศูนย์การศึกษาพิเศษ</h3>
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
            {!! nl2br($service->service_embed_map) !!}
{{--            {{$service->}}--}}
        </div>
    </section>

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