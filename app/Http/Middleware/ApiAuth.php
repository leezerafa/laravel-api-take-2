<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use Request;

class ApiAuth
{
    /**
     * Handle an incoming request for API login
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty(Request::get('user_key')) && empty(Request::get('api_key'))) {
            return response(['Error: Invalid Credentials']);
        }

        if (!$user = User::where('api_user_key',Request::get('user_key'))->first()) {
            return response(['Error: Posted User Key does not match Stored User Key']);
        }

        if (!$this->isUserActiveAndAPIKeyMatch()) {
            return response(['Error: Posted Api Key does not match Stored Api Key']);
        }

        if (!Auth::loginUsingId($user->id)) {
            return response(['Error: Authentication Failed']);            
        }
        
        return $next($request);
    }
    
    /**
     * @return bool
     */    
    private function isUserActiveAndAPIKeyMatch() : bool
    {
        return $user->is_active === 1 && ($user->api->first()->api_key == Request::get('api_key'));
    }
}
