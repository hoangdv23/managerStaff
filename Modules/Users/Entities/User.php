<?php

namespace Modules\Users\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable {
    // use Notifiable;
	use HasFactory;
	use HasRoles;
	use HasPermissions;

    protected $guard_name = 'web';
	protected $table = 'users';
	protected $connection = 'mysql';
	public $timestamps = true;
	protected $fillable = [
		'name',
		'username',
		'phone',
		'email',
		'password',
        'status',
		'isAdmin'
	];
	protected $hidden = [
		'password',
		'remember_token',
	];
	protected $casts = [
		'email_verified_at' => 'datetime',
	];
	protected $appends = [];

	
}