<div class="widget-wrap">
	<div class="single-sidebar-widget popular-post-widget">
		<?php
		$events_popular = App\Event::where('publishing_status' , '1')
			->orderBy('created_at' , 'desc')
            ->orderByViews()
            ->limit(4)
            ->get();
		?>
		<h4 class="popular-title my-font">กิจกรรมล่าสุด</h4>
		<div class="popular-post-list">
			@foreach($events_popular as $event_popular)
			<div class="single-post-list d-flex flex-row align-items-center">
				<div class="thumb" style="width: 40%;">
					<img class="img-fluid" src="{{url('images/image_event/', $event_popular->event_image)}}" alt="{{$event_popular->event_name}}" style="width: 100%; height: 60;">
				</div>
				<div class="details"  style="width: 60%;">
					<a href="blog-single.html"><h6 class="cut-title my-font">{{$event_popular->event_name}}</h6></a>
					<!-- <a href="blog-single.html"> -->
					<p style="font-size: 11px; position: relative; top: -10px;">
					การดู {{$event_popular->views_count}} ครัง
					</p>
					<p style="font-size: 11px; position: relative; top: -10px;">{{Carbon\Carbon::parse($event_popular->created_at)->diffForHumans()}}</p>
				</div>
			</div>
			@endforeach
		</div>
	</div>
								
								<!--  -->
	<div class="single-sidebar-widget popular-post-widget">
		<?php
		$posts_popular = App\Post::where('post_status' , '1')
    		->orderByViews()
    		->limit(4)
    		->get();
		?>
			<h4 class="popular-title my-font">บทความยอดนิยม</h4>
			<div class="popular-post-list">
				@foreach($posts_popular as $post_popular)
				<div class="single-post-list d-flex flex-row align-items-center">
					<div class="thumb" style="width: 40%;">
						<img class="img-fluid" src="{{url('images/image_post/', $post_popular->post_image)}}" alt="{{$post_popular->post_title}}" style="width: 100%; height: 60;">
					</div>
					<div class="details"  style="width: 60%;">
						<a href="blog-single.html"><h6 class="cut-title my-font">{{$post_popular->post_title}}</h6></a>
						<!-- <a href="blog-single.html"> -->
						<p style="font-size: 11px; position: relative; top: -10px;">
						การดู {{$post_popular->views_count}} ครัง
						</p>
						<p style="font-size: 11px; position: relative; top: -10px;">{{Carbon\Carbon::parse($post_popular->created_at)->diffForHumans()}}</p>
					</div>
				</div>
				@endforeach												
			</div>
	</div>				
</div>