@extends('layouts.admin_master')

@section('admin_title')
    {{$service->service_name}}
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
        {{$service->service_name}}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{url('administrator')}}"><i class="fa fa-dashboard"></i> หน้าหลัก</a></li>
        <li><a href="{{url('administrator/service')}}"><i class="fa fa-dashboard"></i> การให้บริการ</a></li>
        <li class="active">{{$service->service_name}}</li>
    </ol>
@endsection

@section('admin_content')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{$service->service_name}}</h3>

                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                        <a href='{{url("administrator/service/$service->uid/show/images/create")}}'
                           class="btn btn-primary btn-sm">เพิ่มรูปภาพ</a>
                    </div>

                </div>

                <div class="box-body">

                    <div class="row">
                        <div class="col-md-12">
                            <p style="color: red;">banner</p>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    @if ($image_banner)
                                        <img src="{{url('/images/service', $image_banner->service_image_file_name)}}"
                                             style="width: 100%;">
                                    @else
                                        <img src="{{url('/images/service/banner-example.jpg')}}" style="width: 100%;">
                                    @endif
                                </div>
                            </div>
                            @if ($image_banner)
                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="btn btn-primary btn-air-primary px-2" title="แก้ไขข้อมูล"
                                           href='{{url("administrator/service/$service->uid/show/images/$image_banner->uid/edit")}}'><i
                                                    class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger btn-air-danger px-2 btn-delete-service-image"
                                                data-id="{{$image_banner->uid}}"><i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            {{$service->service_description}}
                        </div>
                    </div>
                    <br>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p style="color: red;">preview_1</p>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    @if ($image_preview_1)
                                        <img src="{{url('/images/service', $image_preview_1->service_image_file_name)}}"
                                             style="width: 100%;">
                                    @else
                                        <img src="{{url('/images/service/example.jpg')}}" style="width: 100%;">
                                    @endif
                                </div>
                            </div>
                            @if ($image_preview_1)
                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="btn btn-primary btn-air-primary px-2" title="แก้ไขข้อมูล"
                                           href='{{url("administrator/service/$service->uid/show/images/$image_preview_1->uid/edit")}}'><i
                                                    class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger btn-air-danger px-2 btn-delete-service-image"
                                                data-id="{{$image_preview_1->uid}}"><i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <h4>บทบาทหน้าที่/ภารกิจ</h4>
                            {!! nl2br($service->service_mission) !!}
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <h4>การจัดกิจกรรมการเรียนการสอน</h4>
                            {!! nl2br($service->service_learning_activity) !!}
                        </div>
                        <div class="col-md-6">
                            <p style="color: red;">preview_2</p>
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    @if ($image_preview_2)
                                        <img src="{{url('/images/service', $image_preview_2->service_image_file_name)}}"
                                             style="width: 100%;">
                                    @else
                                        <img src="{{url('/images/service/example.jpg')}}" style="width: 100%;">
                                    @endif
                                </div>
                            </div>
                            @if ($image_preview_2)
                                <div class="row">
                                    <div class="col-md-12">
                                        <a class="btn btn-primary btn-air-primary px-2" title="แก้ไขข้อมูล"
                                           href='{{url("administrator/service/$service->uid/show/images/$image_preview_2->uid/edit")}}'><i
                                                    class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger btn-air-danger px-2 btn-delete-service-image"
                                                data-id="{{$image_preview_2->uid}}"><i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <div class="col-md-12">
                            <h4>ช่องทางการติดต่อ</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <B>เบอร์โทรศัพท์</B> {{$service->service_contact_phone_number}}
                        </div>
                        <div class="col-md-9">
                            <B>ชื่อผู้ติดต่อ</B> {{$service->service_contact_name}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <B>ที่อยู่/ที่ตั้ง</B> {{$service->service_address}}
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        @foreach($image_general as $general)
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <img src="{{url('/images/service', $general->service_image_file_name)}}"
                                             style="width: 100%;">
                                    </div>
                                    <div class="col-md-12">
                                        <b><p>{{$general->service_image_name}}</p></b>
                                    </div>
                                    <div class="col-md-12">
                                        <p>{{$general->service_image_description}}</p>
                                    </div>
                                    <div class="col-md-12">
                                        <a class="btn btn-primary btn-air-primary px-2" title="แก้ไขข้อมูล"
                                           href='{{url("administrator/service/$service->uid/show/images/$general->uid/edit")}}'><i
                                                    class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger btn-air-danger px-2 btn-delete-service-image"
                                                data-id="{{$general->uid}}"><i class="fa fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
        $(document).ready(function () {
            $(document).on('click', '.btn-delete-service-image', function () {
                const id = $(this).attr('data-id');
                const service_uid = `{{$service->uid}}`;
                const token = `{{ csrf_token() }}`;
                swal({
                    title: "ยืนยันการลบ",
                    text: "คุณต้องการลบรูปภาพนี้หรือไม่",
                    icon: "warning",
                    buttons: {
                        cancel: "ไม่ใช่",
                        catch: {
                            text: "ใช่",
                            value: "catch",
                        }
                    },
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            // $(".loading").show();
                            $.ajax({
                                url: `{{url("/administrator/service")}}/${service_uid}/show/images/${id}/delete`,
                                method: 'POST',
                                data: {
                                    _token: token, _method: 'POST'
                                },
                                success: function (data) {
                                    swal("สำเร็จ", 'ลบข้อมูลเรียบร้อยแล้ว', "success");
                                    // $('.loading').hide();
                                    location.reload();
                                }, error: function (error) {
                                    // $(".loading").hide();
                                    swal("ผิดพลาด!", error.responseJSON.message, "error");
                                }
                            });
                        }
                    });
            });
        });
    </script>
@endsection