<?php


namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class Logout extends Component
{
    use WireToast;

    public $showLogoutConfirm = false;

    public function confirmLogout()
    {
        $this->showLogoutConfirm = true;
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        toast()->success('Logout Berhasil!', 'Sampai jumpa lagi!')->push();
        
        return redirect('/login');
    }

    public function cancelLogout()
    {
        $this->showLogoutConfirm = false;
    }

    public function render()
    {
        return view('livewire.auth.logout');
    }
}