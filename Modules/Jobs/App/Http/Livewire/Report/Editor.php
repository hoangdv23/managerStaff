<?php

namespace Modules\Jobs\App\Http\Livewire\Report;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\Jobs\Repositories\JobRepositoryInterface;
use Modules\Jobs\Repositories\JobRepository;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Entities\Jobs_have_type_service;
use Modules\Users\Entities\User;
use Modules\Customers\Entities\Customer;

class Editor extends Component
{

    public $page,$editorList,$selected_editor,$QCList,$selected_QC;
    public $search = '',$CusList;
    public $selected_editor_value = null;
    public $selected_QC_value = null; 
	public 	$name,$customer_id,$status,$user_id,$marketing_user_id,$number_img,$type,$note,$start_date,$finish_date,$fixed_link,$edited_link,$checked_link;
	public $listtype,$listUser;
    public function mount(){
        $this->editorList = User::get();
        $this->QCList = User::get();
    }
    public function hydrate() {
        $this->dispatch( 'selectPerPage' );
    }
    public function render()
    {
        // $editorList = 
        return view('jobs::livewire.report.editor');
    }
}
