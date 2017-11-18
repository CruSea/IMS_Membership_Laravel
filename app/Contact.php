<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function  group(){

//        return ContactGroup::where('id',$this->id)->first()->discription;
        return $this-> belongsTo('App\groupDetail','group_id');
//        return $this-> belongsTo('App\ContactGroup');
    }



}
