<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class TaskSuboperative extends Model
{

    protected $table = 'task_suboperatives';

    public function suboperative()
    {
        return $this->belongsTo(Suboperative::class, 'suboperative_id');
    }


    public function document()
    {
        return $this->belongsTo(SuboperativeDocument::class, 'doc_id');
    }


}
