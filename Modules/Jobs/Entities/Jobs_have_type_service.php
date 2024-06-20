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



class Jobs_have_type_service extends Model {
    // use Notifiable;


	protected $table = 'jobs_have_type_service';
	public $timestamps = true;
	protected $fillable = [
		'type_service_id',
        'job_id',
	];


}