<?php

namespace App\Http\Middleware;

use App\Services\AdminUser;
use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class AdminAuth
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
        $adminUser = new  AdminUser();
        $uid  =  $adminUser->getId();
        if(!$uid){
            Redirect::guest($request->url());
            return Redirect::to(URL::action("Admin\AdminController@loginView"));
        }
        return $next($request);
    }
}
