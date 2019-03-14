@extends('layouts.general_master')

@section('frontend_seo')
<title>เกี่ยวกับเรา - ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ | {{config('app.name')}}</title>
<meta name="description" content="ประวัติความเป็นมา วิสัยทัศน์ พันธกิจ อัตลักษณ์ เอกลักษณ์ และบทบาทหน้าที่ ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
<meta name="author" content="ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์">
@endsection


@section('frontend_style')

@endsection

@section('frontend_content')
<!-- start banner Area -->
<section class="banner-area relative" id="home">	
	<div class="overlay overlay-bg"></div>
	<div class="container">				
		<div class="row d-flex align-items-center justify-content-center">
			<div class="about-content col-lg-12">
				<h1 class="text-white my-font">
					เกี่ยวกับเรา				
				</h1>	
				<p class="text-white link-nav"><a href="{{asset('')}}">หน้าหลัก </a>  
					<span class="lnr lnr-arrow-right"></span><a href="javascript:void(0)">เกี่ยวกับเรา </a>
				</p>
			</div>	
		</div>
	</div>
</section>
<!-- End banner Area -->

<p><br></p>
<section class="info-area pb-120">
	<div class="container-fluid">
		<div class="row align-items-center">
			<div class="col-lg-6 no-padding info-area-left">
				<img class="img-fluid" src="{{url('template/frontend/img/kalasin.jpg')}}" alt="">
			</div>
			<div class="col-lg-6 info-area-right" style="font-family: 'Mitr', sans-serif;">
				<h1 style="font-family: 'Mitr', sans-serif;">ศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์</h1>
				<p> ศูนย์การศึกษาพิเศษ  ประจังหวัดกาฬสินธุ์  สังกัดสำนักบริหารงานการศึกษาพิเศษ  สำนักงานคณะกรรมการการศึกษาขั้นพื้นฐาน   กระทรวงศึกษาธิการ  ได้รับอนุมัติให้จัดตั้งเมื่อวันที่  31 กรกฎาคม  พ.ศ.  2543 ศูนย์การศึกษาพิเศษก่อตั้งครั้งแรกอาศัยตั้งสำนักงาน ณ โรงเรียนศึกษาพิเศษกาฬสินธุ์ ปัจจุบันเปลี่ยนเป็น โรงเรียนกาฬสินธุ์ปัญญานุกูล และได้ย้ายสำนักงานอาคารศูนย์การศึกษาพิเศษ  ประจำจังหวัดกาฬสินธุ์  มาตั้งอยู่เลขที่  400  ถนนถีนานนท์  หมู่ที่  1  ตำบลยางตลาด  อำเภอยางตลาด จังหวัดกาฬสินธุ์  มีพื้นที่ จำนวน  7 ไร่      3 งาน  80 ตารางวา  ศูนย์การศึกษาพิเศษ  ประจำจังหวัดกาฬสินธุ์  เป็นสถานศึกษาที่จัดการศึกษาเพื่อเด็กพิการในลักษณะศูนย์บริการช่วยเหลือระยะแรกเริ่ม  ฟื้นฟูสมรรถภาพ  และเตรียมความพร้อมเพื่อส่งต่อเด็กพิการเข้าเรียนร่วม กับนักเรียนในโรงเรียนปกติหรือโรงเรียนเฉพาะความพิการ  ทุกประเภทในจังหวัดกาฬสินธุ์</p>
			</div>
		</div>
	</div>
</section>


