<?php

namespace Modules\Roles\App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Roles\Repositories\RoleRepositoryInterface;
use Spatie\Permission\Models\Permission;
class CreatePage extends Component
{
    public $name, $guard_name, $selectedPermissions = [];
	public $permissionArr;
	public $selectAll = false;
	protected $roleRepository;

	private function listPermission() {
		$modules = Permission::select('module')->distinct()->orderBy('module')->get();
		$rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", 0)
			->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
			->all();

		$listDataPermission = [];
		foreach ($modules as $module) {
			$module['rolePermissions'] = $rolePermissions;
			$module['id'] = 0;
			$module['name'] = $module['module'];
			$module['children'] = has_child_permission($module['module'], $rolePermissions);
			$listDataPermission[] = $module;
		}
		return $listDataPermission;
	}

	//Use boot correct than mount. Check Class Hooks Livewire
	public function boot(RoleRepositoryInterface $roleRepository) {
		$this->roleRepository = $roleRepository;
		// dd($this->roleRepository);
	}


	public function updatedSelectAll($value) {
		if ($value) {
			$this->selectedPermissions = Permission::pluck('name');
		} else {
			$this->selectedPermissions = [];
		}
	}

	public function updatedSelectedPermissions($value) {
		
		$this->selectAll = true;
		// dd($this->selectAll);
	}

	public function store() {
		$data = [
			'name' => $this->name,
			'guard_name' => 'web',
		];

		$permissionRole = $this->selectedPermissions ?? [];
		if ($permissionRole) {
			unset($this->selectedPermissions);
		}
		DB::beginTransaction();
		try {
			session()->flash('success', __('Successfully created.'));
			$roleCreate = $this->roleRepository->create([
				'name' => $this->name,
				'guard_name' => 'web',
			]);
			$roleCreate->syncPermissions($permissionRole);
		} catch (\Exception $e) {
			session()->flash('error', __('False updated.'));
			Log::error($e->getMessage() . json_encode($e->getTrace()));
			DB::rollback();
		}
		// Else commit the queries
		DB::commit();
		return redirect(route('roles.index'));
	}
    public function render()
    {
        $this->permissionArr = $this->listPermission();
        return view('roles::livewire.create-page');
    }
}
