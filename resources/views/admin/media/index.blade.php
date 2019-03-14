@extends('layouts.admin_master')

@section('admin_title')
Post Media
@endsection

@section('admin_style')

@endsection

@section('admin_content_header')
	<h1>
        Post Media
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">Post Media</li>
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
	                  <a href="{{url('administrator/media-embed/create')}}" class="btn btn-primary btn-sm">เพิ่ม Video Live</a>
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

					<table id="data-media-all" class="table table-bordered">
						<thead>
							<tr>
								<th style="width: 25%;">ชื่อโครงการอบบรม</th>
								<th>เรื่องที่บรรยาย</th>
								<th>ผู้บรรยาย</th>
								<th style="width: 20%;">สถานะ</th>
								<th>สถานะการเผยแพร่</th>
								<th>แก้ไข</th>
							</tr>
						</thead>
						<tbody>
						@foreach($media_all as $media)
						<?php
						if ($media->publishing_status == '0') {
							$show_publishing_status = '
							<i class="fa fa-circle-o text-red"></i> <span>ส่วนตัว</span><br>
							<a href="'.url("administrator/media-embed/active/$media->id").'" class="btn  btn-app btn-xs">
				                <i class="fa fa-play"></i> สาธารณะ
				              </a>
							';
						} else {
							$show_publishing_status = '
							<i class="fa fa-circle-o text-aqua"></i> <span>สาธารณะ</span><br>
							<a href="'.url("administrator/media-embed/unactive/$media->id").'" class="btn  btn-app btn-xs">
				                <i class="fa fa-pause"></i> ส่วนตัว
				              </a>
							';
						}
						if ($media->live_status == '0') {
							$show_live_status = '
							<i class="fa fa-circle-o text-red"></i> <span>ยังไม่เริ่ม</span><br>
							<a href="'.url("administrator/media-embed/start/$media->id").'" class="btn  btn-app btn-xs">
				                <i class="fa fa-play"></i> เริ่ม
				              </a>
							';
						} 
						
						if ($media->live_status == '1'){
							$show_live_status = '
							<i class="fa fa-circle-o text-aqua"></i> <span>กำลังถ่ายทอดสด</span><br>
							<a href="'.url("administrator/media-embed/stop/$media->id").'" class="btn  btn-info btn-app btn-xs">
				                <i class="fa fa-pause"></i> ปิด
				              </a>
							';
						} 

						if ($media->live_status == '2'){
							$show_live_status = '
							<i class="fa fa-circle-o text-red"></i> <span>สิ้นสุดการถ่ายทอดสดแล้ว</span><br>
							<a href="'.url("administrator/media-embed/start/$media->id").'" class="btn  btn-app btn-xs">
				                <i class="fa fa-play"></i> เริ่มอีกครั้ง
				            </a>
							';
						}
						?>
							<tr>
								<td>{{$media->project_name}}</td>
								<td>{{$media->topics}}</td>
								<td>{{$media->lecturer}}</td>
								<td>{!!$show_live_status!!}</td>
								<td>{!!$show_publishing_status!!}</td>
								<td>
									<a href="{{action('MediaEmbedController@show' , $media->id)}}" class="btn btn-info btn-xs btn-block">ดูรายละเอียด</a>
									<a href="{{action('MediaEmbedController@edit' , $media->id)}}" class="btn btn-warning btn-xs btn-block">แก้ไข</a><p></p>
									<form method="post" class="delete_form" action="{{action('MediaEmbedController@destroy',$media->id)}}">
										{{csrf_field()}}
										<input type="hidden" name="_method" value="DELETE">
										<button type="submit" class="btn btn-danger btn-xs btn-block">ลบ</button>
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
<script type="text/javascript">
$(function(){
	$('.delete_form').on('submit' , function(e){
		if (confirm("คุณต้องการลบบทความนี้หรือไม่?")) {
			return true;
		} else {
			return false;
		}
	});
	$('#data-media-all').DataTable({
		'paging'      : true,
	    'lengthChange': false,
	    'searching'   : false,
	    'ordering'    : false,
	    'info'        : true,
	    'autoWidth'   : false
	});
});
</script>
@endsection