<?php

namespace App\Http\Middleware;

use Closure;

use JWTAuth;
use App\User;
use Tymon\JWTAuth\Middleware\GetUserFromToken;
class is_Editor
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
        return app(GetUserFromToken::class)->handle($request,function($request) use ($next){
            $token = JWTAuth::getToken();
            if($token != null){
                $user = JWTAuth::toUser($token);
                if ($user != null){
//                    $user = User::where('user_id', $user->id)->first();
                    if($user instanceof User){
                        if($user->role_id <= 2  && $user->Account_status == 1){
                            return $next($request);
                        }
                        return response()->json(['error'=>'Insufficient Privilage!!'],400);
                    }
                }else{
                    return response()->json(['error'=>'User Not Found!!'],400);
                }
            }else{
                return response()->json(['error'=>'Token Not Provided!'],400);
            }
        });
    }
}
