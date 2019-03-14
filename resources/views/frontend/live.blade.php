@extends('layouts.general_master')

@section('frontend_seo')
<title>วิดีโอการฝึกการอบบรมกระบวนการจีดการเรียนรู้ตามแนวทางการศึกษาวอลดอร์พ | {{config('app.name')}}</title>
<meta name="description" content="วิดีโอการฝึกการอบบรมกระบวนการจีดการเรียนรู้ตามแนวทางการศึกษาวอลดอร์พ">
<meta name="author" content="ของศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ ">
@endsection

@section('frontend_style')
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
		border:none;overflow:hidden;
	}
	
</style>
@endsection

@section('frontend_content')
<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">				
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white my-font">Live Stream</h1>	
				<p class="text-white link-nav">
					<a href="{{asset('')}}">หน้าหลัก </a>  
					<span class="lnr lnr-arrow-right"></span>
					<a href="{{url('/live')}}">
						LIVE
					</a>
				</p>
			</div>	
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start course-details Area -->
<section class="course-details-area pt-120">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 left-contents">
				<div class="main-image live_main">
					{!!$first_media->embed_video!!}
				</div>
			</div>
			<div class="col-lg-4 right-contents">
				<ul>
					<li>
						<a class="justify-content-between d-flex" href="javascript:void(0)">
							<p class="or">เรื่อง : {{$first_media->topics}}</p> 
							
						</a>
					</li>
					<li>
						<a class="justify-content-between d-flex" href="javascript:void(0)">
							<p>{{$first_media->project_name}}</p>
						</a>
					</li>
					<li>
						<a class="justify-content-between d-flex" href="javascript:void(0)">
							<p>บรรยายโดย <br>{!! nl2br(e($first_media->lecturer)) !!}</p>
						</a>
					</li>
					<li>
						<a class="justify-content-between d-flex" href="javascript:void(0)">
							<p>สถานะ </p>
							<span>
							@if($first_media->live_status == '0')
							ยังไม่เริม
							@endif
							@if($first_media->live_status == '1')
							กำลังถ่ายทอดสด
							@endif
							@if($first_media->live_status == '2')
							สิ้นสุดแล้ว
							@endif
							</span>
						</a>
					</li>
					<li>
						<a class="justify-content-between d-flex" href="javascript:void(0)">
							<p>Views </p>
							<span>{{$first_views}}</span>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<!-- End course-details Area -->

<!-- Start blog Area -->
<!-- -->
<section class="popular-courses-area section-gap courses-page"  style="position: relative;top: -70px;">
	<div class="container">
		<div class="row">
		@foreach($media_list as $media)
			<div class="single-popular-carusel col-lg-3 col-md-6">
				<div class="thumb-wrap relative">
					<div class="thumb relative">
						{!!$media->embed_video!!}
					</div>								
				</div>
				<div class="details">
					<a href="<?php echo url("watch/$media->id"); ?>">
						<h4>{{$media->topics}}</h4>
					</a>
					<p>{{$media->project_name}}</p>
				</div>
			</div>
		@endforeach
		</div>	
	</div>
</section>
<!-- End blog Area -->			
			
@endsection

@section('frontend_content')

@endsection