@extends('layouts.base.master')

@section('seo')
    <title>{{$category->category_name}} | ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</title>
    <meta name="description"
          content="{{$category->category_name}} ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ เป็นสถานศึกษาที่จัดการศึกษาเพื่อเด็กพิการในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม ฟื้นฟูสมรรถภาพ และเตรียมความพร้อมเพื่อส่งต่อเด็กพิการเข้าเรียนร่วม กับนักเรียนในโรงเรียนปกติหรือโรงเรียนเฉพาะความพิการ ทุกประเภทในจังหวัดกาฬสินธุ์">

    <meta name="keywords"
          content="{{$category->category_name}}, ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์, ศูนย์การศึกษาพิเศษ, สำนักบริหารงานการศึกษาพิเศษ, บริการช่วยเหลือระยะแรกเริ่ม, การศึกษาพิเศษ">

    @if ($sub_category)
        <meta property="og:url"
              content='{{url("posts?category=$category->uid&sub_category=$sub_category->uid")}}'/>
    @else
        <meta property="og:url"
              content='{{url("posts?category=$category->uid")}}'/>
    @endif
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{$category->category_name}} | ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"/>
    <meta property="og:description"
          content="{{$category->category_name}} ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ เป็นสถานศึกษาที่จัดการศึกษาเพื่อเด็กพิการในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม ฟื้นฟูสมรรถภาพ และเตรียมความพร้อมเพื่อส่งต่อเด็กพิการเข้าเรียนร่วม กับนักเรียนในโรงเรียนปกติหรือโรงเรียนเฉพาะความพิการ ทุกประเภทในจังหวัดกาฬสินธุ์"/>
    <meta property="og:image" content="{{url("images/logo", env('OG_IMAGE', ''))}}" />
    <link rel="canonical" href="{{url('')}}"/>
@endsection

@section('style')
    <style>
        .section-subtitle-manual {
            font-size: 25px;
            font-family: 'Chakra Petch';
            color: #1E1E1E;
            text-align: center;
            line-height: 2.0;
        }

        @media (max-width: 767px) {
            .section-subtitle-manual {
                font-size: 20px;
                font-family: 'Chakra Petch';
                color: #1E1E1E;
                text-align: center;
                line-height: 1.7;
            }
        }

        @media only screen and (min-width: 576px) and (max-width: 767px) {
            .section-subtitle-manual {
                font-size: 25px;
                font-family: 'Chakra Petch';
                color: #1E1E1E;
                text-align: center;
                line-height: 1.7;
            }
        }

        .subtitle-manual {
            font-size: 18px;
            font-family: 'Chakra Petch';
            /*font-weight: bold;*/
            color: #1E1E1E;
            text-align: left;
            line-height: 2.0;
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
                        <h2 class="breadcrumb-title" style="color: white;">{{$category->category_name}}</h2>
                        @if ($sub_category)
                            <div class="breadcrumb-list">
                                <a href='{{url("/")}}' style="color: white;">หน้าหลัก</a>
                                <a href='{{url("posts?category=$category->uid")}}'
                                   style="color: white;">{{$category->category_name}}</a>
                                <span style="color: white;">{{$sub_category->sub_category_name}}</span>
                            </div>
                        @else
                            <div class="breadcrumb-list">
                                <a href='{{url("/")}}' style="color: white;">หน้าหลัก</a>
                                <span style="color: white;">{{$category->category_name}}</span>
                            </div>
                        @endif
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
                                            <a href='{{url("posts/$post->uid")}}'><img
                                                        src='{{url("images/image_post/$post->post_image")}}'
                                                        alt="{{$post->post_title}}"></a>
                                        </div>
                                        <div class="h2_blog-content">
                                            <div class="h2_blog-content-meta">
                                                {{--                                        <span><i class="fa-thin fa-user"></i>Admin</span>--}}
                                                <span class="set-font-thai"><i class="fa-thin fa-clock"></i>{{formatDateThaiBirthday($post->created_at)}}, {{Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</span>
                                            </div>
                                            <h5 class="h2_blog-content-title h2_blog-content-meta-manual"><a
                                                        href='{{url("posts/$post->uid")}}'>{{$post->post_title}}</a>
                                            </h5>
                                            <p class="h2_course-content-text set-font-thai">
                                                {{$post->post_detail}}
                                            </p>
                                            <a href='{{url("posts/$post->uid")}}'
                                               class="theme-btn blog-btn t-theme-btn set-font-thai">เพิ่มเติม</a>
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