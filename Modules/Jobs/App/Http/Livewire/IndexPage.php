<?php

namespace Modules\Jobs\App\Http\Livewire;

use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\Jobs\Repositories\JobRepositoryInterface;
use Modules\Jobs\Repositories\JobRepository;
use Modules\Jobs\Entities\Job;
class IndexPage extends Component
{
	public 	$name,$customer_id,$status,$user_id,$marketing_user_id,$number_img,$type,$note,$start_date,$finish_date,$fixed_link,$edited_link,$checked_link;
	public $listtype,$listUser;

	public function render()
    {
		$userInfo = getUserInfo();
		$listJob = Job::get();
		// dd($userInfo);
        return view('jobs::livewire.index-page',[
			'listJob' => $listJob
		]);
    }
}
