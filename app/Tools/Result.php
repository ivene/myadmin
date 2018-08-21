<?php
/**
 * Created by PhpStorm.
 * User: yaoyao
 * Date: 16/5/22
 * Time: 11:16
 */

namespace App\Tools;

use App\Tools\Constant;
class Result
{
    public $code;
    public $msg;
    public $data;
    function __construct()
    {
        $this->code = Constant::ERROR;
        $this->msg = "处理失败";
    }
}