<section class="course-mission-area pb-120">
	<div class="container">
		<div class="row">
			<div class="col-md-6 accordion-left">

			<dl class="accordion">
			<dt>
			<a href="">วิสัยทัศน์</a>
			</dt>
			<dd>
			“มุ่งมั่นพัฒนาศูนย์การศึกษาพิเศษ ประจำจังหวัดกาฬสินธุ์ เป็นสถานศึกษาที่มีความเข้มแข็ง ทันสมัย เป็นที่ยอมรับของสังคมและชุมชน โดยมุ่งพัฒนาศักยภาพคนพิการให้ได้ใช้ศักยภาพของตนพร้อมก้าวสู่สังคมของคนปกติ และสามารถดำรงชีวิตได้อย่างมีความสุข”
			</dd>
			<dt>
			<a href="">พันธกิจ</a>
			</dt>
			 <dd>
			ส่งเสริม สนับสนุนและพัฒนาการจัดการศึกษาของสถานศึกษาที่จัดการศึกษาสำหรับคนพิการ และหน่วยงานที่เกี่ยวข้องให้สามารถจัดการศึกษาได้อย่างทั่วถึง และมีคุณภาพ ปรับปรุง พัฒนาระบบการบริการจัดการศึกษาพิเศษภายใต้สภาพแวดล้อมที่ปราศจากอุปสรรค พร้อมทั้งขับเคลื่อนสู่การปฏิบัติอย่างมีประสิทธิภาพ ส่งเสริมการสร้างองค์ความรู้ใหม่ เพื่อพัฒนาการจัดการศึกษาและส่งเสริมทักษะด้านอาชีพ โดยวิจัย พัฒนาเทคโนโลยี เพื่อสนับสนุนให้คนพิการประกอบอาชีพพึ่งพาตนเองได้ มีคุณธรรม และอยู่ในสังคมได้อย่างมีความสุข
			</dd>
			<dt>
			<a href="">อัตลักษณ์</a>
			</dt>
			<dd>
			นักเรียนศูนย์การศึกษาพิเศษประจำจังหวัดกาฬสินธุ์ มีความสุข สนุก ร่งเริง

			</dd>
			<dt>
			<a href="">เอกลักษณ์</a>
			</dt>
			<dd>
			 การจัดการสิ่งแวดล้อมและพัฒนารูปแบบการให้บริการช่วยเหลือระยะแรกเริ่ม การจัดสื่ออุปกรณ์ที่ครอบคลุมและเอื้อต่อการพัฒนาศักยภาพเด็กพิการ
			</dd>
			<dt>
			<a href="">บทบาทหน้าที่</a>
			</dt>
			<dd>
			<ul class="unordered-list">
				<li>
					จัดและส่งเสริม สนับสนุนการศึกษาในลักษณะศูนย์บริการให้ความช่วยเหลือระยะแรกเริ่ม (Early Intervention : EI) และเตรียมความพร้อมของคนพิการเพื่อเข้าศูนย์พัฒนาเด็กเล็กโรงเรียนอนุบาล โรงเรียนเรียนร่วม โรงเรียนเฉพาะความพิการ  ศูนย์การเรียนเฉพาะความพิการและหน่วยงานที่เกี่ยวข้อง เป็นต้น
				</li>
				<li>
					พัฒนาและฝึกอบรมผู้ดูแลคนพิการ บุคลากรที่จัดการศึกษาสำหรับคนพิการ
				</li>
				<li>
					จัดระบบบริการและส่งเสริม สนับสนุนการจัดทำแผนการจัดการศึกษาเฉพาะบุคคล (Individualized Education Program : IEP) สิ่งอำนวยความสะดวก สื่อ บริการ และความช่วยเหลืออื่นใดทางการศึกษาสำหรับคนพิการ
				</li>
				<li>จัดระบบบริการช่วงเชื่อมต่อสำหรับคนพิการ (Transitional Services)</li>
				<li></li>
				<li>ให้บริการฟื้นฟูสมรรถภาพคนพิการโดยครอบครัวและชุมชนด้วยกระบวนทางการศึกษา</li>
				<li>เป็นศูนย์ข้อมูล รวมทั้งจัดระบบสารสนเทศด้านการศึกษาสำหรับคนพิการในจังหวัด</li>
				<li>จัดระบบสนับสนุนการเรียนร่วมและประสานงานการจัดการศึกษาสำหรับคนพิการในจังหวัด</li>
				<li>ภาระหน้าที่อื่นตามที่กฎหมายกำหนด</li>
			</ul>
			</dd>
			</dl>

			</div>
			<div class="col-md-6 video-right justify-content-center align-items-center d-flex relative">
				<div class="overlay overlay-bg"></div>
			<a class="play-btn" href="https://www.youtube.com/watch?v=ARA0AxrnHdM"><img class="img-fluid mx-auto" src="{{url('template/frontend/img/play.png')}}" alt=""></a>
			</div>
		</div>
	</div>
</section>
			
					
					

			
						
			
@endsection

@section('frontend_content')

@endsection