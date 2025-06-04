<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class RestoreRequest extends Model
{

    use CentralConnection;

    protected $table = 'restore_requests';






}
