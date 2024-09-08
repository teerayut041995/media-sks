<!Doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @yield('seo')
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{url('images/logo/favicon.ico')}}" type="image/x-icon">
    <link rel="icon" href="{{url('images/logo/favicon.ico')}}" type="image/x-icon">
    <meta name="author" content="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
    <meta name="robots" content="index, archive">

    <meta name="msapplication-TileImage" content="{{asset('images/logo/apple-touch-icon-new-152.png')}}">
    <link rel="apple-touch-icon" href="{{asset('images/logo/apple-touch-icon-new-152.png')}}">
    <link rel="apple-touch-startup-image" href="{{asset('images/logo/apple-touch-icon-new-152.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('images/logo/apple-touch-icon-new-152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('images/logo/apple-touch-icon-new-180.png')}}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{asset('images/logo/apple-touch-icon-new-167.png')}}">

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1TWHYK5CB5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-1TWHYK5CB5');
    </script>
    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset("template/user-panel/assets/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("template/user-panel/assets/css/animate.min.css")}}">
    <link rel="stylesheet" href="{{asset("template/user-panel/assets/css/magnific-popup.css")}}">
    <link rel="stylesheet" href="{{asset("template/user-panel/assets/css/fontawesome-all.min.css")}}">
    <link rel="stylesheet" href="{{asset("template/user-panel/assets/css/odometer.min.css")}}">
    <link rel="stylesheet" href="{{asset("template/user-panel/assets/css/nice-select.css")}}">
    <link rel="stylesheet" href="{{asset("template/user-panel/assets/css/meanmenu.css")}}">
    <link rel="stylesheet" href="{{asset("template/user-panel/assets/css/swiper-bundle.min.css")}}">
    <link rel="stylesheet" href="{{asset("template/user-panel/assets/css/main-1.css")}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kanit|Mitr|Prompt" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <style type="text/css">
        .my-font {
            font-family: 'Mitr', sans-serif;
        }

        .cut-title {
            font-size: 1em;
            line-height: 1em;
            height: 2em;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .h2_blog-content-title-manual {
            font-size: 18px;
            font-family: 'Chakra Petch';
            font-weight: normal;
            color: #1E1E1E;
            text-align: left;
            line-height: 1.5;
        }
        .h2_blog-content-meta-manual {
            font-family: 'Chakra Petch';
            font-weight: normal;
            text-align: left;
        }
        .blog_details-course-text {
            font-size: 14px;
            font-family: 'Chakra Petch';
            font-weight: normal;
            text-align: left;
        }

        .set-font-thai {
            font-family: 'Chakra Petch';
        }

    </style>

    @yield('style')
</head>

<body>
<!-- sidebar-information-area-start -->
<div class="sidebar-info side-info">
    <div class="sidebar-logo-wrapper mb-25">
        <div class="row align-items-center">
            <div class="col-xl-6 col-8">
                <div class="sidebar-logo">
                    <a href="{{url('/')}}"><img src="{{asset("images/home/logo.png")}}"
                                                alt="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"></a>
                </div>
            </div>
            <div class="col-xl-6 col-4">
                <div class="sidebar-close-wrapper text-end">
                    <button class="sidebar-close side-info-close"><i class="fal fa-times"></i></button>
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar-menu-wrapper fix">
        <div class="mobile-menu"></div>
    </div>
</div>
<div class="offcanvas-overlay"></div>
<!-- sidebar-information-area-end -->

<!-- header area start -->
<header>
    <div class="h7_header-top d-none d-md-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-9">
                    <ul class="h7_header-top-list">
                        <li><a href="tel:{{env('CONTACT_PHONE_NUMBER', '')}}"><i
                                        class="fa-light fa-phone"></i>{{env('CONTACT_PHONE_NUMBER', '')}}</a></li>
                        <li><a href="javascript:void(0)"><i
                                        class="fa-light fa-envelope"></i>{{env('CONTACT_EMAIL', '')}}</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-3">
                    <div class="h7_header-top-social">
                        <ul>
                            {{--                            <li><a href="{{env('SOCIAL_CONTACT_WEBSITE', '')}}"><i class="fa-brands fa-globe"></i></a></li>--}}
                            <li><a href="{{env('SOCIAL_CONTACT_FACEBOOK', '')}}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                            </li>
                            <li><a href="{{env('SOCIAL_CONTACT_WEBSITE', '')}}" target="_blank"><i
                                            class="fa-brands fa fa-dribbble"></i></a></li>
                            <li><a href="{{env('SOCIAL_CONTACT_YOUTUBE', '')}}" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('.layouts.base.header')
</header>
<!-- header area end -->

<main>
    @yield('content')

</main>

<!-- footer area start -->
<footer class="footer-area h2_footer-area">
    @include('layouts.base.footer')
</footer>
<!-- footer area end -->

<!-- JS here -->
<script src="{{asset("template/user-panel/assets/js/jquery.min.js")}}"></script>
<script src="{{asset("template/user-panel/assets/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{asset("template/user-panel/assets/js/swiper-bundle.min.js")}}"></script>
<script src="{{asset("template/user-panel/assets/js/jquery.meanmenu.min.js")}}"></script>
<script src="{{asset("template/user-panel/assets/js/wow.min.js")}}"></script>
<script src="{{asset("template/user-panel/assets/js/jquery.nice-select.min.js")}}"></script>
<script src="{{asset("template/user-panel/assets/js/jquery.scrollUp.min.js")}}"></script>
<script src="{{asset("template/user-panel/assets/js/jquery.magnific-popup.min.js")}}"></script>
<script src="{{asset("template/user-panel/assets/js/odometer.min.js")}}"></script>
<script src="{{asset("template/user-panel/assets/js/appear.min.js")}}"></script>
<script src="{{asset("template/user-panel/assets/js/jquery.bxslider.min.js")}}"></script>
<script src="{{asset("template/user-panel/assets/js/main.js")}}"></script>
@yield('script')
</body>
</html>