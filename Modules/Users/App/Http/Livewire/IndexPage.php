<?php

namespace Modules\Users\App\Http\Livewire;

use Livewire\Component;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Illuminate\Database\Eloquent\Builder;
use Modules\Users\Entities\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Modules\Users\Repositories\UserRepositoryInterface;
use Spatie\Permission\Traits\HasRoles;
class IndexPage extends DataTableComponent
{
    public $roles = [],$editMode;
    protected $userRepository;
    
    protected $model = User::class;
    protected $userInfo,$iduser;

    protected $listeners = ['deleteItem','refreshCustomerLinksTable' => '$refresh'];


    public function mount(UserRepositoryInterface $userRepository)
    {   
    }
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([10, 25, 50, 100, -1]);
        $this->setPerPage(10);
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
    public function builder(): Builder
    {
        $userInfo = getUserInfo();

        $iduser = $userInfo['id'];
        $users = User::query()->where('users.id', '<>', 1);
        $roles = Role::where('name', '!=', 'super-administrator')->get()->pluck('name');
        return $users;
    }
    public function columns(): array
    {   
        return [
            Column::make(__('Id'), 'id')->sortable(),
            Column::make(__('Name'), 'name')->sortable()->searchable(),   
            Column::make(__('Username'), 'username')->sortable()->searchable(),   
            Column::make(__('Email'), 'email')->sortable()->searchable(), 
            Column::make(__('Số điện thoại'), 'phone')->sortable()->searchable(), 
            Column::make(__('Giá Editor'), 'phone')->sortable()->searchable(), 
            Column::make(__('Giá QC'), 'phone')->sortable()->searchable(), 
            Column::make('Vai trò')
                ->label(fn($row) => $row->roles->pluck('name')->implode(', ')),
            BooleanColumn::make(__('Status'), 'status')->sortable(),
            Column::make(__('Action'), 'id')   
            ->format(
                fn($value, $row, Column $column) => view('users::tables.actions.button')->withRow($row)
            )         

        ];
    }

    public function filters(): array
    {
        return [     
            SelectFilter::make(__('Status'))
            ->options([
                '' => __('All'),
                '1' => __('Active'),
                '0' => __('InActive'),
            ])
            ->filter(function(Builder $builder, string $value) {
                if ($value === '1') {
                    $builder->where('status', true);
                } elseif ($value === '0') {
                    $builder->where('status', false);
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
            'activate' => __('Activate'),
            'deactivate' => __('Deactivate'),
            'deleteSelected'  => __('Delete item(s)') 
        ];
    }

    public function activate()
    {
        User::whereIn('id', $this->getSelected())->update(['status' => true]);
        $this->clearSelected();
    }

    public function deactivate()
    {
        User::whereIn('id', $this->getSelected())->update(['status' => false]);

        $this->clearSelected();

    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $idSelected)
        {
            $this->deleteItem($idSelected);
            $this->clearSelected();
 #           User::flushQueryCache(['user_cache_tag']);
        }
    }

    public function deleteItem($userId)
    {

        $userInfoDelete = User::findOrFail($userId);
        DB::beginTransaction();
		try {
				if ($userInfoDelete) {
					$userInfoDelete->delete();
					$this->emit('msgSuccess', __('Successfully delete.'));
				} else {
					session()->flash('msgError', __('False delete.'));
				}
			}catch (\Exception $e) {
			session()->flash('msgError', __('False delete.'));
			Log::error($e->getMessage() . json_encode($e->getTrace()));
			DB::rollback();
		}
		// Else commit the queries
		DB::commit();
    }
}
