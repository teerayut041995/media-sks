<div class="event_details-sidebar mb-60">

    <div class="event_details-sidebar-content mb-40">
        <h4 class="event_details-sidebar-content-title">กิจกรรม</h4>
        <ul>
            <li>
                <span>วันที่</span>
                <span>{{createDateThai($event->event_date)}}</span>
            </li>
{{--            <li>--}}
{{--                <span>สถานที่</span>--}}
{{--                <span>{{$event->event_location}}</span>--}}
{{--            </li>--}}
            <li>
                <span>โพสต์โดย</span>
                <span>{{$event->name}}</span>
            </li>
            <li>
                <span>การดู 2 </span>
                <span>{{$views}} ครั้ง</span>
            </li>
        </ul>
{{--        <div class="event_details-sidebar-btn">--}}
{{--            <a href="#" class="theme-btn theme-btn-big theme-btn-full">Buy Ticket</a>--}}
{{--        </div>--}}
    </div>

    <div class="blog_details-widget">
        <h4 class="blog_details-widget-title">ล่าสุด</h4>
        @foreach($recent_posts as $recent)
            <div class="blog_details-widget-post">
                <div class="blog_details-post-img">
                    <a href='{{url("article/$recent->post_slug")}}'><img
                                src='{{url("images/image_post/$recent->post_image")}}'
                                alt="{{$recent->post_title}}"></a>
                </div>
                <div class="blog_details-post-info">
                    <span><i class="fa-thin fa-clock"></i>{{formatDateThaiBirthday($recent->created_at)}}, {{Carbon\Carbon::parse($recent->created_at)->diffForHumans()}}</span>
                    <h6><a href='{{url("article/$recent->post_slug")}}'>{{$recent->post_title}}</a>
                    </h6>
                </div>
            </div>
        @endforeach
    </div>
    <div class="blog_details-widget widget-category">
        <h4 class="blog_details-widget-title">หมวดหมู่</h4>
        <div class="blog_details-widget-category">
            <ul>
                @foreach($categories as $category)
                    <li>
                        <a href='{{url("หมวดหมู่/$category->category_slug")}}'>{{$category->category_name}}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="blog_details-widget">
        <h4 class="blog_details-widget-title">ยอดนิยม</h4>
        @foreach($popular_posts as $popular)
            <div class="blog_details-widget-course">
                <div class="blog_details-course-img">
                    <a href='{{url("article/$popular->post_slug")}}'><img
                                src='{{url("images/image_post/$popular->post_image")}}'
                                alt="{{$popular->post_title}}"></a>
                </div>
                <div class="blog_details-course-info">
                    <h6><a href='{{url("article/$popular->post_slug")}}'>{{$popular->post_title}}</a></h6>
                    <a href='{{url("article/$popular->post_slug")}}'
                       class="inner-course-rate">การดู {{$popular->views_count}} ครั้ง</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="blog_details-widget">
        <h4 class="blog_details-widget-title">Tags</h4>
        <div class="blog_details-widget-tag">
            <ul>
                @foreach($sub_categories as $sub_category)
                    <li><a href='{{url("หมวดหมู่/$sub_category->category_slug/$sub_category->sub_category_slug")}}'>{{$sub_category->sub_category_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>