<?php

namespace Modules\Customers\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Departments\Entities\Department;
use Modules\Users\Entities\User;

class Customer_Type_Service extends Model {
	use HasFactory;

	protected $table = 'customer_type_service';
	public $timestamps = true;
	protected $fillable = [
		'customer_id',
        'typeService_id',
        'priceCus',
        'priceEditor',
        'priceQC',
	];




}
