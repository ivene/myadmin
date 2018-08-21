@extends('master.base')
@section('title', '管理菜单')
@section("menuname","头像管理")
@section("smallname","头像操作")

@section('css')
    <link href="{{asset('plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/datatables/extensions/Buttons/css/buttons.dataTables.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
    <script src="{{asset('plugins/datatables/jquery.dataTables.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/extensions/Buttons/js/dataTables.buttons.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/extensions/Buttons/js/buttons.html5.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/datatables/extensions/Buttons/js/buttons.export.js')}}" type="text/javascript"></script>
    <script src="{{asset('plugins/jszip/dist/jszip.js')}}" type="text/javascript"></script>


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
                    "url":"{{URL::action('Admin\UserController@getSysMediaDatas')}}",
                    "type":"POST",
                    "dataType":"json",
                    "data":{'_token':'{{ csrf_token() }}'}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "m_url" },
                    { "data": "m_status" }
                ],
                "columnDefs": [
                    {
                        "render" : function(data, type, row){
                          var str ="<img src=\" /uploadfile/"+row.m_url+"\" alt=\"\" width='46px'>";
                            return str;
                        },
                        "targets" :1,
                    },
                    {
                        "render" : function(data, type, row){
                            if(data==1){
                                var str = "正常";
                            }else{
                                var str = "禁用";
                            }
                            return str;
                        },
                        "targets" :2,
                    },
                    {
                        "render" : function(data, type, row){
                            var str="<a class=\"btn btn-sm btn-success\" onclick='add("+row.id+")'>设置头像</a>";
                            return str;
                        },
                        "targets" :3,
                    }
                ],
            });
            return table;
        }
        function add(id) {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{URL::action('Admin\UserController@userImg_save')}}",
                data: {'_token':'{{ csrf_token() }}','id':id},
                success: function (result) {
                    if (result.code == "10000") {
                        parent.location.reload();
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
        }
    </script>

@endsection


@section('content')
      <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="ibox-tools-btn">
                            <a class="btn btn-primary" href="/admin/userimg/edit">添加头像</a>
                        </div>
                    </div>  <!-- /.box-header -->
                    <div class="box-body">
                        <table id="mytable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>图片id</th>
                                <th>图片</th>
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
@endsection