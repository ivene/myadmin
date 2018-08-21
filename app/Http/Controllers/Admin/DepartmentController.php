<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminDepartmentRequest;
use App\Models\Base\BaseSysAdminPower;
use App\Services\AdminUser;
use App\Tools\Result;
use App\Tools\Constant;
use App\Models\Base\BaseSysAdminDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Models\SysAdminPower;

class DepartmentController extends Controller
{
    public $adminUser;

    function __construct(AdminUser $user)
    {
        $this->adminUser =  $user;
    }
    public function list(){
        $power_name = BaseSysAdminDepartment::select('id','dp_name','parent_id')
            ->where('parent_id','!=','-1')->get();
        $getTree = $this->getTree($power_name);
        $data['department_rule'] = $getTree;
        return view('admin.department_list',$data);
    }
    public function getTree($data, $pId=0) {
        $tree = [];
        foreach($data as $k => $v) {
            if($v->parent_id == $pId) {
                $childs = $this->getTree($data, $v->id);
                $v = [
                    'id' => $v->id,
                    'dp_name' => $v->dp_name,
                    'pid' => $v->parent_id,
                    'child'=> $childs
                ];
                $tree[] = $v;
            }
        }
        return $tree;
    }


    public function getListData(){
        $list = BaseSysAdminDepartment::where('id','>',0);
        Log::error("=================登陆用户部门编号======".$this->adminUser->getDeptId());
        if($this->adminUser->getPosId() != 1){
            $list->where('id','!=',1);
        }
        $datatable =DataTables::eloquent($list);
        return $datatable->make(true);
    }
    public function view(Request $request){
        $id=$request->get('id',0);

        if (empty($request->level)){
            $data['level'] = 0;
        }else{
            $data['level'] =$request->level;
        }
        if (empty($request->parent_id)){
            $data['parent_id'] = 0;
        }else{
            $data['parent_id'] =$request->parent_id;
        }
        if($id!=0){
            $department = BaseSysAdminDepartment::find($id);
            $department->powerid = explode('|',$department->powerid);
        }else{
            $department = new BaseSysAdminDepartment();
            if($request->pid>0){
                $data['dp_name'] = BaseSysAdminDepartment::all('id','dp_name');
                $department->pid = $request->pid;
            }
        }

        $power_name = BaseSysAdminPower::all('id','pname','parent_id');
        $data['power_name']  = $power_name;

        $data['info'] = $department;
        $powerid = $department->powerid ? array_filter($department->powerid) : '';
        $data['powerid'] = $powerid;

        $sysAdminPower_model = new SysAdminPower();
        $getTree = $sysAdminPower_model->getTree($power_name);
        $data['department_rule'] = $getTree;



        return view("admin.department_view",$data);
    }

    public function save(AdminDepartmentRequest $request){
        Log::error("====================".json_encode(Input::all()));
        $result =new Result();
        if($request->ajax()) {
            try {
                if($request->id>0){
                    $power  = BaseSysAdminDepartment::find($request->id);
                }else{
                    $power  = new BaseSysAdminDepartment();
                }
                Log::error("====================".json_encode($request->powerid));
                $power->fill(Input::all());
                $power->save();
                Log::error("=========power===========".json_encode($power));
                Log::error("=========level===========".json_encode($request->level));
                if($request->level == 0){
                    $power->root_id = $power->id;
                    $power->path = "|".$power->id."|";
                    $power->level = 1;
                }else{
                    $parent  =  BaseSysAdminDepartment::find($request->parent_id);
                    Log::error("=========parent===========".json_encode($parent));
                    $power->root_id = $parent->root_id;
                    $power->path = $parent->path.$power->id."|";
                    $power->level = $parent->level+1;
                }
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
                    BaseSysAdminDepartment::find($request->id)->update(['status'=> 0]);
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