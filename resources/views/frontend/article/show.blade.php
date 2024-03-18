@extends('layouts.base.master')

@section('seo')
    <title>{{$post->post_title}}</title>
    <meta name="description" content="{{$post->post_detail}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
          content="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์, สำนักบริหารงานการศึกษาพิเศษ, {{$post->post_title}}, CAPER, คูปองการศึกษา">
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
          content='{{url("article/$post->post_slug")}}'/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{$post->post_title}}"/>
    <meta property="og:description" content="{{$post->post_detail}}"/>
    <meta property="og:image" content='{{url("images/image_post/$post->post_image")}}'/>

    <link rel="canonical" href="{{url('')}}"/>

@endsection

@section('style')
    <style type="text/css">
        .live_main {
            height: 400px;
        }

        .live_main iframe {
            width: 100%;
            height: 100%;
        }

        .thumb {
            height: 200px;
        }

        .thumb iframe {
            width: 100%;
            height: 100%;
            border: none;
            overflow: hidden;
        }

    </style>
@endsection

@section('content')
    <!-- breadcrumb area start -->
    <section class="breadcrumb-area bg-default" data-background="{{url("images/home/kalasin-3.jpg")}}">
        <img src="{{url("template/user-panel/assets/img/breadcrumb/shape-1.png")}}" alt="" class="breadcrumb-shape">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content" style="color: white;">
                        <h2 class="breadcrumb-title" style="color: white;">{{$post->post_title}}</h2>
                        {{--                        <div class="breadcrumb-list">--}}
                        {{--                            <a href="{{url('/')}}" style="color: white;">หน้าหลัก</a>--}}
                        {{--                            <a href='{{url("หมวดหมู่/$post->category_slug")}}' style="color: white;">{{$post->category_name}}</a>--}}
                        {{--                            <a href='{{url("หมวดหมู่/$post->category_slug/$post->sub_category_slug")}}' style="color: white;">{{$post->sub_category_name}}</a>--}}
                        {{--                            <span style="color: white;">{{$post->post_title}}</span>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->


    <!-- blog details area start -->
    <section class="blog_details-area pt-60 pb-80">
        <div class="container">
            @if(empty($post->post_youtube_embed))
                <div class="blog_details-img">
                    <img src='{{url("images/image_post/$post->post_image")}}' alt="{{$post->post_title}}"
                         style="border-radius: 25px;">
                </div>
            @endif
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="blog_details-wrap mb-60">
                        @if(empty($post->post_youtube_embed))
                            <div class="blog_details-top mb-50">
                                <h3 class="blog_details-title">{{$post->post_title}}</h3>
                                <div class="blog_details-meta">
                                    <div class="blog_details-author">
                                        <div class="blog_details-author-img">
                                            <img src="{{url('/images/home/sks-logo-2.png')}}" alt="">
                                        </div>
                                        <div class="blog_details-author-info">
                                            <span>เขียนโดย</span>
                                            <h5>{{$post->name}}</h5>
                                        </div>
                                    </div>
                                    <div class="blog_details-category">
                                        <span>เขียนเมื่อ</span>
                                        <h5>{{formatDateThaiBirthday($post->created_at)}}
                                            , {{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</h5>
                                    </div>
                                    <div class="blog_details-category">
                                        <span>จำนวนการเข้าชม</span>
                                        <h5>{{$views}} ครั้ง</h5>
                                    </div>

                                </div>
                            </div>
                            <div class="blog_details-content">
                                <blockquote class="blog_details-quote">
                                    <p>{{$post->post_detail}}</p>
                                    <span class="blog_details-quote-icon">
                                            <i class="fa-solid fa-quote-right"></i>
                                        </span>
                                </blockquote>
                                <div class="blog_details-inner-text mr-80">
                                    {!! $post->post_content !!}
                                </div>

                            </div>
                        @else
                            <div class="main-image live_main">
                                {!!$post->post_youtube_embed!!}
                            </div>

                            <div class="blog_details-top mb-50">
                                <h3 class="blog_details-title">{{$post->post_title}}</h3>
                                <div class="blog_details-meta">
                                    <div class="blog_details-author">
                                        <div class="blog_details-author-img">
                                            <img src="{{url('/images/home/sks-logo-2.png')}}" alt="">
                                        </div>
                                        <div class="blog_details-author-info">
                                            <span>เขียนโดย</span>
                                            <h5>{{$post->name}}</h5>
                                        </div>
                                    </div>
                                    <div class="blog_details-category">
                                        <span>เขียนเมื่อ</span>
                                        <h5>{{formatDateThaiBirthday($post->created_at)}}
                                            , {{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</h5>
                                    </div>
                                    <div class="blog_details-category">
                                        <span>จำนวนการเข้าชม</span>
                                        <h5>{{$views}} ครั้ง</h5>
                                    </div>

                                </div>
                            </div>
                            <div class="blog_details-content">
                                <blockquote class="blog_details-quote">
                                    <p>{{$post->post_detail}}</p>
                                    <span class="blog_details-quote-icon">
                                            <i class="fa-solid fa-quote-right"></i>
                                        </span>
                                </blockquote>
                                <div class="blog_details-inner-text mr-80">
                                    {!! $post->post_content !!}
                                </div>

                            </div>
                        @endif

                        <div class="blog_details-related mt-45 mb-20">
                            <h3 class="blog_details-related-title">เนื้อหาที่เกี่ยวข้อง</h3>
                            <div class="row">
                                @foreach($post_related as $related)
                                    <div class="col-md-6">
                                        <div class="h2_blog-item mb-30">
                                            <div class="h2_blog-img">
                                                <a href='{{url("article/$related->post_slug")}}'><img
                                                            src='{{url("images/image_post/$related->post_image")}}'
                                                            alt="{{$post->post_title}}"></a>
                                            </div>
                                            <div class="h2_blog-content">
                                                <div class="h2_blog-content-meta">
                                                    <span><i class="fa-thin fa-clock"></i> {{formatDateThaiBirthday($post->created_at)}}, {{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span>
                                                </div>
                                                <h5 class="h2_blog-content-title"><a
                                                            href='{{url("article/$related->post_slug")}}'>{{$related->post_title}}</a>
                                                </h5>
                                                <a href='{{url("article/$related->post_slug")}}'
                                                   class="theme-btn blog-btn t-theme-btn">เพิ่มเติม</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4">
                    @include('frontend.components.side-content-detail')
                </div>
            </div>
        </div>
    </section>


@endsection