<div class="header-area header-sticky">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-10 col-lg-10 col-md-10 col-10">
                <div class="header-left">
                    <div class="header-logo">
                        <a href="{{url('/')}}"><img src="{{asset("images/home/logo.png")}}"
                                                    alt="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"></a>
                    </div>
                    <nav class="main-menu mobile-menu d-none d-xl-block" id="mobile-menu">
                        <ul>
                            <li class="menu-has-child">
                                <a href="{{url('/')}}">หน้าหลัก</a>
                            </li>
                            @foreach($category_menu as $main_menu)
                                <li class="menu-has-child">
                                    <a href='{{url("หมวดหมู่/$main_menu->category_slug")}}'>{{$main_menu['category_name']}}</a>
                                    <ul class="submenu">
                                        @foreach($main_menu['sub_categories'] as $sub_menu)
                                            <li>
                                                <a href='{{url("หมวดหมู่/$main_menu->category_slug/$sub_menu->sub_category_slug")}}'>{{$sub_menu->sub_category_name}}</a>
                                            </li>
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
            <div class="col-xl-2 col-lg-2 col-md-2 col-2">
                <div class="header-right">
                    <div class="header-menu-bar d-xl-none ml-10">
                        <span class="header-menu-bar-icon side-toggle">
                            <i class="fa-light fa-bars"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>