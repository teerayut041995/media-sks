@extends('layouts.admin_master')

@section('admin_title')
กิจกรรม
@endsection

@section('admin_style')

@endsection

@section('admin_content_header')
	<h1>
        กิจกรรม
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">กิจกรรม</li>
    </ol>
@endsection

@section('admin_content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">กิจกรรมทั้งหมด</h3>
				<div class="box-tools pull-right" data-toggle="tooltip" title="Status">
	                <div class="btn-group" data-toggle="btn-toggle">
	                  <a href="{{url('administrator/event/create')}}" class="btn btn-primary btn-sm">เพิ่มกิจกรรม</a>
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
					<table id="data-event-all" class="table table-bordered" >
						<thead>
							<tr>
								<th>ชื่อกิจกรรม</th>
								<th>วันที่จัดกิจกรรม</th>
								<th>สถานที่จัดกิจกรรม</th>
								<th>สถานะ</th>
								<th>จัดการ</th>
							</tr>
						</thead>
						<tbody>
						@if(count($events) > 0)
							@foreach($events as $event)
							<?php
							if ($event->publishing_status == '0') {
								$show_status = '
								<i class="fa fa-circle-o text-red"></i> <span>ไม่เผยแพร่</span><br>
								<a href="'.url("administrator/event/active/$event->id").'" class="btn  btn-app btn-xs">
					                <i class="fa fa-play"></i> เปิดกการเผยแพร่
					              </a>
								';
							} else {
								$show_status = '
								<i class="fa fa-circle-o text-aqua"></i> <span>กำลังเผยแพร่</span><br>
								<a href="'.url("administrator/event/unactive/$event->id").'" class="btn  btn-app btn-xs">
					                <i class="fa fa-pause"></i> ปิดการเผยแพร่
					              </a>
								';
							}
							?>
							<tr>
								<td>{{$event->event_name}}</td>
								<td>{{createDateThai($event->event_date)}}</td>
								<td>{{$event->event_location}}</td>
								<td>{!!$show_status!!}</td>
								<td>
									<a href="{{action('EnentController@show' , $event->id)}}" class="btn btn-info btn-xs btn-block">ดูรายละเอียด</a>
									<a href="{{action('EnentController@edit' , $event->id)}}" class="btn btn-warning btn-xs btn-block">แก้ไข</a><p></p>
									<form method="post" class="delete_form" action="{{action('EnentController@destroy',$event->id)}}">
										{{csrf_field()}}
										<input type="hidden" name="_method" value="DELETE">
										<button type="submit" class="btn btn-danger btn-xs btn-block">ลบ</button>
									</form>	
								</td>
							</tr>
							@endforeach
						@else
							<tr>
								<td colspan="6">ไม่มีข้อมูล</td>
							</tr>
						@endif
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
$(document).ready(function(){
	$('.delete_form').on('submit' , function(e){
		if (confirm("คุณต้องการลบบทความนี้หรือไม่?")) {
			return true;
		} else {
			return false;
		}
	});
	$('#data-event-all').DataTable({
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