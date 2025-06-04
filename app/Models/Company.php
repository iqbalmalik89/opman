<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Company extends Model
{

    protected $table = 'companies';

    public function super_admin(): HasOne
    {
        return $this->hasOne(User::class, 'company_id')->role('super_admin');
    }
}
