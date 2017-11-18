<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class groupDetail extends Model
{

    public $timestamps=false;
//    public  function contacts()
//    {
//        return $this->hasMany(Contact::class, 'contact_id');
//
//    }
    public  function contact(){
        return $this->belongsTo(Contact::class, 'contact_id');
    }

}
