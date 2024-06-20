<?php

namespace Modules\Customers\App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Modules\Customers\Entities\Customer;
use Modules\Users\Entities\User;
use Modules\Customers\Repositories\CustomerRepositoryInterface;
use Modules\Customers\Repositories\CustomerRepository;


class CreatePage extends Component
{
    protected $customerRepository;    
    public $name, $email, $type,$code,$note,$phone, $status;


    public function boot(
        CustomerRepositoryInterface $customerRepository
    )
    {
        $this->customerRepository = $customerRepository;
    }


    public function create()
    {

        DB::beginTransaction();
        try {
            session()->flash('success', __('Customer successfully created.'));            

            //Insert table customers
            $dataCustomer = [
                'name'          => trim($this->name),
                'code'         => trim($this->code),
                'phone'         => trim($this->phone),
                'email'      => $this->email,
                'type'      =>  $this->type,
                'status'        => $this->status,
                'note'        => trim($this->note)
            ];
            $customerCreate = $this->customerRepository->create($dataCustomer);
            

        } catch (\Exception $e) {
            session()->flash('error', __('customer.Customer false created.'));
            Log::error($e->getMessage() . json_encode($e->getTrace()));
            DB::rollback();
        }
        // Else commit the queries
        DB::commit();
        return redirect()->to('/customers');
    }

    
    public function render()
    {
        return view('customers::livewire.create-page');
    }
}
