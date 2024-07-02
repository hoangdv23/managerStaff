<?php

namespace Modules\Jobs\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;
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
		'color'
	];
	public function jobs()
    {
        return $this->belongsToMany(Job::class, 'jobs_have_type_service', 'type_service_id', 'job_id');
    }

}