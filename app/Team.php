<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    //
    protected $guarded = [];

    public function lead(){
        $this->belongsTo(User::class, 'lead_id','id');
    }
    public function members(){
        $this->hasMany(TeamMember::class,'team_id');
    }
}
