<?php

namespace App\Http\Middleware;

use App\Tools\Constant;
use Closure;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class SmsAuth

{
    /**
     * Handle an incoming request.
     *
     * @param  \illuminate\http\request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $referer = $request->server('HTTP_REFERER','');
        $remoteip = $request->getClientIp();
        $appurl =  config('app.url');
        $appurl =  substr($appurl,4);
        $remoteip =  md5($remoteip."Sms_ip_Session");
        if(!Cache::has($remoteip)){
            Cache::put($remoteip,0,1);
        }
        Log::error("SMS Middleware =  appurl=".$appurl.";remoteip=".$request->getClientIp());

        Cache::increment($remoteip,1);
        if(empty($referer) || !strstr($referer,$appurl)){
            Log::error("SMS Middleware =  appurl=".$appurl.";");
            Log::error("SMS Middleware =  referer=".$referer."; clientip=".$remoteip);
            return response()->json(['code'=>Constant::ERROR,'msg'=>'Bad Request!'],411);
        }else if(Cache::get($remoteip) >10){
            Log::error("SMS Middleware ".$request->getClientIp()."=".Cache::get($remoteip));
            return response()->json(['code'=>Constant::ERROR,'msg'=>'Too Many Request!'],411);
        }
        return $next($request);
    }
}
