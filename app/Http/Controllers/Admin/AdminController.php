<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Base\BaseCecUser;
use App\Models\Base\BaseSysAdminDepartment;
use App\Models\Base\BaseSysAdminPosition;
use App\Models\Base\BaseSysAdminUser;
use App\Models\Base\BaseSysMedia;
use App\Models\SysAdminPower;
use App\Models\SysAdminUser;
use App\Services\AdminUser;
use App\Services\SysMediaBuild;
use App\Tools\Constant;
use Carbon\Carbon;
use function foo\func;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Tools\Result;
/**
 * Created by PhpStorm.
 * User: yaoyao
 * Date: 18/3/31
 * Time: 16:35
 */
class AdminController extends Controller{
    private $uid=0;
    private $fb;
    private $user;
    public function __construct(SysMediaBuild $fb,AdminUser $user)
    {
        $this->adminUser =  $user;
        $this->fb = $fb;
        $this->user =  $user;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @description 主页
     * @auther YaoYao
     */
    public function index(){


        return view('master.adminhome');


    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @description 登陆
     * @auther YaoYao
     */
    public function loginView(){
        return view('login');
    }
    public function getLogin(){
        return view('Admin.login');
    }
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @description 登陆
     * @auther YaoYao
     */
    public function login(Request $request){
        $result =new Result();
        if($request->ajax()) {
            try {
                $name = Input::get('name');
                $user =  BaseSysAdminUser::where('login_name',$name)->where('status',1)->first();
                if(!empty($user)){
                    if(Hash::check($request->get('password'),$user->pwd)){
                        $this->adminUser->setId($user->id);
                        $userInfo = SysAdminUser::where('id',$user->id)
                            ->with(['dept'=>function($query){
                                $query->select('id','dp_name');
                            }])
                            ->with(['posi'=>function($query){
                                $query->select('id','position_name');
                            }])->first();
                        unset($userInfo->pwd);
                        unset($userInfo->login_name);
                        $this->adminUser->setUser($userInfo);

                        Session::forget("ACTIVE_MAINMENU");
                        Session::forget("ACTIVE_SUBMENU");
                        $result->code = Constant::OK;
                        $result->msg = "登录成功！";
                    }else{
                        $result->msg = "密码不正确";
                    }
                }else{
                    $result->msg  = "账号不存在";
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
    /**
     * 退出登录
     * @return array
     */
    public function logout(){
        $this->adminUser->forget();
        return view("login");
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @description 账号设置
     * @auther YaoYao
     */
    public function getSet(){
        $account = BaseSysAdminUser::find($this->uid);
        $data['info'] =  $account;
        $data['img'] =  $this->fb->buildFileDataByUrl($account->img);
        $data['msg'] = '';
        return view('Admin.set',$data);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @description 更新资料
     * @auther YaoYao
     */
    public function anyUpdate(Request $request){
        $result =new Result();
        if($request->ajax()) {
            try {
                $account = BaseSysAdminUser::find($this->uid);
                if(!empty($account)){
                    $pwd = Input::get("pwd");
                    $newpwd = Input::get("newpwd");
                    $flag  = true;
                    if(Input::get("pwd")!="" && $newpwd!=""){
                        if($account->pwd == md5($pwd)){
                            $account->pwd=md5($newpwd);
                        }else{
                            $flag  = false;
                            $result->msg  = "操作失败:原密码输入错误";
                        }
                    }
                    if($flag){
                        $account->avata = $this->fb->getUrl(Input::get("img"));
                        $account->uname =  Input::get("uname");
                        $account->save();
                        $result->code = Constant::OK;
                        $result->msg  = "操作成功";
                    }
                }else{
                    $result->msg  = "操作失败:参数缺失";
                }
            } catch (\Exception $e) {

                $result->msg  = "操作失败:".$e->getMessage();
            }
        }else{
            $result->msg  = "Invalid Request";
        }
        return response()->json($result);
    }

    public function getDoc(){
        return view('Admin.doc');
    }
    public function getWelcome(){
        return view('Admin.welcome');
    }
    public static function leftMenu(){
        $actions = explode('\\',\Route::current()->getActionName());
        $action = end($actions);

        $leftMenu=null;
        $userInfo  = Session::get(Constant::ADMIN_SESSION);
        if(is_null($userInfo)){
            $leftMenu=null;
        }else{
            $allpower =  SysAdminPower::where('status',1)
                ->orderBy('pindex','asc')
                ->get();
            $position = BaseSysAdminPosition::find($userInfo['position_id']);
            $roleinfo = BaseSysAdminDepartment::find($userInfo['department_id']);
            $mypower  =  $position->powerid.$roleinfo->powerid;
            $main_active = 0;
            $sub_action=0;
            foreach($allpower as $power){
                $power->active="";
                if(strpos($power->purl,$action)!==false){
                    $main_active = $power->parent_id;
                    $sub_action=$power->id;
                }
                if (strpos($mypower,'ALL')!==false) {//含有所有的权限
                    $leftMenu[$power->parent_id][$power->id] = $power->toArray();
                }else{
                    $mypowerid =  preg_split("/\\|/",$mypower);
                    foreach($mypowerid as $id){
                        if($power->id == $id){
                            $leftMenu[$power->parent_id][$power->id] = $power->toArray();
                        }
                    }
                }
            }
            if($main_active==0 && $sub_action ==0){
                $main_active =  Session::get("ACTIVE_MAINMENU",0);
                $sub_action =  Session::get("ACTIVE_SUBMENU",0);
            }else{
                Session::put("ACTIVE_MAINMENU",$main_active);
                Session::put("ACTIVE_SUBMENU",$sub_action);
            }
            if($main_active!=0 && $sub_action !=0){
                $leftMenu[0][$main_active]['active'] = "active";
                $leftMenu[$main_active][$sub_action]['active'] = "active";
            }
         //   Session::put(Constant::$SESSION_ROLE,$roleinfo->rolename);
        }
//        Log::error("==MYMENU===".json_encode($leftMenu));
        return $leftMenu;
    }
    /**
     * 重设密码
     * 输入手机号 和旧密码  新密码 重新设置密码
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @description 暂时无需实现
     * @auther YaoYao
     */
    public function getResetPwd(){
        return  view('Admin.resetpwd');
    }

    /**
     * 忘记密码
     * 输入手机号 和验证码  新密码 重新设置密码
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @description 暂时无需实现
     * @auther YaoYao
     */
    public function getForgetPwd(){
        return view('Admin.forget');
    }
}