<?php

namespace Modules\ReportJob\App\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\Jobs\Repositories\JobRepositoryInterface;
use Modules\Jobs\Repositories\JobRepository;
use Modules\Jobs\Entities\Job;
use Modules\Users\Entities\User;

class IndexPage extends Component
{


    public function render()
    {
        $jobsList = Job::select('*');
        $result = $jobsList->paginate(10);
        return view('reportjob::livewire.index-page',[
			'listJobs' => $result,
		]);
    }
}
