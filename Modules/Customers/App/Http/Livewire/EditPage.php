<?php

namespace Modules\Customers\App\Http\Livewire;

use Livewire\Attributes\On; 
use Livewire\Component;
use Modules\Customers\Entities\Customer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use DateTimeZone;
use DateTime;
class EditPage extends Component
{
    public $customerId,$titleForm;
    protected $customerRepository;   
    private $customerInfo; 
    public $name, $email, $type,$code,$note,$phone, $status,$timezones,$formattedTimezones;
    public $timezone,$country,$paypal;


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

    #[On('triggerEditCus')]
    public function triggerEditCus($customerId){
        $this->customerId = $customerId;
        // dd($customerId);
        $this->customerInfo = Customer::where('id',$this->customerId )->get()->first();
        if($this->customerInfo){
            $this->name = $this->customerInfo->name;
			$this->phone = $this->customerInfo->phone;
			$this->email = $this->customerInfo->email;
			$this->code = $this->customerInfo->code;
            $this->note = $this->customerInfo->note;
            $this->type = $this->customerInfo->type;
            $this->status = $this->customerInfo->status; 
            $this->timezone = $this->customerInfo->timezone; 
            $this->country = $this->customerInfo->country; 
            $this->paypal = $this->customerInfo->paypal; 
            
        }
        action_modal(
			$content = $this,
			$modalId = '#user-update-Cus',
			$actionModal = 'show',
			$flashMessage = null,
			$flashType = null
		);
    }

    public function EditCustomers($customerId){
        $this->customerId = $customerId;
        DB::beginTransaction();
        try {
            $flashType = 'success';
            $flashMessage = 'Chỉnh sửa tài khoản thành công.';
            $dataEdit = [
                'name' => trim($this->name),
                'phone' => trim($this->phone) ?? NULL,
                'email' => trim($this->email) ?? NULL,
                'code' => trim($this->code) ?? NULL,
                'type' => trim($this->type) ?? NULL,
                'status' => trim($this->status) ?? NULL,
                'note' => trim($this->note) ?? NULL,
                'timezone'        => trim($this->timezone),
                'country'        => trim($this->country),
                'paypal'        => trim($this->paypal),
            ];
    
            // Cập nhật thông tin khách hàng
            Customer::where('id', $customerId)->update($dataEdit);
            
            DB::commit();
        } catch (\Exception $e) {
            $flashType = 'error';
            $flashMessage = 'Chỉnh sửa khách hàng không thành công.';
            Log::error($e->getMessage() . json_encode($e->getTrace()));
            DB::rollback();
        }
        action_modal(
			$content = $this,
			$modalId = '#user-update-Cus',
			$actionModal = 'hide',
			$flashMessage = null,
			$flashType = null
		);
    }
    public function render()
    {
        $this->titleForm = "Chỉnh sửa thông tin khách hàng";
        return view('customers::livewire.edit-page');
    }
}
