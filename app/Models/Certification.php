<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{

    protected $table = 'certifications';

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }



}
