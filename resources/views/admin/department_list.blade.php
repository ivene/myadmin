@extends('master.base')
@section('title', '管理菜单')
@section("menuname","部门管理")
@section("smallname","部门列表")

@section('css')
    <link href="{{asset('plugins/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/datatables/extensions/Buttons/css/buttons.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{asset('/admin/css/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet">
    <link href="{{ asset('admin/css/plugins/jsTree/style.min.css')}}" rel="stylesheet"/>


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
    <script src="{{asset('admin/js/plugins/jsTree/jstree.min.js')}}"></script>




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
                    "url":"{{URL::action('Admin\DepartmentController@getListData')}}",
                    "type":"POST",
                    "dataType":"json",
                    "data":{'_token':'{{ csrf_token() }}'}
                },
                "columns": [
                    { "data": "id" },
                    { "data": "dp_name" },
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
                        "targets" :2,
                    },
                    {
                        "render" : function(data, type, row){
                            var str="<a class=\"btn btn-sm btn-danger\"  onclick='del("+row.id+")'>删除</a> <a class=\"btn btn-sm btn-primary\" href=\" /admin/dept/view?id= " + row.id+ "\">修改</a>";
                            if(row.level == 1){
                                str +=" <a class=\"btn btn-sm btn-success\" href=\"/admin/dept/view?level="+row.level+"&parent_id="+row.id+"\" >添加二级</a>";
                            }else if(row.level == 2){
                                str +=" <a class=\"btn btn-sm btn-success\" href=\"/admin/dept/view?level="+row.level+"&parent_id="+row.id+"\" >添加三级</a>";
                            }else if (row.level == 3){
                                str +=" <a class=\"btn btn-sm btn-success\" href=\"/admin/dept/view?level="+row.level+"&parent_id="+row.id+"\" >添加四级</a>";
                            }else{
                                str +="";
                            }
                            return str;
                        },
                        "targets" :3,
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
                        url: "{{URL::action('Admin\DepartmentController@delete')}}",
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
        $('#full').jstree(
            {
                plugins : ["checkbox"],
                "types" : { "file" : { "icon" : "jstree-file" }
                }
            });
    </script>

@endsection


@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-6">
                <div class="box">
                    <div class="box-header">
                            <a class="btn btn-primary" href="/admin/dept/view">添加部门</a>
                    </div>  <!-- /.box-header -->
                    <div class="box-body">
                        <table id="mytable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>部门ID</th>
                                <th>部门名称</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                        </table>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div><!-- /.col -->

            <div class="col-xs-6">
                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">部门权限：</label>
                                <div class="col-sm-8 tree" id="full">
                                    @foreach($department_rule as $department)
                                        <ul>
                                            <li class="jstree-open">
                                            {{ $department['dp_name'] }}
                                            @if(!empty($department['child']))
                                                @foreach($department['child'] as $subgrade)
                                                    <ul>
                                                        <li>
                                                        {{ $subgrade['dp_name'] }}
                                                            @if(!empty($subgrade['child']))
                                                                @foreach($subgrade['child'] as $grandson)
                                                                    <ul>
                                                                        <li>
                                                                            {{ $grandson['dp_name'] }}
                                                                            @if(!empty($grandson['child']))
                                                                                @foreach($grandson['child'] as $extremity)
                                                                                    <ul>
                                                                                        <li>
                                                                                            {{ $extremity['dp_name'] }}
                                                                                        </li>
                                                                                    </ul>
                                                                                @endforeach
                                                                            @endif
                                                                        </li>
                                                                    </ul>
                                                                @endforeach
                                                            @endif
                                                        </li>
                                                    </ul>
                                                 @endforeach
                                            @endif
                                            </li>
                                        </ul>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection