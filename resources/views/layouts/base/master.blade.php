<!Doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @yield('seo')
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("images/home/favicon.ico")}}">
    <!-- Place favicon.ico in the root directory -->

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
    <link rel="stylesheet" href="{{asset("template/user-panel/assets/css/main.css")}}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Kanit|Mitr|Prompt" rel="stylesheet">
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