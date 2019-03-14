@extends('layouts.general_master')

@section('frontend_title')
ห้องพัฒนาครูพ่อแม่และผู้เกี่ยวข้อง เด็กที่มีความต้องการพิเศษ
@endsection

@section('frontend_seo')
<title>รูปภาพการจัดกิจกรรมของศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ | {{config('app.name')}}</title>
<meta name="description" content="เก็บรวบรวมรูปภาพการจัดกิจกรรม ของศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
<meta name="author" content="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
@endsection

@section('frontend_style')

@endsection

@section('frontend_content')
<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">				
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white my-font">
					รูปภาพกิจกรรม				
				</h1>	
				<p class="text-white link-nav"><a href="{{asset('')}}">หน้าหลัก </a>  
					<span class="lnr lnr-arrow-right"></span><a href="">รูปภาพกิจกรรม </a>
				</p>
			</div>	
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start popular-courses Area --> 
<section class="popular-courses-area section-gap courses-page">
	<div class="container">
		<div class="row">
			@if(count($events) > 0)
				@foreach($events as $event)
				<div class="single-popular-carusel col-lg-3 col-md-6">
					<div class="thumb-wrap relative">
						<div class="thumb relative">
							<div class="overlay overlay-bg"></div>	
							<img class="img-fluid" src="<?php echo url("images/image_event/$event->event_image"); ?>" alt="{{$event->event_name}}" style="width: 100%;height: 200px;">
						</div>									
					</div>
					<div class="meta d-flex justify-content-between">
						<p>{{Carbon\Carbon::parse($event->created_at)->diffForHumans()}}</p>
						<p>
							@if($event->views_count > 0)
								การดู {{$event->views_count}} ครัง
							@else
								เข้าดูเป็นคนแรก
							@endif		 
						</p>
					</div>		
					<div class="details">
						<a href="<?php echo url("กิจกรรม/$event->event_slug") ?>">
							<h4 class="my-font">{{$event->event_name}}</h4>
						</a>
					</div>
				</div>
				@endforeach
			@else
			<h4 class="my-font">ยังไม่มีกิจกรรม</h4>
			@endif										
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<center>
		            {{$events->links()}}
		        </center>
			</div>
		</div>
		
	</div>	
</section>
<!-- End popular-courses Area -->			

			
					
					

			
						
			
@endsection

@section('frontend_content')

@endsection