@extends('layouts.admin_master')

@section('admin_title')
เพิ่มกิจกรรม
@endsection

@section('admin_style')
<link rel="stylesheet" href="{{asset('template/plugins/dropify/dist/css/dropify.min.css')}}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{('template/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
<!-- Dropzone css -->
<link href="{{asset('template/plugins/dropzone-master/dist/dropzone.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('admin_content_header')
	<h1>
        เพิ่มกิจกรรม
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">เพิ่มกิจกรรม</li>
    </ol>
@endsection

@section('admin_content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">เพิ่มกิจกรรม</h3>
				<div class="box-tools pull-right" data-toggle="tooltip" title="Status">
	                <div class="btn-group" data-toggle="btn-toggle">
	                  <a href="{{url('administrator/event')}}" class="btn btn-primary btn-sm">กิจกรรมทั้งหมด</a>
	                </div>
	            </div>
			</div>
			<div class="box-body">

				<form action="{{url('administrator/event')}}" method="POST" enctype="multipart/form-data" >
					{{ csrf_field() }}
					<div class="form-group col-lg-7 col-md-7">
	                  <label>ชื่อกิจกรรม</label>
	                  <input type="text" class="form-control" id="event_name" name="event_name">
	                  	@if($errors->first('event_name'))
				          <small class="text-danger">
				          {{ $errors->first('event_name') }}
				          </small>
				        @endif		
	                </div>
	                <div class="form-group col-lg-7 col-md-7" >
	                  	<label>รูปภาพหลัก</label>
	                  	<div style="width: 50%;">
	                  		<input type="file" id="input-file-now" class="dropify" name="event_image" accept="image/*">
	                  	</div>
	                 	@if($errors->first('event_image'))
				          <small class="text-danger">
				          {{ $errors->first('event_image') }}
				          </small>
				        @endif		
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
		                <label>วันที่จัดกิจกรรม</label>
		                <div style="width: 50%;">
		                  <input type="text" class="form-control pull-right" id="datepicker" name="event_date" autocomplete="off">
		                </div>
	                  	@if($errors->first('event_date'))
				          <small class="text-danger">
				          {{ $errors->first('event_date') }}
				          </small>
				        @endif		
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
	                  <label>สถานที่จัดกิจกรรม</label>
	                  <input type="text" class="form-control" id="event_location" name="event_location">
	                  	@if($errors->first('event_location'))
				          <small class="text-danger">
				          {{ $errors->first('event_location') }}
				          </small>
				        @endif		
	                </div>
	                <div class="form-group col-lg-7 col-md-7">
	                  	<label>คำอธิบายประกอบกิจกรรม</label>
	                  	<textarea name="event_description" class="form-control" rows="6"></textarea>
	                  	@if($errors->first('event_description'))
				          <small class="text-danger">
				          {{ $errors->first('event_description') }}
				          </small>
				        @endif		
	                </div>
		            <div class="form-group col-lg-8 col-md-8" >
	                	<div class="row">
	                		<div class="col-md-3">สถานะการเผยแพร่</div>
	                		<div class="col-md-3">
	                			<input type="radio" name="publishing_status" value="0" class="minimal" checked>
				                  ส่วนตัว
	                		</div>
	                		<div class="col-md-3">
	                			<input type="radio" name="publishing_status" value="1" class="minimal">
				                  สาธารณะ
	                		</div>
	                	</div>
	                	@if($errors->first('publishing_status'))
				          <small class="text-danger">
				          {{ $errors->first('publishing_status') }}
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
<!-- jQuery file upload -->
<script src="{{asset('template/plugins/dropify/dist/js/dropify.min.js')}}"></script>
<!-- bootstrap datepicker -->
<script src="{{asset('template/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Dropzone Plugin JavaScript -->
<script src="{{asset('template/plugins/dropzone-master/dist/dropzone.js')}}"></script>

<script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();
        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });
        // Used events
        var drEvent = $('#input-file-events').dropify();
        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });
        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });
        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });
        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });

    //Date picker
    $('#datepicker').datepicker({
      	autoclose: true,
      	changeMonth: true,
        changeYear: true,
        //  dateFormat: 'mm/dd/yy', // Hide this line
        minDate: 0
    });
</script>
@endsection