@extends('layouts.admin_master')

@section('admin_title')
เพิ่มประเภทบทความย่อย
@endsection

@section('admin_style')

@endsection

@section('admin_content_header')
	<h1>
        เพิ่มประเภทบทความย่อย
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> เพิ่มประเภทบทความย่อย</a></li>
        <li class="active">Here</li>
    </ol>
@endsection

@section('admin_content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">เพิ่มประเภทบทความย่อย</h3>
			</div>
			<div class="box-body">
				<form action="{{url('administrator/sub-category')}}" method="POST">
					{{ csrf_field() }}
					<div class="form-group col-lg-7 col-md-7">
	                  <label>เลือกประเภทบทความหลัก</label>
	                  <select class="form-control" name="category_id">
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
					<div class="form-group col-lg-7 col-md-7">
	                  <label>ชื่อประเภทบทความย่อย</label>
	                  <input type="text" class="form-control" id="sub_category_name" name="sub_category_name">
	                  	@if($errors->first('sub_category_name'))
				          <small class="text-danger">
				          {{ $errors->first('sub_category_name') }}
				          </small>
				        @endif		
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
	                  <label>ลำดับการจัดเรียง</label>
	                  <input type="number" class="form-control" id="sub_category_ranking" name="sub_category_ranking" value="0" style="width: 20%;">
	                  @if($errors->first('sub_category_ranking'))
				          <small class="text-danger">
				          {{ $errors->first('sub_category_ranking') }}
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