<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    protected $fillable = [
        'message', 'sent_to','sent_by'
    ];


    public  function contact(){
        return $this->belongsTo(Contact::class);
    }

    public function group(){
        return $this->belongsTo(ContactGroup::class);
    }
}
