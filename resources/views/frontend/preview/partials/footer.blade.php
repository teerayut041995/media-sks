<section class="contact-band" id="contact" aria-labelledby="contact-title">
    <div class="container contact-band-inner">
        <div><span class="eyebrow">เราพร้อมให้ข้อมูล</span><h2 id="contact-title">เริ่มต้นโอกาสการเรียนรู้<br>พูดคุยกับศูนย์ของเรา</h2></div>
        <div class="contact-actions"><a class="button button-light" href="tel:043840099"><svg class="icon" aria-hidden="true"><use href="#i-phone"/></svg>043-840-099</a><a class="contact-detail-link" href="{{ route('preview.contact') }}">ช่องทางติดต่อทั้งหมด <svg class="icon" aria-hidden="true"><use href="#i-diagonal"/></svg></a></div>
    </div>
</section>
<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-identity">
            <a class="brand" href="{{ route('preview.home') }}"><img src="{{ asset('images/logo/sks-logo.png') }}" width="48" height="50" alt=""><span><strong>ศูนย์การศึกษาพิเศษ</strong><span class="brand-province">ประจำจังหวัดกาฬสินธุ์</span></span></a>
            <p>จัดและส่งเสริมการศึกษาเพื่อเด็กพิการ<br>พัฒนาศักยภาพ และสร้างโอกาสการเรียนรู้</p>
            <div class="social-links"><a href="https://www.facebook.com/61561301892392/" aria-label="Facebook ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"><svg class="icon" aria-hidden="true"><use href="#i-facebook"/></svg></a><a href="https://www.youtube.com/@user-kr2wd7br8w" aria-label="YouTube ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์"><svg class="icon" aria-hidden="true"><use href="#i-youtube"/></svg></a></div>
        </div>
        <div><h2>สำรวจเว็บไซต์</h2><ul><li><a href="{{ isset($article) ? route('preview.home') : '' }}#news">ข่าวและประชาสัมพันธ์</a></li><li><a href="{{ route('preview.about', ['page' => 'history']) }}">ประวัติและข้อมูลศูนย์</a></li><li><a href="{{ route('preview.about', ['page' => 'executive']) }}">คณะผู้บริหาร</a></li><li><a href="{{ route('preview.services', ['service_type' => 'service_unit']) }}">หน่วยบริการ</a></li></ul></div>
        <div id="staff-links"><h2>สำหรับบุคลากร</h2><ul><li><a href="https://caper.sks.go.th/">ระบบ CAPER <span aria-hidden="true">↗</span></a></li><li><a href="https://report.sks.go.th/">ระบบรายงานปฏิบัติงาน <span aria-hidden="true">↗</span></a></li><li><a href="https://caper.sks.go.th/learning-online">Learning Online <span aria-hidden="true">↗</span></a></li><li><a href="https://services.sks.go.th/certificate">เกียรติบัตรออนไลน์ <span aria-hidden="true">↗</span></a></li></ul></div>
        <div class="footer-contact"><h2>พบกับเรา</h2><address>เลขที่ 400 หมู่ 1 ถนนถีนานนท์<br>ตำบลยางตลาด อำเภอยางตลาด<br>จังหวัดกาฬสินธุ์ 46120</address><a href="mailto:ksped400@gmail.com">ksped400@gmail.com</a><a class="footer-directions" href="{{ route('preview.contact').'#location' }}">ดูแผนที่และการเดินทาง <svg class="icon" aria-hidden="true"><use href="#i-diagonal"/></svg></a></div>
    </div>
    <div class="container footer-bottom"><span>ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</span><span class="preview-note">ต้นแบบเว็บไซต์ · ข้อมูลอ้างอิง 15 ต.ค. 2569 · <a href="https://sks.go.th/">เว็บไซต์ปัจจุบัน <span aria-hidden="true">↗</span></a></span></div>
</footer>
