@extends('layouts.admin_master')

@section('admin_title')
เพิ่มข้อมูลผู้ดูแลระบบ
@endsection

@section('admin_style')

@endsection

@section('admin_content_header')
	<h1>
        เพิ่มข้อมูลผู้ดูแลระบบ
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">เพิ่มข้อมูลผู้ดูแลระบบ</li>
    </ol>
@endsection

@section('admin_content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">เพิ่มข้อมูลผู้ดูแลระบบ</h3>
			</div>
			<div class="box-body">
				<form action="{{url('administrator/user')}}" method="POST">
					{{ csrf_field() }}
					<div class="form-group col-lg-7 col-md-7">
	                  <label>ชื่อ - นามสกุล</label>
	                  <input type="text" class="form-control" id="name" name="name">
	                  	@if($errors->first('name'))
				          <small class="text-danger">
				          {{ $errors->first('name') }}
				          </small>
				        @endif		
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
	                  <label>อีเมล <small>(ใช้เข้าสู่ระบบ)</small></label>
	                  <input type="text" class="form-control" id="email" name="email">
	                  @if($errors->first('email'))
				          <small class="text-danger">
				          {{ $errors->first('email') }}
				          </small>
				        @endif
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
	                  <label>รหัสผ่าน</label>
	                  <input type="password" class="form-control" id="password" name="password">
	                  	@if($errors->first('password'))
				          <small class="text-danger">
				          {{ $errors->first('password') }}
				          </small>
				        @endif
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
	                  <label>ตำแหน่ง</label>
	                  <input type="text" class="form-control" id="position" name="position">
	                  @if($errors->first('position'))
			          <small class="text-danger">
			          {{ $errors->first('position') }}
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

@endsection