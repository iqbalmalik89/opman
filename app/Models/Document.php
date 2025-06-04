<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Document extends Model
{
    use SoftDeletes;

    protected $table = 'documents';

    public function people()
    {
        return $this->belongsTo(People::class, 'people_id');
    }

    public function training()
    {
        return Training::where('people_id', $this->people_id)->where('doc_class', $this->doc_class)->whereIn('status', ['Active', 'Pending'])->first();
    }


    // public function training($peopleId, $docClass)
    // {
    //     return Training::where('people_id', $peopleId)->where('doc_class', $docClass)->count();
    // }

    // public function training(): HasOne
    // {
    //     return $this->hasOne(Training::class, 'doc_class', 'doc_class');
    // }
    
    public function skill()
    {
        return $this->belongsTo(Certification::class, 'doc_class');
    }

    public function project($peopleId)
    {
        $date = date('Y-m-d');

        $rec = ProjectAssignment::where('people_id', $peopleId)->where('start_date', '<=', $date)->where('end_date', '>=', $date)->first();
        if(!empty($rec->project))
        {
            return $rec->project;
        }

    }


}
