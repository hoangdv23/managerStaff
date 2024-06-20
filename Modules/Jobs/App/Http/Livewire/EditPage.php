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

class EditPage extends Component
{
    public $jobId,$jobInfo,$titleForm,$listCustomer=[];
    public $name,$code,$amount, $type=[],$note, $status,$startday,$stopday;
    protected $customerRepository,$jobRepository;

    public function boot(
        CustomerRepositoryInterface $customerRepository,
        JobRepositoryInterface $jobRepository,
    )
    {
        $this->customerRepository = $customerRepository;
        $this->jobRepository = $jobRepository;
    }
    #[On('triggerEditJobs')]
    public function triggerEditJobs($jobId){
        $this->jobId = $jobId;
        $this->jobInfo = $this->jobRepository->find($jobId);
        // dd($this->jobInfo->name);
        if($this->jobInfo){
            $this->name =  $this->jobInfo->name;
            $this->code =  $this->jobInfo->code;
            $this->type =  $this->jobInfo->type;
            $this->amount =  $this->jobInfo->number_img;
            $this->status =  $this->jobInfo->status;
            $this->startday =  $this->jobInfo->start_date;
            $this->stopday =  $this->jobInfo->finish_date;
            $this->note =  $this->jobInfo->note;
        }
        action_modal(
			$content = $this,
			$modalId = '#jobs-update',
			$actionModal = 'show',
			$flashMessage = null,
			$flashType = null
		);
    }
    public function editJobs($jobId){
        $this->jobId = $jobId;
        $this->jobInfo = $this->jobRepository->find($jobId);
        DB::beginTransaction();
        try{
            $dataCustomer = [
                'name'          => trim($this->name),
                'customer_id'         => trim($this->code),
                'number_img'         => trim($this->amount),
                'start_date'      => $this->startday,
                'finish_date'      => $this->stopday,
                'status'        => $this->status,
                'note'        => trim($this->note)
            ];
            $jobUpdate = $this->jobRepository->find($this->jobId,$dataCustomer);
        } catch (\Exception $e) {
            session()->flash('error', __('customer.Customer false edited.'));
            Log::error($e->getMessage() . json_encode($e->getTrace()));
            DB::rollback();
        }
        DB::commit();
        action_modal(
			$content = $this,
			$modalId = '#jobs-update',
			$actionModal = 'hide',
			$flashMessage = null,
			$flashType = null
		);
    }
    public function render()
    {
        $this->titleForm = 'Chỉnh sửa công việc';
        $this->listCustomer = $this->customerRepository->getListCustomer();
        $listType_service = Type_service::get();
        return view('jobs::livewire.edit-page',[
            'listType_service' => $listType_service,
        ]);
    }
}
