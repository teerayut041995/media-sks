@extends('layouts.admin_master')

@section('admin_title')
กิจกรรม {{$event->event_name}}
@endsection

@section('admin_style')
<link rel="stylesheet" href="{{asset('template/plugins/dropify/dist/css/dropify.min.css')}}">
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
				<h3 class="box-title">{{$event->event_name}}</h3>
				<div class="box-tools pull-right" data-toggle="tooltip" title="Status">
	                <div class="btn-group" data-toggle="btn-toggle">
	                  <a href="{{url('administrator/event/create')}}" class="btn btn-primary btn-sm">เพิ่มกิจกรรม</a>
	                </div>
	            </div>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-6">
						<div class="user">
			                
			                <span class="description"></span>
			             </div>
			             <img class="img-responsive pad" src="<?php echo url("images/image_event/$event->event_image");?>" alt="Photo" style="width: 100%;height: 200px;">
					</div>
					<div class="col-md-6">
						<p>จัดกิจกรรมวันที่ : {{createDateThai($event->event_date)}}</p>
			            <p>สถานที่จัดกิจกรรม : {{$event->event_location}}</p>
			            <p>เพิ่มกิจกรรมโดย : {{$event->name}}</p>
			            <p>{{Carbon\Carbon::parse($event->created_at)->diffForHumans()}}</p>
			            รายละเอียด<br>
		                  {{$event->event_description}}
					</div>
				</div>
			</div>
			<div class="box-footer">
				<form action="<?php echo url("administrator/event/upload-image/$event->id"); ?>" method="post" id="form_upload_image" enctype="multipart/form-data">
					{{ csrf_field() }}
					{{method_field('PATCH')}}
                    <div class="form-group col-lg-7 col-md-7" >
	                  	<label>เพิ่มรูปภาพ</label>
	                  	<div style="width: 50%;">
	                  		<input type="file" id="input-file-now" class="dropify" name="image_name" accept="image/*">
	                  	</div>
	                 	@if($errors->first('event_image'))
				          <small class="text-danger">
				          {{ $errors->first('event_image') }}
				          </small>
				        @endif		
	                </div>
	                <div class="form-group col-lg-7 col-md-7" >
	                  	<button type="submit" class="btn btn-primary">บันทึกรูปภาพ</button>
	                </div>
                </form>

                <div class="row">
                	<div class="col-md-12">
                		<div class="timeline-item">
			                <div class="timeline-body">
			                	<div class="row">
			                	@if(count($images) > 0)
			                		@foreach($images as $image)
			                		<div class="col-md-3" align="center">
			                			<!-- 150x100 -->
			                			<img src="<?php echo url("images/image_event/more_image/$image->image_name");?>" alt="..." class="margin" style="width: 100%;height: 200px;">
				                		<form method="post" class="delete_form" action="<?php echo url("administrator/event/image/delete/$image->id");?>">
											{{csrf_field()}}
											<input type="hidden" name="_method" value="DELETE">
											<button type="submit" class="btn btn-danger">ลบ</button>
										</form>	
			                		</div>
			                		@endforeach
			                	@else
			                	<label>ยังไม่มีรูปภาพ</label>
			                	@endif
			                	</div>
			                  
			                  
			                </div>
		              	</div>
                	</div>
                </div>
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
    	$('.delete_form').on('submit' , function(e){
			if (confirm("คุณต้องการลบประเภทบทความนี้หรือไม่?")) {
				return true;
			} else {
				return false;
			}
		});
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

    $("#form_upload_image").submit(function(){
    	if ($("#input-file-now").val() == '') {
    		alert('กรุณาเลือกรูปภาพ');
    		return false;
    	} 
    });

</script>
@endsection