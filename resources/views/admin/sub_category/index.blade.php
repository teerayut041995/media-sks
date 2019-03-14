@extends('layouts.admin_master')

@section('admin_title')
ประเภทบทความ
@endsection

@section('admin_style')

@endsection

@section('admin_content_header')
	<h1>
        ประเภทบทความย่อย
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">ประเภทบทความย่อย</li>
    </ol>
@endsection

@section('admin_content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">ประเภทบทความย่อย</h3>

				<div class="box-tools pull-right" data-toggle="tooltip" title="Status">
	                <div class="btn-group" data-toggle="btn-toggle">
	                  <a href="{{url('administrator/sub-category/create')}}" class="btn btn-primary btn-sm">เพิ่มประเภทบทความย่อย</a>
	                </div>
	             </div>

			</div>
			<div class="box-body">
				<div class="table-responsive">
					@if ($message = Session::get('success'))
				     <div class="alert alert-info alert-block">
				      <button type="button" class="close" data-dismiss="alert">×</button>
				      <strong>{{ $message }}</strong>
				     </div>
				    @endif
					<table class="table table-bordered">
						<thead>
							<tr>
								<td>ประเถทบทความย่อย</td>
								<td>ประเถทบทความหลัก</td>
								<td>ลำดับการจัดเรียง</td>
								<td>สถานะ</td>
								<td>แก้ไข</td>
								<td>ลบ</td>
							</tr>
						</thead>
						<tbody>
						@foreach($sub_categories as $category)
						<?php
						if ($category->sub_category_status == '0') {
							$show_status = '
							<i class="fa fa-circle-o text-red"></i> <span>ไม่เผยแพร่</span><br>
							<a href="'.url("administrator/sub-category/active/$category->id").'" class="btn  btn-app btn-xs">
				                <i class="fa fa-play"></i> เปิดกการเผยแพร่
				              </a>
							';
						} else {
							$show_status = '
							<i class="fa fa-circle-o text-aqua"></i> <span>กำลังเผยแพร่</span><br>
							<a href="'.url("administrator/sub-category/unactive/$category->id").'" class="btn  btn-app btn-xs">
				                <i class="fa fa-pause"></i> ปิดการเผยแพร่
				              </a>
							';
						}
						?>
							<tr>
								<td>{{$category->sub_category_name}}</td>
								<td>{{$category->category_name}}</td>
								<td>{{$category->sub_category_ranking}}</td>
								<td>
									{!!$show_status!!}</td>
								<td>
									<a href="{{action('SubCategoryController@edit' , $category->id)}}" class="btn btn-warning">แก้ไข</a>
								</td>
								<td>
									<form method="post" class="delete_form" action="{{action('SubCategoryController@destroy',$category->id)}}">
										{{csrf_field()}}
										<input type="hidden" name="_method" value="DELETE">
										<button type="submit" class="btn btn-danger">ลบ</button>
									</form>
									
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('admin_script')
<script>
$(document).ready(function() {
	$('.delete_form').on('submit' , function(e){
		if (confirm("คุณต้องการลบประเภทบทความนี้หรือไม่?")) {
			return true;
		} else {
			return false;
		}
	});
});
</script>
@endsection