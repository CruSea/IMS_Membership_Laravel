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
                     return response()->json(['message' , 'Data not Found!!'], 404);
                                         }
                     $groups = new groupDetail;
                     $groups->group_id = $request-> group_id;
                     $groups->contact_id = $request-> contact_id;

                 $groups->save();
                 return response()->json(['group', $groups], 201);

                  }
// load contact list
      public  function  contactList($group_id){
          $contacts = Contact::whereNotIn('id',groupDetail::where('group_id','=', $group_id)->select('contact_id')->get() )->orderBy('id','DESC')->paginate(5);


                     $response=[
                     'contact_lists'=>$contacts
                               ];
                     return response() ->json($response,200);


//                     $contactlists = Contact::orderBy('id','DESC')->paginate(10);
//                     $response=[
//                     'contactlists'=>$contactlists
//                               ];
//                     return response() ->json($response,200);


                               }
      public  function showGroup( $group_id){
                      $showcontact = groupDetail::with('contact')->where('group_id',$group_id)->paginate(5);

                     $count = count($showcontact);
                      $response=[
                          'members'=>$showcontact,
                          'count'=> $count
                                ];
                      return response() ->json($response,200);

                        }
       public  function  removeContact($id){
                      $contactToDelete = groupDetail::find($id);
                      $contactToDelete -> delete();
                      return response()->json(['message' => 'Contact removed' ], 200);
       }


}