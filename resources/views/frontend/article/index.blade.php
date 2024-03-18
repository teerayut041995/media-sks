@extends('layouts.base.master')

@section('seo')
    <title>{{$category->category_name}}</title>
    <meta name="description" content="{{$category->category_name}} ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
          content="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์, สำนักบริหารงานการศึกษาพิเศษ, {{$category->category_name}}">
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
          content='{{url("หมวดหมู่/$category->category_slug")}}'/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{$category->category_name}}"/>
    <meta property="og:description" content="{{$category->category_name}} ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"/>
    <meta property="og:image" content='{{url("images/kalasin-og.jpg")}}'/>
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
                        <h2 class="breadcrumb-title" style="color: white;">{{$category->category_name}}</h2>
                        <div class="breadcrumb-list">
                            <a href="{{url('/')}}" style="color: white;">หน้าหลัก</a>
                            <span style="color: white;">{{$category->category_name}}</span>
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
                    @if (count($posts) > 0)
                        <div class="row">
                            @foreach($posts as $post)
                                <div class="col-xl-4 col-lg-6 col-md-6">
                                    <div class="h2_blog-item mb-30">
                                        <div class="h2_blog-img">
                                            <a href='{{url("article/$post->post_slug")}}'><img
                                                        src='{{url("images/image_post/$post->post_image")}}'
                                                        alt="{{$post->post_title}}"></a>
                                        </div>
                                        <div class="h2_blog-content">
                                            <div class="h2_blog-content-meta">
                                                {{--                                        <span><i class="fa-thin fa-user"></i>Admin</span>--}}
                                                <span><i class="fa-thin fa-clock"></i>{{formatDateThaiBirthday($post->created_at)}}, {{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span>
                                            </div>
                                            <h5 class="h2_blog-content-title"><a
                                                        href='{{url("article/$post->post_slug")}}'>{{$post->post_title}}</a>
                                            </h5>
                                            <p class="h2_course-content-text">
                                                {{$post->post_detail}}
                                            </p>
                                            <a href='{{url("article/$post->post_slug")}}'
                                               class="theme-btn blog-btn t-theme-btn">เพิ่มเติม</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{$posts->links()}}
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