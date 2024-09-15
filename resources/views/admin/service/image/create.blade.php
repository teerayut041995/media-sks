@extends('layouts.admin_master')

@section('admin_title')
    เพิ่มรูปภาพ {{$service->service_name}}
@endsection

@section('admin_style')
    <link rel="stylesheet" type="text/css" href="{{asset('template/plugins/sweet-alert/sweetalert2.css')}}">
    {{--    <link rel="stylesheet" href="{{url('template/backend/assets/plugins/dropify/dist/css/dropify.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('template/plugins/formvalidation/formValidation.min.css')}}">
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('template/backend/assets/css/vendors/sweetalert2.css')}}">--}}
    {{--    <link rel="stylesheet" type="text/css" href="{{asset('template/backend/assets/css/vendors/select2.css')}}">--}}
    <style>
        #imagePreview {
            max-width: 100%;
            /*max-height: 400px;*/
            /*border: 1px solid #ccc;*/
            /*margin-top: 10px;*/
            margin-bottom: 10px;
        }
    </style>
@endsection

@section('admin_content_header')
    <h1>
        เพิ่มรูปภาพ {{$service->service_name}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li><a href="{{url('administrator/service')}}"><i class="fa fa-dashboard"></i> การให้บริการ</a></li>
        <li><a href='{{url("administrator/service/$service->uid/show")}}'><i class="fa fa-dashboard"></i> {{$service->service_name}}</a></li>
        <li class="active">{{$service->service_name}}</li>
    </ol>
@endsection

@section('admin_content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">เพิ่มรูปภาพ {{$service->service_name}}</h3>
                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status"></div>
                </div>
                <div class="box-body">

                    <form id="form-insert-service-image" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="col-form-label">ชื่อรูปภาพ</label>
                            <input class="form-control" name="service_image_name" type="text" required
                                   placeholder="">
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-form-label m-r-10">ประเภทรูปภาพ</label>
                            <select class="form-control" name="service_image_type" required>
                                <option value="">ระบุประเภทรูปภาพ</option>
                                @foreach(findServiceImageType() as $key => $service_type)
                                    <option value="{{$key}}">{{$service_type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-form-label">อัพโหลดไฟล์รูปภาพ<small
                                        class="text-muted">* สำหรับไฟล์ รูปภาพ ขนาดไม่เกิน 2MB
                                    เท่านั้น</small></label>
                            <input type="file" id="imageUpload" name="service_image_file_name" class="form-control"
                                   accept="image/*">
                            <small class="text-danger" id="msg_file"></small>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <img  class="profile-img" id="imagePreview">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-form-label">คำอธิบายรูปภาพ</label>
                            <textarea class="form-control" rows="5" name="service_image_description"></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-form-label">ลำดับการแสดงผล</label>
                            <input class="form-control" name="service_image_sequence"
                                   type="number"
                                   placeholder="กรอกลำดับการแสดงผล">
                        </div>


                        <div class="form-group mb-3">
                            <label class="col-form-label m-r-10">สถานะเผยแพร่</label>
                            <select class="form-control" name="service_image_status">
                                <option value="active">เผยแพร่</option>
                                <option value="inactive">ไม่เผยแพร่</option>
                            </select>
                        </div>

                        <div class="form-group mb-3" align="center">
                            <a href='{{url("/administrator/service/$service->uid/show")}}'
                               class="btn btn-danger btn-air-danger"><i class="fa fa-power-off"></i>
                                ยกเลิก</a>
                            <button type="submit" class="btn btn-primary btn-air-primary"><i
                                        class="fa fa-save"></i> บันทึก
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('admin_script')
    <script src="{{asset('template/plugins/formvalidation/formValidation.min.js')}}"></script>
    <script src="{{asset('template/plugins/formvalidation/bootstrap.min.js')}}"></script>
    <script src="{{asset('template/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script>
        const imageUpload = document.getElementById('imageUpload');
        imageUpload.addEventListener('change', function () {
            // Get the selected file
            const file = imageUpload.files[0];

            // Create a FileReader object
            const reader = new FileReader();

            // Set up the reader's onload event handler
            reader.onload = function (e) {
                // Get the image data URL
                const imageDataUrl = e.target.result;

                // Display the uploaded image
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = imageDataUrl;
            };

            // Read the selected file as Data URL
            reader.readAsDataURL(file);
        });

    </script>
    <script>

        $(document).ready(function () {

            $('#form-insert-service-image').formValidation({
                framework: 'bootstrap',
                fields: {
                    service_image_name: {
                        validators: {
                            notEmpty: {
                                message: 'กรุณากรอกชื่อรูปภาพ'
                            }
                        }
                    },
                    service_image_type: {
                        validators: {
                            notEmpty: {
                                message: 'กรุณาระบุประเภทรูปภาพ'
                            }
                        }
                    },
                    service_image_file_name: {
                        validators: {
                            notEmpty: {
                                message: 'กรุณากรอกอัพโหลดไฟล์รูปภาพ'
                            },
                            file: {
                                maxSize: 2097152, // 2 * 1024 * 1024
                                message: 'สำหรับไฟล์ รูปภาพ ขนาดไม่เกิน 2MB เท่านั้น',
                            }
                        }
                    },
                    service_image_sequence: {
                        validators: {
                            notEmpty: {
                                message: 'กรุณากรอกลำดับการแสดงผล'
                            }
                            , integer: {
                                message: 'กรอกเฉพาะตัวเลขเท่านั้น',
                            }
                        }
                    }
                }
            })
                .on('success.form.fv', function (event) {
                    event.preventDefault();
                    // $(".loading").show();
                    let formData = new FormData($(this)[0]);
                    let service_uid = `{{$service->uid}}`;
                    $.ajax({
                        url: `{{url("administrator/service/")}}/${service_uid}/show/images/store`,
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            swal("สำเร็จ", "บันทึกข้อมูลเรียบร้อยแล้ว", "success");
                            window.location.href = `{{url("administrator/service")}}/${service_uid}/show`;
                            $('.loading').hide();
                        }, error: function (error) {
                            $('.loading').hide();
                            swal("ผิดพลาด!", error.responseJSON.message, "error");
                        }
                    });

                    {{--$.ajax({--}}
                    {{--    url: '{{url("/administration/banner/store")}}',--}}
                    {{--    method: 'POST',--}}
                    {{--    data: $("#form-insert-banner").serialize(),--}}
                    {{--    success: function (data) {--}}
                    {{--        // console.log(data);--}}
                    {{--        window.location.href = '{{url("/administration/banner")}}';--}}
                    {{--        $('.loading').hide();--}}
                    {{--    }, error: function (error) {--}}
                    {{--        $('.loading').hide();--}}
                    {{--        swal("ผิดพลาด", error.responseJSON.message, "error");--}}
                    {{--    }--}}
                    {{--});--}}
                });


        });
    </script>
@endsection
