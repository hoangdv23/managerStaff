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
class DetailEditpage extends Component
{
    public $jobId,$jobInfo,$titleForm,$listCustomer=[],$typeId,$type_service,$qc_price,$deadline,$editor_price,$total_editor_price;
    public $name,$code,$amount, $type=[],$note, $status,$startday,$stopday,$type_old=[],$fixed_link,$price,$checked_link,$edited_link;
    protected $customerRepository,$jobRepository;

    public $listType_service,$listJobs;
    public function boot(
        CustomerRepositoryInterface $customerRepository,
        JobRepositoryInterface $jobRepository,
    )
    {
        $this->customerRepository = $customerRepository;
        $this->jobRepository = $jobRepository;
    }
    public function mount(){ // cái nào chỉ load 1 lần thì mount luôn
        $this->titleForm = 'Chỉnh sửa Loại công việc';
        $this->listCustomer = $this->customerRepository->getListCustomer();
        $this->listJobs = Job::get();
        $this->listType_service = Type_service::get();
    }
    #[On('triggerEditTypes')]
    public function triggerEditTypes($typeId){
        $this->typeId = $typeId;
        $detaiInfo = Jobs_have_type_service::find($this->typeId);
        // dd($detaiInfo);
        if($detaiInfo){
            $this->name =  $detaiInfo->job_id;
            $this->type_service = $detaiInfo->type_service_id;
            $this->amount = $detaiInfo->amount;
            $this->fixed_link = $detaiInfo->fixed_link;
            $this->status = $detaiInfo->status;
            // $this->price = $detaiInfo->price;
            $this->edited_link = $detaiInfo->edited_link;
            $this->checked_link = $detaiInfo->checked_link;
            $this->deadline = $detaiInfo->deadline;
            // $this->editor_price = $detaiInfo->editor_price;
            // $this->qc_price = $detaiInfo->qc_price;
        }

        action_modal(
			$content = $this,
			$modalId = '#jobs-detai-update',
			$actionModal = 'show',
			$flashMessage = null,
			$flashType = null
		);
    }
    public function editTypeJobs($typeId){
        $this->typeId = $typeId;
        $detaiInfo = Jobs_have_type_service::find($this->typeId);
        DB::beginTransaction();
        try{
            $flashMessage= 'Chỉnh sửa thành công';
            $flashType = 'success';
            $data = [
                'job_id' => trim($this->name),
                'type_service_id'=>trim($this->type_service),
                'amount' => trim($this->amount),
                'fixed_link' => $this->fixed_link,
                'status' => trim($this->status),
                // 'price' => trim($this->price),
                'total_price' => $this->price * $this->amount,
                'edited_link' => $this->edited_link,
                'checked_link' => $this->checked_link,
                'deadline' => $this->deadline,
                // 'qc_price' => $this->qc_price,
                // 'editor_price' => $this->editor_price,
                'total_editor_price' => $this->amount * $this->editor_price,
                'total_qc_price' => $this->amount * $this->qc_price,
            ];
            // dd($data);
            $detaiInfo->update($data);

        }catch (\Exception $e) {
            session()->flash('error', __('chỉnh sửa false edited.'));
            Log::error($e->getMessage() . json_encode($e->getTrace()));
            DB::rollback();
        }
        DB::commit();
        action_modal(
			$content = $this,
			$modalId = '#jobs-detai-update',
			$actionModal = 'hide',
			$flashMessage = $flashMessage,
			$flashType = $flashType
		);
    }

    public function render()
    {
        return view('jobs::livewire.detail-editpage');
    }
}
