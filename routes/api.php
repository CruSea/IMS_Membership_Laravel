<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



//log user in
    Route:: post('/signin',[ 'uses' => 'UserController@signUserIn' ]);
    Route:: put('/password',[ 'uses' => 'Change_PasswordController@change_password' ]);
//routes for user registering
    Route:: post('/signup',[ 'uses' => 'UserController@sign_user_up' ]);
    Route:: get('/signup',[ 'uses' => 'UserController@getUser' ]);
    Route:: get('/role',[ 'uses' => 'UserController@getRole' ]);
    Route:: put('/signup/{id}',[ 'uses' => 'UserController@updateUser' ]);
    Route:: put('/status/{id}',[ 'uses' => 'UserController@status' ]);
    Route:: delete('/signup/{id}',[ 'uses' => 'UserController@DeleteUser' ]);
// route for contact list pages

   Route::group(['middleware' => 'auth.jwt'], function () {
    Route:: post('/Contact-list', [ 'uses' => 'ContactController@postContact' ]);
    Route:: get('/Contact-list', [ 'uses' => 'ContactController@getContact' ]);
    Route:: put('/Contact-list/{id}', [ 'uses' => 'ContactController@putContact' ]);
    Route:: delete('/Contact-list/{id}', [ 'uses' => 'ContactController@deleteContact' ]);
   });
 //route for contact group pages
   Route::group(['middleware' => 'auth.jwt'], function (){
    Route:: post('/Contact-group',[ 'uses' => 'ContactGroupController@postContactGroup' ]);
    Route:: get('/Contact-group',[ 'uses' => 'ContactGroupController@getContactGroup' ]);
    Route:: delete('/Contact-group/{id}',[ 'uses' => 'ContactGroupController@deleteContactGroup' ]);
  });

//route for contact detail
  Route::group(['middleware' => 'auth.jwt'], function () {
    Route:: get('/Contact-detail/{group_id}/{contact_id}', [ 'uses' => 'groupDetailController@addToGroup' ]);
    Route:: get('/Contact-show/{id}', [ 'uses' => 'groupDetailController@contactList' ]);
    Route:: get('/Contact-detail/{group_id}', [ 'uses' => 'groupDetailController@showGroup', 'middleware'=>'is_Viewer' ]);
    Route:: delete('/Contact-detail/{id}', [ 'uses' => 'groupDetailController@removeContact' ]);
    Route:: post('/Contact-image', [ 'uses' => 'imageController@store' ]);
  });
//message routes
Route::group(['middleware' => 'auth.jwt'], function () {
   Route:: get('/groups',[ 'uses'=>'MessageController@getGroup' ]);
   Route:: get('/group-message',[ 'uses'=>'MessageController@get_group_message' ]);
   Route:: post('/group-message',[ 'uses'=>'MessageController@send_group_message' ]);
   Route:: post('/contact-message',[ 'uses'=>'MessageController@send_contact_message' ]);

   Route:: get('/contact-message',[ 'uses'=>'MessageController@get_contact_message' ]);
   Route:: delete('/group-message/{id}',[ 'uses'=>'MessageController@DeleteGroupMessage' ]);
   Route:: delete('/contact-message/{id}',[ 'uses'=>'MessageController@DeleteContactMessage' ]);
});
// dashboard routes
Route::group(['middleware' => 'auth.jwt'], function () {
        Route:: get('/contact_count',[ 'uses'=>'DashboardController@get_contact_number' ]);
        Route:: get('/sent_count',[ 'uses'=>'DashboardController@sent_messages' ]);
        Route:: get('/received_count',[ 'uses'=>'DashboardController@recieved_messages' ]);
        //Route:: get('/member_count',[ 'uses'=>'ContactGroupController@group_contact_count' ]);
});