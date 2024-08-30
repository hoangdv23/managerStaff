<?php

namespace Modules\Customers\App\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 
use Modules\Jobs\Entities\Jobs_have_type_service;
use Modules\Jobs\Entities\Type_service;
use Modules\Customers\Entities\Customer_Type_Service;
class CusTypeServicePage extends Component
{
    public $titleForm,$customerId,$typeService_id,$price,$priceEditor,$priceQC;
    public $typeService;
    public function mount(){
        $this->titleForm = 'Giá type mặc định theo Khách hàng';
        $this->typeService = Type_service::get();
    }

    #[On('triggerCusType')]
    public function triggerCusType($customerId){
        // dd($customerId);
        $this->customerId = $customerId;
        action_modal(
			$content = $this,
			$modalId = '#cusTypeService',
			$actionModal = 'show',
			$flashMessage = null,
			$flashType = null
		);

    }
    public function editCustype($customerId){
        $this->customerId = $customerId;
        $data = [
            'customer_id' => $customerId,
            'typeService_id' => trim($this->typeService_id),
            'priceCus' => $this->price,
            'priceEditor' => $this->priceEditor,
            'priceQC' => $this->priceQC,
        ];
        $issetCusType = Customer_Type_Service::where('customer_id', $this->customerId)->where('typeService_id', $this->typeService_id)->first();
        if($issetCusType == NULL){
            $createCusType = Customer_Type_Service::create($data);
        }else{
            $mesage = 'Loại ' .typeServiceName($this->typeService_id) . ' đã được set giá';
            session()->flash('message', $mesage);
        }
        // dd($data);
        action_modal(
			$content = $this,
			$modalId = '#cusTypeService',
			$actionModal = 'show',
			$flashMessage = null,
			$flashType = null
		);
    }
    #[On('deleteCusType')]
    public function deleteCusType($customerId,$typeId){
        $this->customerId = $customerId;
        $this->typeId = $typeId;

        $typeService = Customer_Type_Service::where('customer_id', $this->customerId)
        ->where('typeService_id', $this->typeId)
        ->first();

        if ($typeService) {
        $typeService->delete();
        }
    }
    public function render()
    {
        // $this->customerId;
        $listCusTypeQuery = Customer_Type_Service::where('customer_id',$this->customerId)->get();
        // dd($this->customerId);
        return view('customers::livewire.cus-type-service-page',[
            'listCusType' => $listCusTypeQuery
        ]);
    }
}
