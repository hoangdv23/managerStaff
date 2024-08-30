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

class UpdateStatusPage extends Component
{
    public $titleForm,$typeId,$status;

    public function mount(){
        $this->titleForm = "Chỉnh sủa trạng thái công việc";
    }

    #[On('triggerSatus')]
    public function triggerSatus($typeId){
        $this->typeId = $typeId;
        $this->jobInfo = Jobs_have_type_service::find($typeId);
        // dd($this->jobInfo);
        if($this->jobInfo){
            $this->status =  $this->jobInfo->status;
        }
        action_modal(
			$content = $this,
			$modalId = '#jobs-status',
			$actionModal = 'show',
			$flashMessage = null,
			$flashType = null
		);
    }

    public function updateStatus($typeId)
    {
        $this->typeId = $typeId;
        $this->jobInfo = Jobs_have_type_service::find($typeId);
        
        try{
            $flashMessage= 'chỉnh sửa Status thành công';
            $flashType = 'success';
            $dataCustomer = [
                'status'=> trim($this->status),
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
			$modalId = '#jobs-status',
			$actionModal = 'hide',
			$flashMessage = null,
			$flashType = null
		);
    }

    public function render()
    {
        return view('jobs::livewire.update-status-page');
    }
}
