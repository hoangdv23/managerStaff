<?php

namespace Modules\Customers\App\Http\Livewire;

use Livewire\Component;
use Modules\Customers\Entities\Customer;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Illuminate\Database\Eloquent\Builder;
class IndexPage extends DataTableComponent
{

    protected $model = Customer::class;

    protected $listeners = ['deleteItem','refreshCustomerLinksTable'=>'refesh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([10, 25, 50, 100, -1]);
        $this->setPerPage(25);
        $this->setDefaultSort('id', 'desc');

        $this->setHideBulkActionsWhenEmptyStatus(true);

        $this->setThAttributes(function(Column $column) {
            if ($column->isField('id')) {
              return [
                'class' => 'text-end',
            ];
        }

        return [];
    });

        $this->setTdAttributes(function(Column $column, $row, $columnIndex, $rowIndex) {
            if ($column->isField('id')) {
              return [
                'class' => 'text-end',
            ];
        }

        return [];
    });

    }



    public function columns(): array
    {
        return [
            Column::make('ID', 'id')->hideIf(true),
            Column::make(__('Name'), 'name')->sortable()->searchable(),
            Column::make(__('Mã khách hàng'), 'code')->sortable()->searchable(),
            Column::make(__('Email'), 'email')->sortable()->searchable(),
            Column::make(__('Số điện thoại'), 'phone'),
            Column::make(__('Ghi chú'), 'note'),
            Column::make(__('Loại khách hàng'),'type')->hideIf(true),
            BooleanColumn::make(__('Status'), 'status'),
            Column::make(__('Action'), 'id')   
            ->format(
                fn($value, $row, Column $column) => view('customers::tables.actions.button')->withRow($row)
            )         

        ];
    }


    public function filters(): array
    {
        return [     
            SelectFilter::make(__('Status'))
            ->options([
                '' => __('All'),
                '0' => __('Inactive'),
                '1'     => __('Active'),
            ])
            ->filter(function(Builder $builder, string $value) {
                if ($value === 'Inactive') {
                    $builder->where('status', '0');
                } elseif ($value === 'Active') {
                    $builder->where('status', '1');
                }
            }),
            DateFilter::make(__('Created From'))
            ->config([
                'min' => '2023-01-01',
                'max' => '2050-12-31',
            ])
            ->filter(function(Builder $builder, string $value) {
                $builder->where('created_at', '>=', $value);
            }),
            DateFilter::make(__('Created To'))
            ->filter(function(Builder $builder, string $value) {
                $builder->where('created_at', '<=', $value);
            }),
        ];
    }


    public function bulkActions(): array
    {
        return [
            'published' => __('Published'),
            'draft' => __('Draft'),
            'pending' => __('Pending'),
            'deleteSelected'  => __('Delete item(s)') 
        ];
    }

    public function published()
    {
        Customer::whereIn('id', $this->getSelected())->update(['status' => 'published']);
        //Delete cache
        Customer::flushQueryCache(['customer_cache_tag']);
        $this->clearSelected();
    }

    public function draft()
    {
        Customer::whereIn('id', $this->getSelected())->update(['status' => 'draft']);
        //Delete cache
        Customer::flushQueryCache(['customer_cache_tag']);
        $this->clearSelected();
    }


    public function deleteSelected()
    {
        foreach($this->getSelected() as $idSelected)
        {
            $this->deleteItem($idSelected);
            $this->clearSelected();
        }
    }

    public function deleteItem($cutomerId)
    {
        $customer = Customer::findOrFail($cutomerId);
        if($customer){
            $customer->delete();
            $this->dispatch('msgSuccess', __('Successfully delete.'));
        }else{
            session()->flash('msgError', __('False delete.'));
        }
    }
}
