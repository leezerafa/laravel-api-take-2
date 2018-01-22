<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
use Request;

class ApiAuth
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
        
        if(!empty(Request::get('user_key')) && !empty(Request::get('api_key'))){      

            $user = User::where('api_user_key',Request::get('user_key'))->first();

            if($user){
                if($user->is_active === 1){
                    if($user->api->first()->api_key == Request::get('api_key')){

                        if(Auth::loginUsingId($user->id)){
                            return $next($request);
                        }
                        else
                        {
                            return response(['Error: Authentication Failed']);
                        }
                    }
                    else{
                        return response(['Error: Posted Api Key does not match Stored Api Key']);
                    }
                }
                else{
                    return response(['Error: User is no longer active']);
                }

            }
            else{
                return response(['Error: Posted User Key does not match Stored User Key']);
            }
        }
        else
        {
            return response(['Warning: Invalid Credentials']);
        }
    }
}