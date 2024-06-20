<?php

namespace Modules\Jobs\App\Http\Livewire;

use Livewire\Component;
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

class CreatePage extends Component
{

    protected $customerRepository;
    protected $jobRepository, $listType_service;
    public $name,$code,$amount, $type=[],$note, $status,$start_date,$finish_date;
    public $listCustomer =[],$startday,$stopday;

    public function boot(
        CustomerRepositoryInterface $customerRepository,
        JobRepositoryInterface $jobRepository,
    )
    {
        $this->customerRepository = $customerRepository;
        $this->jobRepository = $jobRepository;
    }
    
    public function createJobs(){
        DB::beginTransaction();
        try {
            session()->flash('success', __('Customer successfully created.'));            

            //Insert table customers
            $dataCustomer = [
                'name'          => trim($this->name),
                'customer_id'         => trim($this->code),
                'number_img'         => trim($this->amount),
                'start_date'      => $this->startday,
                'finish_date'      => $this->stopday,
                'status'        => $this->status,
                'note'        => trim($this->note)
            ];
            // dd($dataCustomer);
            $jobCreate = $this->jobRepository->create($dataCustomer);
            $createdJobId = $jobCreate->id;
            // Giả sử $createdJobId là ID của công việc vừa được tạo
            foreach ($this->type as $typeId) {
                Jobs_have_type_service::create([
                    'type_service_id' => $typeId,
                    'job_id' => $createdJobId
                ]); 
            }
            

        } catch (\Exception $e) {
            session()->flash('error', __('customer.Customer false created.'));
            Log::error($e->getMessage() . json_encode($e->getTrace()));
            DB::rollback();
        }
        // Else commit the queries
        DB::commit();
        return redirect()->to('/jobs');
    }
    public function render()
    {
        $this->listCustomer = $this->customerRepository->getListCustomer();
        $listType_service = Type_service::get();
        return view('jobs::livewire.create-page',[
            'listType_service' => $listType_service,
        ]);
    }
}
