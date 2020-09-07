<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    // インクリメントidを無効化
    public $incrementing = false;
    
    // created_at, update_atを無効化
    public $timestamps = false;
    
    
    public function toUserId()
    {
        return $this->belongsTo('App\User','to_user_id','id');
    }
    
    public function fromUserId()
    {
        return $this->belongsTo('App\User','from_user_id','id');
    }
}
