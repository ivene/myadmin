@extends('master.base')
@section('title', '账号列表')
@section("menuname","账号管理")
@section("smallname","账号列表")

@section('css')
    <link href="{{asset('plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/admin/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{asset('admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/extensions/Buttons/js/buttons.html5.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/extensions/Buttons/js/buttons.export.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/jszip/dist/jszip.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('admin/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script type="text/javascript">
        var myTable
        $(function () {
            myTable =  initDataTable();

        });
        function initDataTable(){
            var table ;
            table  =  $("#mytable").DataTable({
                "oLanguage":{"sUrl":"{{asset('plugins/datatables/jquery.dataTable.cn.txt')}}"},
                "responsive":true,
                "serverSide": true,
                'stateSave':true,
                "retrieve": true,
                "processing": true,
                "autoWidth": false,
                "order": [[ 0, "desc" ]],
                "ajax": {
                    "url":"{{URL::action('Admin\UserController@getListData')}}",
                    "type":"POST",
                    "dataType":"json",
                    "data":{'_token':'{{ csrf_token() }}'}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "uname" },
                    { "data": "email" },
                    { "data": "tel" },
                    { "data": "dept.dp_name" },
                    { "data": "posi.position_name" },
                    { "data": "status" }
                ],
                "columnDefs": [
                    {
                        "render" : function(data, type, row){
                            if(data==1){
                                var str = "正常";
                            }else{
                                var str = "禁用";
                            }
                            return str;
                        },
                        "targets" :6,
                    },
                    {
                        "render" : function(data, type, row){
                            var str="<a class=\"btn btn-sm btn-danger\" onclick='del("+row.id+")'>删除</a> <a class=\"btn btn-sm btn-primary\"  data-target=\"#myModal2\" href=\"/admin/user/view?id="+row.id+"\">修改</a>";

                            return str;
                        },
                        "targets" :7,
                    }
                ],
            });
            return table;
        }
        function del(id) {
            swal({
                    title: "确定删除吗？",
                    text: "你将无法恢复该虚拟文件！",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "确定删除！",
                    closeOnConfirm: false
                },
                function(){
                    $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: "{{URL::action('Admin\UserController@delete')}}",
                        data: {'_token':'{{ csrf_token() }}','id':id},
                        success: function (result) {
                            if (result.code == "10000") {
                                myTable.ajax.reload(null,false);
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
                });
            return false;
        }

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
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title"></h3>
                                <button type="button" id="btn" class="btn btn-primary" data-toggle="modal" data-target="#myModal2">
                                    添加账号
                                </button>

                            </div>  <!-- /.box-header -->
                            <div class="box-body">
                                <table id="mytable" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                    <th>用户ID</th>
                                    <th>名称</th>
                                    <th>邮箱</th>
                                    <th>手机号</th>
                                    <th>部门</th>
                                    <th>职位</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div><!-- /.box-body -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div>
            </section>

            <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content animated bounceInRight">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">用户管理</h4>
                        </div>
                        <div class="modal-body">
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
                                        <input id="login_name" name="login_name"  type="text" class="form-control" value="{{$info->login_name}}">
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
                                        <input id="pwd" name="pwd" type="text" class="form-control" value="{{$info->pwd}}">
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
                                                <option value="{{$v->id}}" @if($info->id == $v->id ) selected="selected" @endif> {{$v->dp_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">职位：</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="position_id">
                                            @foreach($pt_name as $k=>$v)
                                                <option value="{{$v->id}}" @if($info->id == $v->id ) selected="selected" @endif>{{$v->position_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">状态：</label>
                                    <div class="radio i-checks">
                                        <label>
                                            <input type="radio" value="1" checked="" name="status" id="status"> <i></i> 正常</label>
                                        <label>
                                            <input type="radio" value="0" name="status" id="status"><i></i> 禁用</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="button" id="addpower" name="addpower">提交</button>
                            <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                        </div>
                    </div>
                </div>
            </div>



@endsection