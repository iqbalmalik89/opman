<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Subcontractor extends Model
{

    protected $table = 'subcontractors';

    
    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function tasks()
    {
        return $this->hasMany(TeamTask::class);
    }

    // public function suboperatives()
    // {
    //     return $this->hasMany(Suboperative::class);
    // }
}
