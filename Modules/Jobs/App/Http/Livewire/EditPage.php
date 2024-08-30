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
    public $name,$code,$amount, $type=[],$note, $status,$startday,$stopday,$type_old=[];
    protected $customerRepository,$jobRepository;

    public $listType_service;
    public function boot(
        CustomerRepositoryInterface $customerRepository,
        JobRepositoryInterface $jobRepository,
    )
    {
        $this->customerRepository = $customerRepository;
        $this->jobRepository = $jobRepository;
    }

    public function mount(){ // cái nào chỉ load 1 lần thì mount luôn
        $this->titleForm = 'Chỉnh sửa công việc';
        $this->listCustomer = $this->customerRepository->getListCustomer();
        $this->listType_service = Type_service::get();
    }

    public function hydrate()
    {
        // call lại mỗi khi có cập nhật dữ liệu
        $this->dispatch('refreshSelect2Table'); // run lại mỗi khi upload dữ liệu, select2 sẽ mất funtion, cần gọi lại
    }
    
    #[On('triggerEditJobs')]
    public function triggerEditJobs($jobId){
        $this->jobId = $jobId;
        $jobInfo = $this->jobRepository->find($jobId);
// có this và k có this khác nhau
        // truy vấn xong điền vào các input 

        if($jobInfo){
            $this->name =  $jobInfo->name;
            $this->code =  $jobInfo->customer_id;
            $this->type = $jobInfo->types->pluck('id')->toArray(); 
            $this->type_old = $this->type;
            $this->amount =  $jobInfo->number_img;
            $this->status =  $jobInfo->status;
            $this->stopday =  $jobInfo->finish_date;
            $this->note =  $jobInfo->note;
        }

        // $jobInfo->types()->wherePivot;
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
            $flashMessage= 'Chỉnh sửa thành công';
            $flashType = 'success';
            $dataCustomer = [
                'name'          => trim($this->name),
                'customer_id'         => trim($this->code),
                'note'        => trim($this->note)
            ];
            // dd($dataCustomer);
            $jobUpdate = $this->jobRepository->update($this->jobId,$dataCustomer);
            Jobs_have_type_service::where('job_id', $this->jobId)->update(['customer_id' => trim($this->code)]);
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
			$flashMessage = $flashMessage,
			$flashType = $flashType
		);
    }

    
    public function render()
    {

        return view('jobs::livewire.edit-page');
    }
}
