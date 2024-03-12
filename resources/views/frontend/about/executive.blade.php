@extends('layouts.base.master')

@section('seo')
    <title>ผู้บริหารศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</title>
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
          content='{{url("/about/executive")}}'/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="ผู้บริหารศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"/>
    <meta property="og:description"
          content="เป็นสถานศึกษาที่จัดการศึกษาเพื่อเด็กพิการในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม ฟื้นฟูสมรรถภาพ และเตรียมความพร้อมเพื่อส่งต่อเด็กพิการเข้าเรียนร่วม กับนักเรียนในโรงเรียนปกติหรือโรงเรียนเฉพาะความพิการ ทุกประเภทในจังหวัดกาฬสินธุ์"/>
    <meta property="og:image" content='{{url("images/kalasin1.png")}}'/>
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
                        <h2 class="breadcrumb-title" style="color: white;">ช่องทางการติดต่อ</h2>
                        <div class="breadcrumb-list">
                            <a href="{{url('/')}}" style="color: white;">หน้าหลัก</a>
                            <span style="color: white;">ช่องทางการติดต่อ</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- teacher area start -->
    <section class="h9_teacher-area pt-105 pb-80">
        <div class="container">
            <div class="teacher-active-9">
                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                        <div class="h9_teacher-item mb-30">
                            <div class="h9_teacher-img">
                                <img src="{{url("images/home/executive/director.jpg")}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="section-area-9 text-center mb-40">
                        <h3 class=" mb-0">นายเจษฎา เวียงพล</h3>
                        <span class="section-subtitle">ผู้อำนวยการศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</span>

                    </div>
                </div>
            </div>
            <div class="teacher-active-9">
                <div class="row">
                    <div class="col-md-5"></div>
                    <div class="col-md-2">
                        <div class="h9_teacher-item mb-30">
                            <div class="h9_teacher-img">
                                <img src="{{url("images/home/executive/director-1.png")}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="section-area-9 text-center mb-40">
                        <h3 class=" mb-0">นางกุลทวี พลขันธ์</h3>
                        <span class="section-subtitle">รองผู้อำนวยการศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- teacher area end -->

    <!-- teacher area start -->
    <section class="innerPage_teacher-area pt-0 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-area-9 text-center mb-40">
                        <h3 class=" mb-0">หัวหน้ากลุ่มงาน</h3>
                    </div>
                </div>
            </div>
            <div class="row">
{{--                <div class="col-xl-6 col-lg-8 col-md-12 mb-30">--}}
{{--                    <div class="h2_teacher-section bg-default" data-background="{{url("template/user-panel/assets/img/teacher/2/bg.jpg")}}">--}}
{{--                        <div class="section-area-2">--}}
{{--                            <h2 class="section-title mb-30">Our Most <br> Experience--}}
{{--                                <span>Professor <img src="{{url("template/user-panel/assets/img/banner/2/line.png")}}" alt=""></span></h2>--}}
{{--                        </div>--}}
{{--                        <div class="h2_teacher-button">--}}
{{--                            <a href="#" class="theme-btn theme-btn-medium teacher-btn">Become An Instructor</a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-3 col-lg-4 col-sm-6">--}}
{{--                    <div class="h2_teacher-item mb-30">--}}
{{--                        <div class="h2_teacher-img">--}}
{{--                            <img src="{{url("template/user-panel/assets/img/teacher/2/1.jpg")}}" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="h2_teacher-content">--}}
{{--                            <h5 class="h2_teacher-content-title">--}}
{{--                                <a href="#">Parsley Montana</a>--}}
{{--                            </h5>--}}
{{--                            <span>Lead Teacher</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xl-3 col-lg-4 col-sm-6">--}}
{{--                    <div class="h2_teacher-item mb-30">--}}
{{--                        <div class="h2_teacher-img">--}}
{{--                            <img src="{{url("template/user-panel/assets/img/teacher/2/2.jpg")}}" alt="">--}}
{{--                        </div>--}}
{{--                        <div class="h2_teacher-content">--}}
{{--                            <h5 class="h2_teacher-content-title">--}}
{{--                                <a href="#">Parsley Montana</a>--}}
{{--                            </h5>--}}
{{--                            <span>Lead Teacher</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="h2_teacher-item mb-30">
                        <div class="h2_teacher-img">
                            <img src="{{url("images/home/executive/team-lead-1.jpg")}}" alt="">
                        </div>
                        <div class="h9_teacher-content" style="text-align: center;">
                            <h5 class="h2_teacher-content-titlee">
                                นางพิกุล หินวิเศษ
                            </h5>
                            <span>หัวหน้ากลุ่มบริหารงานวิชาการ</span>
                        </div>
{{--                        <div class="h2_teacher-content">--}}
{{--                            <h5 class="h2_teacher-content-title">--}}
{{--                                <a href="#">Parsley Montana</a>--}}
{{--                            </h5>--}}
{{--                            <span>Lead Teacher</span>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="h2_teacher-item mb-30">
                        <div class="h2_teacher-img">
                            <img src="{{url("images/home/executive/team-lead-2.jpg")}}" alt="">
                        </div>
                        <div class="h9_teacher-content" style="text-align: center;">
                            <h5 class="h2_teacher-content-titlee">
                                นางสาวศรัญญา ขานหยู
                            </h5>
                            <span>หัวหน้ากลุ่มบริหารงานแผนงานและงบประมาณ</span>
                        </div>
{{--                        <div class="h2_teacher-content">--}}
{{--                            <h5 class="h2_teacher-content-title">--}}
{{--                                นางสาวศรัญญา ขานหยู--}}
{{--                            </h5>--}}
{{--                            <span>หัวหน้ากลุ่มบริหารงานแผนงานและงบประมาณ</span>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="h2_teacher-item mb-30">
                        <div class="h2_teacher-img">
                            <img src="{{url("images/home/executive/team-lead-3.jpg")}}" alt="">
                        </div>
                        <div class="h9_teacher-content" style="text-align: center;">
                            <h6 class="h2_teacher-content-titlee">
                                นางปนัดดา อามาตย์สมบัติ
                            </h6>
                            <span>หัวหน้ากลุ่มบริหารงานบุคคล</span>
                        </div>
{{--                        <div class="h2_teacher-content">--}}
{{--                            <h5 class="h2_teacher-content-title">--}}
{{--                                นางปนัดดา อามาตย์สมบัติ--}}
{{--                            </h5>--}}
{{--                            <span>หัวหน้ากลุ่มบริหารงานบุคคล</span>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="h2_teacher-item mb-30">
                        <div class="h2_teacher-img">
                            <img src="{{url("images/home/executive/team-lead-4.jpg")}}" alt="">
                        </div>
                        <div class="h9_teacher-content" style="text-align: center;">
                            <h5 class="h2_teacher-content-titlee">
                                นายบัญชา ขัณฑ์ชลา
                            </h5>
                            <span>หัวหน้ากลุ่มบริหารงานทั่วไป</span>
                        </div>
{{--                        <div class="h2_teacher-content">--}}
{{--                            <h5 class="h2_teacher-content-title">--}}
{{--                               นายบัญชา ขัณฑ์ชลา--}}
{{--                            </h5>--}}
{{--                            <span>หัวหน้ากลุ่มบริหารงานทั่วไป</span>--}}
{{--                        </div>--}}
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- teacher area end -->

@endsection