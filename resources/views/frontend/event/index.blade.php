@extends('layouts.base.master')

@section('seo')
    <title>กิจกรรมศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</title>
    <meta name="description" content="กิจกรรมศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
    <meta name="keywords"
          content="กิจกรรมศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์, สำนักบริหารงานการศึกษาพิเศษ">

    <meta property="og:url"
          content='{{url("")}}'/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="กิจกรรมศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"/>
    <meta property="og:description"
          content="กิจกรรมศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"/>
    <meta property="og:image" content="{{url("images/logo", env('OG_IMAGE', ''))}}" />
@endsection


@section('content')
    <!-- breadcrumb area start -->
    <section class="breadcrumb-area bg-default" data-background="{{url("images/home/kalasin-3.jpg")}}">
        <img src="{{url("template/user-panel/assets/img/breadcrumb/shape-1.png")}}" alt="" class="breadcrumb-shape">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content" style="color: white;">
                        <h2 class="breadcrumb-title" style="color: white;">กิจกรรม</h2>
                        <div class="breadcrumb-list">
                            <a href="{{url('/')}}" style="color: white;">หน้าหลัก</a>
                            <span style="color: white;">กิจกรรม</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->


    <!-- blog details area start -->
    <section class="blog_details-area pt-120 pb-80">
        <div class="container">
{{--            <div class="blog_details-img">--}}
{{--                <img src="{{url("template/user-panel/assets/img/blog/details/1.jpg")}}" alt="">--}}
{{--            </div>--}}
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    @if (count($events) > 0)
                        <div class="row">
                            @foreach($events as $event)
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="h2_blog-item mb-30">
                                        <div class="h2_blog-img">
                                            <a href='{{url("events/$event->event_slug")}}'><img
                                                        src='{{url("images/image_event/$event->event_image")}}'
                                                        alt="{{$event->event_name}}"></a>
                                        </div>
                                        <div class="h2_blog-content">
                                            <div class="h2_blog-content-meta">
                                                <span><i class="fa-thin fa-clock"></i>{{formatDateThaiBirthday($event->created_at)}}, {{Carbon\Carbon::parse($event->created_at)->diffForHumans()}}</span>
                                            </div>
                                            <h5 class="h2_blog-content-title"><a
                                                        href='{{url("events/$event->event_slug")}}'>{{$event->event_name}}</a></h5>
{{--                                            <p class="h2_course-content-text">--}}
{{--                                                {{$event->event_description}}--}}
{{--                                            </p>--}}
                                            <a href='{{url("events/$event->event_slug")}}'class="theme-btn blog-btn t-theme-btn">เพิ่มเติม</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{$events->links()}}
                    @else
                        <div class="row">
                            <div class="col-md-12" align="center">
                                <h2 class="breadcrumb-title">ไม่พบบทความในหมวดหมู่นี้</h2>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-xl-4 col-lg-4">
                    @include('frontend.components.side-content')
                </div>
            </div>
        </div>
    </section>


@endsection