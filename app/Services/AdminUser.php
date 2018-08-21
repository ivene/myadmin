<?php
/**
 * Created by PhpStorm.
 * User: yaoyao
 * Date: 2018/6/19
 * Time: 13:47
 */

namespace App\Services;


use App\Tools\Constant;
use Illuminate\Support\Facades\Session;

class AdminUser
{
    public $id = 0;
    public $user="";

    function __construct()
    {
        $this->id  = session(Constant::ADMIN_SESSION_ID);
        $this->user = session(Constant::ADMIN_SESSION);
    }

    /**
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|int|mixed
     */
    public function getId()
    {
        $this->id  = session(Constant::ADMIN_SESSION_ID);
        return $this->id;
    }

    /**
     * @param \Illuminate\Session\SessionManager|\Illuminate\Session\Store|int|mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
        Session::put(Constant::ADMIN_SESSION_ID,$id);
    }

    /**
     * @return \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed|string
     */
    public function getUser()
    {
        $this->user = session(Constant::ADMIN_SESSION);
        return $this->user;
    }

    /**
     * @param \Illuminate\Session\SessionManager|\Illuminate\Session\Store|mixed|string $user
     */
    public function setUser($user): void
    {
        Session::put(Constant::ADMIN_SESSION,$user);
        $this->user = $user;
    }

    public function forget(){
        Session::forget(Constant::ADMIN_SESSION_ID);
        Session::forget(Constant::ADMIN_SESSION);
    }

    public function getDeptId(){
        return $this->getUser()->department_id;
    }
    public function getPosId(){
        return $this->getUser()->position_id;
    }
    public function getPosiName(){
        return $this->getUser()->posi->position_name;
    }
    public function getDpName(){
        return $this->getUser()->dept->dp_name;
    }


}