@extends('layouts.general_master')

@section('frontend_title')

ห้องพัฒนาครูพ่อแม่และผู้เกี่ยวข้อง เด็กที่มีความต้องการพิเศษ
@endsection

@section('frontend_seo')
<title>{{$post->post_title}}</title>
<meta name="description" content="{{$post->post_title}} {{$post->post_detail}}">
<meta name="author" content="{{$post->name}}">
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
								{{$post->post_title}}				
							</h1>	
							<p class="text-white link-nav"><a href="{{asset('')}}">หน้าหลัก </a>  
							<span class="lnr lnr-arrow-right"></span><a href="<?php echo url("categories/$post->category_slug"); ?>">{{$post->category_name}} </a>
							@if($post->sub_category_name != '')
							<span class="lnr lnr-arrow-right"></span><a href="<?php echo url("categories/$post->category_slug/$post->sub_category_slug"); ?>">{{$post->sub_category_name}} </a>
							@endif
							<span class="lnr lnr-arrow-right"></span> <a href="javascript:void(0)"> {{$post->post_title}}</a></p>
						</div>	
					</div>
				</div>
			</section>
			<!-- End banner Area -->

			<!-- Start post-content Area -->
			<section class="post-content-area single-post-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-8 posts-list">
							<div class="single-post row">
								<div class="col-lg-12">
									<div class="feature-img">
										<img class="img-fluid" src="<?php echo asset("images/image_post/$post->post_image"); ?>" alt="{{$post->post_title}}">
									</div>									
								</div>
								<div class="col-lg-3  col-md-3 meta-details">
									<ul class="tags">
										<li><a href="<?php echo url("categories/$post->category_slug"); ?>">{{$post->category_name}}</a></li><br>
										<li><a href="<?php echo url("categories/$post->category_slug/$post->sub_category_slug"); ?>">{{$post->sub_category_name}}</a></li>
									</ul>
									<div class="user-details row">
										<p class="user-name col-lg-12 col-md-12 col-6"><a href="#">{{$post->name}}</a> <span class="lnr lnr-user"></span></p>
										<p class="date col-lg-12 col-md-12 col-6"><a href="#">{{createDateThai($post->created_at)}}</a> <span class="lnr lnr-calendar-full"></span></p>
										<p class="view col-lg-12 col-md-12 col-6"><a href="#">{{Carbon\Carbon::parse($post->created_at)->diffForHumans()}} </a> <span class="lnr lnr-clock"></span></p>
										<p class="view col-lg-12 col-md-12 col-6"><a href="#">{{$views}} Views</a> <span class="lnr lnr-eye"></span></p>
										
																														
									</div>
								</div>
								<div class="col-lg-9 col-md-9">
									<h3 class="mt-20 mb-20 my-font">{{$post->post_title}}</h3>
									{!!$post->post_content!!}
								</div>
								
							</div>

						</div>
						<div class="col-lg-4 sidebar-widgets">
						@include('template.frontend.post_right')
						</div>
					</div>
				</div>	
			</section>
			<!-- End post-content Area -->
					
					

			
						
			
@endsection

@section('frontend_content')

@endsection