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
use Modules\Jobs\Entities\Job;

class Type_service extends Model {
    // use Notifiable;
	use HasFactory;
	use HasRoles;
	use HasPermissions;

	protected $table = 'type_services';
	public $timestamps = true;
	protected $fillable = [
		'name',
	];
	public function jobs()
    {
        return $this->belongsToMany(Job::class, 'jobs_have_type_service', 'type_service_id', 'job_id');
    }

}