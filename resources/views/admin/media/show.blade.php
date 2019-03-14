@extends('layouts.admin_master')

@section('admin_title')
Show Video Live
@endsection

@section('admin_style')

@endsection

@section('admin_content_header')
	<h1>
        Show Video Live
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">Show Video Live</li>
    </ol>
@endsection

@section('admin_content')
<div class="row">
	<div class="col-md-12">
		
		<!-- Box Comment -->
		        <div class="box box-widget">
		            <div class="box-header with-border">
		              <div class="user">
		                <span class="username"><a href="#">{{$media->project_name}}</a></span><br>
		                <span class="description">{{Carbon\Carbon::parse($media->created_at)->diffForHumans()}}</span>
		              </div>
		              <div class="box-tools">
		                <a href="{{url('administrator/media-embed/create')}}" class="btn btn-primary btn-sm">ดู Video Live ทั้งหมด</a>
		              </div>
		            </div>
		            <div class="box-body">
		              {!!$media->embed_video!!}

		              <p>{{$media->topics}}</p>

		            @if($media->live_status == '0')
		              <a href="<?php echo url("administrator/media-embed/start/$media->id"); ?>" class="btn btn-default btn-xs"><i class="fa fa-play"></i> ยังไม่เริ่ม</a>
		    		@endif
		    		@if($media->live_status == '1')
		              <a href="<?php echo url("administrator/media-embed/stop/$media->id"); ?>" class="btn btn-default btn-xs"><i class="fa fa-pause"></i> กำลังถ่ายทอดสด</a>
		    		@endif
		    		@if($media->live_status == '2')
		              <a href="<?php echo url("administrator/media-embed/start/$media->id"); ?>" class="btn btn-default btn-xs"><i class="fa fa-play-circle"></i> สิ้นสุดการถ่ายทอดสดแล้ว</a>
		    		@endif

					@if($media->publishing_status == '0')
					<a href="<?php echo url("administrator/media-embed/active/$media->id"); ?>" class="btn btn-default btn-xs"><i class="fa fa-lock"></i> ส่วนตัว</a>
					@else
					<a href="<?php echo url("administrator/media-embed/unactive/$media->id"); ?>" class="btn btn-default btn-xs"><i class="fa fa-globe"></i> สาธารณะ</a>
					@endif
              		  
		              <span class="pull-right text-muted">{{$views}} view</span>
		            </div>
		            <div class="box-footer">
		              <div class="box-comment">    
		                <div class="comment-text">
		                  {{$media->description}}
		                </div>
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