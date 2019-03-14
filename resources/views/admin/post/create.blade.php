@extends('layouts.admin_master')

@section('admin_title')
เพิ่มบทความ
@endsection

@section('admin_style')
<!-- summernotes CSS -->
<link href="{{asset('template/plugins/summernote/dist/summernote.css')}}" rel="stylesheet" />
@endsection

@section('admin_content_header')
	<h1>
        เพิ่มบทความ
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> เพิ่มบทความ</a></li>
        <li class="active">Here</li>
    </ol>
@endsection

@section('admin_content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">เพิ่มบทความ</h3>
			</div>
			<div class="box-body">
				<form action="{{url('administrator/post')}}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group col-lg-7 col-md-7">
	                  <label>ชื่อเรื่อง</label>
	                  <input type="text" class="form-control" id="post_title" name="post_title" required>
	                  	@if($errors->first('post_title'))
				          <small class="text-danger">
				          {{ $errors->first('post_title') }}
				          </small>
				        @endif		
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
	                  <label>รูปภาพ</label>
	                  <input type="file" class="form-control" id="post_image" name="post_image" required>
	                  	@if($errors->first('post_image'))
				          <small class="text-danger">
				          {{ $errors->first('post_image') }}
				          </small>
				        @endif		
	                </div>
					<div class="form-group col-lg-6 col-md-6">
	                  <label>เลือกประเภทบทความหลัก</label>
	                  <select class="form-control" name="category_id" id="category_id" required>
	                  	<option value="">เลือกประเภทบทความหลัก</option>
	                  @foreach($categories as $category)
	                  	<option value="{{$category->id}}">{{$category->category_name}}</option>
	                  @endforeach
	                  </select>
	                  	@if($errors->first('category_id'))
				          <small class="text-danger">
				          {{ $errors->first('category_id') }}
				          </small>
				        @endif		
	                </div>
					<div class="form-group col-lg-6 col-md-6">
	                  <label>เลือกประเภทบทความย่อย</label>
	                  <select class="form-control" id="sub_category_id" name="sub_category_id">
	                  	<option value="0">เลือกประเภทบทความย่อย</option>
	                  	<!-- <div></div> -->
	                  </select>
	                  
	                  	@if($errors->first('sub_category_id'))
				          <small class="text-danger">
				          {{ $errors->first('sub_category_id') }}
				          </small>
				        @endif		
	                </div>
	                <div class="form-group col-lg-4 col-md-4">
	                	<label>เนื้อหาย่อ</label>
	                  	<textarea class="form-control" name="post_detail" required></textarea>
	                  @if($errors->first('post_detail'))
				          <small class="text-danger">
				          {{ $errors->first('post_detail') }}
				          </small>
				        @endif
	                </div>
	                <div class="form-group col-lg-8 col-md-8">
	                	<label>สถานะการเผยแพร่</label>
	                  	<select class="form-control" name="post_status">
	                  		<option value="0">ไม่เผยแพร่</option>
	                  		<option value="1">เผยแพร่</option>
	                  	</select>
	                </div>

	                <div class="form-group col-lg-12 col-md-12">
	                	<label>เนื้อหาบทความ</label>
	                  	<textarea name="summernoteInput" id="summernoteInput" class="summernote"></textarea>
	                  	@if($errors->first('summernoteInput'))
				          <small class="text-danger">
				          {{ $errors->first('summernoteInput') }}
				          </small>
				        @endif  
	                </div>
	                
	                
	           		<div class="form-group col-lg-7 col-md-7">
	                  <button type="submit" class="btn btn-primary">บันทึก</button>
	                  <button type="reset" class="btn btn-danger">ล้างฟอร์ม</button>
	                </div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('admin_script')
<script src="{{asset('template/plugins/summernote/dist/summernote.min.js')}}"></script>
<!-- <script src="{{asset('template/plugins/summernote/plugin/summernote-ext-video.js')}}"></script> -->
<script>
    jQuery(document).ready(function() {
        $('.summernote').summernote({
            height: 350, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
            
        });
        $('.inline-editor').summernote({
            airMode: true
        });
    });
    window.edit = function() {
        $(".click2edit").summernote()
    }, window.save = function() {
        $(".click2edit").destroy()
    }
</script>
<script type="text/javascript">
$(document).ready(function(){
	$("#category_id").change(function(){
		var category_id = $("#category_id").val();
		$.ajax({
            url : "{{ URL::to('administrator/post/load/sub-category')}}",
            method : 'POST',
            data : {category_id:category_id},
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(data){
            	//alert(data);
                $("#sub_category_id").html(data);
            }
        });
	});
});
</script>
@endsection