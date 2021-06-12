<?php

namespace App\Http\Livewire\Auth;

use App\Services\AuthService;
use Livewire\Component;

class Login extends Component
{
    public $username, $password, $remember;

    protected $rules = [
        'username' => 'required|exists:users',
        'password' => 'required|min:8'
    ];

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login(AuthService $auth)
    {
        $data = [
            'username' => $this->username,
            'password' => $this->password
        ];

        $customMessages = [
            'exists' => "Username doesn't exist.",
            'min' => "The password must be at least 8 characters"
        ];

        $credentials = $this->validate($this->rules, $customMessages, $data);
        $remember = !empty($this->remember);

        if ($auth->login($credentials, $remember)) {
            return redirect()->route('home');
        } else {
            session()->flash('error', 'Username atau Password Anda salah!.');
        }
    }
}
