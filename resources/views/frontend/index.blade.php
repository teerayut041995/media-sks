@extends('layouts.general_master')


@section('frontend_seo')
<title>การพัฒนาสื่ออนไลน์ ของศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ | {{config('app.name')}}</title>
<meta name="description" content="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ เป็นสถานศึกษาที่มีความเข้มแข็ง ทันสมัย เป็นที่ยอมรับของสังคมและชุมชน โดยมุ่งพัฒนาศักยภาพคนพิการให้ได้ใช้ศักยภาพของตนพร้อมก้าวสู่สังคมของคนปกติ">
<meta name="author" content="ของศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ ">
@endsection

@section('frontend_style')
<style type="text/css">
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

@section('frontend_content')
<!-- start banner Area -->
			<section class="banner-area relative my-font" id="home">
				<div class="overlay overlay-bg"></div>	
				<div class="container">
					<div class="row fullscreen d-flex align-items-center justify-content-between">
						<div class="banner-content col-lg-9 col-md-12">
							
							<h1 class="text-uppercase my-font" style="font-size: 40px;">
								การพัฒนาสื่ออนไลน์ ของศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์			
							</h1>
							<p class="pt-10 pb-10">
								Online media development Of Kalasin Special Education Center
							</p>
							<a href="#" class="primary-btn text-uppercase">Get Started</a>
						</div>										
					</div>
				</div>					
			</section>
			<!-- End banner Area -->

			<!-- Start feature Area -->
			<section class="feature-area my-font">
				<div class="container">
					<div class="row">
						<div class="col-lg-4">
							<div class="single-feature">
								<div class="title ">
									<h4 class="my-font">ศูนย์การศึกษาพิเศษ</h4>
								</div>
								<div class="desc-wrap">
									<p>
										ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ เป็นสถานศึกษาที่มีความเข้มแข็ง ทันสมัย เป็นที่ยอมรับของสังคมและชุมชน โดยมุ่งพัฒนาศักยภาพคนพิการให้ได้ใช้ศักยภาพของตนพร้อมก้าวสู่สังคมของคนปกติ
									</p>									
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="single-feature">
								<div class="title">
									<h4 class="my-font">การศึกษาเพื่อเด็กพิการ</h4>
								</div>
								<div class="desc-wrap">
									<p>
										ศูนย์บริการช่วยเหลือระยะแรกเริ่ม  ฟื้นฟูสมรรถภาพ  และเตรียมความพร้อมเพื่อส่งต่อเด็กพิการเข้าเรียนร่วม กับนักเรียนในโรงเรียนปกติหรือโรงเรียนเฉพาะความพิการ  ทุกประเภทในจังหวัดกาฬสินธุ์
									</p>							
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="single-feature">
								<div class="title">
									<h4 class="my-font">พัฒนาการจัดการศึกษา</h4>
								</div>
								<div class="desc-wrap">
									<p>
										ส่งเสริมการสร้างองค์ความรู้ใหม่ เพื่อพัฒนาการจัดการศึกษาและส่งเสริมทักษะด้านอาชีพ  เพื่อสนับสนุนให้คนพิการประกอบอาชีพพึ่งพาตนเองได้ มีคุณธรรม และอยู่ในสังคมได้อย่างมีความสุข
									</p>									
								</div>
							</div>
						</div>												
					</div>
				</div>	
			</section>
			<!-- End feature Area -->
			

			<!-- Start popular-course Area -->
			<section class="popular-course-area section-gap">
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-20 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10 my-font" >รูปภาพกิจกรรม</h1>
							</div>
						</div>
					</div>						
					<div class="row">
						<div class="active-popular-carusel">
						@foreach($events as $event)	
							<div class="single-popular-carusel">
								<div class="thumb-wrap relative">
									<div class="thumb relative">
										<div class="overlay overlay-bg"></div>	
										<img class="img-fluid" src="<?php echo asset("images/image_event/$event->event_image");?>" alt="{{$event->event_name}}" style="height: 200px;">
									</div>
									<div class="meta d-flex justify-content-between">
										<p>{{Carbon\Carbon::parse($event->created_at)->diffForHumans()}}</p>
										<P>การดู {{ $event->views_count }} ครัง</p>
									</div>									
								</div>
								<div class="details" >
									<a href="<?php echo url("กิจกรรม/$event->event_slug"); ?>">
										<h4 class="my-font">
											{{$event->event_name}}
										</h4>
									</a>
								</div>
							</div>
						@endforeach
														
						</div>
					</div>
				</div>
				<p><br></p>
			<!-- </section> -->
	
			<!-- <section class="popular-courses-area section-gap courses-page" style="position: relative;top: -200px;"> -->
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-20 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10 my-font" >วิดีโอการอบรมล่าสุด</h1>
							</div>
						</div>
					</div>
					<div class="row">
					@foreach($media_list as $media)
						<div class="single-popular-carusel col-lg-4 col-md-6">
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
								<p >การดู {{$media->views_count}} ครั้ง | {{Carbon\Carbon::parse($media->created_at)->diffForHumans()}}</p>
							</div>
						</div>
					@endforeach
					</div>	
				</div>
			<!-- </section> -->

			<!-- <section class="popular-course-area section-gap" > -->
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-20 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10 my-font" >บทความมาใหม่</h1>
							</div>
						</div>
					</div>						
					<div class="row">
						<div class="active-popular-carusel">
						@foreach($new_post as $new)	
							<div class="single-popular-carusel">
								<div class="thumb-wrap relative">
									<div class="thumb relative">
										<div class="overlay overlay-bg"></div>	
										<img class="img-fluid" src="<?php echo asset("images/image_post/$new->post_image");?>" alt="" style="height: 200px;">
									</div>
									<div class="meta d-flex justify-content-between">
										<p>{{Carbon\Carbon::parse($new->created_at)->diffForHumans()}}</p>
										<P>การดู {{ $new->views_count }} ครัง</p>
									</div>									
								</div>
								<div class="details" >
									<a href="<?php echo url("article/$new->post_slug"); ?>">
										<h4 class="my-font">
											{{$new->post_title}}
										</h4>
									</a>
									<p class="my-font">
										{{$new->post_detail}}										
									</p>
								</div>
							</div>
						@endforeach
														
						</div>
					</div>
				</div>
				<p><br></p>
				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-20 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10 my-font" >บทความยอดนิยม</h1>
							</div>
						</div>
					</div>						
					<div class="row">
						<div class="active-popular-carusel">
						@foreach($popular_post as $popular)	
							<div class="single-popular-carusel">
								<div class="thumb-wrap relative">
									<div class="thumb relative">
										<div class="overlay overlay-bg"></div>	
										<img class="img-fluid" src="<?php echo asset("images/image_post/$popular->post_image");?>" alt="" style="height: 200px;">

									</div>
									<div class="meta d-flex justify-content-between">
										<p>{{Carbon\Carbon::parse($popular->created_at)->diffForHumans()}}</p>
										<p>
										@if($popular->views_count > 0)
										การดู {{$popular->views_count}} ครัง
										@else
										เป็นคนแรกที่อ่านบทความ
										@endif		 
										</p>
									</div>									
								</div>
								<div class="details">
									<a href="<?php echo url("article/$popular->post_slug"); ?>">
										<h4 class="my-font">
											{{$popular->post_title}}
										</h4>
									</a>
									<p class="my-font">
										{{$popular->post_detail}}										
									</p>
								</div>
							</div>
						@endforeach
														
						</div>
					</div>
				</div>	
			</section>
			<!-- End popular-course Area -->	

			<section class="info-area pb-120">
				<div class="container-fluid">
					<div class="row align-items-center">
						<div class="col-lg-6 no-padding info-area-left">
							<img class="img-fluid" src="{{url('template/frontend/img/kalasin.jpg')}}" alt="">
						</div>
						<div class="col-lg-6 info-area-right" style="font-family: 'Mitr', sans-serif;">
							<h1 style="font-family: 'Mitr', sans-serif;">ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</h1>
							<p> ศูนย์การศึกษาพิเศษ  ประจังหวัดกาฬสินธุ์  สังกัดสำนักบริหารงานการศึกษาพิเศษ  สำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน   กระทรวงศึกษาธิการ  ได้รับอนุมัติให้จัดตั้งเมื่อวันที่  31 กรกฎาคม  พ.ศ.  2543 ศูนย์การศึกษาพิเศษก่อตั้งครั้งแรกอาศัยตั้งสำนักงาน ณ โรงเรียนศึกษาพิเศษกาฬสินธุ์ ปัจจุบันเปลี่ยนเป็น โรงเรียนกาฬสินธุ์ปัญญานุกูล และได้ย้ายสำนักงานอาคารศูนย์การศึกษาพิเศษ  ประจำจังหวัดกาฬสินธุ์  มาตั้งอยู่เลขที่  400  ถนนถีนานนท์  หมู่ที่  1  ตำบลยางตลาด  อำเภอยางตลาด จังหวัดกาฬสินธุ์  มีพื้นที่ จำนวน  7 ไร่      3 งาน  80 ตารางวา  ศูนย์การศึกษาพิเศษ  ประจำจังหวัดกาฬสินธุ์  เป็นสถานศึกษาที่จัดการศึกษาเพื่อเด็กพิการในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม  ฟื้นฟูสมรรถภาพ  และเตรียมความพร้อมเพื่อส่งต่อเด็กพิการเข้าเรียนร่วม กับนักเรียนในโรงเรียนปกติหรือโรงเรียนเฉพาะความพิการ  ทุกประเภทในจังหวัดกาฬสินธุ์</p>
						</div>
				</div>
			</div>
			</section>
						
			<!-- Start review Area -->
			
				@yield('review_area')
				@include('template.frontend.review_area')
				
			<!-- End review Area -->
@endsection

@section('frontend_content')

@endsection