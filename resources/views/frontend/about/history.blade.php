@extends('layouts.public')
@section('title', 'ประวัติความเป็นมา')
@section('description', 'ประวัติความเป็นมา วิสัยทัศน์ พันธกิจ และบทบาทหน้าที่ของศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ ก่อตั้งวันที่ 31 กรกฎาคม พ.ศ. 2543')
@section('content')
<main id="main" tabindex="-1" class="about-page history-page">
    @include('frontend.about.partials.page-navigation')
    <section class="about-introduction">
        <div class="container">
            <nav class="breadcrumbs" aria-label="เส้นทางนำทาง"><a href="{{ $aboutPreview ? route('preview.home') : url('/') }}">หน้าหลัก</a><span aria-hidden="true">/</span><span>เกี่ยวกับเรา</span><span aria-hidden="true">/</span><span aria-current="page">ประวัติความเป็นมา</span></nav>
            <div class="history-intro-grid">
                <div class="history-intro-copy"><p class="eyebrow">รู้จักศูนย์ของเรา</p><h1>ประวัติความเป็นมา</h1><p class="about-lead">จากจุดเริ่มต้นของศูนย์<br><span>สู่โอกาสทางการศึกษาที่เท่าเทียม</span></p><p class="about-intro-description">ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ จัดและส่งเสริมการศึกษาเพื่อเด็กพิการ ให้บริการช่วยเหลือระยะแรกเริ่ม ฟื้นฟูสมรรถภาพ และเตรียมความพร้อมเพื่อส่งต่อเข้าสู่การศึกษาอย่างเหมาะสม</p>
                    <dl class="about-facts"><div><dt>ก่อตั้งเมื่อ</dt><dd><time datetime="2000-07-31">31 กรกฎาคม 2543</time></dd></div><div><dt>พื้นที่ของศูนย์</dt><dd>7 ไร่ 3 งาน 80 ตารางวา</dd></div></dl>
                </div>
                <figure class="history-hero-image"><img src="{{ asset('images/kalasin1.jpg') }}" width="2048" height="1536" alt="อาคารและพื้นที่ของศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์" decoding="async" fetchpriority="high"><figcaption><span>พื้นที่แห่งการเรียนรู้</span><strong>ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</strong></figcaption></figure>
            </div>
        </div>
    </section>
    <div class="container about-content-layout">
        <aside class="page-contents"><nav aria-label="เนื้อหาในหน้านี้"><p>ในหน้านี้</p><a href="#our-history">จุดเริ่มต้นของศูนย์</a><a href="#vision">วิสัยทัศน์</a><a href="#mission">พันธกิจ</a><a href="#identity">อัตลักษณ์และเอกลักษณ์</a><a href="#responsibilities">บทบาทหน้าที่</a></nav></aside>
        <div class="history-sections">
            <section class="about-reading-section" id="our-history" tabindex="-1" aria-labelledby="history-title"><p class="eyebrow">จากวันแรกถึงวันนี้</p><h2 id="history-title">จุดเริ่มต้นของศูนย์</h2><p>ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ สังกัดสำนักบริหารงานการศึกษาพิเศษ สำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน กระทรวงศึกษาธิการ ได้รับอนุมัติให้จัดตั้งเมื่อวันที่ 31 กรกฎาคม พ.ศ. 2543</p>
                <ol class="history-timeline" role="list"><li><span class="timeline-period">พ.ศ. 2543</span><h3>เริ่มต้นการจัดตั้งศูนย์</h3><p>ศูนย์การศึกษาพิเศษก่อตั้งครั้งแรกอาศัยตั้งสำนักงาน ณ โรงเรียนศึกษาพิเศษกาฬสินธุ์ ปัจจุบันเปลี่ยนเป็นโรงเรียนกาฬสินธุ์ปัญญานุกูล</p></li><li><span class="timeline-period">ปัจจุบัน</span><h3>พื้นที่แห่งการเรียนรู้ที่ยางตลาด</h3><p>ได้ย้ายสำนักงานอาคารศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ มาตั้งอยู่เลขที่ 400 ถนนถีนานนท์ หมู่ที่ 1 ตำบลยางตลาด อำเภอยางตลาด จังหวัดกาฬสินธุ์ มีพื้นที่จำนวน 7 ไร่ 3 งาน 80 ตารางวา</p></li></ol>
                <p>ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ เป็นสถานศึกษาที่จัดการศึกษาเพื่อเด็กพิการ ในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม ฟื้นฟูสมรรถภาพ และเตรียมความพร้อม เพื่อส่งต่อเด็กพิการเข้าเรียนร่วมกับนักเรียนในโรงเรียนปกติหรือโรงเรียนเฉพาะความพิการ ทุกประเภทในจังหวัดกาฬสินธุ์</p>
            </section>
            <section class="vision-panel" id="vision" tabindex="-1" aria-labelledby="vision-title"><p class="eyebrow">ทิศทางของเรา</p><h2 id="vision-title">วิสัยทัศน์</h2><blockquote>“ศูนย์การศึกษาพิเศษประจำจังหวัดกาฬสินธุ์ เป็นสถานศึกษาที่มีมาตรฐาน ก้าวทันเทคโนโลยี พัฒนาคุณภาพชีวิตเด็กพิการแบบองค์รวม ตามแนวทางปรัชญาเศรษฐกิจพอเพียง และมนุษยปรัชญา ให้เป็นคนดีและมีความสุข”</blockquote></section>
            <section class="about-reading-section" id="mission" tabindex="-1" aria-labelledby="mission-title"><p class="eyebrow">สิ่งที่เรามุ่งมั่น</p><h2 id="mission-title">พันธกิจ</h2><ol class="mission-list" role="list">@foreach($about['missions'] as $mission)<li><span class="list-number" aria-hidden="true">{{ sprintf('%02d', $loop->iteration) }}</span><p>{{ $mission }}</p></li>@endforeach</ol></section>
            <section class="identity-grid" id="identity" tabindex="-1" aria-label="อัตลักษณ์และเอกลักษณ์"><div><span class="identity-line" aria-hidden="true"></span><h2>อัตลักษณ์</h2><p>“นักเรียนศูนย์การศึกษาพิเศษประจำจังหวัดกาฬสินธุ์ มีความสุข สนุก ร่าเริง”</p></div><div><span class="identity-line" aria-hidden="true"></span><h2>เอกลักษณ์</h2><p>“สถานศึกษาแกนนำ ที่นำสื่อและเทคโนโลยีทางการศึกษาเพื่อพัฒนากระบวนการจัดการเรียนรู้ที่มีคุณภาพ”</p></div></section>
            <section class="about-reading-section" id="responsibilities" tabindex="-1" aria-labelledby="responsibilities-title"><p class="eyebrow">การศึกษาเพื่อทุกโอกาส</p><h2 id="responsibilities-title">บทบาทหน้าที่</h2><ol class="responsibility-list">@foreach($about['responsibilities'] as $responsibility)<li>{{ $responsibility }}</li>@endforeach</ol></section>
            <div class="about-next-page"><div><p class="eyebrow">รู้จักศูนย์ให้มากขึ้น</p><h2>ผู้บริหารและหัวหน้ากลุ่มงาน</h2></div><a class="button button-primary" href="{{ $aboutPreview ? route('preview.about', ['page' => 'executive']) : url('/about/executive') }}">รู้จักฝ่ายบริหาร <svg class="icon" aria-hidden="true"><use href="#i-arrow"/></svg></a></div>
        </div>
    </div>
</main>
@endsection
