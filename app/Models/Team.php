<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{

    protected $table = 'teams';

    public function subcontractors()
    {
        return $this->belongsTo(Subcontractor::class, 'subcontractor_id');
    }


    public function tasks()
    {
        return $this->hasMany(TeamTask::class);
    }



}
