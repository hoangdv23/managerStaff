<?php

namespace Modules\Jobs\App\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Modules\Jobs\Entities\Type_service;

class TypePage extends DataTableComponent
{
    // #[On('createType')]
    // public function createType(){
    //     dd(123);
    // }
    protected $listeners = ['deleteItem','refreshCustomerLinksTable' => '$refresh'];
    protected $model = Type_service::class;
    public $typeId;
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([10, 25, 50, 100, -1]);
        $this->setPerPage(25);
        $this->setDefaultSort('id', 'desc');
        $this->setHideBulkActionsWhenEmptyStatus(true);
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id'),
            Column::make(__('Name'), 'name')->sortable()->searchable(),
            Column::make('Mã màu', 'color')->sortable()->searchable()->format(function( $valColor ) {
                return '<input type="color" value="'.$valColor.'" disabled>';
            })
                ->html(),
            Column::make(__('Action'), 'id')   
            ->format(
                fn($value, $row, Column $column) => view('jobs::tables.actions.button_type')->withRow($row)
            )         
        ];
    }




    // public function render()
    // {
    //     return view('jobs::livewire.type-page');
    // }
}
