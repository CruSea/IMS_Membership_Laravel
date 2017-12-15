<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SentMessages extends Model
{
    protected $fillable = [
        'message', 'sent_to','status'
    ];
}
