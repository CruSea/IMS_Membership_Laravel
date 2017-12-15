<?php

namespace App\Http\Controllers;

use App\groupDetail;
use Illuminate\Http\Request;
use App\ContactGroup;
class ContactGroupController extends Controller
{

    public function  __construct(){
        $this->middleware('is_Admin',['except'=>['postContactGroup','getContactGroup','deleteContactGroup']]);
        $this->middleware('is_Editor',['except'=>['getContactGroup']]);
    }
    public function postContactGroup(Request $request){
        $contactgroup = new ContactGroup();
        $contactgroup->groupname = $request -> input('groupname');
        $contactgroup->discription = $request -> input('discription');

        $contactgroup -> save();
        return response() ->json(['contact'=> $contactgroup,201]);
    }

    public function getContactGroup(){

        $contactgroup = ContactGroup::all();

//        $contacts = groupDetail::whereIn('group_id',$contactgroup->id)->select('contact_id')->get();
//
//        $count = count($contacts);

        $response=[
            'contactgroup'=>$contactgroup
        ];
        return response() ->json($response,200);
    }
//    public function group_contact_count(){
//         $contact_count = groupDetail::all();
//         return $contact_count->count();
//    }
    public function deleteContactGroup($id){
        $contactgroup = ContactGroup:: find($id);
        $contactgroup -> delete();
        return response() -> json (['message'=> 'Group Deleted!'],200);
     }


}
