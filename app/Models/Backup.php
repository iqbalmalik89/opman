<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class Backup extends Model
{

    use CentralConnection;

    protected $table = 'backups';






}
