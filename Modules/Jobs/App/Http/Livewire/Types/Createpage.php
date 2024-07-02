<?php

namespace Modules\Jobs\App\Http\Livewire\Types;

use Livewire\Component;
use Modules\Jobs\Entities\Type_service;

class Createpage extends Component
{
    public $name,$color;
    public function createTypes(){
        // dd($this->name);
        $data=[
            'name' => $this->name,
            'color' => $this->color,
        ];
        // dd($data);
        $createTypes = Type_service::create($data);
        return redirect()->to('/types');
    }
    public function render()
    {
        return view('jobs::livewire.types.createpage');
    }
}
