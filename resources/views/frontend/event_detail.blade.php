@extends('layouts.general_master')

@section('frontend_title')
{{$event->event_name}}
@endsection

@section('frontend_seo')
<title>{{$event->event_name}} | {{config('app.name')}}</title>
<meta name="description" content="{{$event->event_name}} {{$event->event_description}}">
<meta name="author" content="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
@endsection

@section('frontend_style')
<!-- Popup CSS -->
<link href="{{asset('template/plugins/Magnific-Popup-master/dist/magnific-popup.css')}}" rel="stylesheet">
<link href="{{asset('template/plugins/animated-masonry-gallery/_css/animated-masonry-gallery.css')}}" rel="stylesheet" type="text/css" />
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
				<p class="text-white link-nav">
					<a href="{{asset('')}}">หน้าหลัก </a>  
					<span class="lnr lnr-arrow-right"></span><a href="{{url('/กิจกรรม')}}">รูปภาพกิจกรรม </a>
					<span class="lnr lnr-arrow-right"></span><a href="javascript:void(0)">{{$event->event_name}}</a>
				</p>
			</div>	
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start gallery Area -->
<section class="gallery-area ">

<!-- Start Align Area -->
	<div class="whole-wrap">
		<div class="container">
			<div class="section-top-border">
				<h3 class="mb-30  my-font">{{$event->event_name}}</h3>
				<div class="row">
					<div class="col-lg-12">
						<blockquote class="generic-blockquote">
							{{$event->event_description}}
							<p></p>
							<div class="">
									<ul class="unordered-list">
										<li>
											วัันที่จัดกิจกรรม {{createDateThai($event->event_date)}}
										</li>
										<li>
											สถานที่จัดกิจกรรม {{$event->event_location}}
										</li>
										<li>
											รายละเอียด
											<ul>
												<li>โพสต์โดย {{$event->user->name}}</li>
												<li>โพสต์เมื่อ {{createDateThai($event->created_at)}}</li>
												<li>{{Carbon\Carbon::parse($event->created_at)->diffForHumans()}}</li>
												<li>การดู {{$event->views_count}} ครัง</li>
											</ul>
										</li>
									</ul>
							</div>
						</blockquote>
					</div>
					
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row" >

			<div id="gallery-content">
				<div id="gallery-content-center" class="zoom-gallery">
				@foreach($images as $image)
				 <a href="<?php echo url("images/image_event/more_image/$image->image_name"); ?>" class="image-link" title="{{$event->event_name}}">
				 	<img src="<?php echo url("images/image_event/more_image/$image->image_name"); ?>" alt="{{ $event->event_name }}" class="all studio"/>
				 </a>
				@endforeach
				</div>
			</div>

		</div>
	</div>	
</section>
<!-- End gallery Area -->
			
					
					

			
						
			
@endsection

@section('frontend_script')
<!-- Magnific popup JavaScript -->
<script src="{{asset('template/plugins/Magnific-Popup-master/dist/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('template/plugins/Magnific-Popup-master/dist/jquery.magnific-popup-init.js')}}"></script>
<script type="text/javascript" src="{{asset('template/plugins/animated-masonry-gallery/_scripts/animated-masonry-gallery.js')}}"></script>
@endsection