@extends('master.base')
@section('title', '管理菜单')
@section("menuname","头像管理")
@section("smallname","头像列表")

@section('css')
    <link rel="stylesheet" href="{{asset('plugins/fileinput/css/fileinput.min.css')}}" xmlns="http://www.w3.org/1999/html">
@endsection

@section('js')
    <script src="{{asset('plugins/fileinput/js/fileinput.js')}}"></script>
    <script src="{{asset('plugins/fileinput/js/fileinput_locale_zh.js')}}"></script>
    <script src="{{asset('plugins/fileinput/js/fileinput_locale_zh.js')}}"></script>
    <script src="{{mix('js/fileupload.js')}}"></script>

    <script>
        $(document).ready(function () {
            // $('.i-checks').iCheck({
            //     checkboxClass: 'icheckbox_square-green',
            //     radioClass: 'iradio_square-green',
            // });
            var uid = '{{$info->id}}';

            var file = new upload({ uid:uid,pictype:1001,uploadid:"fileupload",tag:"img",token:'<?php echo e(csrf_token());?>'});
            file.initUpload('{!! $info->imginfo !!}','{{asset('uploadfile')}}/') ;
        });
        $('#signupButton').on('click',function(){
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"{{\Illuminate\Support\Facades\URL::action('CecController@save')}}",
                data:$("#signupForm").serialize(),
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

    <script type="text/javascript">
        var myTable;
    </script>
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="ibox float-e-margins ">
            <div class="ibox-title border-success">
                <h5>图片管理</h5>
            </div>
            <div class="ibox-content">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">上传图片：</label>
                        <div class="col-md-8">
                            <div id="img_info">
                                <input type="hidden" id="img" name="img" value="{{$info->imginfo}}"/>
                                <input id="fileupload" name="fileupload" type="file" multiple>
                                <input type="hidden" name="_token"  value="{{csrf_token()}}"/>
                                <span class="help-block text_infor">支持文件格式:xls, xlsx, doc, docx, pdf, jpg, png, jpeg。</span>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
@endsection