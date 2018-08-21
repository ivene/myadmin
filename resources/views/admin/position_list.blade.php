@extends('master.base')
@section('title', '管理菜单')
@section("menuname","职位管理")
@section("smallname","职位列表")

@section('css')
    <link href="{{asset('plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{asset('admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('/admin/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
@endsection

@section('js')
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/extensions/Buttons/js/dataTables.buttons.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/extensions/Buttons/js/buttons.html5.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/extensions/Buttons/js/buttons.export.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/jszip/dist/jszip.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('admin/js/plugins/iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('/admin/js/plugins/sweetalert/sweetalert.min.js')}}"></script>

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
                    "url":"{{URL::action('Admin\PositionController@getListData')}}",
                    "type":"POST",
                    "dataType":"json",
                    "data":{'_token':'{{ csrf_token() }}'}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "position_name" },
                    { "data": "dp_name" },
                    { "data": "desc" },
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
                        "targets" :4,
                    },
                    {
                        "render" : function(data, type, row){
                            var str="<a class=\"btn btn-sm btn-danger\" onclick='del("+row.id+")'>删除</a> <a class=\"btn btn-sm btn-primary\" href=\"/admin/posi/view?id="+ row.id +"\">修改</a>";
                            return str;
                        },
                        "targets" :5,
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
                        url: "{{URL::action('Admin\PositionController@delete')}}",
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
    </script>

@endsection


@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                        <a class="btn btn-primary" href="/admin/posi/view">添加职位</a>
                </div>  <!-- /.box-header -->
                <div class="box-body">
                    <table id="mytable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>职位ID</th>
                            <th>职位名称</th>
                            <th>归属部门</th>
                            <th>描述</th>
                            <th>状态</th>
                            <th>操作</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
@endsection