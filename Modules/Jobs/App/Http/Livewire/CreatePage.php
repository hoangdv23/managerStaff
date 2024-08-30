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
use Modules\Customers\Entities\Customer_Type_Service;

class CreatePage extends Component
{

    protected $customerRepository;
    protected $jobRepository, $listType_service;
    public $name,$code,$amount, $type=[],$note, $status,$start_date,$finish_date,$price,$qc_price,$editor_price;
    public $listCustomer =[],$startday,$stopday;

    public function boot(
        CustomerRepositoryInterface $customerRepository,
        JobRepositoryInterface $jobRepository,
    )
    {
        $this->customerRepository = $customerRepository;
        $this->jobRepository = $jobRepository;
    }
    public function mount(){
        $this->listCustomer = $this->customerRepository->getListCustomer();
        // dd($this->listCustomer);
    }
    public function createJobs(){
        DB::beginTransaction();
        try {
            session()->flash('success', __('Customer successfully created.'));            

            //Insert table customers
            $dataCustomer = [
                'name'          => trim($this->name),
                'customer_id'         => trim($this->code),
                'finish_date'      => $this->stopday,
                'note'        => trim($this->note)
            ];
            // dd($dataCustomer);
            $amountsArray = explode(',', $this->amount);
            $typesArray = $this->type;
            if (count($amountsArray) !== count($this->type)) {
                throw new \Exception('Số lượng ảnh phải tương ướng số lượng Loại');
            }

            // $pricesArray = explode(',', $this->price);
            // if (count($pricesArray) !== count($this->type)) {
            //     throw new \Exception('Số lượng giá Editer phải tương ướng số lượng Loại');
            // }
            // $qc_pricesArray = explode(',', $this->qc_price);
            // if (count($qc_pricesArray) !== count($this->type)) {
            //     throw new \Exception('Số lượng giá QC phải tương ướng số lượng Loại');
            // }
            // $editor_pricesArray = explode(',', $this->editor_price);
            // if (count($editor_pricesArray) !== count($this->type)) {
            //     throw new \Exception('Số lượng giá editor phải tương ướng số lượng Loại');
            // }

            
            // Giả sử $createdJobId là ID của công việc vừa được tạo
            foreach ($typesArray as $index => $typeId) {
                $issetCusType = Customer_Type_Service::where('customer_id', $this->code)->where('typeService_id', $typeId)->first();
                // dd($issetCusType->priceCus);
                if($issetCusType !== NULL){
                    $jobCreate = $this->jobRepository->create($dataCustomer);
                    $createdJobId = $jobCreate->id;
                    Jobs_have_type_service::create([
                        'type_service_id' => $typeId,
                        'job_id' => $createdJobId,
                        'status'        => $this->status,
                        'deadline'      => $this->stopday,
                        'amount' => trim($amountsArray[$index]),
                        // 'price' => trim($pricesArray[$index]), 
                        // 'editor_price' => trim($editor_pricesArray[$index]), 
                        // 'qc_price' => trim($qc_pricesArray[$index]), 
                        'total_price' => trim($issetCusType->priceCus  * $amountsArray[$index] ), 
                        'total_editor_price' => trim($issetCusType->priceEditor * $amountsArray[$index] ), 
                        'total_qc_price' => trim($issetCusType->priceQC * $amountsArray[$index] ), 
                        'customer_id' => trim($this->code),
                    ]);
                }else{
                    $mesage = 'Loại ' .typeServiceName($typeId) . 'chưa set giá. Hãy set giá trước mới đc chọn';
                    session()->flash('error', __($mesage));
                }   
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
        $listType_service = Type_service::get();
        
        return view('jobs::livewire.create-page',[
            'listType_service' => $listType_service,
        ]);
    }
}
