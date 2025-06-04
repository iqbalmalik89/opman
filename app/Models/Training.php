<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Training extends Model
{

    use SoftDeletes;
    protected $table = 'trainings';

    public function doc()
    {
        return $this->belongsTo(Document::class, 'doc_id');
    }

    public function skill()
    {
        return $this->belongsTo(Certification::class, 'doc_class');
    }

    public function people()
    {
        return $this->belongsTo(People::class, 'people_id');
    }


}
