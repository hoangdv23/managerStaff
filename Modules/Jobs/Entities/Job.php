<?php

namespace Modules\Jobs\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
use Modules\Users\Entities\User;
use Modules\Customers\Entities\Customer;
use Modules\Jobs\Entities\Type_service;
use Modules\Jobs\Entities\Jobs_have_type_service;


class Job extends Model {
    // use Notifiable;
	use HasFactory;

	protected $table = 'jobss';
	public $timestamps = true;
	protected $fillable = [
		'name',
		'customer_id',
		'status',
		'user_id',
		'marketing_user_id',
        'number_img',
        'type',
		'note',
        'start_date',
        'finish_date',
		'fixed_link',
		'edited_link',
		'checked_link',
	];

	// public function customer(): BelongsTo
    // {
    //     return $this->belongsTo(Customer::class, 'customer_id', 'id');
    // }
	public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
	public function types()
    {
        return $this->belongsToMany(Type_service::class, 'jobs_have_type_service', 'job_id', 'type_service_id');
    }
}