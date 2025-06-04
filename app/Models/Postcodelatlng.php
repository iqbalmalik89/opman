<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class Postcodelatlng extends Model
{

    use CentralConnection;

    protected $table = 'postcodelatlng';
    public $timestamps = false;






}
