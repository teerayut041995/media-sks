@extends('layouts.admin_master')

@section('admin_title')
    เพิ่มแบนเนอร์สไลด์
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
        แบนเนอร์สไลด์
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">แบนเนอร์สไลด์</li>
    </ol>
@endsection

@section('admin_content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">เพิ่มแบนเนอร์สไลด์ จำนวน <label id="count-total"></label> สไลด์</h3>

                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                        <div class="btn-group" data-toggle="btn-toggle">
                            <a href="{{url('administrator/banner/create')}}" class="btn btn-primary btn-sm">เพิ่มแบนเนอร์</a>
                        </div>
                    </div>

                </div>
                <div class="box-body">

                    <form id="form-update-banner" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="col-form-label">ชื่อแบนเนอร์</label>
                            <input class="form-control" name="banner_name" value="{{$banner->banner_name}}" type="text"
                                   placeholder="ชื่อแบนเนอร์">
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-form-label">อัพโหลดไฟล์รูปภาพแบนเนอร์ <small
                                        class="text-muted">* สำหรับไฟล์ รูปภาพ ขนาดไม่เกิน 2MB
                                    เท่านั้น</small> <small
                                        class="text-danger">* ขนาดรูปภาพที่เหมาะสมคือ 1920px X 960px</small></label>
                            <input type="file" id="imageUpload" name="banner_file_name" class="form-control"
                                   accept="image/*">
                            <input type="hidden" id="imageUpload" name="old_banner_file_name"
                                   value="{{$banner->banner_file_name}}">
                            <small class="text-danger" id="msg_file"></small>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <img src="{{url('images/banner', $banner->banner_file_name)}}" class="profile-img" id="imagePreview">
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-form-label">หัวเรื่อง</label> <small class="text-muted">
                                *เว้นว่างได้</small>
                            <input class="form-control" name="banner_title" value="{{$banner->banner_title}}" type="text"
                                   placeholder="กรอกหัวเรื่อง">
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-form-label">รายละเอียดเพิ่มเติม</label> <small class="text-muted">
                                *เว้นว่างได้</small>
                            <input class="form-control" name="banner_description" type="text"
                                   placeholder="รายละเอียดเพิ่มเติม" value="{{$banner->banner_description}}">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">ลิงค์ 1</label> <small class="text-muted">
                                        *เว้นว่างได้</small>
                                    <input class="form-control" name="banner_first_link" type="text" value="{{$banner->banner_first_link}}"
                                           placeholder="www.facebook.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Text to display</label> <small class="text-muted">
                                        *เว้นว่างได้</small>
                                    <input class="form-control" name="banner_first_link_text" value="{{$banner->banner_first_link_text}}"
                                           type="text"
                                           placeholder="FACEBOOK">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">ลิงค์ 2</label> <small class="text-muted">
                                        *เว้นว่างได้</small>
                                    <input class="form-control" name="banner_second_link" type="text" value="{{$banner->banner_second_link}}"
                                           placeholder="www.special.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-form-label">Text to display</label> <small class="text-muted">
                                        *เว้นว่างได้</small>
                                    <input class="form-control" name="banner_second_link_text" type="text" value="{{$banner->banner_second_link_text}}"
                                           placeholder="WEBSITE">
                                </div>
                            </div>
                        </div>


                        <div class="form-group mb-3">
                            <label class="col-form-label">ลำดับการแสดงผล</label>
                            <input class="form-control" name="banner_sequence"
                                   type="number" value="{{$banner->banner_sequence}}"
                                   placeholder="กรอกลำดับการแสดงผล">
                        </div>


                        <div class="form-group mb-3">
                            <label class="col-form-label m-r-10">สถานะเผยแพร่</label>
                            <select class="form-control" name="status">
                                <option value="active" @if ($banner->banner_status == 'active') selected @endif>เผยแพร่</option>
                                <option value="inactive" @if ($banner->banner_status == 'inactive') selected @endif>ไม่เผยแพร่</option>
                            </select>
                        </div>

                        <div class="form-group mb-3" align="center">
                            <a href="{{url('/administrator/banner')}}"
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

            $('#form-update-banner').formValidation({
                framework: 'bootstrap',
                fields: {
                    banner_name: {
                        validators: {
                            notEmpty: {
                                message: 'กรุณากรอกชื่อแบนเนอร์'
                            }
                        }
                    },
                    banner_file_name: {
                        validators: {
                            file: {
                                maxSize: 2097152, // 2 * 1024 * 1024
                                message: 'สำหรับไฟล์ รูปภาพ ขนาดไม่เกิน 2MB เท่านั้น',
                            }
                        }
                    },
                    banner_sequence: {
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
                    $(".loading").show();

                    let formData = new FormData($(this)[0]);
                    $.ajax({
                        url: `{{url("administrator/banner/$banner->uid/update")}}`,
                        method: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            window.location.href = '{{url("administrator/banner")}}';
                            $('.loading').hide();
                        }, error: function (error) {
                            $('.loading').hide();
                            swal("ผิดพลาด!", error.responseJSON.message, "error");
                        }
                    });
                });
        });
    </script>
@endsection
