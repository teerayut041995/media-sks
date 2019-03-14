@extends('layouts.admin_master')

@section('admin_title')
ข้อมูลผู้ดูแลระบบ
@endsection

@section('admin_style')

@endsection

@section('admin_content_header')
	<h1>
        ข้อมูลผู้ดูแลระบบ
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">ข้อมูลผู้ดูแลระบบ</li>
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
								<td>ชื่อ</td>
								<td>อีเมล</td>
								<td>ตำแหน่ง</td>
								<td>แก้ไข</td>
								<td>ลบ</td>
							</tr>
						</thead>
						<tbody>
						@foreach($users as $user)
							<tr>
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>{{$user->position}}</td>
								<td>
									<a href="{{action('UserAdminController@edit' , $user->id)}}" class="btn btn-warning">แก้ไข</a>
								</td>
								<td>
									<form method="post" class="delete_form" action="{{action('UserAdminController@destroy',$user->id)}}">
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
		if (confirm("คุณต้องการลบข้อมูลผู้ดูแลระบบนี้หรือไม่?")) {
			return true;
		} else {
			return false;
		}
	});
});
</script>
@endsection