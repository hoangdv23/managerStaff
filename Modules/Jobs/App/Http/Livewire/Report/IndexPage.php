<?php

namespace Modules\Jobs\App\Http\Livewire\Report;

use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\On;
use App\Http\Export\CustomerInvoice;
use App\Http\Export\CustomerView;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\Jobs\Repositories\JobRepositoryInterface;
use Modules\Jobs\Repositories\JobRepository;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Entities\Jobs_have_type_service;
use Modules\Users\Entities\User;
use Modules\Customers\Entities\Customer;
use Modules\Jobs\Entities\Type_service;

class IndexPage extends Component
{
    use WithPagination;
    public $page,$editorList,$selected_editor,$QCList,$selected_QC,$customerId,$startday,$stopday;
    public $search = '',$CusList,$listType;
    public $selected_editor_value = null;
    public $selected_QC_value = null; 
	public 	$name,$customer_id,$status,$user_id,$marketing_user_id,$number_img,$type,$note,$start_date,$finish_date,$fixed_link,$edited_link,$checked_link;
	public $listtype,$listUser;


    public function updatingPerPage() {
        $this->resetPage();
    }

    public function mount(){
        $this->listType = Type_service::orderByDesc('id')->get();
        $this->editorList = Customer::get();    
        $this->startday=  date("Y-m")."-01";
        $this->stopday = date("Y-m-d", strtotime("last day of this month"));
        
    }
    #[On('exportCustomers')]
    public function exportCustomers(){
        $customerId = $this->customerId;
        $startday = $this->startday;
        $stopday = $this->stopday;
            // dd($this);
        if(is_null($this->customerId)){
            $cusName = 'ALL';
        }else{
            $cusNames = Customer::where('id',$customerId)->value('name');
            $cusName = stripVN($cusNames);
        }
        return Excel::download(new CustomerInvoice(
            $customerId = $this->customerId,
            $startday = $this->startday,
            $stopday = $this->stopday,
          ),
            'Bao_cao_kh_' . $cusName . '_' . NOW() . '.xlsx');
    }
    public function hydrate() {
        $this->dispatch( 'selectPerPage' );
    }

    public function filterEditor($value){
        $this->customerId = $value;
        $this->selected_editor = Customer::where('id',$value)->value('name');
        // dd($value);
    }
    public function render()
    {
        // dd($listType);
        $query = Jobs_have_type_service::query();
        if(!empty($this->customerId)){
            $query->where('customer_id',$this->customerId);
        }
        if (!empty($this->startday)) {
            $query->where('created_at', '>=', $this->startday);
            // dump($this->startday);
        }

        if (!empty($this->stopday)) {
            $query->where('created_at', '<=', $this->stopday);
        }

        $jobsList = $query->paginate(15);
        
        
        return view('jobs::livewire.report.index-page',[
            'customerList' => $jobsList,
            // 'listType' => $listType,
            'selected_editor' => $this->selected_editor,
        ]);
    }
}
