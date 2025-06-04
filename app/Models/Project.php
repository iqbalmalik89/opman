<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{

    protected $table = 'projects';

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function links()
    {
        return $this->hasMany(ProjectLink::class, 'project_id');
    }

    public function assignments()
    {
        return $this->hasMany(ProjectAssignment::class, 'project_id');
    }

}
