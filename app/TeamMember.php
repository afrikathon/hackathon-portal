<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    //
    protected $guarded = [];

    public function user(){
      return  $this->belongsTo(User::class,'user_id');
    }
    public function team(){
       return $this->belongsTo(Team::class,'team_id');
    }
}
