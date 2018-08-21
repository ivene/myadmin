<?php
/**
 * Created by PhpStorm.
 * User: yangzailong
 * Date: 2018/6/5
 * Time: 下午3:01
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Base\BaseSysMedia;
use App\Models\SysAdminUser;
use App\Services\AdminUser;
use App\Services\SysMediaBuild;
use App\Tools\Result;
use App\Tools\Constant;
use App\Models\Base\BaseSysAdminUser;
//use APP\Models\Base\BaseSysAdminUser;
use App\Models\Base\BaseSysAdminDepartment;
use App\Models\Base\BaseSysAdminPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\AdminUserRequest;

class UserController extends Controller
{
    public $adminUser;
    public $fb;

    function __construct(AdminUser $user,SysMediaBuild $fb)
    {
        $this->adminUser =  $user;
        $this->fb =$fb;
    }

    public function list(Request $request){
        $id=$request->get('id',0);
        if($id!=0){
            $department = BaseSysAdminUser::find($id);
        }else{
            $department = new BaseSysAdminUser();
        }
        $data['info']=$department;
        if($this->adminUser->getPosId()!=1){
            $data['dp_name']= BaseSysAdminDepartment::select('id','dp_name')->where('id','>',1)->get();
            $data['pt_name'] =BaseSysAdminPosition::select('id','position_name')->where('id','>',1)->get();
        }else{
            $data['dp_name']= BaseSysAdminDepartment::all('id','dp_name');
            $data['pt_name'] =BaseSysAdminPosition::all('id','position_name');
        }

        return view('admin.user_list',$data);
    }
    public function getListData(){
        $list = SysAdminUser::select('id','uname','email','tel','department_id','position_id','status')
            ->with(['dept'=>function($query){
                $query->select('id','dp_name');
            }])
            ->with(['posi'=>function($query){
                $query->select('id','position_name');
            }]);
        if($this->adminUser->getPosId()!=1){
            $list->where('position_id','!=',1);
        }
        $datatable =DataTables::eloquent($list);
        return $datatable->make(true);
    }

    public function view(Request $request){
        $id=$request->get('id',0);
        if($id!=0){
            $department = BaseSysAdminUser::find($id);
        }else{
            $department = new BaseSysAdminUser();
        }
        $dp_name= BaseSysAdminDepartment::all('id','dp_name');
        $pt_name =BaseSysAdminPosition::all('id','position_name');
      //  Log::error('=====>>>>部门 职位信息',json_encode($data));
        return view("admin.user_view",['info'=>$department,'dp_name'=>$dp_name,'pt_name'=>$pt_name]);
    }

    public function save(AdminUserRequest $request){
        Log::error("=====save===".json_encode($request->all()));
        $result =new Result();
        if($request->ajax()) {
            try {
                if($request->id>0){
                    $user  = BaseSysAdminUser::find($request->id);
                }else{
                    $user  = new BaseSysAdminUser();
                }
                $user->fill(Input::all());

                if($request->pwd!=""){
                    $user->pwd = Hash::make($request->pwd);
                }
                $user->login_name = $request->login_name;
                $user->save();
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
                    BaseSysAdminUser::find($request->id)->update(['status'=>0]);
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
    /**
     * 头像管理
     */
    public function userImg_edit(){

        $user_id = $this->adminUser->getId(); // 用户ID
        $user=BaseSysAdminUser::find($user_id);
  //      $ids=$this->fb->getImgIds($user_id);
        $user->imginfo =  $this->fb->getDataByIds(0);
        $data['info'] =  $user;
        return view('admin.edit',$data);
    }
    /**
     * 头像展示
     */
    public function userImg_list(){
        return view('admin.head_portrait');
    }
    public function getSysMediaDatas(){
        $list  =  BaseSysMedia::where('id','>',0);
        $datatable = DataTables::eloquent($list);
        return $datatable->make(true);
    }
    /**
     * 头像修改
     */

    public function userImg_save(Request $request){
        $result =new Result();
        if($request->ajax()) {
            try {
                $user_id =$this->adminUser->getId();
                BaseSysAdminUser::find($user_id)->update(['avatr'=>$request->id]);
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
    /**
     * 用户资料
     */
    public function brief_list(){
        return view('admin.set');
    }
    /**
     * 修改资料
     */
    public function brief_save(Request $request){
        Log::error("===ssss=====".json_encode($request->all()));
        $result =new Result();
        if($request->ajax()) {
            try {

                $power  = BaseSysAdminUser::find($request->id);
                Log::error("===power=====".json_encode($power));
                if ($power->password == $request->password){
                    BaseSysAdminUser::find($request->id)->update(['password'=>$request->newpassword]);
                    $result->msg = "操作成功";
                    $result->code =  Constant::OK;
                }else{
                    $result->msg  = "操作失败";
                }
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
