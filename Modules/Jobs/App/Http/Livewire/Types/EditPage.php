<?php

namespace Modules\Jobs\App\Http\Livewire\Types;

use Livewire\Component;
use Livewire\Attributes\On;
use Modules\Jobs\Entities\Type_service;

class EditPage extends Component
{
    public $typeId,$name,$color,$titleForm;
    public function mount(){
        $this->titleForm = 'Chỉnh sửa';
    }

    #[On('triggerEditTypes')]
    public function triggerEditTypes($typeId){
        $this->typeId = $typeId;
        $resultType = Type_service::where('id',$typeId)->first();
        // dd($resultType);
        if($resultType !== null){
            $this->name =  $resultType->name;
            $this->color =  $resultType->color;
        }
        action_modal(
			$content = $this,
			$modalId = '#types-update',
			$actionModal = 'show',
			$flashMessage = null,
			$flashType = null
		);
    }

    public function editTypesService($typeId){
        $this->typeId = $typeId;
        // dd($typeId);
        $data =[
            'name' => trim($this->name),
            'color' => trim($this->color),
        ];
        // dd($data);
        try{
            $updateTypes = Type_service::where('id',$typeId)->update($data);
            $flashType = 'success';
            $flashMessage = 'Chỉnh sửa thành công';
        }catch (\Exception $e) {
            session()->flash('error', __('Chỉnh sửa false edited.'));
            \Log::error($e->getMessage() . json_encode($e->getTrace()));
        }

        action_modal(
			$content = $this,
			$modalId = '#types-update',
			$actionModal = 'hide',
			$flashMessage = null,
			$flashType = null
		);
    }

    #[On('triggerDelete')]
    public function triggerDelete($typeId)
    {
        $this->typeId = $typeId;
        $saleStatusDeleteInfo = Type_service::where('id', $typeId)->first();
        
        if ($saleStatusDeleteInfo) {
            $saleStatusDeleteInfo->delete();
            $this->dispatch('msgSuccess', __('Successfully deleted.'));
        } else {
            session()->flash('msgError', __('Failed to delete.'));
        }
    }
    public function render()
    {
        return view('jobs::livewire.types.edit-page');
    }
}
