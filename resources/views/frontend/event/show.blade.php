@extends('layouts.base.master')

@section('seo')
    <title>{{$event->event_name}}</title>
    <meta name="description" content="{{$event->event_description}}">
    <meta name="keywords"
          content="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์, สำนักบริหารงานการศึกษาพิเศษ, {{$event->event_name}}, CAPER, คูปองการศึกษา">
    <meta property="og:url"
          content='{{url("events/$event->event_slug")}}'/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{$event->event_name}}"/>
    <meta property="og:description" content="{{$event->event_description}}"/>
    <meta property="og:image" content='{{url("images/image_event/$event->event_image")}}'/>
@endsection

@section('content')
    <!-- breadcrumb area start -->
    <section class="breadcrumb-area bg-default" data-background="{{url("images/home/kalasin-3.jpg")}}">
        <img src="{{url("template/user-panel/assets/img/breadcrumb/shape-1.png")}}" alt="" class="breadcrumb-shape">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content" style="color: white;">
                        <h2 class="breadcrumb-title" style="color: white;">{{$event->event_name}}</h2>
{{--                        <div class="breadcrumb-list">--}}
{{--                            <a href="{{url('/')}}" style="color: white;">หน้าหลัก</a>--}}
{{--                            <a href='{{url("events")}}' style="color: white;">กิจกรรม</a>--}}
{{--                            <span style="color: white;">{{$event->event_name}}</span>--}}
{{--                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->


    <!-- blog details area start -->
    <section class="event_details-area pt-60 pb-80">
        <div class="container">
            <div class="event_details-img">
                <img src='{{url("images/image_event/$event->event_image")}}' alt="{{$event->event_name}}"
                     style="border-radius: 25px;">
            </div>
            <div class="row">
                <div class="col-xl-8 col-lg-8">
                    <div class="event_details-wrap mb-55">
                        <div class="event_details-content">
                            <h3 class="event_details-content-title">{{$event->event_name}}</h3>
                            {!! $event->event_description !!}
                        </div>
                    </div>

                    <div class="innerPage_gallery-wrap">
                        <div class="row">
                            @foreach($images as $image)
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                                    <div class="innerPage_gallery-item mb-30">
                                        <div class="innerPage_gallery-img">
                                            <img src='{{url("images/image_event/more_image/$image->image_name")}}' alt="{{$event->event_name}}">
                                        </div>
                                        <div class="innerPage_gallery-content">
                                            <a href='{{url("images/image_event/more_image/$image->image_name")}}' class="popup-image"><i
                                                        class="fa-thin fa-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
{{--                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">--}}
{{--                                <div class="innerPage_gallery-item mb-30">--}}
{{--                                    <div class="innerPage_gallery-img">--}}
{{--                                        <img src="{{url("template/user-panel/assets/img/gallery/innerPage/1.jpg")}}" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="innerPage_gallery-content">--}}
{{--                                        <a href="{{url("template/user-panel/assets/img/gallery/innerPage/1.jpg")}}" class="popup-image"><i--}}
{{--                                                    class="fa-thin fa-plus"></i></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">--}}
{{--                                <div class="innerPage_gallery-item mb-30">--}}
{{--                                    <div class="innerPage_gallery-img">--}}
{{--                                        <img src="{{url("template/user-panel/assets/img/gallery/innerPage/2.jpg")}}" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="innerPage_gallery-content">--}}
{{--                                        <a href="{{url("template/user-panel/assets/img/gallery/innerPage/2.jpg")}}" class="popup-image"><i--}}
{{--                                                    class="fa-thin fa-plus"></i></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">--}}
{{--                                <div class="innerPage_gallery-item mb-30">--}}
{{--                                    <div class="innerPage_gallery-img">--}}
{{--                                        <img src="{{url("template/user-panel/assets/img/gallery/innerPage/3.jpg")}}" alt="">--}}
{{--                                    </div>--}}
{{--                                    <div class="innerPage_gallery-content">--}}
{{--                                        <a href="{{url("template/user-panel/assets/img/gallery/innerPage/3.jpg")}}" class="popup-image"><i--}}
{{--                                                    class="fa-thin fa-plus"></i></a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>

                </div>
                <div class="col-xl-4 col-lg-4">
                    @include('frontend.components.side-content-event-detail')
                </div>
            </div>
        </div>
    </section>


@endsection