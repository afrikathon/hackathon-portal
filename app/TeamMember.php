<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    //
    protected $guarded = [];

    public function user(){
        $this->belongsTo(User::class,'user_id');
    }
    public function team(){
        $this->belongsTo(Team::class,'team_id');
    }
}
