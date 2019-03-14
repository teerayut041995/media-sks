@extends('layouts.admin_master')

@section('admin_title')
เพิ่มประเภทบทความ
@endsection

@section('admin_style')

@endsection

@section('admin_content_header')
	<h1>
        เพิ่มประเภทบทความ
        <small>Optional description</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> เพิ่มประเภทบทความ</a></li>
        <li class="active">Here</li>
    </ol>
@endsection

@section('admin_content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">เพิ่มประเภทบทความ</h3>
			</div>
			<div class="box-body">
				<form action="{{url('administrator/category')}}" method="POST">
					{{ csrf_field() }}
					<div class="form-group col-lg-7 col-md-7">
	                  <label>ชื่อประเภทบทความ</label>
	                  <input type="text" class="form-control" id="category_name" name="category_name">
	                  	@if($errors->first('category_name'))
				          <small class="text-danger">
				          {{ $errors->first('category_name') }}
				          </small>
				        @endif		
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
	                  <label>ลำดับการจัดเรียง</label>
	                  <input type="number" class="form-control" id="category_ranking" name="category_ranking" value="0">
	                  @if($errors->first('category_ranking'))
				          <small class="text-danger">
				          {{ $errors->first('category_ranking') }}
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