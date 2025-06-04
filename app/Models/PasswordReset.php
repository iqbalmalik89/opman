<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PasswordReset extends Authenticatable
{
	public $timestamps = false;
	protected $table = 'password_resets';
}