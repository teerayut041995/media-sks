@php
    $publicHome = $aboutPreview ? route('preview.home') : url('/');
    $aboutBase = $aboutPreview ? url('/preview/about') : url('/about');
    $contentBase = $aboutPreview ? 'https://sks.go.th' : url('/');
    $publicPosts = $aboutPreview ? route('preview.posts') : url('/posts');
    $publicContact = $aboutPreview ? route('preview.contact') : url('/contact');
    $publicDirections = $publicContact.'#location';
    $publicService = $aboutPreview ? route('preview.services', ['service_type' => 'service_unit']) : url('/services?service_type=service_unit');
    $publicCanonical = isset($publicCanonical) ? $publicCanonical : ($aboutPage === 'contact' ? url('/contact') : url('/about/'.$aboutPage));
    $publicPhone = config('public.contact_phone') ?: '043-840-099';
    $publicEmail = config('public.contact_email') ?: 'ksped400@gmail.com';
    $publicFacebook = config('public.facebook') ?: 'https://www.facebook.com/61561301892392/';
    $publicYoutube = config('public.youtube') ?: 'https://www.youtube.com/@user-kr2wd7br8w';
@endphp
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</title>
    <meta name="description" content="@yield('description')">
    <meta property="og:title" content="@yield('title') | ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:type" content="{{ !empty($publicArticle) ? 'article' : 'website' }}">
    <meta property="og:url" content="{{ $publicCanonical }}">
    <meta property="og:image" content="{{ !empty($publicOgImage) ? $publicOgImage : asset('images/kalasin-og.jpg') }}">
    <link rel="canonical" href="{{ $publicCanonical }}">
    @if($aboutPreview)<meta name="robots" content="noindex, nofollow">@endif
    <meta name="theme-color" content="#195580">
    <link rel="icon" href="{{ asset('images/logo/favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home-preview.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about-pages.css') }}?v={{ filemtime(public_path('css/about-pages.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/public-navigation.css') }}?v={{ filemtime(public_path('css/public-navigation.css')) }}">
    @if($aboutPage === 'contact')<link rel="stylesheet" href="{{ asset('css/contact-page.css') }}">@endif
    @if($aboutPage === 'services')<link rel="stylesheet" href="{{ asset('css/service-list.css') }}">@endif
    @if($aboutPage === 'events')<link rel="stylesheet" href="{{ asset('css/event-list.css') }}">@endif
    @if($aboutPage === 'posts')<link rel="stylesheet" href="{{ asset('css/post-list.css') }}">@endif
    @if(!empty($articleDetail))<link rel="stylesheet" href="{{ asset('css/post-detail.css') }}?v={{ filemtime(public_path('css/post-detail.css')) }}">@endif
    @if(!empty($eventDetail))<link rel="stylesheet" href="{{ asset('css/event-detail.css') }}">@endif
    @if(!empty($serviceDetail))<link rel="stylesheet" href="{{ asset('css/service-detail.css') }}">@endif
    <script src="{{ asset('js/home-preview.js') }}" defer></script>
    <script src="{{ asset('js/public-navigation.js') }}?v={{ filemtime(public_path('js/public-navigation.js')) }}" defer></script>
    @if(!empty($eventDetail))<script src="{{ asset('js/event-detail.js') }}" defer></script>@endif
    <noscript><style>.news-filters{display:none!important}.site-header.has-disclosures{position:static;max-height:none!important;overflow:visible!important}.header-inner{flex-wrap:wrap}.main-nav{display:grid!important;grid-template-columns:repeat(2,minmax(0,1fr));width:100%;align-items:start}.nav-disclosure-panel[hidden]{display:block!important;position:static;box-shadow:none;width:100%;max-width:none;max-height:none}.nav-trigger,.nav-category-toggle,.menu-toggle{display:none!important}html{scroll-padding-top:20px}</style></noscript>
</head>
<body class="sks-preview sks-public">
@include('frontend.preview.partials.icons')
@include('layouts.public.header')
@yield('content')
@include('layouts.public.footer')
</body>
</html>
