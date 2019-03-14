@extends('layouts.admin_master')

@section('admin_title')
แก้ไขบทความ
@endsection

@section('admin_style')
<!-- summernotes CSS -->
<link href="{{asset('template/plugins/summernote/dist/summernote.css')}}" rel="stylesheet" />
@endsection

@section('admin_content_header')
	<h1>
        แก้ไขบทความย่อย
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> แก้ไขบทความย่อย</a></li>
        <li class="active">Here</li>
    </ol>
@endsection

@section('admin_content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">แก้ไขบทความย่อย</h3>
			</div>
			@if(count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
			@foreach($errors->all() as $error)
				<li>{{$error}}</li>
			@endforeach
			</ul>
		</div>
		@endif
			<div class="box-body">
				<form action="{{action('PostController@update' , $id)}}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
					{{method_field('PATCH')}}
					<div class="form-group col-lg-7 col-md-7">
	                  <label>ชื่อเรื่อง</label>
	                  <input type="text" class="form-control" id="post_title" name="post_title" value="{{$post->post_title}}">
	                  	@if($errors->first('post_title'))
				          <small class="text-danger">
				          {{ $errors->first('post_title') }}
				          </small>
				        @endif		
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
	                  <label>รูปภาพ</label>
	                  <input type="hidden" name="old_post_image" value="{{$post->post_image}}" required>
	                  <?php
	                  if ($post->post_image != '') {
	                  	$image = asset("images/image_post/$post->post_image");
	                  } else {
	                  	$image = asset("images/image_default/no-post-image.jpg");
	                  }
	                  ?>
	                  <img src="{{$image}}" class="img img-thumbnail">
	                  <label>อัพโหลดรูปภาพใหม่</label>
	                  <input type="file" class="form-control" id="post_image_update" name="post_image_update">
	                  	@if($errors->first('post_image_update'))
				          <small class="text-danger">
				          {{ $errors->first('post_image_update') }}
				          </small>
				        @endif		
	                </div>
					<div class="form-group col-lg-6 col-md-6">
	                  <label>เลือกประเภทบทความหลัก</label>
	                  <select class="form-control" name="category_id" id="category_id">
	                  	<option value="">เลือกประเภทบทความหลัก</option>
	                  @foreach($categories as $category)
	                  	<option value="{{$category->id}}"
	                  	@if($category->id == $post->category_id)
	                  	selected
	                  	@endif
	                  	>{{$category->category_name}}</option>
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
	                  	<textarea class="form-control" rows="4" name="post_detail" required>{{$post->post_detail}}</textarea>
	                  @if($errors->first('post_detail'))
				          <small class="text-danger">
				          {{ $errors->first('post_detail') }}
				          </small>
				        @endif
	                </div>
	                <div class="form-group col-lg-8 col-md-8">
	                	<label>สถานะการเผยแพร่</label>
	                  	<select class="form-control" name="post_status">
	                  		<option value="0"
	                  		@if($post->post_status == 0)
	                  		selected
	                  		@endif
	                  		>ไม่เผยแพร่</option>
	                  		<option value="1"
	                  		@if($post->post_status == 1)
	                  		selected
	                  		@endif
	                  		>เผยแพร่</option>
	                  	</select>
	                </div>

	                <div class="form-group col-lg-12 col-md-12">
	                	<label>เนื้อหาบทความ</label>
	                  	<textarea name="summernoteInput" id="summernoteInput" class="summernote">{!!$post->post_content!!}</textarea>
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
	defaultCategory();
	function defaultCategory(){
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
	}
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