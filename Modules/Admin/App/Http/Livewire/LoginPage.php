<?php

namespace Modules\Admin\App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Modules\Users\Entities\User;
class LoginPage extends Component
{
    public $email;
    public $password,$username;
    public function render()
    {
        return view('admin::livewire.login-page');
    }
    public function loginPage()
    {
        
        $fieldType = filter_var($this->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Thử đăng nhập
        if (Auth::attempt([$fieldType => $this->email, 'password' => $this->password])) {
            // Lấy thông tin người dùng dựa trên email hoặc username và đăng nhập thành công
            $user = User::where($fieldType, $this->email)->first();

            // Điều hướng tới trang chủ hoặc trang dự định
            return redirect()->intended('/users');
        } else {
            // Đặt thông báo lỗi
            session()->flash('message', 'Sai tài khoản hoặc mật khẩu');
            return redirect()->back();
        }
    }
}
