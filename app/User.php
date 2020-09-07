<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    // hasmany設定
    public function posts()
    {
        if($this->role === 'model'){
            return $this->hasMany('App\ModelPost');
        }
        
        if($this->role === 'creator'){
            return $this->hasMany('App\CreatorPost');
        }
    }
    
    public function toUserId()
    {
        // hasMany('相手のモデル名','相手のモデルid','自分のモデルid')
        return $this->hasMany('App\Reaction','to_user_id', 'id');
    }
    public function fromUserId()
    {
        return $this->hasMany('App\Reaction','from_user_id', 'id');
    }
    
    
    
    public function chatMessages()
    {
        return $this->hasMany('App\ChatMessage');
    }
    
    public function chatRoomUsers()
    {
        return $this->hasMany('App\ChatRoomUser');
    }
}
