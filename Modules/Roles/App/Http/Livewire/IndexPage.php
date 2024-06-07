<?php

namespace Modules\Roles\App\Http\Livewire;

use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
class IndexPage extends DataTableComponent 
{
    protected $model = Role::class;

    public function configure(): void{
		$this->setPrimaryKey('id');
		$this->setPerPageAccepted([10, 25, 50, 100, -1]);
		$this->setPerPage(10);
		$this->setDefaultSort('id', 'desc');

		$this->setHideBulkActionsWhenEmptyStatus(true);

		$this->setThAttributes(function (Column $column) {
			if ($column->isField('id')) {
				return [
					'class' => 'text-end',
				];
			}

			return [];
		});

		$this->setTdAttributes(function (Column $column, $row, $columnIndex, $rowIndex) {
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
			Column::make(__('Guard Name'), 'guard_name'),
			Column::make(__('Action'), 'id')
				->format(
					fn($value, $row, Column $column) => view('roles::tables.actions.button')->withRow($row)
				),

		];
	}

    public function builder(): Builder {
		return Role::query()->where('name', '!=', 'super-administrator');
	}
    public function filters(): array
	{
		return [
			DateFilter::make(__('Created From'))
				->config([
					'min' => '2024-01-01',
					'max' => '2030-12-31',
				])
				->filter(function (Builder $builder, string $value) {
					$builder->where('created_at', '>=', $value);
				}),
			DateFilter::make(__('Created To'))
				->filter(function (Builder $builder, string $value) {
					$builder->where('created_at', '<=', $value);
				}),
		];
	}

    public function bulkActions(): array
	{
		return [
			/*'activate' => __('Activate'),
			'deactivate' => __('Deactivate'),*/
			'deleteSelected' => __('Delete item(s)'),
		];
	}

    public function deleteSelected() {
		foreach ($this->getSelected() as $idSelected) {
			$this->deleteItem($idSelected);
			$this->clearSelected();
		}
	}

	public function deleteItem($menuId) {
		//check mode action website
		$modeActionWebsite = env('MODE_ACTION_WEBSITE', true);
		if ($modeActionWebsite == false) {
			session()->flash('error', __('This function is not working demo system'));
			return redirect(route('routes'));
		}

		$permission = Role::findOrFail($menuId);
		if ($permission) {
			$permission->delete();
			$this->emit('msgSuccess', __('Successfully delete.'));
		} else {
			session()->flash('msgError', __('False delete.'));
		}
	}

    // public function render()
    // {
    //     return view('roles::livewire.index-page');
    // }
}
