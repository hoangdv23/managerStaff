<?php

namespace Modules\Jobs\Repositories;
use App\Http\Repositories\BaseRepository;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Repositories\JobRepositoryInterface;

class JobRepository extends BaseRepository implements JobRepositoryInterface
{
    public function getModel()
    {
        return Job::class;
    }
}
