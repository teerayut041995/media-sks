<div class="header-area header-sticky">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-12 col-lg-12 col-md-12 col-12">
{{--            <div class="col-xl-7 col-lg-6 col-md-6 col-6">--}}
                <div class="header-left">
                    <div class="header-logo">
                        <a href="{{url('/')}}"><img src="{{asset("images/home/sks-logo-1.png")}}" style="width: 44px;" alt="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"></a>
                    </div>
                    <nav class="main-menu mobile-menu d-none d-xl-block" id="mobile-menu">
                        <ul>
                            <li class="menu-has-child">
                                <a href="{{url('/')}}">หน้าหลัก</a>
{{--                                <ul class="submenu">--}}
{{--                                    <li><a href="index.html">Education Main</a></li>--}}
{{--                                    <li><a href="index-2.html">Online Education</a></li>--}}
{{--                                    <li><a href="index-3.html">Classic LMS</a></li>--}}
{{--                                    <li><a href="index-4.html">Elearning Education</a></li>--}}
{{--                                    <li><a href="index-5.html">College Status</a></li>--}}
{{--                                    <li><a href="index-6.html">University Campus</a></li>--}}
{{--                                    <li><a href="index-7.html">Academic Education</a></li>--}}
{{--                                    <li><a href="index-8.html">Online Courses</a></li>--}}
{{--                                    <li><a href="index-9.html">Kids Education</a></li>--}}
{{--                                    <li><a href="index-10.html">Preschool Program</a></li>--}}
{{--                                </ul>--}}
                            </li>
                            @foreach($category_menu as $main_menu)
                                <li class="menu-has-child">
                                    <a href='{{url("หมวดหมู่/$main_menu->category_slug")}}'>{{$main_menu['category_name']}}</a>
                                    <ul class="submenu">
                                        @foreach($main_menu['sub_categories'] as $sub_menu)
                                        <li><a href='{{url("หมวดหมู่/$main_menu->category_slug/$sub_menu->sub_category_slug")}}'>{{$sub_menu->sub_category_name}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            <li><a href="{{url('events')}}">กิจกรรม</a></li>
                            <li class="menu-has-child">
                                <a href="{{url('about/history')}}">เกี่ยวกับเรา</a>
                                <ul class="submenu">
                                    <li><a href="{{url('about/history')}}">ประวัติความเป็นมา</a></li>
                                    <li><a href="{{url('about/executive')}}">ฝ่ายบริหาร</a></li>
                                    <li><a href="{{url('/')}}">บุคลากร</a></li>
                                </ul>
                            </li>
                            <li><a href="{{url('contact')}}">ติดต่อเรา</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
{{--            <div class="col-xl-5 col-lg-6 col-md-6 col-6">--}}
{{--                <div class="header-right">--}}
{{--                    <div class="header-search d-none d-lg-block">--}}
{{--                        <form action="#">--}}
{{--                            <input type="text" placeholder="Search Item">--}}
{{--                            <button type="submit" class="header-search-btn"><i class="fa-thin fa-magnifying-glass"></i></button>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                    <div class="header-btn d-none d-sm-block">--}}
{{--                        <a href="#" class="header-btn theme-btn theme-btn-medium">Enroll Now</a>--}}
{{--                    </div>--}}
{{--                    <div class="header-menu-bar d-xl-none ml-10">--}}
{{--                                    <span class="header-menu-bar-icon side-toggle">--}}
{{--                                        <i class="fa-light fa-bars"></i>--}}
{{--                                    </span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
</div>