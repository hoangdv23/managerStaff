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
use DateTimeZone;
use DateTime;


class CreatePage extends Component
{
    protected $customerRepository;    
    public $name, $email, $type,$code,$note,$phone, $status,$timezones,$formattedTimezones;
    public $timezone,$country,$paypal;


    public function boot(
        CustomerRepositoryInterface $customerRepository
    )
    {
        $this->customerRepository = $customerRepository;
    }
    public function mount(){
        $timezones = timezone_identifiers_list();
        $formattedTimezones = [];

        foreach ($timezones as $timezone) {
            $dateTimeZone = new DateTimeZone($timezone);
            $dateTime = new DateTime("now", $dateTimeZone);
            $offset = $dateTimeZone->getOffset($dateTime) / 3600;
            $offset_prefix = $offset >= 0 ? '+' : '-';
            $offset_formatted = "UTC" . $offset_prefix . abs($offset);
            $timezone_name = str_replace('_', ' ', $timezone);
    
            $formattedTimezones[] = '('.$offset_formatted .')'. $timezone_name;
        }
        ksort($formattedTimezones);
        $this->timezones = $formattedTimezones;
        // dd($formattedTimezones);
    }
    public function hydrate(){
        $this->dispatch('timezone');
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
                'status'  => $this->status ? 0 : 1,
                'note'        => trim($this->note),
                'timezone'        => trim($this->timezone),
                'country'        => trim($this->country),
                'paypal'        => trim($this->paypal),
            ];
            // dd($dataCustomer);
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
