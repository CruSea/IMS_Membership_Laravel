<?php

namespace App\Http\Controllers;


use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use JWTAuth;
class Change_PasswordController extends Controller
{
    public function change_password(Request $request){
        $this->validate($request, [
            'current_password'=> 'required',
            'new_password'=> 'required',
            'confirm_password'=> 'required|same:new_password',
        ]);

         $data = $request->all();

        $token = JWTAuth::getToken();
        $user = JWTAuth::toUser($token);

        if(!Hash::check($data['current_password'] , $user->password)){
            return response()->json(['message'=>' password do not match!' ]);
        }

        $user->password = Hash::make($data['new_password']);
        $user->save();

        return response()->json(['message'=>' password Changed Successfully!!']);

    }
}
