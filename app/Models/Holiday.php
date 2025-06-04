<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    public $timestamps = false;
    protected $table = 'holidays';

    public function people()
    {
        return $this->belongsTo(People::class, 'people_id');
    }

}
