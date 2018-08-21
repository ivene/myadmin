<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AdminPower;
use App\Http\Requests\AdminPowerRequest;
use App\Models\Base\BaseSysAdminPower;
use App\Services\AdminUser;
use App\Tools\Constant;
use App\Tools\Result;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class PowerController extends Controller
{
    public $adminUser;
    function __construct(AdminUser $user)
    {
        $this->adminUser =  $user;
    }

    public function view(Request $request){
        $id=$request->get('id',0);
        if($id!=0){
            $power = BaseSysAdminPower::find($id);
        }else{
            $power = new BaseSysAdminPower();
            if ($request->pid > 0){
                $power->parent_id = $request->pid;
                $data['pname'] =BaseSysAdminPower::select('id','pname')->where('parent_id',0)->get();

            }
        }
        $data['id']=$id;
        $data['pname'] =BaseSysAdminPower::select('id','pname')->where('parent_id',0)->get();
        $data['info']=$power;
        return view("admin.power_view",$data);
    }

    public function list(Request $request){
        $id=$request->get('id',0);
        if($id!=0){
            $power = BaseSysAdminPower::find($id);
        }else{
            $power = new BaseSysAdminPower();
        }
        $data['info']=$power;
        return view("admin.power_list",$data);
    }
    public function getListData(){
        $list  =  BaseSysAdminPower::where('id','>',0);
        $datatable = DataTables::eloquent($list);
        return $datatable->make(true);
    }

    public function save(AdminPowerRequest $request){
        $result =new Result();
        if($request->ajax()) {
            try {
                if($request->id>0){
                    $power  = BaseSysAdminPower::find($request->id);
                }else{
                    $power  = new BaseSysAdminPower();
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
                   BaseSysAdminPower::find($request->id)->update(['status'=>0]);
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
