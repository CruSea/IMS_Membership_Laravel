<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserController extends Controller
{

   public function sign_user_up(Request $request){



                   $this->validate($request, [
                             'fullname'=> 'required',
                             'username'=>'required',
                             'email'=> 'required|email|unique:users',
                             'password'=>'required',
                             'phonenumber'=>'required',
                             'user_privilage'=>'required'
                   ]);
                          $account_status = 0;
                      $user = new User([

                            'fullname' =>$request->input('fullname'),
                            'username' =>$request->input('username'),
                            'email' => $request->input('email'),
                            'password' =>bcrypt($request->input('password')),
                            'phonenumber' => $request->input('phonenumber'),
                            'user_privilage' =>$request-> input('user_privilage'),
                            'Account_status' =>$account_status
                   ]);
                   $user-> save();
                   return response()->json([
                         'message' =>'User created Successfully!'
                       ],201);
           }
  //Sign User In
    public  function signUserIn(Request $request){
                 $this->validate($request, [
                    'email'=> 'required|email',
                    'password'=>'required'
                  ]);
                 $credentials = $request->only('email','password');
                 try{
                    if (!$token = JWTAuth::attempt($credentials)){
                        return response()->json([
                            'error'=>'Invalid Credential!'
                        ],401);
                    }
                 }catch (JWTException $e){
                      return response()->json([
                          'error'=>'Could not Create token'
                      ],500);
                 }
                  return response()->json([
                      'token'=> $token
                  ],200);
    }

   public function getUser(){
          $user = User::all();

          $response = [
              'users' => $user
          ];
          return response()->json($response ,200);
   }

   public  function  updateUser(Request $request, $id){
              $user = User::find($id);

              if(!$user instanceof User){

                  return response()->json(['message'=>'Document not found'],404);
              } else
              {
                  $account_status = 0;
                  $user-> fullname = $request->input('fullname');
                  $user->username = $request->input('username');
                  $user->email = $request->input('email');
                  $user->password = bcrypt($request->input('password'));
                  $user->phonenumber = $request->input('phonenumber');
                  $user->user_privilage = $request->input('user_privilage');
                  $user->Account_status = $account_status;

                  $user->save();

                  return response()->json(['user'=>$user],200);

              }


   }


}
