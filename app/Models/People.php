<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{

    protected $table = 'people';

    public function assignments()
    {
        return $this->hasMany(ProjectAssignment::class, 'people_id')->orderBy('start_date', 'desc');
        //->where('end_date', '>=', date('Y-m-d'));
    }

    public function project()
    {
        $date = date('Y-m-d');


        $rec = ProjectAssignment::where('people_id', $this->id)->where('start_date', '<=', $date)->where('end_date', '>=', $date)->first();

        if(!empty($rec->project))
        {

            return $rec->project;
        }

    }


    public function trainings()
    {
        return $this->hasMany(Training::class, 'people_id')->where('status', 'Active');
    }

    public function pending_trainings()
    {
        return $this->hasMany(Training::class, 'people_id')->where('status', 'Pending');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'people_id');//->where('status', '!=', 'Expired');
    }


}
