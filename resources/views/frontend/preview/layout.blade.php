<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ isset($article) ? $article['title'].' · ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์' : 'ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ · หน้าแรกต้นแบบ' }}</title>
    <meta name="description" content="ข่าวสาร กิจกรรม ข้อมูลศูนย์ หน่วยบริการ และเอกสารจากศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
    <meta name="theme-color" content="#195580">
    <link rel="icon" href="{{ asset('images/logo/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://sks.go.th">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about-pages.css') }}">
    <link rel="stylesheet" href="{{ asset('css/public-navigation.css') }}?v={{ filemtime(public_path('css/public-navigation.css')) }}">
    <script src="{{ asset('js/home-preview.js') }}" defer></script>
    <script src="{{ asset('js/public-navigation.js') }}?v={{ filemtime(public_path('js/public-navigation.js')) }}" defer></script>
    <noscript><style>.news-filters{display:none!important}.site-header.has-disclosures{position:static;max-height:none!important;overflow:visible!important}.header-inner{flex-wrap:wrap}.main-nav{display:grid!important;grid-template-columns:repeat(2,minmax(0,1fr));width:100%;align-items:start}.nav-disclosure-panel[hidden]{display:block!important;position:static;box-shadow:none;width:100%;max-width:none;max-height:none}.nav-trigger,.nav-category-toggle,.menu-toggle{display:none!important}html{scroll-padding-top:20px}</style></noscript>
</head>
<body class="sks-preview">
@include('frontend.preview.partials.icons')
@include('frontend.preview.partials.header')
@yield('content')
@include('frontend.preview.partials.footer')
</body>
</html>
