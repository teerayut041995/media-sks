@extends('layouts.base.master')

@section('seo')
    <title>{{findServiceType($request->service_type)}} | ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</title>
    <meta name="description"
          content="{{findServiceType($request->service_type)}} ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ จัดและส่งเสริม  สนับสนุนการศึกษาในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม (Early Intervention :EI) และเตรียมความพร้อมของเด็กพิการที่หน่วยบริการของศูนย์การศึกษาพิเศษ รวมทั้งที่บ้านและชุมชน  เพื่อเข้าสู่ศูนย์พัฒนาเด็กเล็กโรงเรียนอนุบาล โรงเรียนเรียนรวม  โรงเรียนเฉพาะความพิการและหน่วยงานที่เกี่ยวข้อง">

    <meta name="keywords"
          content="{{findServiceType($request->service_type)}}, {{findServiceType($request->service_type)}} ศูนย์การศึกษาพิเศษ, {{findServiceType($request->service_type)}} ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์, สำนักบริหารงานการศึกษาพิเศษ, บริการช่วยเหลือระยะแรกเริ่ม, การศึกษาพิเศษ">

    <meta property="og:url"
          content="{{url('services?service_type=service_unit')}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title"
          content="{{findServiceType($request->service_type)}} | ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"/>
    <meta property="og:description"
          content="{{findServiceType($request->service_type)}} ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ จัดและส่งเสริม  สนับสนุนการศึกษาในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม (Early Intervention :EI) และเตรียมความพร้อมของเด็กพิการที่หน่วยบริการของศูนย์การศึกษาพิเศษ รวมทั้งที่บ้านและชุมชน  เพื่อเข้าสู่ศูนย์พัฒนาเด็กเล็กโรงเรียนอนุบาล โรงเรียนเรียนรวม  โรงเรียนเฉพาะความพิการและหน่วยงานที่เกี่ยวข้อง"/>
    <meta property="og:image" content="{{url("images/logo", env('OG_IMAGE', ''))}}"/>
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
                        <h2 class="breadcrumb-title"
                            style="color: white;">{{findServiceType($request->service_type)}}</h2>
                        <div class="breadcrumb-list">
                            <a href='{{url("/")}}' style="color: white;">หน้าหลัก</a>
                            <span style="color: white;">{{findServiceType($request->service_type)}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->


    <!-- blog details area start -->
    <section class="blog_details-area pt-80 pb-80">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="section-area-8 mb-20">
                        <h2 class="section-title mb-0">{{findServiceType($request->service_type)}}</h2>
                        <span class="section-subtitle">{{env('SCHOOL_NAME', '')}}</span>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    @if (count($services) > 0)
                        <div class="row">
                            @foreach($services as $service)
                                <div class="col-xl-4 col-lg-6 col-md-6">
                                    <div class="h2_blog-item mb-30">
                                        <div class="h2_blog-img">
                                            <a href='{{url("services/$service->uid")}}'><img
                                                        src='{{url("images/service/thumbnail/$service->service_image_file_name")}}'
                                                        alt="{{$service->service_name}}"></a>
                                        </div>
                                        <div class="h2_blog-content">
                                            <h4 class="set-font-thai"><a
                                                        href='{{url("services/$service->uid")}}'>{{$service->service_name}}</a>
                                            </h4>
                                            <div align="right">
                                                <a href='{{url("services/$service->uid")}}'
                                                   class="theme-btn blog-btn t-theme-btn set-font-thai">ดูข้อมูล</a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="row">
                            <div class="col-md-12" align="center">
                                <h2 class="breadcrumb-title">ไม่พบบทความในหมวดหมู่นี้</h2>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection