<?php

namespace Modules\Users\App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Users\Repositories\UserRepositoryInterface;
use Livewire\Attributes\On; 
use Modules\Users\Entities\User;
class EditPage extends Component
{
    public $name, $username, $phone, $email, $show_all_record, $roles = [],$userid= [];
	public $editMode,$listRole,$titleForm;
	protected $userRepository;
	private $userInfo;
	public $userId;
    // public User $userid;


    public function boot(UserRepositoryInterface $userRepository) {
		$this->userRepository = $userRepository;
	}

    #[On('triggerEdit')]
    public function triggerEdit( $userId)
    {
        $this->userId = $userId;
        $this->userInfo = $this->userRepository->find($userId);
        // dd($this->userInfo);
        if($this->userInfo){
			$this->name = $this->userInfo->name;
			$this->username = $this->userInfo->username;
			$this->phone = $this->userInfo->phone;
			$this->email = $this->userInfo->email;
			$this->status = $this->userInfo->status;
		}
        action_modal(
			$content = $this,
			$modalId = '#user-update',
			$actionModal = 'show',
			$flashMessage = null,
			$flashType = null
		);
    }

    public function editUsers($userId)
    {
        $this->userId= $userId;
        $this->userInfo = $this->userRepository->find($userId);
        DB::beginTransaction();
        try {
			$flashType = 'success';
			$flashMessage = 'Chỉnh sửa tài khoản thành công.';
            $dataEditClient = [
                'name' => $this->name,
                'username' => trim($this->username),
                'phone' => trim($this->phone),
                'email' => trim($this->email),
                'show_all_record' => $this->show_all_record,
            ];
            $userUpdate = $this->userRepository->update($this->userId, $dataEditClient);
        }catch (\Exception $e) {
			$flashType = 'error';
			$flashMessage = 'Chỉnh sửa tài khoản không thành công.';
			Log::error($e->getMessage() . json_encode($e->getTrace()));
			DB::rollback();
		}

        DB::commit();
        action_modal(
			$content = $this,
			$modalId = '#user-update',
			$actionModal = 'hide',
			$flashMessage = $flashMessage ?? NULL,
			$flashType = $flashType ?? NULL
		);
    }
    public function render()
    {
        $this->titleForm = 'Chỉnh sửa người dùng';
        return view('users::livewire.edit-page');
    }
}
