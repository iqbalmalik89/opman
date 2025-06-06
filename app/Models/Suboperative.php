<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Suboperative extends Model
{
    use SoftDeletes;

    protected $table = 'suboperatives';

    public function assignments()
    {
        return $this->hasMany(SubopAssignment::class, 'suboperative_id')->orderBy('start_date', 'desc');
    }

    public function subcontractor()
    {
        return $this->belongsTo(Subcontractor::class, 'subcontractor_id');
    }

    public function documents()
    {
        return $this->hasMany(SuboperativeDocument::class, 'suboperative_id');
    }

    // public function suboperativeTasks()
    // {
    //     return $this->hasMany(TaskSuboperative::class, 'suboperative_id');
    // }

}
