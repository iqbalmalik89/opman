<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubopAssignment extends Model
{
    
    use SoftDeletes;
    protected $table = 'subop_assignments';

    public function doc()
    {
        return $this->belongsTo(SuboperativeDocument::class, 'doc_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function subop()
    {
        return $this->belongsTo(Suboperative::class, 'suboperative_id');
    }




}
