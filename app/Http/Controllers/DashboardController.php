<?php

namespace App\Http\Controllers;

use App\Contact;
use App\SentMessages;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
            public function get_contact_number(){
               $contacts_count = Contact::all();

               return $contacts_count->count();
        }

        public function sent_messages(){
                $sent_messages_count = SentMessages::all();
                 return $sent_messages_count->count();
        }
}
