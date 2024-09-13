<div class="blog_details-sidebar mb-60">

    <div class="blog_details-widget">
        <h4 class="blog_details-widget-title">ล่าสุด</h4>
        @foreach($recent_posts as $recent)
            <div class="blog_details-widget-post">
                <div class="blog_details-post-img">
                    <a href='{{url("posts/$recent->uid")}}'><img
                                src='{{url("images/image_post/$recent->post_image")}}'
                                alt="{{$recent->post_title}}"></a>
                </div>
                <div class="blog_details-post-info">
                    <span class="set-font-thai"><i class="fa-thin fa-clock"></i>{{formatDateThaiBirthday($recent->created_at)}}, {{Carbon\Carbon::parse($recent->created_at)->diffForHumans()}}</span>
                    <h6 style="font-weight: normal;"><a href='{{url("posts/$recent->uid")}}' class="set-font-thai">{{$recent->post_title}}</a>
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
                        <a href='{{url("posts?category=$category->uid")}}'>{{$category->category_name}}</a>
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
                    <a href='{{url("posts/$popular->uid")}}'><img
                                src='{{url("images/image_post/$popular->post_image")}}'
                                alt="{{$popular->post_title}}"></a>
                </div>
                <div class="blog_details-course-info">
                    <h6 style="font-weight: normal;"><a href='{{url("posts/$popular->uid")}}' class="set-font-thai">{{$popular->post_title}}</a></h6>
                    <a href='{{url("posts/$popular->uid")}}'
                       class="inner-course-rate set-font-thai">การดู {{$popular->views_count}} ครั้ง</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="blog_details-widget">
        <h4 class="blog_details-widget-title">Tags</h4>
        <div class="blog_details-widget-tag">
            <ul>
                @foreach($category_menu as $category)
                    @foreach($category['sub_categories'] as $sub_category)
                        <li>
                            <a href='{{url("posts?category=$category->uid&sub_category=$sub_category->uid")}}'>{{$sub_category->sub_category_name}}</a>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
</div>