<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactGroup extends Model
{
//    public function contactlist()
//    {
//
//        return $this-> belongsTo(groupDetail::class);
//
//    }

    public  function contact(){
        return $this->belongsTo(Contact::class, 'contact_id');
    }
//    public function group_messages(){
//        return $this->hasMany(GroupMessage::class);
//    }

}
