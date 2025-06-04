<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = false;


    public function certifications()
    {
        return $this->hasMany(Certification::class);
    }


}
