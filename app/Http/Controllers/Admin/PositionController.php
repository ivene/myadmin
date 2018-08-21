<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminPower;
use App\Http\Requests\AdminPowerRequest;
use App\Models\Base\BaseSysAdminPosition;
use App\Models\Base\BaseSysAdminDepartment;
use App\Models\Base\BaseSysAdminPower;
use App\Models\Department;
use App\Services\AdminUser;
use App\Tools\Constant;
use App\Tools\Result;
use App\Http\Requests\AdminPositionRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SysAdminPower;

class PositionController extends Controller
{
    public $adminUser;
    function __construct(AdminUser $user)
    {
        $this->adminUser =  $user;
    }

    public function view(Request $request){
        $id=$request->get('id',0);
        if($id!=0){
            $power = BaseSysAdminPosition::find($id);
            $power->powerid = explode('|',$power->powerid);
        }else{
            $power = new BaseSysAdminPosition();
        }
        $dp_name =BaseSysAdminDepartment::all('id','dp_name');
        $power_name = BaseSysAdminPower::all('id','pname','parent_id');

        $sysAdminPower_model = new SysAdminPower();
        $getTree = $sysAdminPower_model->getTree($power_name);

        $powerid = $power->powerid ? array_filter($power->powerid) : '';

        $data = [
            'info' => $power,
            'dp_name' => $dp_name,
            'power_name' => $power_name,
            'position_rule' => $getTree,
            'powerid' => $powerid,
        ];
        return view("admin.position_view",$data);
    }

    public function list(){
        return view("admin.position_list");
    }




    public function getListData(){
        $list  =  BaseSysAdminPosition::select('sys_admin_position.*','sys_admin_department.dp_name')
            ->leftjoin('sys_admin_department','sys_admin_department.id','=','sys_admin_position.department_id')->where('sys_admin_position.id','>',0);
        $datatable = DataTables::eloquent($list);
        log::error("base信息=======".json_encode($datatable));
        return $datatable->make(true);
    }
    public function powerName($powerid){
        $power_names ="";
        foreach ($powerid as $k=>$v){
            $power_name =BaseSysAdminPower::find($v);
            $power_names .=$power_name->pname.",";
        }
        return $power_names;
    }
    public function save(AdminPositionRequest $request){
        // Log::error("====input===>",json_encode(Input::all()));
        $result =new Result();
        if($request->ajax()) {
            try {
                if($request->id>0){
                    $power  = BaseSysAdminPosition::find($request->id);
                }else{
                    $power  = new BaseSysAdminPosition();
                }
                $power->fill(Input::all());
                $power->save();
                $result->msg = "操作成功";
                $result->code =  Constant::OK;
            } catch (\Exception $e) {
                Log::error($e);
                Log::error("==========".$e->getFile().";".$e->getLine().";".$e->getMessage());
                $result->msg  = "操作失败:".$e->getMessage();
            }
        }else{
            $result->msg  = "Invalid Request";
        }
        return response()->json($result);
    }
    public function delete(Request $request){
        $result =new Result();
        if($request->ajax()) {
            try {
                if($request->id>0){
                    BaseSysAdminPosition::find($request->id)->update(['status'=>0]);
                }
                $result->msg = "操作成功";
                $result->code =  Constant::OK;
            } catch (\Exception $e) {
                Log::error($e);
                Log::error("==========".$e->getFile().";".$e->getLine().";".$e->getMessage());
                $result->msg  = "操作失败:".$e->getMessage();
            }
        }else{
            $result->msg  = "Invalid Request";
        }
        return response()->json($result);
    }
}
