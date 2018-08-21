<?php
/**
 * Created by PhpStorm.
 * User: yaoyao
 * Date: 16/4/13
 * Time: 14:44
 */

namespace App\Tools;


use Illuminate\Support\Facades\Config;

class HttpRequest
{
    public static function post($url,$params){
        $params_str="";
        foreach ($params as $key => $value){
            $params_str.=$key."=".$value."&";
        }
        $params_str = substr($params_str,0,strlen($params_str)-1);
        return  self::PostHttp($url,$params_str);
    }

    private static function PostHttp($url,$post_string){

        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST,1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
            $result = curl_exec($ch);
            curl_close($ch);
        } else {
            $context =
                array('http' =>
                    array('method' => 'POST',
                        'header' => 'Content-type: application/x-www-form-urlencoded'."\r\n".
                            'User-Agent: Xiaoshuo API PHP5 Client 1.1 '."\r\n".
                            'Content-length: ' . strlen($post_string),
                        'content' => "$post_string"));
            $contextid=stream_context_create($context);
            $sock=fopen($url, 'r', false, $contextid);
            if ($sock) {
                $result='';
                while (!feof($sock))
                    $result.=fgets($sock, 4096);
                fclose($sock);
            }
        }

        return $result;
    }
}