<?php
/**
 * Created by PhpStorm.
 * User: yaoyao
 * Date: 2017/9/12
 * Time: 11:44
 */

namespace App\Services;

use App\Tools\Constant;
use App\Tools\HttpRequest;
use App\Tools\Result;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Facades\Log;

class MessageService
{
    use DispatchesJobs;


    public function sendSms($country,$mobile,$code,$type='regisger')
    {
        $result = new Result();
        $sendinfo = array();
        $sendinfo['to'] = urlencode($mobile);
        if($country == "cn"){
            if(strpos($mobile,"+86") !== false){
                $sendinfo['to'] = substr($mobile,3,11);
            }
            $url = "https://api.mysubmail.com/message/xsend";
            $sendinfo['appid'] = "23962";
            $sendinfo['signature'] = "5ce41acf593285e31db1a5c9ad6e9cf7";
            if($type == "register"){
                $sendinfo['project'] = 'fMge11';
            }elseif($type == "resetpwd"){
                $sendinfo['project'] = 'CfVpg1';
            }
        }else{
            $url = "https://api.mysubmail.com/internationalsms/xsend";
            $sendinfo['appid'] = "60273";
            $sendinfo['signature'] = "2d080b15b385fb11b600e5e2cbdee528";
            if($type == "register"){
                $sendinfo['project'] = 'PSjG31';
            }elseif($type == "resetpwd"){
                $sendinfo['project'] = 'LGYAF2';
            }
        }
        $sendinfo['vars'] = json_encode(array('code'=>$code,'time'=>2));
//        Log::error("发送短信=$url =SendData=".json_encode($sendinfo));
        $send_str=HttpRequest::post($url,$sendinfo);
        Log::error("发送短信==Result=$mobile=".json_encode($send_str));
        if($send_str!=""){
            $sendresult  = json_decode($send_str,true);
            $result->data = $sendresult;
            if($sendresult['status']=='success'){
                $result->code = Constant::OK;
                $result->msg = '短信发送成功';
            }
        }

        return $result;
    }

    public function addMsg($types,$uids,$title,$content,$url="#",$senduid="-1"){
        foreach($types as $type){
            foreach($uids as $uid){
                $msg  = new SysMessage();
                $user  =  SpUser::find($uid);
                $msg->uid  = $user->spuid;
                $msg->openid =  $user->payopenid;
                $msg->iphone = $user->iphone;
                $msg->msg_title = $title;
                $msg->msg_content = $content;
                $msg->msg_type = $type;
                $msg->mstatus =0;
                $msg->templeteid = 'jrJ3kb99_9Y5vcQx9OmHoBpqISAigozCeFfJiSif54Y';
                $msg->senduid = $senduid;
                $msg->link_url = $url;
                $msg->save();
                if($type=='WX' || $type=='SMS'){
                    $job  =  (new MessageJob($msg->id));
                    $this->dispatch($job);
                }
            }
        }
        return true;
    }
}