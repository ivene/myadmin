@extends('master.base')
@section('title', '个人资料')
@section("menuname","密码")
@section("smallname","个人资料")

@section('css')
    <link href="{{asset('plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/admin/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">

@endsection

@section('js')
    <!-- iCheck -->
    <script src="{{asset('admin/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/extensions/Buttons/js/buttons.html5.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/extensions/Buttons/js/buttons.export.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/jszip/dist/jszip.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

        });

        $('#addpwd').on('click', function () {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{\Illuminate\Support\Facades\URL::action('Admin\UserController@brief_save')}}",
                data: $("#addform").serialize(),
                success: function (result) {
                    if (result.code == "10000") {
                        sweetAlert("操作成功",result.msg,'success');
                    } else {
                        sweetAlert("操作失败",result.msg,'error');
                    }
                },
                error: function (result) {
                    $.each(result.responseJSON.errors, function (k, val) {
                        sweetAlert("操作失败",val[0],'error');
                        return false;
                    });
                }
            });
            return false;

        });

        $('#addbrief').on('click', function () {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{\Illuminate\Support\Facades\URL::action('Admin\UserController@save')}}",
                data: $("#addforms").serialize(),
                success: function (result) {
                    if (result.code == "10000") {
                        sweetAlert("操作成功",result.msg,'success');
                    } else {
                        sweetAlert("操作失败",result.msg,'error');
                    }
                },
                error: function (result) {
                    $.each(result.responseJSON.errors, function (k, val) {
                        sweetAlert("操作失败",val[0],'error');
                        return false;
                    });
                }
            });
            return false;

        });
    </script>
@endsection

@section('content')

<?php
$userinfo =\Illuminate\Support\Facades\Session::get('userinfo');
?>

<section class="content">
    <div class="row">
        <div class="col-xs-6">
            <div class="box box-warning">
                <div class="box-body">
                    <form class="form-horizontal m-t" id="addform">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input id="id" name="id" type="hidden" value="{{$userinfo->id}}">
                            <label class="col-sm-3 control-label">用户名称：</label>
                            <div class="col-sm-8">
                                <input id="name" name="name"  type="text" class="form-control" value="{{$userinfo->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">密码：</label>
                            <div class="col-sm-8">
                                <input id="password" name="password"  type="text" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">新密码：</label>
                            <div class="col-sm-8">
                                <input id="newpassword" name="newpassword"  type="text" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="button" id="addpwd" name="addpwd">提交</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <div class="col-xs-6">
            <div class="box box-warning">
                <div class="box-header">
                    <h3 class="box-title">个人资料</h3>
                </div>
                <div class="box-body">
                    <form class="form-horizontal m-t" id="addforms">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input id="id" name="id" type="hidden" value="{{$userinfo->id}}">
                            <label class="col-sm-3 control-label">用户名称：</label>
                            <div class="col-sm-8">
                                <input id="name" name="name"  type="text" class="form-control" value="{{$userinfo->name}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">邮箱：</label>
                            <div class="col-sm-8">
                                <input id="email" name="email" type="text" class="form-control" value="{{$userinfo->email}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">电话：</label>
                            <div class="col-sm-8">
                                <input id="tel" name="tel" type="text" class="form-control" value="{{$userinfo->tel}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-3">
                                <button class="btn btn-primary" type="button" id="addbrief" name="addbrief">提交</button>
                            </div>
                        </div>
                    </form>



                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

    </div><!-- /.row -->
</section><!-- /.content -->

@endsection