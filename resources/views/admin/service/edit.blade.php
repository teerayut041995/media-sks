@extends('layouts.admin_master')

@section('admin_title')
    แก้ไขข้อมูลการให้บริการ
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
        แก้ไขข้อมูลการให้บริการ
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li class="active">การให้บริการ</li>
    </ol>
@endsection

@section('admin_content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">แก้ไขข้อมูลการให้บริการ</h3>

                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                    </div>

                </div>
                <div class="box-body">

                    <form id="form-update-service" method="post">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="col-form-label">ชื่อ</label>
                            <input class="form-control" name="service_name" value="{{$service->service_name}}" type="text" required
                                   placeholder="">
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-form-label m-r-10">ประเภทการให้บริการ</label>
                            <select class="form-control" name="service_type" required>
                                <option value="">ระบุประเภทการให้บริการ</option>
                                @foreach(findServiceType() as $key => $service_type)
                                    <option value="{{$key}}"
                                    @if ($service->service_type == $key) selected @endif>{{$service_type}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-form-label">คำอธิบายเกี่ยวกับหน่วยบริการ/ห้องเรียน</label>
                            <textarea class="form-control" rows="10" name="service_description">{{$service->service_description}}</textarea>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">บทบาทหน้าที่/ภารกิจ</label>
                                    <textarea class="form-control" rows="20" name="service_mission">{{$service->service_mission}}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">การจัดกิจกรรมการเรียนการสอน</label>
                                    <textarea class="form-control" rows="20"
                                              name="service_learning_activity">{{$service->service_learning_activity}}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">เบอร์โทรศัพท์ติดต่อ</label>
                                    <input class="form-control" name="service_contact_phone_number" value="{{$service->service_contact_phone_number}}" type="text" required
                                           placeholder="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label">ชื่อผู้ติดต่อ</label>
                                    <input class="form-control" name="service_contact_name" value="{{$service->service_contact_name}}" type="text" required
                                           placeholder="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-form-label">ที่อยู่/ที่ตั้งหน่วยบริการ</label>
                            <input class="form-control" name="service_address" type="text"  value="{{$service->service_address}}" required
                                   placeholder="">
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-form-label">ฝังแผนที่ตำแหน่งที่ตั้ง</label>
                            <textarea class="form-control" rows="5" name="service_embed_map">{{$service->service_embed_map}}</textarea>
                        </div>

                        <div class="form-group mb-3">
                            <label class="col-form-label">ลำดับการแสดงผล</label>
                            <input class="form-control" name="service_sequence"
                                   type="number" value="{{$service->service_sequence}}"
                                   placeholder="กรอกลำดับการแสดงผล">
                        </div>


                        <div class="form-group mb-3">
                            <label class="col-form-label m-r-10">สถานะเผยแพร่</label>
                            <select class="form-control" name="service_status">
                                <option value="active" @if ($service->service_status == 'active') selected @endif>เผยแพร่</option>
                                <option value="inactive" @if ($service->service_status == 'inactive') selected @endif>ไม่เผยแพร่</option>
                            </select>
                        </div>

                        <div class="form-group mb-3" align="center">
                            <a href="{{url('/administrator/service')}}"
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

            $('#form-update-service').formValidation({
                framework: 'bootstrap',
                fields: {
                    service_name: {
                        validators: {
                            notEmpty: {
                                message: 'กรุณากรอกชื่อ'
                            }
                        }
                    },
                    service_type: {
                        validators: {
                            notEmpty: {
                                message: 'กรุณาระบุประเภทการให้บริการ'
                            }
                        }
                    },
                    service_description: {
                        validators: {
                            notEmpty: {
                                message: 'กรุณากรอกคำอธิบายเกี่ยวกับหน่วยบริการ/ห้องเรียน'
                            }
                        }
                    },
                    service_mission: {
                        validators: {
                            notEmpty: {
                                message: 'กรุณากรอกบทบาทหน้าที่/ภารกิจ'
                            }
                        }
                    },
                    service_learning_activity: {
                        validators: {
                            notEmpty: {
                                message: 'กรุณากรอกการจัดกิจกรรมการเรียนการสอน'
                            }
                        }
                    },
                    service_contact_phone_number: {
                        validators: {
                            notEmpty: {
                                message: 'กรุณากรอกเบอร์โทรศัพท์ติดต่อ'
                            }
                        }
                    },
                    service_contact_name: {
                        validators: {
                            notEmpty: {
                                message: 'กรุณากรอกชื่อผู้ติดต่อ'
                            }
                        }
                    },
                    service_address: {
                        validators: {
                            notEmpty: {
                                message: 'กรุณากรอกที่อยู่/ที่ตั้งหน่วยบริการ'
                            }
                        }
                    },
                    service_embed_map: {
                        validators: {
                            notEmpty: {
                                message: 'กรุณาฝังแผนที่ตำแหน่งที่ตั้ง'
                            }
                        }
                    },
                    service_sequence: {
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
                    let service_uid = `{{$service->uid}}`;
                    $.ajax({
                        url: `{{url("administrator/service")}}/${service_uid}/update`,
                        method: 'POST',
                        data: $("#form-update-service").serialize(),
                        success: function (data) {
                            swal("สำเร็จ", "บันทึกข้อมูลเรียบร้อยแล้ว", "success");
                            window.location.href = '{{url("administrator/service")}}';
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