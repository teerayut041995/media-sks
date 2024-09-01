@extends('layouts.admin_master')

@section('admin_title')
    แบนเนอร์สไลด์
@endsection

@section('admin_style')
    <link rel="stylesheet" type="text/css" href="{{asset('template/plugins/sweet-alert/sweetalert2.css')}}">
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
                    <h3 class="box-title">แบนเนอร์สไลด์ จำนวน <label id="count-total">{{$banners->total()}}</label> สไลด์</h3>

                    <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
                        <div class="btn-group" data-toggle="btn-toggle">
                            <a href="{{url('administrator/banner/create')}}" class="btn btn-primary btn-sm">เพิ่มแบนเนอร์</a>
                        </div>
                    </div>

                </div>
                <div class="box-body">
                    <form method="get">
                        <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-2 mb-3">
                            <div class="col-md-4">
                                <select name="banner_status" id="search_status" class="form-control form-select"
                                        aria-label="Default select example">
                                    <option value="">สถานะการแผยแพร่</option>
                                    <option value="inactive"
                                            @if ($request->banner_status == 'inactive') selected @endif>ปิด
                                    </option>
                                    <option value="active" @if ($request->banner_status == 'active') selected @endif>
                                        เปิด
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input name="name" id="search-name" type="text" class="form-control"
                                       placeholder="ค้นหาด้วยชื่อ" value="{{$request->name}}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" id="btn-search" class="btn btn-primary"><i
                                            class="fa fa-search"></i> ค้นหา
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="table table-responsive">
                        <table class="table" style="width: 150%;">
                            <thead>
                            <tr style="text-align: left; font-weight: bold;">
                                <th style="width: 10%; text-align: center;">จัดการ</th>
                                <th style="width: 15%;">รูปภาพแบนเนอร์</th>
                                <th style="width: 20%;">ชื่อแบนเนอร์</th>
                                <th style="width: 20%;">หัวเรื่อง</th>
                                <th style="width: 5%; text-align: center;">ลำดับแสดงผล</th>
                                <th style="width: 10%; text-align: center;">สถานะ</th>
                                <th style="width: 10%; text-align: left;">วันที่เพิ่ม</th>
                                <th style="width: 10%; text-align: left;">อัพเดตล่าสุด</th>
                            </tr>
                            </thead>
                            <tbody id="load-data-table">
                            @foreach($banners as $banner)
                                <tr style="text-align: center;">
                                    <td valign="top">
                                        <a class="btn btn-primary btn-air-primary px-2" title="แก้ไขข้อมูล"
                                           href='{{url("administrator/banner/$banner->uid/edit")}}'><i
                                                    class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger btn-air-danger px-2 btn-delete-banner"
                                                data-id="{{$banner->uid}}"><i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                    <td align="left" valign="top"><img
                                                src="{{url('images/banner', $banner->banner_file_name)}}"
                                                style="width: 100%;"></td>
                                    <td align="left" valign="top">{{$banner->banner_name}}</td>
                                    <td align="left" valign="top">{{$banner->banner_title ? $banner->banner_title : ''}}
                                        <br> <small
                                                class="text-success">{{$banner->banner_description ? $banner->banner_description : ''}}</small>
                                    </td>
                                    <td align="center"
                                        valign="top">{{$banner->banner_sequence ?  $banner->banner_sequence : '-'}}</td>
                                    <td align="center" valign="top">
                                        @if ($banner->banner_status == 'active')
                                            แผยแพร่
                                        @else
                                            ไม่แผยแพร่
                                        @endif
                                    </td>
                                    <td align="center" valign="top">{{formatDateThat($banner->created_at)}}</td>
                                    <td align="center" valign="top">{{formatDateThat($banner->updated_at)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{--                    {{$banners->links()}}--}}
                </div>
                <div class="box-footer">
                    {{$banners->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('admin_script')
    <script>
        $(document).ready(function () {
            $('.delete_form').on('submit', function (e) {
                if (confirm("คุณต้องการลบประเภทบทความนี้หรือไม่?")) {
                    return true;
                } else {
                    return false;
                }
            });
        });
    </script>
    <script src="{{asset('template/plugins/sweet-alert/sweetalert.min.js')}}"></script>
    <script>
        $(document).ready(function () {

            function padTo2Digits(num) {
                return num.toString().padStart(2, '0');
            }

            function formatDate(date) {
                let day = padTo2Digits(date.getDate());
                let month = padTo2Digits(date.getMonth() + 1);
                let year = date.getFullYear();
                let getHours = padTo2Digits(date.getHours());
                let getMinutes = padTo2Digits(date.getMinutes());
                let getSeconds = padTo2Digits(date.getSeconds());
                return `${day}/${month}/${year} ${getHours}:${getMinutes}:${getSeconds}`
            }

            loadData();

            function loadData(page = null, status = null, name = null) {
                let url = `{{url("administration/banner/load-data")}}`;
                if (page) {
                    url = page
                }
                $(".loading").show();
                $.ajax({
                    url: url,
                    method: 'GET',
                    data: {banner_status: status, name: name},
                    success: function (data) {
                        const results = data.data.data;
                        const links = data.data.links;
                        let from = data.data.from;
                        let data_total = data.data.total;
                        $("#load-data-table").empty();
                        $("#count-total").html(data_total);
                        $("#get-admin-for-assign").prop('disabled', false);
                        let table = $("#load-data-table");
                        results.forEach(function (item) {
                            let created_at = formatDate(new Date(item.created_at));
                            let updated_at = formatDate(new Date(item.updated_at));
                            // console.log(`Day: ${day}, Month: ${month}, Year: ${year}`);

                            let status = ``;
                            if (item.banner_status === 'active') {
                                status = `<button class="btn badge-light-success">เปิด</button>`;
                            } else {
                                status = `<button class="btn badge-light-light">ปิด</button>`;
                            }
                            let edit_url = `{{url("/administration/banner")}}/${item.uid}/edit`;
                            let image_url = `{{url("/storage/banner")}}/${item.banner_file_name}`;
                            table.append(`
                            <tr style="text-align: center;">
                                <td valign="top">
                                    <a class="btn btn-dark btn-air-dark px-2" title="แก้ไขข้อมูล"
                                       href='${edit_url}'><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-danger btn-air-danger px-2 btn-delete-banner"
                                        data-id="${item.uid}"><i class="fa fa-trash"></i>
                                        </button>
                                </td>
                                <td align="left" valign="top"><img src="${image_url}" style="width: 100%;"></td>
                                <td align="left" valign="top">${item.banner_name}</td>
                                <td align="left" valign="top">${item.banner_title ? item.banner_title : ''}<br> <small class="text-success">${item.banner_description ? item.banner_description : ''}</small></td>
                                <td align="center" valign="top">${item.banner_sequence ? item.banner_sequence : '-'}</td>
                                <td align="center" valign="top">${status}</td>
                                <td align="left" valign="top">${created_at}<br>${item.created_firstname ? item.created_firstname : ''} ${item.created_lastname ? item.created_lastname : ''}</td>
                                <td align="left" valign="top">${updated_at}<br>${item.updated_firstname ? item.updated_firstname : ''} ${item.updated_lastname ? item.updated_lastname : ''}</td>
                            </tr>
                        `);

                            $("#load-pagination").empty();
                            let pagination = $("#load-pagination");
                            links.forEach(function (item) {
                                pagination.append(`
                                    <li class="page-item ${item.active ? 'active' : ''}">
                                        <a class="page-link active change-pagination" href="javascript:void(0)" data-page="${item.url}">${item.label}</a>
                                    </li>
                            `);
                            });

                        });
                        $(".loading").hide();
                    }
                });
            }

            $(document).on('click', '.change-pagination', function () {
                const url = $(this).attr('data-page');
                const status = $("#search_status").val();
                const name = $("#search-name").val();
                loadData(url, status, name);
            });

            $(document).on('change', '#search_status', function () {
                const status = $("#search_status").val();
                const name = $("#search-name").val();
                loadData(null, status, name);
            });

            $(document).on('click', '#btn-search', function () {
                const status = $("#search_status").val();
                const name = $("#search-name").val();
                loadData(null, status, name);
            });

            $(document).on('click', '.btn-delete-banner', function () {
                const id = $(this).attr('data-id');
                const token = `{{ csrf_token() }}`;
                swal({
                    title: "ยืนยันการลบ",
                    text: "คุณต้องการลบแบนเนอร์สไลด์นี้หรือไม่",
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
                            $(".loading").show();
                            $.ajax({
                                url: `{{url("/administrator/banner")}}/${id}/delete`,
                                method: 'POST',
                                data: {
                                    _token: token, _method: 'POST'
                                },
                                success: function (data) {
                                    swal("สำเร็จ", 'ลบข้อมูลเรียบร้อยแล้ว', "success");
                                    $('.loading').hide();
                                    location.reload();
                                }, error: function (error) {
                                    $(".loading").hide();
                                    swal("ผิดพลาด!", error.responseJSON.message, "error");
                                }
                            });
                        }
                    });
            });

        });
    </script>
@endsection
