<?php

namespace App\Http\Controllers;
use App\Contact;
use App\GroupMessage;
use App\groupDetail;
use App\ContactGroup;
use App\SentMessages;
use Illuminate\Http\Request;
use JWTAuth;

class MessageController extends Controller
{

    public function  __construct(){
        $this->middleware('is_Admin',['except'=>['getGroup', 'send_group_message','send_contact_message','get_group_message', 'get_contact_message','DeleteGroupMessage','DeleteContactMessage']]);
        $this->middleware('is_Editor',['except'=>['get_group_message', 'get_contact_message']]);
        $this->middleware('is_Viewer');

    }
     public  function getGroup(){
         $groups = ContactGroup::all();
         $response=[
             'groups'=>$groups
         ];
         return response() ->json($response,200);
     }
    public function send_group_message(Request $request){
          $status = 0;
           $user = JWTAuth::parseToken()->toUser();
            $group_message = new GroupMessage();
            $group_message-> message = $request->input('message');
            $group_message-> group_id = $request->input('group_id');
            $group_message-> sent_by =  $user->fullname;
           $group_message->save();
        $contacts = Contact::whereIn('id',groupDetail::where('group_id','=', $group_message-> group_id)->select('contact_id')->get() )->get();
           for( $i = 0; $i < count($contacts); $i++) {

                $contact = $contacts[$i];
                $sent_message = new SentMessages([
                    'message' => $request->input('message'),
                    'sent_to' => $contact->mobilenumber,
                    'status' => $status
                ]);
                $sent_message->save();

        }


//            $group_message->sent_messages()->saveMany($sent_message);
            return response()->json([
                'info'=>'message Sent!!'
            ],201);

    }

    public function send_contact_message(Request $request){
        $status=0;
        $sent_message= new SentMessages([

            'message' => $request->input('message'),
            'sent_to' => $request->input('sent_to'),
            'status' => $status
        ]);
        $sent_message->save();

        return response()->json([
            'info'=>'message Sent!!'
        ],201);
    }
    public function get_group_message(){
        $messages = GroupMessage::orderBy('id','DESC')->with('group')->paginate(5);
        $response=[
            'messages'=>$messages
        ];
        return response() ->json($response,200);
    }
    public function get_contact_message(){
        $messages = SentMessages::orderBy('id','DESC')->paginate(5);
        $response=[
            'messages'=>$messages
        ];
        return response() ->json($response,200);
    }

    public function DeleteGroupMessage($id){
        $group_message = GroupMessage:: find($id);
        $group_message -> delete();
        return response() -> json (['message'=> 'Message Deleted!'],200);
    }
    public function DeleteContactMessage($id){
        $contact_message = SentMessages:: find($id);
        $contact_message -> delete();
        return response() -> json (['message'=> 'Message Deleted!'],200);
    }


}
