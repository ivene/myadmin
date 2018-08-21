<?php
/**
 * Created by PhpStorm.
 * User: yaoyao
 * Date: 2017/7/26
 * Time: 12:53
 */

\Validator::extend('flow_money', function ($attribute, $value, $parameters) {
    if (is_numeric($value)) {
        if ($value <= 0) {
            return false;
        }
        if ($value % 100 == 0) {
            return true;
        }
    }
    return false;
});
Validator::extend('select', function ($attribute, $value, $parameters) {
    if($value==""){
        return false;
    }elseif (is_numeric($value)) {
        if ($value > 0) {
            return true;
        }
    }elseif($value!=""){
        return true;
    }
    return false;
});
Validator::extend('zh_mobile', function ($attribute, $value, $parameters) {
    return preg_match('/^(\+?0?86\-?)?((13\d|14[57]|15[^4,\D]|17[678]|18\d)\d{8}|170[059]\d{7})$/', $value);
});

Validator::extend('password_geshi', function ($attribute, $value, $parameters) {
    $pattern = '/^(?=.*[0-9])(?=.*[a-zA-Z])/';
    if (preg_match($pattern, $value)) {
        return true;
    }
    return false;
});

Validator::extend('phone', function ($attribute, $value, $parameters) {
    $pattern = '/^(0\d{2,3}-\d{7,8})$/';
    if (preg_match($pattern, $value)) {
        return true;
    }
    return false;
});
//最多2位小数
Validator::extend('money', function ($attribute, $value, $parameters) {
    $pattern = '/^\d+(\.\d{1,2})?$/';
    if (preg_match($pattern, $value)) {
        return true;
    }
    return false;
});
Validator::extend('number', function ($attribute, $value, $parameters) {
    $pattern = '/^[0-9]*$/';
    if (preg_match($pattern, $value)) {
        return true;
    }
    return false;
});
//
Validator::extend('sms_number', function ($attribute, $value, $parameters) {
    if (is_numeric($value)) {
        if ($value <= 0) {
            return false;
        }
        if ($value % 5000 == 0) {
            return true;
        }
    }
    return false;
});