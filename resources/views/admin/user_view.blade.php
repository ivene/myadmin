@extends('master.base')
@section('title', '用户添加')
@section("menuname","用户管理")
@section("smallname","用户添加")

@section('css')
    <link href="{{asset('admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('/admin/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
@endsection

@section('js')
    <!-- iCheck -->
    <script src="{{asset('admin/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('/admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });

        });

        $('#addpower').on('click', function () {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{URL::action('Admin\UserController@save')}}",
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
    </script>
@endsection

@section('content')

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
                        <div class="col-md-8">
                            <form class="form-horizontal m-t" id="addform">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <input id="id" name="id" type="hidden" value="{{$info->id}}">
                                    <label class="col-sm-3 control-label">姓名：</label>
                                    <div class="col-sm-8">
                                        <input id="uname" name="uname"  type="text" class="form-control" value="{{$info->uname}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">账号：</label>
                                    <div class="col-sm-8">
                                        <input id="login_name" name="login_name" type="text" class="form-control" value="{{$info->login_name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">邮箱：</label>
                                    <div class="col-sm-8">
                                        <input id="email" name="email" type="text" class="form-control" value="{{$info->email}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">密码：</label>
                                    <div class="col-sm-8">
                                        <input id="pwd" name="pwd" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">电话：</label>
                                    <div class="col-sm-8">
                                        <input id="tel" name="tel" type="text" class="form-control" value="{{$info->tel}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">部门：</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="department_id">
                                            @foreach($dp_name as $k=>$v)
                                                <option value="{{$v->id}}" @if($info->department_id == $v->id ) selected="selected" @endif> {{$v->dp_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">职位：</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="position_id">
                                            @foreach($pt_name as $k=>$v)
                                                <option value="{{$v->id}}" @if($info->position_id == $v->id ) selected="selected" @endif> {{$v->position_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">状态：</label>
                                    <div class="radio i-checks">
                                        <label>
                                            <input type="radio" value="1" checked="" name="status" id="status" @if($info->status == 1)  checked="" @endif> <i></i> 正常</label>
                                        <label>
                                            <input type="radio" value="0" name="status" id="status" @if($info->status == 0)  checked="" @endif><i></i> 禁用</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-3">
                                        <button class="btn btn-primary btn-block" type="button" id="addpower" name="addpower">提交</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!--/.col (right) -->
        </div><!-- /.row -->
    </section><!-- /.content -->
@endsection