<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelPost extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function likes()
    {
        return $this->hasMany('App\ModelLike');
    }
    
    public function likedBy($user)
    {
        return ModelLike::where('user_id', $user->id)->where('post_id', $this->id);
    }
}
