<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeamTask extends Model
{

    protected $table = 'team_tasks';


    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }


    public function suboperatives()
    {
        return $this->hasMany(TaskSuboperative::class, 'task_id');
    }

}
