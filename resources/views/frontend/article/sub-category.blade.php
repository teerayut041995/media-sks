@extends('layouts.base.master')

@section('seo')
    <title>{{$category->sub_category_name}}</title>
    <meta name="description" content="{{$category->sub_category_name}} ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
          content="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์, สำนักบริหารงานการศึกษาพิเศษ, {{$category->sub_category_name}}">
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
          content='{{url("หมวดหมู่/$category->category_slug/$category->sub_category_name")}}'/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{$category->sub_category_name}}"/>
    <meta property="og:description" content="{{$category->sub_category_name}} ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"/>
    <meta property="og:image" content='{{url("images/kalasin-og.jpg")}}'/>

    <link rel="canonical" href="{{url('')}}" />

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
                            <a href='{{url("หมวดหมู่/$category->category_slug")}}' style="color: white;">{{$category->category_name}}</a>
                            <span style="color: white;">{{$category->sub_category_name}}</span>
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
            <div class="blog_details-img">
                <img src="assets/img/blog/details/1.jpg" alt="">
            </div>
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
                                                        href='{{url("article/$post->post_slug")}}'>{{$post->post_title}}</a></h5>
                                            <p class="h2_course-content-text">
                                                {{$post->post_detail}}
                                            </p>
                                            <a href='{{url("article/$post->post_slug")}}' class="theme-btn blog-btn t-theme-btn">เพิ่มเติม</a>
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
                    <div class="blog_details-sidebar mb-60">
                        <div class="blog_details-widget">
                            <h4 class="blog_details-widget-title">ค้นหา</h4>
                            <form method="get">
                                <input type="text" name="name" placeholder="ค้นหารที่นี้..."
                                       value="{{$active['name']}}">
                                <button type="submit"><i class="fa-thin fa-magnifying-glass"></i></button>
                            </form>
                        </div>
                        <div class="blog_details-widget">
                            <h4 class="blog_details-widget-title">ล่าสุด</h4>
                            @foreach($recent_posts as $recent)
                                <div class="blog_details-widget-post">

                                    <div class="blog_details-post-img">
                                        <a href='{{url("article/$recent->post_slug")}}'><img
                                                    src='{{url("images/image_post/$recent->post_image")}}'
                                                    alt="{{$recent->post_title}}"></a>
                                    </div>
                                    <div class="blog_details-post-info">
                                        <span><i class="fa-thin fa-clock"></i>{{formatDateThaiBirthday($recent->created_at)}}, {{Carbon\Carbon::parse($recent->created_at)->diffForHumans()}}</span>
                                        <h6><a href='{{url("article/$recent->post_slug")}}'>{{$recent->post_title}}</a>
                                        </h6>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="blog_details-widget widget-category">
                            <h4 class="blog_details-widget-title">หมวดหมู่</h4>
                            <div class="blog_details-widget-category">
                                <ul>
                                    @foreach($categories as $category)
                                        <li>
                                            <a href='{{url("หมวดหมู่/$category->category_slug")}}'>{{$category->category_name}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="blog_details-widget">
                            <h4 class="blog_details-widget-title">ยอดนิยม</h4>
                            @foreach($popular_posts as $popular)
                                <div class="blog_details-widget-course">
                                    <div class="blog_details-course-img">
                                        <a href='{{url("article/$popular->post_slug")}}'><img
                                                    src='{{url("images/image_post/$popular->post_image")}}'
                                                    alt="{{$popular->post_title}}"></a>
                                    </div>
                                    <div class="blog_details-course-info">
                                        <h6><a href="#">{{$popular->post_title}}</a></h6>
                                        <a href='{{url("article/$popular->post_slug")}}'
                                           class="inner-course-rate">การดู {{$popular->views_count}} ครั้ง</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="blog_details-widget">
                            <h4 class="blog_details-widget-title">Tags</h4>
                            <div class="blog_details-widget-tag">
                                <ul>
                                    @foreach($sub_categories as $sub_category)
                                        <li><a href="#">{{$sub_category->sub_category_name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection