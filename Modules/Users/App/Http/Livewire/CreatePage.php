<?php

namespace Modules\Users\App\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\On; 
use App\Enums\CommonType;
use App\Enums\SubscriberType;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\RequiredIf;

use Modules\Users\Repositories\UserRepositoryInterface;
use Spatie\Permission\Models\Role;
class CreatePage extends Component
{
    public $name, $username, $phone, $email, $password, $roles = [];
	public $listRole, $userInfo;
	protected $userRepository;


    public function mount() {
		$this->listRole = Role::where('name', '!=', 'super-administrator')->get()->pluck('name');
		$this->userInfo = getUserInfo();
	}
    public function boot(
		UserRepositoryInterface $userRepository,
	) {
		$this->userRepository = $userRepository;
	}

    public function hydrate() {
		$this->dispatch('selectRole');
	}

    public function createUser() {

		$listRoles = $this->roles ?? [];
		if ($listRoles) {
			unset($this->roles);
		}

		DB::beginTransaction();
		try {

				$data = [
					'name' => $this->name,
					'username' => trim($this->username),
					'phone' => trim($this->phone),
					'email' => trim($this->email),
					'password' => Hash::make($this->password),
				];
				$userCreate = $this->userRepository->create($data);
				$userCreate->syncRoles($listRoles);
				session()->flash('success', __('user.User successfully created.'));
			} catch (\Exception $e) {
			session()->flash('error', __('user.User false created.'));
			Log::error($e->getMessage() . json_encode($e->getTrace()));
			DB::rollback();
		}
		// Else commit the queries
		DB::commit();
		return redirect(route('users.index'));
	}


    public function render()
    {
        return view('users::livewire.create-page');
    }
}
