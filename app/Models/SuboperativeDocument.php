<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SuboperativeDocument extends Model
{
    // use SoftDeletes;

    protected $table = 'suboperative_documents';

    public function people()
    {
        return $this->belongsTo(Suboperative::class, 'suboperative_id');
    }

    public function skill()
    {
        return $this->belongsTo(Certification::class, 'doc_class');
    }


}
