<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    protected $guarded = [];

    public function lead(){
      return  $this->belongsTo(User::class, 'lead_id','id');
    }
    public function members(){
       return $this->hasManyThrough(User::class,TeamMember::class,'team_id','id','id','user_id');
    }
}
