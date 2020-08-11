<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreatorPost extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
