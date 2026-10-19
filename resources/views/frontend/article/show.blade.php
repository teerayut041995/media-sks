@extends('layouts.public')
@section('title', e($post->post_title))
@section('description', e(str_limit(trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($post->post_detail ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8'))), 180)))
@section('content')
@php
    $postHome = $aboutPreview ? route('preview.home') : url('/');
    $postList = $aboutPreview ? route('preview.posts') : url('/posts');
    $postDetailBase = $aboutPreview ? url('/preview/article') : url('/posts');
    $categoryUrl = $postList.'?'.http_build_query(['category' => $post->category_uid]);
    $subCategoryUrl = !empty($post->sub_category_uid) ? $postList.'?'.http_build_query(['category' => $post->category_uid, 'sub_category' => $post->sub_category_uid]) : null;
    $imageName = !empty($post->post_image) ? basename($post->post_image) : null;
    $imagePath = $imageName ? 'images/image_post/'.$imageName : null;
    $imageUrl = $imagePath ? (($aboutPreview || !is_file(public_path($imagePath))) ? 'https://sks.go.th/'.$imagePath : asset($imagePath)) : null;
    $published = $post->created_at ? \Carbon\Carbon::parse($post->created_at) : null;
    $summary = trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($post->post_detail ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
    $contentOpening = trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($post->post_content ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
    $showLead = $summary !== '' && ($contentOpening === '' || mb_strpos($contentOpening, $summary) !== 0);
    $hasVideo = !empty($post->post_youtube_embed);
@endphp
<main id="main" tabindex="-1" class="post-detail-page">
    <section class="post-detail-introduction" aria-labelledby="post-detail-title">
        <div class="container">
            <nav class="breadcrumbs" aria-label="เส้นทางนำทาง">
                <a href="{{ $postHome }}">หน้าหลัก</a><span aria-hidden="true">/</span>
                <a href="{{ $categoryUrl }}">{{ $post->category_name }}</a>
                @if($subCategoryUrl)<span aria-hidden="true">/</span><a href="{{ $subCategoryUrl }}">{{ $post->sub_category_name }}</a>@endif
                <span aria-hidden="true">/</span><span aria-current="page">รายละเอียดบทความ</span>
            </nav>
            <div class="post-detail-heading">
                <p class="eyebrow">{{ $post->sub_category_name ?: $post->category_name }}</p>
                <h1 id="post-detail-title">{{ $post->post_title }}</h1>
                <div class="post-detail-meta" aria-label="ข้อมูลบทความ">
                    @if($published)<span><svg class="icon" aria-hidden="true"><use href="#i-calendar"/></svg><time datetime="{{ $published->toDateString() }}">{{ formatDateThaiBirthday($post->created_at) }}</time></span>@endif
                    @if($post->name)<span>โดย {{ $post->name }}</span>@endif
                    @if($views !== null)<span>เข้าชม {{ number_format($views) }} ครั้ง</span>@endif
                </div>
            </div>
        </div>
    </section>

    @if($hasVideo)
        <div class="post-detail-media-wrap"><div class="container"><div class="post-detail-video" aria-label="วิดีโอประกอบบทความ">{!! $post->post_youtube_embed !!}</div></div></div>
    @elseif($imageUrl)
        <div class="post-detail-media-wrap"><div class="container"><figure class="post-detail-cover"><img src="{{ $imageUrl }}" width="1290" height="726" alt="ภาพประกอบ {{ $post->post_title }}" decoding="async" fetchpriority="high" data-image-fallback><figcaption class="image-fallback" hidden>ไม่สามารถแสดงภาพประกอบบทความได้</figcaption></figure></div></div>
    @endif

    <section class="post-detail-story" id="article-content" aria-label="เนื้อหาบทความ">
        <div class="container post-detail-layout">
            <div class="post-detail-primary">
            <article class="post-detail-content">
                @if($showLead)<p class="post-detail-lead">{{ $summary }}</p>@endif
                @if(!empty($post->post_content))<div class="post-detail-richtext">{!! $post->post_content !!}</div>@endif
                <div class="post-detail-endline" aria-hidden="true"></div>
                <div class="post-detail-return"><a href="{{ $subCategoryUrl ?: $categoryUrl }}"><svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg>กลับไปดู{{ $post->sub_category_name ?: $post->category_name }}ทั้งหมด</a></div>
            </article>
            @if($post_related->isNotEmpty())
        <section class="post-detail-related" aria-labelledby="post-related-title">
            <div class="post-detail-related-heading"><div><p class="eyebrow">อ่านต่อจากหมวดเดียวกัน</p><h2 id="post-related-title">เรื่องที่เกี่ยวข้อง</h2></div><a href="{{ $subCategoryUrl ?: $categoryUrl }}">ดูทั้งหมด <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></div>
            <div class="post-detail-related-grid">
                @foreach($post_related as $related)
                    @php
                        $relatedImageName = !empty($related->post_image) ? basename($related->post_image) : null;
                        $relatedPath = $relatedImageName ? 'images/image_post/'.$relatedImageName : null;
                        $relatedImage = $relatedPath ? (($aboutPreview || !is_file(public_path($relatedPath))) ? 'https://sks.go.th/'.$relatedPath : asset($relatedPath)) : null;
                        $relatedUrl = $postDetailBase.'/'.rawurlencode($related->uid);
                        $relatedDate = $related->created_at ? \Carbon\Carbon::parse($related->created_at) : null;
                    @endphp
                    <article class="post-detail-related-card">
                        <a class="post-detail-related-image" href="{{ $relatedUrl }}" aria-label="อ่านบทความ: {{ $related->post_title }}">@if($relatedImage)<img src="{{ $relatedImage }}" width="1290" height="726" alt="" loading="lazy" decoding="async" data-image-fallback><span class="image-fallback" hidden>ภาพประกอบบทความ</span>@else<span class="image-fallback">ภาพประกอบบทความ</span>@endif</a>
                        <div class="post-detail-related-body">@if($relatedDate)<time datetime="{{ $relatedDate->toDateString() }}">{{ formatDateThaiBirthday($related->created_at) }}</time>@endif<h3><a href="{{ $relatedUrl }}">{{ $related->post_title }}</a></h3><a class="post-detail-related-read" href="{{ $relatedUrl }}">อ่านรายละเอียด <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></div>
                    </article>
                @endforeach
            </div>
        </section>
            @endif
            </div>
            @include('frontend.article.partials.detail-sidebar')
        </div>
    </section>
</main>
@endsection
