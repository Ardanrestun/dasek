<?php


namespace App\Livewire\Setting;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class Setting extends Component
{
    use WireToast;

    public $name;
    public $email;
    public $current_password;
    public $password;
    public $password_confirmation;
    
    public $activeTab = 'profile';

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore(auth()->id()),
            ],
        ];
    }

    protected function passwordRules()
    {
        return [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ];
    }

    protected $messages = [
        'name.required' => 'Nama harus diisi.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan oleh user lain.',
        'current_password.required' => 'Password saat ini harus diisi.',
        'password.required' => 'Password baru harus diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ];

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetValidation();
        $this->resetPasswordFields();
    }

    public function updateProfile()
    {
        $this->validate();

        try {
            auth()->user()->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            toast()->success('Berhasil!', 'Profil berhasil diperbarui!')->push();
        } catch (\Exception $e) {
            toast()->danger('Error!', 'Terjadi kesalahan saat memperbarui profil.')->push();
        }
    }

    public function updatePassword()
    {
        $this->validate($this->passwordRules());

        if (!Hash::check($this->current_password, auth()->user()->password)) {
            $this->addError('current_password', 'Password saat ini tidak benar.');
            return;
        }

        try {
            auth()->user()->update([
                'password' => Hash::make($this->password),
            ]);

            $this->resetPasswordFields();
            toast()->success('Berhasil!', 'Password berhasil diperbarui!')->push();
        } catch (\Exception $e) {
            toast()->danger('Error!', 'Terjadi kesalahan saat memperbarui password.')->push();
        }
    }

    private function resetPasswordFields()
    {
        $this->current_password = '';
        $this->password = '';
        $this->password_confirmation = '';
    }

    public function render()
    {
        return view('livewire.setting.setting')->layout('layouts.app'); 
    }
}