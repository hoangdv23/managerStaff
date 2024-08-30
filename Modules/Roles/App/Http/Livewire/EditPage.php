<?php

namespace Modules\Roles\App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Modules\Roles\Repositories\RoleRepositoryInterface;
use Modules\Users\Entities\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditPage extends Component
{
	public $name, $guard_name, $selectedPermissions = [];
	public $permissionArr;
	public $selectAll = false;
	public $firstId = null;
	private $roleInfo;
	public $roleId;
	public $rolePermissionAdded;
	protected $roleRepository;

	//Use boot correct than mount. Check Class Hooks Livewire
	public function boot(RoleRepositoryInterface $roleRepository) {
		$this->roleRepository = $roleRepository;
	}

	public function mount($role) {
		$this->roleInfo = $this->roleRepository->find($role);
		if ($this->roleInfo) {
			$this->roleId = $role;
			$this->name = $this->roleInfo->name;
			$this->guard_name = $this->roleInfo->guard_name;
			$this->selectedPermissions = isset($this->roleInfo) ? $this->roleInfo->permissions()->pluck('name')->toArray() : [];
		} else {
			session()->flash('error', __('Not found.'));
			return redirect(route('roles.index'));
		}

	}

	private function listPermission() {
		$modules = Permission::select('module')->distinct()->orderBy('module')->get();
		$rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $this->roleId)
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

	protected function rules() {
		return [
			'name' => 'required|min:3',
		];
	}

	protected function messages() {
		return [
			'name.required' => __('The :attribute cannot be empty.'),
			'name.min' => __('The :attribute must be at least :min characters.'),
		];
	}

	protected function validationAttributes() {
		return [
			'name' => __('Name'),
		];
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
	}

	public function store() {
		//check mode action website
		$modeActionWebsite = $this->roleRepository->checkModeActionWebsite();
		if ($modeActionWebsite == false) {
			session()->flash('error', __('This function is not working demo system'));
			return redirect(route('roles.index'));

		}

		$this->validate();

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
			$roleResult = $this->roleRepository->find($this->roleId);
			session()->flash('success', __('Successfully updated.'));
			$roleUpdate = $roleResult->update([
				'name' => $this->name,
				'guard_name' => $this->guard_name,
			]);

			$roleResult->syncPermissions($permissionRole);
			//Xoá cache sync permission cho Role khi edit
			$listUserWithRole = User::role($roleResult->name)->pluck('id')->toArray();
			//forgetArrayCache($listUserWithRole);

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
        return view('roles::livewire.edit-page');
    }
}
