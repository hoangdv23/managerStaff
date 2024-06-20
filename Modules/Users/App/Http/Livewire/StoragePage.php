<?php

namespace Modules\Users\App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\Users\Repositories\UserRepositoryInterface;
use Livewire\Attributes\On; 

class StoragePage extends Component
{
    public $confirmPassword, $newPassword, $userId,$titleForm,$username;
    protected $userRepository;
    public function boot(
        UserRepositoryInterface $userRepository
    ) {
        $this->userRepository = $userRepository;
    }
    #[On('triggerPw')]
    public function triggerPw($userId){
        $this->userId = $userId;
        $this->userInfo = $this->userRepository->find($userId);
        if($this->userInfo){
			$this->username = $this->userInfo->username;
		}
        action_modal(
			$content = $this,
			$modalId = '#user-password',
			$actionModal = 'show',
			$flashMessage = null,
			$flashType = null
		);
    }
    public function store($userId)
    {
        // dd(userId);
        DB::beginTransaction();
        try {

                $data = [
                    'password' => bcrypt($this->newPassword),
                ];
                // dd($this->newPassword);
                $userUpdate = $this->userRepository->update($this->userId, $data);
                session()->flash('success', __('setting.Your password has been updated.'));
            }catch (\Exception $e) {
            session()->flash('error', __('setting.Your password false updated.'));
            DB::rollback();
        }
        // Else commit the queries
        DB::commit();
        action_modal(
			$content = $this,
			$modalId = '#user-password',
			$actionModal = 'hide',
			$flashMessage = null,
			$flashType = null
		);
    }
    public function render()
    {
        $this->titleForm = 'Đổi mật khẩu';
        return view('users::livewire.storage-page');
    }
}
