@extends('layouts.admin_master')

@section('admin_title')
หน้าหลัก
@endsection

@section('admin_style')

@endsection

@section('admin_content_header')
	<h1>
        หน้าหลัก
        <small>Optional description</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">Here</li>
    </ol>
@endsection

@section('admin_content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">ข้อมูลผู้ดูแลระบบ</h3>
			</div>
			<div class="box-body">
			</div>
		</div>
	</div>
</div>
@endsection

@section('admin_script')

@endsection