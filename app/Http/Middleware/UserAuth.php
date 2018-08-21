<?php

namespace App\Http\Middleware;

use App\Services\AdminUser;
use App\Services\CECUser;
use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = new  CECUser();
        $uid  =  $user->getId();
//        Log::error("===============MiddleWare uid".$uid);
        if(!$uid){
//            Redirect::guest($request->url());
            return Redirect::to(URL::action("CecUserController@getLogin"));
        }
        return $next($request);
    }
}
