@extends('frontend.preview.layout')
@section('content')
<main id="main" tabindex="-1" class="content-page">
    <div class="container">
        <nav class="breadcrumbs" aria-label="เส้นทางนำทาง">
            <a href="{{ route('preview.home') }}">หน้าหลัก</a><span aria-hidden="true">/</span>
            <a href="{{ route('preview.home') }}#{{ $kind === 'events' ? 'events' : 'news' }}">{{ $kind === 'events' ? 'กิจกรรม' : 'ข่าวสาร' }}</a><span aria-hidden="true">/</span>
            <span aria-current="page">{{ $article['type'] }}</span>
        </nav>
        <article class="content-article" aria-labelledby="article-title">
            <header class="article-heading">
                <p class="eyebrow">{{ $article['type'] }}</p>
                <h1 id="article-title">{{ $article['title'] }}</h1>
                @if($article['date'])<p class="article-date">{{ $kind === 'events' ? 'วันที่จัดกิจกรรม' : 'เผยแพร่เมื่อ' }} <time datetime="{{ $article['date'] }}">{{ $article['display_date'] }}</time></p>@endif
            </header>
            @if($article['image'])
                <figure class="article-image"><a href="{{ $article['image'] }}" aria-label="เปิดภาพขนาดเต็ม: {{ $article['title'] }}"><img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" width="1290" height="726" decoding="async" fetchpriority="high" data-image-fallback><span class="image-fallback" hidden>ภาพประกอบจากศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</span></a></figure>
            @endif
            <div class="article-copy">
                @forelse($article['paragraphs'] ?? [] as $paragraph)<p>{{ $paragraph }}</p>@empty<p>{{ $article['summary'] }}</p>@endforelse
                <div class="article-source"><p>ข้อมูลจากเว็บไซต์ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ บันทึกวันที่ 14 ตุลาคม 2569</p><a class="text-link" href="{{ $article['url'] }}">ดู{{ $kind === 'events' ? 'ภาพกิจกรรมทั้งหมด' : 'เนื้อหาและเอกสาร' }}บนเว็บไซต์ศูนย์ <svg class="icon" aria-hidden="true"><use href="#i-diagonal"/></svg></a></div>
                <a class="text-link" href="{{ route('preview.home') }}#{{ $kind === 'events' ? 'events' : 'news' }}">กลับไป{{ $kind === 'events' ? 'ภาพกิจกรรม' : 'ข่าวสารล่าสุด' }} <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a>
            </div>
        </article>
        @if(count($related))
            <section class="related-stories" aria-labelledby="related-title"><div class="section-heading"><h2 id="related-title">{{ $kind === 'events' ? 'กิจกรรมอื่น ๆ' : 'เรื่องราวที่น่าสนใจ' }}</h2></div><div class="news-grid">@foreach($related as $story)@include('frontend.preview.partials.news-card', ['story' => $story, 'isAward' => false])@endforeach</div></section>
        @endif
    </div>
</main>
@endsection
