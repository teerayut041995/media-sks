@extends('layouts.general_master')

@section('frontend_title')
{{$category->category_name}}
@endsection

@section('frontend_seo')
<title>{{$category->category_name}} | {{config('app.name')}}</title>
<meta name="description" content="อ่านบทความเกี่ยวกับการศึกษาพิเศษ การพัฒนานักเรียนพิเศษ ในหมวดหมู่ {{$category->sub_category_name}} {{$category->category_name}} ได้ที่เว็บไซต์ Laravel.sks.go.th">
<meta name="author" content="ของศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ ">
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
					{{$category->sub_category_name}}			
				</h1>	
				<p class="text-white link-nav">
					<a href="{{asset('')}}">หน้าหลัก </a>  
					<span class="lnr lnr-arrow-right"></span>
					<a href="<?php echo url("หมวดหมู่/$category->category_slug"); ?>">{{$category->category_name}} </a>
					<span class="lnr lnr-arrow-right"></span>
					<a href="javascript::void(0)">{{$category->sub_category_name}} </a>
				</p>
			</div>	
		</div>
	</div>
</section>
<!-- End banner Area -->

<!-- Start post-content Area -->
<section class="post-content-area section-gap courses-page">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 posts-list">
			<!-- post list start -->
				<div class="row">
				@if(count($posts) > 0)
					@foreach($posts as $post)
					<div class="single-popular-carusel col-lg-4 col-md-6">
							<div class="thumb-wrap relative">
								<div class="thumb relative">
									<div class="overlay overlay-bg"></div>	
									<img class="img-fluid" src="<?php echo url("images/image_post/$post->post_image"); ?>" alt="{{$post->post_title}}" style="width: 100%;height: 170px;">
								</div>
								<div class="meta d-flex justify-content-between">
									<p><span class="lnr lnr-eye"></span>
								</div>									
							</div>
							<div class="details">
								<a href="<?php echo url("article/$post->post_title"); ?>">
									<h4 class="my-font">
										{{$post->post_title}}
									</h4>
								</a>
								<p class="my-font">
									{{$post->post_detail}}
								</p>
							</div>
					</div>
					@endforeach
				@else
					<h4 class="my-font">ยังไม่มีบทความ</h4>
				@endif
				</div>
				<center>
		            {{$posts->links()}}
		        </center>
			<!-- post list end -->
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