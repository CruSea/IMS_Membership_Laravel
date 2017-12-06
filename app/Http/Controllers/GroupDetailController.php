<?php

namespace App\Http\Controllers;
use App\ContactGroup;
use App\groupDetail;
use App\Contact;
use Illuminate\Http\Request;


class GroupDetailController extends Controller
{
    public function  __construct(){
        $this->middleware('is_Admin',['except'=>['addToGroup','contactList','showGroup','removeContact']]);
        $this->middleware('is_Editor',['except'=>['showGroup']]);
    }
// Get Contact lists
      public function addToGroup( Request $request, $group_id, $contact_id){
                     $group = ContactGroup::find($group_id)->first();
                     $contact = Contact::find($contact_id)->first();
                 if(!$contact && !$group){
                     return response()->json(['message' , 'failed to load data'], 404);
                                         }
                     $groups = new groupDetail;
                     $groups->group_id = $request-> group_id;
                     $groups->contact_id = $request-> contact_id;
                     $groups->save();
                     return response()->json(['group', $groups], 201);}
// load contact list
      public  function  contactList(){
                     $contactlists = Contact::all();
                     $response=[
                     'contactlists'=>$contactlists
                               ];
                     return response() ->json($response,200);
                               }
      public  function showGroup( $group_id){
                      $showcontact = groupDetail::with('contact')->where('group_id',$group_id)->get();
                      $response=[
                          'groupmembers'=>$showcontact
                                ];
                      return response() ->json($response,200);

                        }
       public  function  removeContact($contact_id){
                      $contactToDelete = groupDetail:: find($contact_id);
                      $contactToDelete-> delete();
                      return response() ->json(['message' => ' Contact removed' ], 201);
       }
}