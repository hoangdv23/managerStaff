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

class AddMarketingUserPage extends Component
{
    public $titleForm,$typeId;

    public $user_id;

    protected $customerRepository,$jobRepository;

    public function boot(
        CustomerRepositoryInterface $customerRepository,
        JobRepositoryInterface $jobRepository,
    )
    {
        $this->customerRepository = $customerRepository;
        $this->jobRepository = $jobRepository;
    }

    #[On('triggerQC')]
    public function triggerQC($typeId){
        $this->typeId = $typeId;
        $this->jobInfo = Jobs_have_type_service::find($typeId);

        if($this->jobInfo){
            $this->marketing_user_id =  $this->jobInfo->marketing_user_id;
        }
        action_modal(
			$content = $this,
			$modalId = '#jobs-mar',
			$actionModal = 'show',
			$flashMessage = null,
			$flashType = null
		);
    }
    public function addMarToJobs($typeId)
    {
        $this->typeId = $typeId;
        $this->jobInfo = Jobs_have_type_service::find($typeId);
        
        try{
            $flashMessage= 'Thêm người marketing thành công';
            $flashType = 'success';
            $dataCustomer = [
                'marketing_user_id'=> trim($this->user_id),
            ];
            // dd($dataCustomer);
            $jobUpdate = $this->jobInfo->update($dataCustomer);
        } catch (\Exception $e) {
            session()->flash('error', __('Thêm người marketing thất bại'));
            Log::error($e->getMessage() . json_encode($e->getTrace()));
            DB::rollback();
        }
        DB::commit();
        action_modal(
			$content = $this,
			$modalId = '#jobs-mar',
			$actionModal = 'hide',
			$flashMessage = null,
			$flashType = null
		);
    }
    public function render()
    {
        $this->titleForm = 'Thêm người quảng cáo';
        $listUser = User::where('id','<>','1')->get();
        return view('jobs::livewire.add-marketing-user-page',[
            'listUser' => $listUser
        ]);
    }
}
