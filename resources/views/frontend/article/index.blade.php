@extends('layouts.public')
@section('title', ($sub_category ? $sub_category->sub_category_name.' · ' : '').$category->category_name)
@section('description', 'ติดตาม'.($sub_category ? $sub_category->sub_category_name.' ในหมวด' : '').$category->category_name.' ข่าวสาร ความรู้ และข้อมูลจากศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์')
@section('content')
@php
    $postsBase = $aboutPreview ? route('preview.posts') : url('/posts');
    $detailBase = $aboutPreview ? url('/preview/article') : url('/posts');
    $categoryUrl = $postsBase.'?'.http_build_query(['category' => $category->uid]);
    $currentUrl = $postsBase.'?'.http_build_query(array_filter(['category' => $category->uid, 'sub_category' => $sub_category->uid ?? null]));
    $menuCategory = collect($category_menu)->first(function ($item) use ($category) { return (string) data_get($item, 'uid') === (string) $category->uid; });
    $subcategories = data_get($menuCategory, 'sub_categories', []);
    $heading = $sub_category ? $sub_category->sub_category_name : $category->category_name;
    $pageNumbers = [];
    if ($posts->lastPage() > 1) {
        $pageNumbers = array_unique([1, $posts->currentPage() - 1, $posts->currentPage(), $posts->currentPage() + 1, $posts->lastPage()]);
        $pageNumbers = array_values(array_filter($pageNumbers, function ($page) use ($posts) { return $page >= 1 && $page <= $posts->lastPage(); }));
        sort($pageNumbers);
    }
