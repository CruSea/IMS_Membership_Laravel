<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    public $timestamps=false;
    public  function users(){
         return $this->belongsToMany('App\User');
    }
}
