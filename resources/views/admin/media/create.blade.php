@extends('layouts.admin_master')

@section('admin_title')
เพิ่ม Video Live
@endsection

@section('admin_style')
<!-- iCheck for checkboxes and radio inputs -->
<link rel="stylesheet" href="{{asset('template/plugins/plugins/iCheck/all.css')}}">
@endsection

@section('admin_content_header')
	<h1>
        เพิ่ม Video Live
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">เพิ่ม Video Live</li>
    </ol>
@endsection

@section('admin_content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">ข้อมูลผู้ดูแลระบบ</h3>
				<div class="box-tools pull-right" data-toggle="tooltip" title="Status">
	                <div class="btn-group" data-toggle="btn-toggle">
	                  <a href="{{url('administrator/media-embed')}}" class="btn btn-primary btn-sm">Video Live ทั้งหมด</a>
	                </div>
	             </div>
			</div>
			<div class="box-body">

				<form action="{{url('administrator/media-embed')}}" method="POST">
					{{ csrf_field() }}
					<div class="form-group col-lg-7 col-md-7">
	                  <label>ชื่อโครงการอบบรม</label>
	                  <input type="text" class="form-control" id="project_name" name="project_name">
	                  	@if($errors->first('project_name'))
				          <small class="text-danger">
				          {{ $errors->first('project_name') }}
				          </small>
				        @endif		
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
	                  <label>เรื่องที่บรรยาย</label>
	                  <input type="text" class="form-control" id="topics" name="topics">
	                  	@if($errors->first('topics'))
				          <small class="text-danger">
				          {{ $errors->first('topics') }}
				          </small>
				        @endif		
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
	                  <label>ผู้บรรยาย</label>
	                  <textarea  name="lecturer" class="form-control"></textarea>
	                  @if($errors->first('lecturer'))
				          <small class="text-danger">
				          {{ $errors->first('lecturer') }}
				          </small>
				        @endif
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
	                  <label>เพิ่มคำอธิบาย</label>
	                  <textarea name="description" class="form-control"></textarea>
	                  @if($errors->first('description'))
				          <small class="text-danger">
				          {{ $errors->first('description') }}
				          </small>
				        @endif
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
	                  <label>Embed Video</label>
	                  <textarea name="embed_video" class="form-control" rows="4"></textarea>
	                  	@if($errors->first('embed_video'))
				          <small class="text-danger">
				          {{ $errors->first('embed_video') }}
				          </small>
				       	@endif
	                </div>
	                <div class="form-group col-lg-8 col-md-8" >
	                	<div class="row">
	                		<div class="col-md-3">สถานะ</div>
	                		<div class="col-md-3">
	                			<input type="radio" name="live_status" value="0" class="minimal" checked>
				                  ยังไม่เผยแพร่
	                		</div>
	                		<div class="col-md-3">
	                			<input type="radio" name="live_status" value="1" class="minimal">
				                  กำลังเผยแพร่
	                		</div>
	                		<div class="col-md-3">
	                			<input type="radio" name="live_status" value="3" class="minimal">
				                  สิ้นสุดการเผยแพร่
	                		</div>
	                	</div>
	                	@if($errors->first('live_status'))
				          <small class="text-danger">
				          {{ $errors->first('live_status') }}
				          </small>
				       	@endif 
		            </div>
		            <div class="form-group col-lg-8 col-md-8" >
	                	<div class="row">
	                		<div class="col-md-3">สถานะการเผยแพร่</div>
	                		<div class="col-md-3">
	                			<input type="radio" name="publishing_status" value="0" class="minimal" checked>
				                  ส่วนตัว
	                		</div>
	                		<div class="col-md-3">
	                			<input type="radio" name="publishing_status" value="1" class="minimal">
				                  สาธารณะ
	                		</div>
	                	</div>
	                	@if($errors->first('publishing_status'))
				          <small class="text-danger">
				          {{ $errors->first('publishing_status') }}
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

<!-- iCheck 1.0.1 -->
<script src="{{asset('template/plugins/iCheck/icheck.min.js')}}"></script>

<script>

</script>
@endsection