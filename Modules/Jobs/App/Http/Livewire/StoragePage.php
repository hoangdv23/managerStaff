<?php

namespace Modules\Jobs\App\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Entities\Type_service;
use Modules\Jobs\Entities\Jobs_have_type_service;
use Modules\Customers\Entities\Customer;
use Modules\Users\Entities\User;
use Modules\Customers\Repositories\CustomerRepositoryInterface;
use Modules\Customers\Repositories\CustomerRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Modules\Jobs\Repositories\JobRepositoryInterface;
use Modules\Jobs\Repositories\JobRepository;
class StoragePage extends Component
{
    public $user_id,$titleForm,$jobId ;

    protected $customerRepository,$jobRepository;

    public function boot(
        CustomerRepositoryInterface $customerRepository,
        JobRepositoryInterface $jobRepository,
    )
    {
        $this->customerRepository = $customerRepository;
        $this->jobRepository = $jobRepository;
    }

    #[On('triggerAddUser')]
    public function triggerAddUser($jobId)
    {
        $this->jobId = $jobId;
        $this->jobInfo = $this->jobRepository->find($jobId);
        // dd();
        if($this->jobInfo){
            $this->user_id =  $this->jobInfo->user_id;
        }
        action_modal(
			$content = $this,
			$modalId = '#jobs-user',
			$actionModal = 'show',
			$flashMessage = null,
			$flashType = null
		);
    }
    public function addUserToJobs($jobId){
        $this->jobId = $jobId;
        $this->jobInfo = $this->jobRepository->find($jobId);
        // dd($this->jobInfo);
        DB::beginTransaction();

        try{
            $dataCustomer = [
                'user_id'=> trim($this->user_id),
            ];
            // dd($dataCustomer);
            $jobUpdate = $this->jobRepository->find($this->jobId,$dataCustomer);
        } catch (\Exception $e) {
            session()->flash('error', __('customer.Customer false edited.'));
            Log::error($e->getMessage() . json_encode($e->getTrace()));
            DB::rollback();
        }
        DB::commit();
        action_modal(
			$content = $this,
			$modalId = '#jobs-user',
			$actionModal = 'hide',
			$flashMessage = null,
			$flashType = null
		);
    }
    public function render()
    {
        $this->titleForm = 'Thêm người nhận job';
        $listUser = User::get();
        return view('jobs::livewire.storage-page',[
            'listUser' => $listUser
        ]);
    }
}
