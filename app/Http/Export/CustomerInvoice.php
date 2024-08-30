<?php
namespace App\Http\Export;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use Modules\Callcenter\Entities\Campaignreport;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Modules\Jobs\Entities\Job;
use Modules\Jobs\Entities\Jobs_have_type_service;
use Modules\Users\Entities\User;
use Modules\Customers\Entities\Customer;
use Modules\Jobs\Entities\Type_service;


class CustomerInvoice implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize, WithEvents
{
    protected $name,$customerId,$startday,$stopday;
	public function __construct(
		$customerId,
		$startday,
		$stopday,
	) {
		$this->customerId = $customerId;
		$this->startday = $startday;
		$this->stopday = $stopday;
	}
	
    
    public function headings(): array
	{
        

		$listType = Type_service::orderByDesc('id')->get()->pluck('name')->toArray();
		if($this->customerId !== null){
			$listType = typeServiceNameByCus($this->customerId);
			$listType = array_values($listType);
		}
		 
		return array_merge(
			[
				'STT',
				'Ngày tạo',
				'Tên job',
			],
			$listType,
			[
				'Thanh toán'
			]
		);

	}
    public function title(): string {
		return 'Báo cáo KH ' . date('d-m-Y');
	}

    public function collection(){
		$listType = Type_service::orderByDesc('id')->get()->pluck('name', 'id')->toArray();
		$query = Job::query();
		
		if(!empty($this->customerId)){
			$listType = typeServiceNameByCus($this->customerId);
			$query->where('customer_id', $this->customerId);
		}
		if (!empty($this->startday)) {
			$query->where('created_at', '>=', $this->startday);
		}
		if (!empty($this->stopday)) {
			$query->where('created_at', '<=', $this->stopday);
		}
		$results = $query->get();
		$arrInfo = [];
		
		if ($results->isNotEmpty()) {
			$i = 1;
			
			foreach ($results as $item) {
				$row = [
					'STT' => $i++,
					'Ngày tạo' => \Carbon\Carbon::parse($item['created_at'])->format('d-m-Y'),
					'Tên job' => $item->name,
				];
				foreach ($listType as $id => $name) {
					$row[$name] = hasTypeServices($id, $item->id);
				}
				$row['Thanh toán'] = invoiceCustomer($item->id);
				$arrInfo[] = $row;
			}
		} else {
			$arrInfo[] = [];
		}
		
		return collect($arrInfo);
	}
	
public function registerEvents(): array
	{
		return [
			AfterSheet::class => function (AfterSheet $event) {
				$cellRange = 'A1:J1'; // All headers
				$event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
				// set width
				$event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
				$event->sheet->getDelegate()->getColumnDimension('B')->setWidth(15);
				$event->sheet->getDelegate()->getColumnDimension('C')->setWidth(15);
				$event->sheet->getDelegate()->getColumnDimension('D')->setWidth(15);
				$event->sheet->getDelegate()->getColumnDimension('E')->setWidth(15);
				$event->sheet->getDelegate()->getColumnDimension('F')->setWidth(15);
				$event->sheet->getDelegate()->getColumnDimension('G')->setWidth(15);
				$event->sheet->getDelegate()->getColumnDimension('H')->setWidth(15);
				$event->sheet->getDelegate()->getColumnDimension('I')->setWidth(15);
				$event->sheet->getDelegate()->getColumnDimension('J')->setWidth(15);

			},
		];
	}

    public function batchSize(): int
    {
        return 1000;
    }
	public function chunkSize(): int
    {
        return 1000;
    }

}