<?php

namespace Modules\Customers\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Departments\Entities\Department;
use Modules\Users\Entities\User;

class Customer extends Model {
	use HasFactory;

	protected $table = 'customers';
	public $timestamps = true;
	protected $fillable = [
		'name',
		'code',
		'phone',
		'email',
		'status',
        'note',
        'type',
		'paypal',
		'country',
		'timezone',
	];




}
