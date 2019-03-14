@extends('layouts.general_master')

@section('frontend_title')
ห้องพัฒนาครูพ่อแม่และผู้เกี่ยวข้อง เด็กที่มีความต้องการพิเศษ
@endsection

@section('frontend_seo')
<title>{{$media->topics}} | {{config('app.name')}}</title>
<meta name="description" content="{{$media->topics}} {{$media->project_name}}">
<meta name="author" content="{{$media->name}}">
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
					<span class="lnr lnr-arrow-right"></span>
					<a href="javascript:void(0)">
						{{$media->topics}}
					</a>
				</p>
			</div>	
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start event-details Area -->
			<section class="event-details-area section-gap">
				<div class="container">
					<div class="row">
						<div class="col-lg-8 event-details-left">
							<div class="main-image live_main">
								{!!$media->embed_video!!}
							</div>
							<div class="details-content">
								<a href="#">
									<h4 class="my-font">{{$media->topics}}</h4>
								</a>
								<p class="comment my-font" style="font-size: 1.1em;">
                                    {{$media->project_name}}
                                </p>
								<p>
									บรรยายโดย<br>
									{!! nl2br(e($media->lecturer)) !!}</p>
								<p>	{!! nl2br(e($media->description)) !!}</p>
							</div>
						</div>
						<div class="col-lg-4 event-details-right">
							<div class="single-event-details my-font">
								<h4>รายละเอียด</h4>
								<ul class="mt-10">
									<li class="justify-content-between d-flex">
										<span>วันที่</span>
										<span>{{createDateThai($media->created_at)}}</span>
									</li>
									<li class="justify-content-between d-flex">
										<span>อัพโหลดโดย</span>
										<span>{{$media->name}}</span>
									</li>
									<li class="justify-content-between d-flex">
										<span>สถานะการถ่ายทอดสด</span>
										<span>
										@if($media->live_status == '0')
										ยังไม่เริม
										@endif
										@if($media->live_status == '1')
										กำลังถ่ายทอดสด
										@endif
										@if($media->live_status == '2')
										สิ้นสุดแล้ว
										@endif
										</span>
									</li>
									<li class="justify-content-between d-flex">
										<span>สถานะการเผยแพร่</span>
										<span>
										@if($media->publishing_status == '0')
										ส่วนตัว
										@endif
										@if($media->publishing_status == '1')
										สาธารณะ
										@endif
										</span>
									</li>
									<li class="justify-content-between d-flex">
										<span>ยอดการเข้าชม</span>
										<span>{{$views}}</span>
									</li>
									<li class="justify-content-between d-flex">
										<span></span>
										<span>{{Carbon\Carbon::parse($media->created_at)->diffForHumans()}}</span>
									</li>
								</ul>
							</div>
							
																			
						</div>
					</div>
				</div>	
			</section>
			<!-- End event-details Area -->
			
			
@endsection

@section('frontend_content')

@endsection