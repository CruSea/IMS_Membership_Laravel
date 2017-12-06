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
            Route:: post('/signin',[
                'uses' => 'UserController@signUserIn'
            ]);
            Route:: put('/status/{id}',[
                'uses' => 'UserController@status'
            ]);
            Route:: get('/signup',[
                'uses' => 'UserController@getRole'
            ]);

//routes for user registering
            Route:: post('/signup',[
                'uses' => 'UserController@sign_user_up'
            ]);
            Route:: get('/signup',[
                'uses' => 'UserController@getUser'

            ]);
            Route:: put('/signup/{id}',[
                'uses' => 'UserController@updateUser'
            ]);
// route for contact list pages
            Route::group(['middleware' => 'auth.jwt'], function () {
                Route:: post('/Contact-list', [
                    'uses' => 'ContactController@postContact'
                ]);
                Route:: get('/Contact-list', [
                    'uses' => 'ContactController@getContact'
                ]);
                Route:: put('/Contact-list/{id}', [
                    'uses' => 'ContactController@putContact'
                ]);
                Route:: delete('/Contact-list/{id}', [
                    'uses' => 'ContactController@deleteContact'
                ]);
            });
 //route for contact group pages
        Route::group(['middleware' => 'auth.jwt'], function (){
                Route:: post('/Contact-group',[
                    'uses' => 'ContactGroupController@postContactGroup'
                ]);
                Route:: get('/Contact-group',[
                    'uses' => 'ContactGroupController@getContactGroup'

                ]);
                Route:: delete('/Contact-group/{id}',[
                    'uses' => 'ContactGroupController@deleteContactGroup'
                ]);

            });


 //route for contact detail
            Route::group(['middleware' => 'auth.jwt'], function () {
                Route:: post('/Contact-detail/{group_id}/{contact_id}', [
                    'uses' => 'groupDetailController@addToGroup'
                ]);
                Route:: get('/Contact-detail', [
                    'uses' => 'groupDetailController@contactList'
                ]);
                Route:: get('/Contact-detail/{group_id}', [
                    'uses' => 'groupDetailController@showGroup',
                    'middleware'=>'is_Viewer'
                ]);
                Route:: delete('/Contact-detail/{contact_id}', [
                    'uses' => 'groupDetailController@removeContact'
                ]);
                Route:: post('/Contact-image', [
                    'uses' => 'imageController@store'
                ]);
            });

