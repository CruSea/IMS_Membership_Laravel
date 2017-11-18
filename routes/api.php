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

// route for contact list pages
            Route:: post('/Contact-list',[
                'uses' => 'ContactController@postContact'
            ]);
            Route:: get('/Contact-list',[
                'uses' => 'ContactController@getContact'
            ]);
            Route:: put('/Contact-list/{id}',[
                'uses' => 'ContactController@putContact'
            ]);
            Route:: delete('/Contact-list/{id}',[
                'uses' => 'ContactController@deleteContact'
            ]);
 //route for contact group pages
            Route:: post('/Contact-group',[
                'uses' => 'ContactGroupController@postContactGroup'
            ]);
            Route:: get('/Contact-group',[
                'uses' => 'ContactGroupController@getContactGroup'
            ]);
            Route:: delete('/Contact-group/{id}',[
                'uses' => 'ContactGroupController@deleteContactGroup'
            ]);
 //route for contact detail pages
            Route:: post('/Contact-detail/{group_id}/{contact_id}',[
                'uses' => 'groupDetailController@addToGroup'
            ]);
            Route:: get('/Contact-detail',[
                'uses' => 'groupDetailController@contactList'
            ]);
            Route:: get('/Contact-detail/{group_id}',[
                'uses' => 'groupDetailController@showGroup'
            ]);
            Route:: delete('/Contact-detail/{contact_id}',[
                'uses' => 'groupDetailController@removeContact'
            ]);



Route:: post('/Contact-image',[
    'uses' => 'imageController@store'
]);

//Route::post('/groups/{group_id}/{contact_id}','GroupDetailController@postGroup');
//
//Route::get('/detail','GroupDetailController@showgroup');