@endphp
<main id="main" tabindex="-1" class="post-list-page">
    <section class="post-introduction" aria-labelledby="post-list-title">
        <div class="container">
            <nav class="breadcrumbs" aria-label="เส้นทางนำทาง"><a href="{{ $aboutPreview ? route('preview.home') : url('/') }}">หน้าหลัก</a><span aria-hidden="true">/</span>@if($sub_category)<a href="{{ $categoryUrl }}">{{ $category->category_name }}</a><span aria-hidden="true">/</span>@endif<span aria-current="page">{{ $heading }}</span></nav>
            <div class="post-intro-grid">
                <div><p class="eyebrow">อัปเดตจากศูนย์การศึกษาพิเศษ</p><h1 id="post-list-title">{{ $heading }}</h1><p class="post-intro-description">@if($sub_category)เรื่องราวและข้อมูล{{ $sub_category->sub_category_name }}จากศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์@elseติดตามข่าว เรื่องราว และข้อมูล{{ $category->category_name }}จากศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์@endif</p></div>
                <div class="post-intro-side"><span class="post-intro-line" aria-hidden="true"></span><p>ข้อมูลเพื่อทุกคน<br>เข้าถึงได้ในที่เดียว</p></div>
            </div>
        </div>
    </section>
    @if(count($subcategories))
        <nav class="post-subcategories" aria-label="หมวดย่อย{{ $category->category_name }}"><div class="container post-subcategories-inner">
            <a href="{{ $categoryUrl }}" @if(!$sub_category) aria-current="page" @endif>ทั้งหมด</a>
            @foreach($subcategories as $item)
                <a href="{{ $postsBase.'?'.http_build_query(['category' => $category->uid, 'sub_category' => data_get($item, 'uid')]) }}" @if($sub_category && (string) $sub_category->uid === (string) data_get($item, 'uid')) aria-current="page" @endif>{{ data_get($item, 'sub_category_name') }}</a>
            @endforeach
        </div></nav>
    @endif
    <section class="post-list-section" id="post-results" aria-labelledby="post-results-title"><div class="container">
        <div class="post-list-toolbar">
            <div><p class="eyebrow">เรื่องราวล่าสุด</p><h2 id="post-results-title">{{ $search !== '' ? 'ผลการค้นหา' : ($sub_category ? 'ทั้งหมดในหมวด '.$sub_category->sub_category_name : 'ข่าวและข้อมูลทั้งหมด') }}</h2><p class="post-result-count" role="status">{{ $search !== '' ? 'คำค้น “'.$search.'” · ' : '' }}พบ {{ number_format($posts->total()) }} รายการ</p></div>
            <form class="post-search" action="{{ $postsBase }}#post-results" method="get" role="search"><input type="hidden" name="category" value="{{ $category->uid }}">@if($sub_category)<input type="hidden" name="sub_category" value="{{ $sub_category->uid }}">@endif<label for="post-search-input">ค้นหาในหมวดนี้</label><div class="post-search-row"><input id="post-search-input" name="name" type="search" value="{{ $search }}" maxlength="120" placeholder="ค้นหาชื่อเรื่องหรือรายละเอียด" autocomplete="off"><button type="submit">ค้นหา <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></button></div>@if($search !== '')<a class="post-search-clear" href="{{ $currentUrl }}#post-results">ล้างคำค้นหา</a>@endif</form>
        </div>
        @if($posts->count())
            <div class="post-grid">
                @foreach($posts as $post)
                    @php
                        $postUrl = $detailBase.'/'.rawurlencode($post->uid);
                        $imageName = !empty($post->post_image) ? basename($post->post_image) : null;
                        $imagePath = $imageName ? 'images/image_post/'.$imageName : null;
                        $imageUrl = $imagePath ? (($aboutPreview || !is_file(public_path($imagePath))) ? 'https://sks.go.th/'.$imagePath : asset($imagePath)) : null;
                        $summary = trim(preg_replace('/\s+/u', ' ', html_entity_decode(strip_tags($post->post_detail ?? ''), ENT_QUOTES | ENT_HTML5, 'UTF-8')));
                        $summary = str_limit($summary, $loop->first && $posts->currentPage() === 1 ? 210 : 120);
                        $published = $post->created_at ? \Carbon\Carbon::parse($post->created_at) : null;
                    @endphp
                    <article class="post-card {{ $loop->first && $posts->currentPage() === 1 && $search === '' ? 'post-card-featured' : '' }}">
                        <a class="post-card-media" href="{{ $postUrl }}" aria-label="อ่านบทความ: {{ $post->post_title }}">@if($imageUrl)<img src="{{ $imageUrl }}" width="1290" height="726" alt="ภาพประกอบ {{ $post->post_title }}" loading="{{ $loop->first ? 'eager' : 'lazy' }}" decoding="async" data-image-fallback><span class="post-card-image-fallback image-fallback" hidden>ภาพประกอบบทความ</span>@else<span class="post-card-image-fallback">ภาพประกอบบทความ</span>@endif</a>
                        <div class="post-card-body">
                            @if($loop->first && $posts->currentPage() === 1 && $search === '')<span class="post-feature-label">เรื่องล่าสุด</span>@endif
                            @if($published)<p class="post-card-date">เผยแพร่ <time datetime="{{ $published->toDateString() }}">{{ formatDateThaiBirthday($post->created_at) }}</time></p>@endif
                            <h3><a href="{{ $postUrl }}">{{ $post->post_title }}</a></h3>
                            @if($summary)<p class="post-card-summary">{{ $summary }}</p>@endif
                            <a class="post-card-read" href="{{ $postUrl }}">อ่านรายละเอียด <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a>
                        </div>
                    </article>
                @endforeach
            </div>
            @if($posts->lastPage() > 1)
                <nav class="post-pagination" aria-label="หน้ารายการ{{ $heading }}">
                    @if($posts->onFirstPage())<span class="post-page-edge is-disabled" aria-disabled="true">ก่อนหน้า</span>@else<a class="post-page-edge" href="{{ $posts->previousPageUrl() }}#post-results" rel="prev">ก่อนหน้า</a>@endif
                    <div class="post-page-numbers">
                        @foreach($pageNumbers as $page)
                            @if(!$loop->first && $page > $pageNumbers[$loop->index - 1] + 1)<span class="post-page-ellipsis" aria-hidden="true">…</span>@endif
                            @if($page === $posts->currentPage())<span class="post-page-number is-current" aria-current="page" aria-label="หน้า {{ $page }}">{{ $page }}</span>@else<a class="post-page-number" href="{{ $posts->url($page) }}#post-results" aria-label="ไปหน้า {{ $page }}">{{ $page }}</a>@endif
                        @endforeach
                    </div>
                    @if($posts->hasMorePages())<a class="post-page-edge" href="{{ $posts->nextPageUrl() }}#post-results" rel="next">ถัดไป</a>@else<span class="post-page-edge is-disabled" aria-disabled="true">ถัดไป</span>@endif
                </nav>
            @endif
        @else
            <div class="post-list-empty"><h3>{{ $search !== '' ? 'ไม่พบเรื่องที่ตรงกับคำค้นหา' : ($aboutPreview ? 'ยังไม่มีข้อมูลตัวอย่างในหมวดย่อยนี้' : 'ยังไม่มีบทความในหมวดนี้') }}</h3><p>{{ $search !== '' ? 'ลองใช้คำค้นอื่น หรือกลับไปดูบทความทั้งหมดในหมวดนี้' : ($aboutPreview ? 'หน้าเว็บจริงจะแสดงข้อมูลจากฐานข้อมูลของศูนย์' : 'โปรดกลับมาตรวจสอบอีกครั้ง') }}</p>@if($search !== '')<a class="button button-outline" href="{{ $currentUrl }}#post-results">ดูทั้งหมดในหมวดนี้ <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a>@endif</div>
        @endif
    </div></section>
</main>
@endsection
