@extends('commons.layout')

@section('title', '职位添加')

@section('content')
    <div class="ibox-content">
        <form class="form-horizontal m-t" id="commentForm" action="" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label class="col-sm-3 control-label">职位：</label>
                <div class="col-sm-8">
                    <input id="position_name" name="position_name" minlength="2" type="text" class="form-control" required="" aria-required="true">
                </div>
            </div>



            <div class="form-group">
                <label class="col-sm-3 control-label">部门：</label>


                <div class="col-sm-8">
                    <select class="form-control" name="role_id">
                        <option value=""> 无限极</option>
                        {{--@foreach($department as $k=>$v)--}}
                            {{--<option value="{{$v->id}}">{{ str_repeat('--', $v->level). $v->department_name }}</option>--}}
                        {{--@endforeach--}}
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">职位说明：</label>
                <div class="col-sm-8">
                    <textarea id="remark" name="remark" class="form-control" required="" aria-required="true"></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">复选框：</label>
                <div class="checkbox i-checks col-sm-8">
                    <label><input type="checkbox" name="w"> <i></i> 复选</label>
                    {{--@foreach($rule_name as $key=>$value)--}}
                        {{--<label><input type="checkbox" id="rulename[]" value="{{$value->id}}" name="rulename[]"> <i></i> {{$value->rulename}}</label>--}}
                    {{--@endforeach--}}
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label">单选框：</label>
                <div class="col-sm-8">
                    <div class="radio i-checks">
                        <label>
                            <input type="radio" value="1" checked="" name="status"> <i></i> 显示</label>
                        <label>
                            <input type="radio" value="2" name="status"><i></i> 不显示</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-3">
                    <button class="btn btn-primary" type="submit">提交</button>
                </div>
            </div>
        </form>
    </div>
@endsection