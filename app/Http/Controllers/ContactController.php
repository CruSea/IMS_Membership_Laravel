<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{


    public function postContact(Request $request){

        if ($request->hasFile('name')) {
            $filnameWithExt = $request->file('name')->getClientOriginalName();

            $filename = pathinfo($filnameWithExt, PATHINFO_FILENAME);

            $extension = $request->file('name')->getClientOriginalExtension();

            $fileNameToStore = $filename.'_'. time().'.'. $extension;

            $path = $request->file('name')->storeAs('/public/contact_images', $fileNameToStore);
        } else {
            $fileNameToStore = "noimage.jpg";
        }
         $contact = new Contact();
         $contact->firstname = $request -> input('firstname');
         $contact->middlename = $request -> input('middlename');
         $contact->lastname = $request -> input('lastname');
         $contact->sex = $request -> input('sex');
         $contact->age = $request -> input('age');
         $contact->region = $request -> input('region');
         $contact->wereda = $request -> input('wereda');
         $contact->kebele = $request -> input('kebele');
         $contact->housenumber = $request -> input('housenumber');
         $contact->officenumber = $request -> input('officenumber');
         $contact->mobilenumber = $request -> input('mobilenumber');
         $contact->resnumber = $request -> input('resnumber');
         $contact->pobox = $request -> input('pobox');
         $contact->email = $request -> input('email');
         $contact->synod = $request -> input('synod');
         $contact->cong = $request -> input('cong');
         $contact->occupation = $request -> input('occupation');
         $contact ->name = $fileNameToStore;
         $contact -> save();
         return response() ->json(['contact'=> $contact,201]);
     }
     public function getContact(){
         $contacts = Contact::all();
         $response=[
             'contacts'=>$contacts
         ];
         return response() ->json($response,200);
     }
//      public function contactInfo($id){
//         $contact = Contact:: find($id);
//        if(!$contact) {
//            return false;
//        }
// return $contact;

//     }
     public function putContact(Request $request, $id){
              $contact = Contact:: find($id);
            
              if(!$contact instanceof Contact){
                  return response() -> json (['message'=> 'Document not found!'],404);
                          }
                          else{
                            $contact->firstname = $request -> input('firstname');
                            $contact->middlename = $request -> input('middlename');
                            $contact->lastname = $request -> input('lastname');
                            $contact->sex = $request -> input('sex');
                            $contact->age = $request -> input('age');
                            $contact->region = $request -> input('region');
                            $contact->wereda = $request -> input('wereda');
                            $contact->kebele = $request -> input('kebele');
                            $contact->housenumber = $request -> input('housenumber');
                            $contact->officenumber = $request -> input('officenumber');
                            $contact->mobilenumber = $request -> input('mobilenumber');
                            $contact->resnumber = $request -> input('resnumber');
                            $contact->pobox = $request -> input('pobox');
                            $contact->email = $request -> input('email');
                            $contact->synod = $request -> input('synod');
                            $contact->cong = $request -> input('cong');
                            $contact->occupation = $request -> input('occupation');
                           $contact-> save();
                          return response() ->json(['contact'=> $contact,200]);
                          }
     }

     public function deleteContact($id){
        $contact = Contact:: find($id);
        $contact -> delete();
        return response() -> json (['message'=> 'Contact Deleted!'],200);
     }
}
