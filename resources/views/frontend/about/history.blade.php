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

    <!-- breadcrumb area start -->
    <section class="breadcrumb-area bg-default" data-background="{{url("images/home/kalasin-3.jpg")}}">
        <img src="{{url("template/user-panel/assets/img/breadcrumb/shape-1.png")}}" alt="" class="breadcrumb-shape">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content" style="color: white;">
                        <h2 class="breadcrumb-title" style="color: white;">ประวัติความเป็นมา</h2>
                        <div class="breadcrumb-list">
                            <a href="{{url('/')}}" style="color: white;">หน้าหลัก</a>
                            <span style="color: white;">ประวัติความเป็นมา</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- about area start -->
    <section class="about-area pt-60 pb-20">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="about-img">
                        <img src="{{url("images/kalasin1.jpg")}}" alt="">
                        {{--                        <div class="about-img-meta">--}}
                        {{--                            <span><i class="fa-solid fa-star"></i>4.5 (3.4k Reviews)</span>--}}
                        {{--                            <h5>Congratulations</h5>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-10">
                    <div class="about-content">
                        <div class="section-area">
                            <span class="section-subtitle">เกี่ยวกับสถานศึกษา</span>
                            <h2 class="section-title mb-15">ศูนย์การศึกษาพิเศษ <br>ประจำจังหวัดกาฬสินธุ์</h2>
                            <p class="section-text">
                                ศูนย์การศึกษาพิเศษ ประจังหวัดกาฬสินธุ์ สังกัดสำนักบริหารงานการศึกษาพิเศษ
                                <br>สำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน กระทรวงศึกษาธิการ
                                <br>ได้รับอนุมัติให้จัดตั้งเมื่อวันที่ 31 กรกฎาคม พ.ศ. 2543
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
    </section>
    <!-- about area end -->

    <!-- blog details area start -->
    <section class="blog_details-area pt-20 pb-20">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <blockquote class="blog_details-quote">
                        <h3>วิสัยทัศน์</h3>
                        <p>“ศูนย์การศึกษาพิเศษประจำ จังหวัดกาฬสินธุ์ เป็นสถานศึกษาที่มีมาตรฐาน ก้าวทันเทคโนโลยี
                            พัฒนาคุณภาพชีวิตเด็กพิการแบบองค์รวม <br>ตามแนวทางปรัชญาเศรษฐกิจพอเพียง และมนุษยปรัชญา
                            ให้เป็นคนดีและมีความสุข”</p>
                    </blockquote>
                </div>
            </div>
        </div>
    </section>

    <!-- banner area start -->
    <section class="h5_banner-area">
        <div class="h5_single-banner">
            <div class="h5_banner-bg w_img d-none d-lg-block">
                <img src="{{url("images/home/present/sks-present-3.JPG")}}" alt="">
            </div>
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-xl-6 col-lg-6 col-md-12">
                        <div class="h2_banner-content h5_banner-content">
                            <div class="section-area-2 mb-45 ">
                                <h3>พันธกิจ</h3>
                                {{--                                <h1 class="section-title"><span>พันธกิจ <img src="{{url("template/user-panel/assets/img/banner/2/line.png")}}" alt=""></span></h1>--}}
                                <ul class="about-content-list">
                                    <li>
                                        1. ส่งเสริมสนับสนุน และสร้างโอกาสความเสมอภาค
                                        ลดความเหลื่อมล้ำให้เด็กพิการและเด็กด้อยโอกาส
                                        ได้รับบริการทางการศึกษาด้วยระบบและรูปแบบการจัดการศึกษาที่หลากหลาย
                                    </li>
                                    <li>
                                        2. ส่งเสริมสนับสนุนให้สถานศึกษาจัดการศึกษาเพื่อให้ผู้เรียนมีคุณภาพ
                                        สมรรถนะและทักษะที่จำเป็นตามหลักสูตรสถานศึกษา
                                    </li>
                                    <li>
                                        3. ส่งเสริมสนับสนุนให้หน่วยงาน
                                        และสถานศึกษามีความปลอดภัยจากภัยพิบัติและภัยคุกคามทุกรูปแบบ
                                    </li>
                                    <li>
                                        4. ส่งเสริมสนับสนุนให้หน่วยงาน และสถานศึกษานำหลักธรรมาภิบาล
                                        และเทคโนโลยีดิจิทัลมาใช้ในการบริหารจัดการ
                                    </li>
                                    <li>5. ส่งเสริมสนับสนุนให้หน่วยงาน และสถานศึกษาน้อมนำหลักปรัชญาของเศรษฐกิจพอเพียง
                                        มาเป็นแนวทางในการจัดการศึกษา
                                    </li>
                                    <li>
                                        6. ส่งเสริมและพัฒนาผู้บริหาร สถานศึกษาครูและบุคลากรทางการศึกษา
                                        รวมทั้งบุคลากรสังกัดสำนักบริหารงานการศึกษาพิเศษ
                                        ให้มีสมรรถนะตามมาตรฐานตำแหน่งและ/หรือมาตรฐานวิชาชีพ
                                    </li>
                                </ul>
                                <p></p>

                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- banner area end -->



    <!-- feature area start -->
    <section class="h5_feature-area">
        <div class="h5_feature-wrapper">

            <div class="h5_feature-item first_item">
                <div class="h5_feature-inner">
                    <h3 style="font-style: italic;">อัตลักษณ์</h3>
                    <p style="font-size: 20px; font-style: italic; color: #1E1E1E; margin-bottom: 15px;">
                        “นักเรียนศูนย์การศึกษาพิเศษประจำจังหวัดกาฬสินธุ์ มีความสุข สนุก ร่งเริง“
                    </p>

                </div>
            </div>
            <div class="h5_feature-item second_item">
                <div class="h5_feature-inner">
                    {{--                    <span>02</span>--}}
                    <h3 style="font-style: italic;">เอกลักษณ์</h3>
                    <p style="font-size: 20px; font-style: italic; color: #1E1E1E; margin-bottom: 15px;">“สถานศึกษาแกนนำ
                        ที่นำสื่อและเทคโนโลยีทางการศึกษาเพื่อพัฒนากระบวนการจัดการเรียนรู้ที่มีคุณภาพ“</p>
                </div>
            </div>
            <div class="h5_feature-item third_item">
                {{--                <div class="h5_feature-inner">--}}
                {{--                    <h3>อัตลักษณ์</h3>--}}
                {{--                    <p>นักเรียนศูนย์การศึกษาพิเศษประจำจังหวัดกาฬสินธุ์ มีความสุข สนุก ร่งเริง--}}
                {{--                    </p>--}}

                {{--                    <h3>เอกลักษณ์</h3>--}}
                {{--                    <p>สถานศึกษาแกนนำ ที่นำสื่อและเทคโนโลยีทางการศึกษาเพื่อพัฒนากระบวนการจัดการเรียนรู้ที่มีคุณภาพ</p>--}}
                {{--                </div>--}}
                <img src="{{url("images/home/present/sks-present-4.JPG")}}" alt="">
            </div>
        </div>
    </section>
    <!-- feature area end -->

    <!-- about area start -->
    <section class="h6_about-area pt-60 pb-60 fix">
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
                    <div class="h6_about-content ml-30 mb-30 mb-md-0 pb-30">
                        <h3 class="h6_about-content-title">บทบาทหน้าที่</h3>
                        <div class="about-content-list">
                            <ul>

                                <li>
                                    จัดและส่งเสริม สนับสนุนการศึกษาในลักษณะศูนย์บริการให้ความช่วยเหลือระยะแรกเริ่ม
                                    (Early Intervention : EI)
                                    และเตรียมความพร้อมของคนพิการเพื่อเข้าศูนย์พัฒนาเด็กเล็กโรงเรียนอนุบาล
                                    โรงเรียนเรียนร่วม โรงเรียนเฉพาะความพิการ
                                    ศูนย์การเรียนเฉพาะความพิการและหน่วยงานที่เกี่ยวข้อง เป็นต้น
                                </li>
                                <li>
                                    พัฒนาและฝึกอบรมผู้ดูแลคนพิการ บุคลากรที่จัดการศึกษาสำหรับคนพิการ
                                </li>
                                <li>
                                    จัดระบบบริการและส่งเสริม สนับสนุนการจัดทำแผนการจัดการศึกษาเฉพาะบุคคล (Individualized
                                    Education Program : IEP) สิ่งอำนวยความสะดวก สื่อ บริการ
                                    และความช่วยเหลืออื่นใดทางการศึกษาสำหรับคนพิการ
                                </li>
                                <li>จัดระบบบริการช่วงเชื่อมต่อสำหรับคนพิการ (Transitional Services)</li>
                                <li>ให้บริการฟื้นฟูสมรรถภาพคนพิการโดยครอบครัวและชุมชนด้วยกระบวนทางการศึกษา</li>
                                <li>เป็นศูนย์ข้อมูล รวมทั้งจัดระบบสารสนเทศด้านการศึกษาสำหรับคนพิการในจังหวัด</li>
                                <li>จัดระบบสนับสนุนการเรียนร่วมและประสานงานการจัดการศึกษาสำหรับคนพิการในจังหวัด</li>
                                <li>ภาระหน้าที่อื่นตามที่กฎหมายกำหนด</li>
                            </ul>
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
                            <a href='{{url(env('SOCIAL_CONTACT_FACEBOOK'))}}' target="_blank" class="cta-btn"><i class="fa-brands fa-facebook-f"></i> Facebook</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cta area end -->

@endsection