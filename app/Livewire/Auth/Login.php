<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $username = '';
    public $password = '';

    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt(['username' => $this->username, 'password' => $this->password])) {
            $user = Auth::user();

            if ($user->status !== 'aktif') {
                Auth::logout();
                $this->addError('username', 'Akun Anda tidak aktif. Silakan hubungi Super Admin.');
                return;
            }

            // Update last login
            $user->update(['last_login' => now()]);

            // Redirect based on role
            return match ($user->role) {
                'super_admin' => redirect()->to('/superadmin/dashboard'),
                'admin_tenant', 'bendahara', 'pengawas' => redirect()->to('/admin/dashboard'),
                'petugas' => redirect()->to('/pwa/dashboard'),
                default => redirect()->to('/'),
            };
        }

        $this->addError('username', 'Kredensial yang diberikan tidak cocok dengan catatan kami.');
    }

    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.auth');
    }
}
