<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    //
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function new_user(){
        return $this->belongsTo(User::class, 'new_user_id');
    }
    public function team(){
        return $this->belongsTo(Team::class,'team_id');
    }
}
