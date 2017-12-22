<?php

namespace App\Http\Controllers;

use App\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserController extends Controller
{
    public function  __construct(){
         $this->middleware('is_Admin',['except'=>['signUserIn','getuser']]);
         $this->middleware('is_Editor',['only'=>['getUser']]);

                                          }
    public function sign_user_up(Request $request){
                   $this->validate($request, [
                             'fullname'=> 'required',
                             'username'=>'required',
                             'email'=> 'required|email|unique:users',
                             'password'=>'required|min:6',
                             'phonenumber'=>'required',
                             'role_id'=>'required'

                   ]);
                      $account_status = 0;
                      $user = new User([
                            'fullname' =>$request->input('fullname'),
                            'username' =>$request->input('username'),
                            'email' => $request->input('email'),
                            'password' =>bcrypt($request->input('password')),
                            'phonenumber' => $request->input('phonenumber'),
                            'role_id' =>$request->input('role_id'),
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
                 'email' => 'required|email',
                 'password' => 'required|min:6'
             ]);
             $credentials = $request->only('email', 'password');
//              $credentials['Account_status'] = 1;
             try {
                 if (!$token = JWTAuth::attempt($credentials)) {
                     return response()->json([ 'error' => 'Invalid Credential!' ], 401);
                 }
             } catch (JWTException $e) {
                 return response()->json([ 'error' => 'Could not Create token' ], 500);
             }
             $user = JWTAuth::toUser($token);
             if($user->Account_status){
                 return response()->json([ 'token' => $token,'user'=> $user  ], 200);
             }

        return response()->json([ 'message' => 'Account Not Activated!!' ], 200);
    }

   public function getUser(){
       $token = JWTAuth::getToken();
       $logedin_user = JWTAuth::toUser($token);
       $user = User::where('id', '!=',$logedin_user->id)->orderBy('id','DESC')->paginate(10);
       $response = [ 'users' => $user ];
       return response()->json($response, 200);
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
                  $user->role_id = $request->input('role_id');
                  $user->Account_status = $account_status;
                  $user->save();
                  return response()->json(['user'=>$user],200);
              }
   }

   public function status(Request $request , $id){
//              $logedUser = JWTAuth::toUser();

              $user = User::find($id);
//              if($user != $logedUser){

              if(!$user instanceof User){

                  return response()->json(['message'=>'Document not found'],404);
              } else {
                  $user->Account_status =  !$user->Account_status;

                  $user->update();

                  return response()->json(['user' => $user], 200);

//              }

              }
              return response()->json(['user' => 'Cant change your own status'], 200);


          }

    public function getRole(){
              $role = UserRole::all();

              $response = [
                  'roles' => $role
              ];
              return response()->json($response ,200);
          }

    public function DeleteUser($id){
        $user = User:: find($id);
        $user -> delete();
        return response() -> json (['message'=> 'User Deleted!'],200);
    }


}
