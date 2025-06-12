<?php

namespace App\Livewire\Data;

use App\Models\Data\Guru;
use App\Models\Data\Kelas;
use App\Models\Auth\User;
use App\Models\Auth\Role;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Usernotnull\Toast\Concerns\WireToast;

class GuruManager extends Component
{
    use WithPagination, WireToast;

    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $showDetailModal = false;
    public $editMode = false;
    public $showDeleteConfirm = false;
    public $deleteId = null;
    
    public $guruId;
    public $nama_guru = '';
    public $nip = '';
    public $jenis_kelamin = '';
    public $tempat_lahir = '';
    public $tanggal_lahir = '';
    public $alamat = '';
    public $no_telepon = '';
    public $user_id = '';
    
    public $name = '';
    public $email = '';
    public $password = '';
    
    public $selectedKelas = [];
    
    public $selectedGuru;

    protected function rules()
    {
        return [
            'nama_guru' => 'required|string|max:255',
            'nip' => [
                'required',
                'string',
                'max:20',
                Rule::unique('guru', 'nip')->ignore($this->guruId),
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'nullable|string|max:20',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user_id),
            ],
            'password' => $this->editMode ? 'nullable|min:8' : 'required|min:8',
            'selectedKelas' => 'nullable|array',
            'selectedKelas.*' => 'exists:kelas,id',
        ];
    }

    protected function createRules()
    {
        return [
            'nama_guru' => 'required|string|max:255',
            'nip' => [
                'required',
                'string',
                'max:20',
                Rule::unique('guru', 'nip'),
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'nullable|string|max:20',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],
            'password' => 'required|min:8',
            'selectedKelas' => 'nullable|array',
            'selectedKelas.*' => 'exists:kelas,id',
        ];
    }

    protected function updateRules()
    {
        return [
            'nama_guru' => 'required|string|max:255',
            'nip' => [
                'required',
                'string',
                'max:20',
                Rule::unique('guru', 'nip')->ignore($this->guruId),
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'nullable|string|max:20',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user_id),
            ],
            'password' => 'nullable|min:8',
            'selectedKelas' => 'nullable|array',
            'selectedKelas.*' => 'exists:kelas,id',
        ];
    }

    protected $messages = [
        'nama_guru.required' => 'Nama guru harus diisi.',
        'nama_guru.max' => 'Nama guru maksimal 255 karakter.',
        'nip.required' => 'NIP harus diisi.',
        'nip.unique' => 'NIP sudah digunakan.',
        'nip.max' => 'NIP maksimal 20 karakter.',
        'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
        'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
        'tempat_lahir.required' => 'Tempat lahir harus diisi.',
        'tempat_lahir.max' => 'Tempat lahir maksimal 255 karakter.',
        'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
        'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
        'alamat.required' => 'Alamat harus diisi.',
        'no_telepon.max' => 'No. telepon maksimal 20 karakter.',
        'name.required' => 'Nama user harus diisi.',
        'name.max' => 'Nama user maksimal 255 karakter.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'email.max' => 'Email maksimal 255 karakter.',
        'password.required' => 'Password harus diisi.',
        'password.min' => 'Password minimal 8 karakter.',
        'selectedKelas.array' => 'Kelas harus berupa array.',
        'selectedKelas.*.exists' => 'Kelas yang dipilih tidak valid.',
    ];

    public function render()
    {
        $guru = Guru::with(['user', 'kelas'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nama_guru', 'like', '%' . $this->search . '%')
                      ->orWhere('nip', 'like', '%' . $this->search . '%')
                      ->orWhereHas('user', function ($user) {
                          $user->where('email', 'like', '%' . $this->search . '%');
                      });
                });
            })
            ->orderBy('nama_guru')
            ->paginate($this->perPage);

        $kelasList = Kelas::orderBy('nama_kelas')->get();

        return view('livewire.data.guru-manager', compact('guru', 'kelasList'))->layout('layouts.app');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function create()
    {
        $this->resetForm();
        $this->editMode = false;
        $this->showModal = true;
    }

    public function edit($id)
    {
        try {
            $guru = Guru::with(['user', 'kelas'])->findOrFail($id);
            
            $this->guruId = $guru->id;
            $this->nama_guru = $guru->nama_guru;
            $this->nip = $guru->nip;
            $this->jenis_kelamin = $guru->jenis_kelamin;
            $this->tempat_lahir = $guru->tempat_lahir;
            $this->tanggal_lahir = $guru->tanggal_lahir;
            $this->alamat = $guru->alamat;
            $this->no_telepon = $guru->no_telepon;
            $this->user_id = $guru->user_id;
            
            $this->selectedKelas = $guru->kelas->pluck('id')->toArray();
            
            if ($guru->user) {
                $this->name = $guru->user->name;
                $this->email = $guru->user->email;
            }
            
            $this->editMode = true;
            $this->showModal = true;
        } catch (\Exception $e) {
            toast()->danger('Error!', 'Guru tidak ditemukan!')->push();
        }
    }

    public function show($id)
    {
        try {
            $this->selectedGuru = Guru::with(['user', 'kelas'])->findOrFail($id);
            $this->showDetailModal = true;
        } catch (\Exception $e) {
            toast()->danger('Error!', 'Guru tidak ditemukan!')->push();
        }
    }

    public function store()
    {
        if ($this->editMode) {
            $this->validate($this->updateRules());
        } else {
            $this->validate($this->createRules());
        }

        try {
            if ($this->editMode) {
                $guru = Guru::findOrFail($this->guruId);
                $guru->update([
                    'nama_guru' => $this->nama_guru,
                    'nip' => $this->nip,
                    'jenis_kelamin' => $this->jenis_kelamin,
                    'tempat_lahir' => $this->tempat_lahir,
                    'tanggal_lahir' => $this->tanggal_lahir,
                    'alamat' => $this->alamat,
                    'no_telepon' => $this->no_telepon,
                ]);

                $guru->kelas()->sync($this->selectedKelas);

                if ($guru->user) {
                    $userData = [
                        'name' => $this->name,
                        'email' => $this->email,
                    ];
                    
                    if (!empty($this->password)) {
                        $userData['password'] = Hash::make($this->password);
                    }
                    
                    $guru->user->update($userData);
                }

                toast()->success('Berhasil!', 'Guru berhasil diperbarui!')->push();
            } else {
                $roleId = Role::where('name', 'Guru')->first()->id ?? null;
                
                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                    'role_id' => $roleId,
                ]);

                $guru = Guru::create([
                    'nama_guru' => $this->nama_guru,
                    'nip' => $this->nip,
                    'jenis_kelamin' => $this->jenis_kelamin,
                    'tempat_lahir' => $this->tempat_lahir,
                    'tanggal_lahir' => $this->tanggal_lahir,
                    'alamat' => $this->alamat,
                    'no_telepon' => $this->no_telepon,
                    'user_id' => $user->id,
                ]);

                $guru->kelas()->attach($this->selectedKelas);

                toast()->success('Berhasil!', 'Guru berhasil ditambahkan!')->push();
            }

            $this->resetForm();
            $this->showModal = false;
        } catch (\Exception $e) {
            toast()->danger('Error!', 'Terjadi kesalahan: ' . $e->getMessage())->push();
        }
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->showDeleteConfirm = true;
    }

    public function delete()
    {
        try {
            $guru = Guru::findOrFail($this->deleteId);
            
            $guru->kelas()->detach();
            
            if ($guru->user) {
                $guru->user->delete();
            }
            
            $guru->delete();
            toast()->success('Berhasil!', 'Guru berhasil dihapus!')->push();
            $this->showDeleteConfirm = false;
        } catch (\Exception $e) {
            toast()->danger('Error!', 'Terjadi kesalahan: ' . $e->getMessage())->push();
            $this->showDeleteConfirm = false;
        }
    }

    public function cancelDelete()
    {
        $this->showDeleteConfirm = false;
        $this->deleteId = null;
    }

    public function resetForm()
    {
        $this->guruId = null;
        $this->nama_guru = '';
        $this->nip = '';
        $this->jenis_kelamin = '';
        $this->tempat_lahir = '';
        $this->tanggal_lahir = '';
        $this->alamat = '';
        $this->no_telepon = '';
        $this->user_id = '';
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->selectedKelas = [];
        $this->resetValidation();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->selectedGuru = null;
    }
}