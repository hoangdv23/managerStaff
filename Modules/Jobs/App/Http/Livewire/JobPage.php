<?php

namespace Modules\Jobs\App\Http\Livewire;

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
class JobPage extends Component
{
    use WithPagination;
    public $page,$editorList,$selected_editor,$QCList,$selected_QC;
    public $search = '';
    public $selected_editor_value = null;
    public $selected_QC_value = null; 
	public 	$name,$customer_id,$status,$user_id,$marketing_user_id,$number_img,$type,$note,$start_date,$finish_date,$fixed_link,$edited_link,$checked_link;
	public $listtype,$listUser;
	protected $listeners = ['deleteItem','refreshCustomerLinksTable' => '$refresh'];

    public function updatingPerPage() {
        $this->resetPage();
    }
    public function mount(){
        $this->editorList = User::get();
        $this->QCList = User::get();
    }
    public function hydrate() {
        $this->dispatch( 'selectPerPage' );
    }
	
	#[On('triggerDelete')]
    public function triggerDelete($jobId)
    {
        $this->jobId = $jobId;
        $saleStatusDeleteInfo = Job::where('id', $jobId)->first();
        
        if ($saleStatusDeleteInfo) {
            $saleStatusDeleteInfo->delete();
            $this->dispatch('msgSuccess', __('Successfully deleted.'));
        } else {
            session()->flash('msgError', __('Failed to delete.'));
        }
    }
    public function filterEditor($id,$name)
    {
        $this->selected_editor = $name;
        // dd($id);
        $this->selected_editor_value = $id;
    }
    public function filterQC($id,$name)
    {
        $this->selected_QC = $name;
        // dd($id);
        $this->selected_QC_value = $id;
    }

    public function render()
    {
        $jobsList = Job::select('*');
        if($this->search){
            $jobsList = Job::where('name', 'like', '%'. $this->search .'%');
        }
        if($this->selected_editor_value !== null){
            $jobsList = Job::where('user_id',$this->selected_editor_value);
        }if($this->selected_QC_value !== null){
            $jobsList = Job::where('marketing_user_id',$this->selected_QC_value);
        }
        $result = $jobsList->paginate(10);
        return view('jobs::livewire.job-page',[
			'listJobs' => $result,
		]);
    }
}
