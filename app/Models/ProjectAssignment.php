<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectAssignment extends Model
{
    
    use SoftDeletes;
    protected $table = 'project_assignments';

    public function doc()
    {
        return $this->belongsTo(Document::class, 'doc_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function people()
    {
        return $this->belongsTo(People::class, 'people_id');
    }




}
