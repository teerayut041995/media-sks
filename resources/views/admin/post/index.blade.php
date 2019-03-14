@extends('layouts.admin_master')

@section('admin_title')
จัดการบทความ
@endsection

@section('admin_style')

@endsection

@section('admin_content_header')
	<h1>
        จัดการบทความ
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">จัดการบทความ</li>
    </ol>
@endsection

@section('admin_content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">จัดการบทความ</h3>

				<div class="box-tools pull-right" data-toggle="tooltip" title="Status">
	                <div class="btn-group" data-toggle="btn-toggle">
	                  <a href="{{url('administrator/post/create')}}" class="btn btn-primary btn-sm">เพิ่มบทความ</a>
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

					<table id="data-posts-all" class="table table-bordered" >
						<thead>
							<tr>
								<th>บทความ</th>
								<th>ประเถทบทความหลัก</th>
								<th>ประเถทบทความย่อย</th>
								<th>สถานะ</th>
								<th>แก้ไข</th>
								<th>ลบ</th>
							</tr>
						</thead>
						<tbody>
						@foreach($posts as $post)
						<?php
						if ($post->post_status == '0') {
							$show_status = '
							<i class="fa fa-circle-o text-red"></i> <span>ไม่เผยแพร่</span><br>
							<a href="'.url("administrator/post/active/$post->id").'" class="btn  btn-app btn-xs">
				                <i class="fa fa-play"></i> เปิดกการเผยแพร่
				              </a>
							';
						} else {
							$show_status = '
							<i class="fa fa-circle-o text-aqua"></i> <span>กำลังเผยแพร่</span><br>
							<a href="'.url("administrator/post/unactive/$post->id").'" class="btn  btn-app btn-xs">
				                <i class="fa fa-pause"></i> ปิดการเผยแพร่
				              </a>
							';
						}
						?>
							<tr>
								<td>{{$post->post_title}}</td>
								<td>{{$post->category_name}}</td>
								<td>{{$post->sub_category_name}}</td>
								<td>
									{!!$show_status!!}</td>
								<td>
									<a href="{{action('PostController@edit' , $post->id)}}" class="btn btn-warning">แก้ไข</a>
								</td>
								<td>
									<form method="post" class="delete_form" action="{{action('PostController@destroy',$post->id)}}">
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
		if (confirm("คุณต้องการลบบทความนี้หรือไม่?")) {
			return true;
		} else {
			return false;
		}
	});
	$('#data-posts-all').DataTable();
});
</script>

@endsection