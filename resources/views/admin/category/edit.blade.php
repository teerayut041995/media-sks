@extends('layouts.admin_master')

@section('admin_title')
แก้ไขประเภทบทความ
@endsection

@section('admin_style')

@endsection

@section('admin_content_header')
	<h1>
        แก้ไขประเภทบทความ
        <small>Optional description</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> แก้ไขประเภทบทความ</a></li>
        <li class="active">Here</li>
    </ol>
@endsection

@section('admin_content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">แก้ไขประเภทบทความ</h3>
			</div>
			<div class="box-body">
				<form action="{{action('CategoryController@update' , $id)}}" method="POST">
					{{ csrf_field() }}
					{{method_field('PATCH')}}
					<div class="form-group col-lg-7 col-md-7">
	                  <label>ชื่อประเภทบทความ</label>
	                  <input type="text" class="form-control" id="category_name" name="category_name" value="{{$category->category_name}}">
	                  	@if($errors->first('category_name'))
				          <small class="text-danger">
				          {{ $errors->first('category_name') }}
				          </small>
				        @endif		
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
	                  <label>ลำดับการจัดเรียง</label>
	                  <input type="number" class="form-control" id="category_ranking" name="category_ranking" value="{{$category->category_ranking}}">
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