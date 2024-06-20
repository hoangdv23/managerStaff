<?php

namespace Modules\Jobs\App\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 

class TypePage extends Component
{
    // #[On('createType')]
    // public function createType(){
    //     dd(123);
    // }
    public function render()
    {
        return view('jobs::livewire.type-page');
    }
}
