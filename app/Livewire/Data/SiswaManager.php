<?php


namespace App\Livewire\Data;

use App\Models\Auth\Role;
use App\Models\Data\Siswa;
use App\Models\Data\Kelas;
use App\Models\Auth\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Usernotnull\Toast\Concerns\WireToast;

class SiswaManager extends Component
{
    use WithPagination, WireToast;

    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $showDetailModal = false;
    public $editMode = false;
    public $showDeleteConfirm = false;
    public $deleteId = null;

    public $siswaId;
    public $nama_siswa = '';
    public $nisn = '';
    public $nis = '';
    public $jenis_kelamin = '';
    public $tempat_lahir = '';
    public $tanggal_lahir = '';
    public $alamat = '';
    public $no_telepon = '';
    public $kelas_id = '';
    public $user_id = '';

    public $name = '';
    public $email = '';
    public $password = '';

    public $selectedSiswa;

    protected function rules()
    {
        return [
            'nama_siswa' => 'required|string|max:255',
            'nisn' => [
                'required',
                'string',
                'max:20',
                Rule::unique('siswa', 'nisn')->ignore($this->siswaId),
            ],
            'nis' => [
                'required',
                'string',
                'max:20',
                Rule::unique('siswa', 'nis')->ignore($this->siswaId),
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'nullable|string|max:20',
            'kelas_id' => 'required|exists:kelas,id',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user_id),
            ],
            'password' => $this->editMode ? 'nullable|min:8' : 'required|min:8',
        ];
    }

    protected function createRules()
    {
        return [
            'nama_siswa' => 'required|string|max:255',
            'nisn' => [
                'required',
                'string',
                'max:20',
                Rule::unique('siswa', 'nisn'),
            ],
            'nis' => [
                'required',
                'string',
                'max:20',
                Rule::unique('siswa', 'nis'),
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'nullable|string|max:20',
            'kelas_id' => 'required|exists:kelas,id',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],
            'password' => 'required|min:8',
        ];
    }

    protected function updateRules()
    {
        return [
            'nama_siswa' => 'required|string|max:255',
            'nisn' => [
                'required',
                'string',
                'max:20',
                Rule::unique('siswa', 'nisn')->ignore($this->siswaId),
            ],
            'nis' => [
                'required',
                'string',
                'max:20',
                Rule::unique('siswa', 'nis')->ignore($this->siswaId),
            ],
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'nullable|string|max:20',
            'kelas_id' => 'required|exists:kelas,id',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->user_id),
            ],
            'password' => 'nullable|min:8',
        ];
    }

    protected $messages = [
        'nama_siswa.required' => 'Nama siswa harus diisi.',
        'nama_siswa.max' => 'Nama siswa maksimal 255 karakter.',
        'nisn.required' => 'NISN harus diisi.',
        'nisn.unique' => 'NISN sudah digunakan.',
        'nisn.max' => 'NISN maksimal 20 karakter.',
        'nis.required' => 'NIS harus diisi.',
        'nis.unique' => 'NIS sudah digunakan.',
        'nis.max' => 'NIS maksimal 20 karakter.',
        'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
        'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
        'tempat_lahir.required' => 'Tempat lahir harus diisi.',
        'tempat_lahir.max' => 'Tempat lahir maksimal 255 karakter.',
        'tanggal_lahir.required' => 'Tanggal lahir harus diisi.',
        'tanggal_lahir.date' => 'Format tanggal lahir tidak valid.',
        'alamat.required' => 'Alamat harus diisi.',
        'no_telepon.max' => 'No. telepon maksimal 20 karakter.',
        'kelas_id.required' => 'Kelas harus dipilih.',
        'kelas_id.exists' => 'Kelas yang dipilih tidak valid.',
        'name.required' => 'Nama user harus diisi.',
        'name.max' => 'Nama user maksimal 255 karakter.',
        'email.required' => 'Email harus diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'email.max' => 'Email maksimal 255 karakter.',
        'password.required' => 'Password harus diisi.',
        'password.min' => 'Password minimal 8 karakter.',
    ];

    public function render()
    {
        $siswa = Siswa::with(['kelas', 'user'])
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nama_siswa', 'like', '%' . $this->search . '%')
                        ->orWhere('nisn', 'like', '%' . $this->search . '%')
                        ->orWhere('nis', 'like', '%' . $this->search . '%')
                        ->orWhereHas('kelas', function ($kelas) {
                            $kelas->where('nama_kelas', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->orderBy('nama_siswa')
            ->paginate($this->perPage);

        $kelasList = Kelas::orderBy('nama_kelas')->get();

        return view('livewire.data.siswa-manager', compact('siswa', 'kelasList'))->layout('layouts.app');
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
            $siswa = Siswa::with('user')->findOrFail($id);

            $this->siswaId = $siswa->id;
            $this->nama_siswa = $siswa->nama_siswa;
            $this->nisn = $siswa->nisn;
            $this->nis = $siswa->nis;
            $this->jenis_kelamin = $siswa->jenis_kelamin;
            $this->tempat_lahir = $siswa->tempat_lahir;
            $this->tanggal_lahir = $siswa->tanggal_lahir;
            $this->alamat = $siswa->alamat;
            $this->no_telepon = $siswa->no_telepon;
            $this->kelas_id = $siswa->kelas_id;
            $this->user_id = $siswa->user_id;

            if ($siswa->user) {
                $this->name = $siswa->user->name;
                $this->email = $siswa->user->email;
            }

            $this->editMode = true;
            $this->showModal = true;
        } catch (\Exception $e) {
            toast()->danger('Error!', 'Siswa tidak ditemukan!')->push();
        }
    }

    public function show($id)
    {
        try {
            $this->selectedSiswa = Siswa::with(['kelas', 'user','waliMurid'])->findOrFail($id);
            $this->showDetailModal = true;
        } catch (\Exception $e) {
            toast()->danger('Error!', 'Siswa tidak ditemukan!')->push();
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
                $siswa = Siswa::findOrFail($this->siswaId);
                $siswa->update([
                    'nama_siswa' => $this->nama_siswa,
                    'nisn' => $this->nisn,
                    'nis' => $this->nis,
                    'jenis_kelamin' => $this->jenis_kelamin,
                    'tempat_lahir' => $this->tempat_lahir,
                    'tanggal_lahir' => $this->tanggal_lahir,
                    'alamat' => $this->alamat,
                    'no_telepon' => $this->no_telepon,
                    'kelas_id' => $this->kelas_id,
                ]);

                if ($siswa->user) {
                    $userData = [
                        'name' => $this->name,
                        'email' => $this->email,
                    ];

                    if (!empty($this->password)) {
                        $userData['password'] = Hash::make($this->password);
                    }

                    $siswa->user->update($userData);
                }

                toast()->success('Berhasil!', 'Siswa berhasil diperbarui!')->push();
            } else {
                $roleId = Role::where('name', 'Siswa')->first()->id;
                $user = User::create([
                    'name' => $this->name,
                    'email' => $this->email,
                    'password' => Hash::make($this->password),
                    'role_id' =>  $roleId,
                ]);

                Siswa::create([
                    'nama_siswa' => $this->nama_siswa,
                    'nisn' => $this->nisn,
                    'nis' => $this->nis,
                    'jenis_kelamin' => $this->jenis_kelamin,
                    'tempat_lahir' => $this->tempat_lahir,
                    'tanggal_lahir' => $this->tanggal_lahir,
                    'alamat' => $this->alamat,
                    'no_telepon' => $this->no_telepon,
                    'kelas_id' => $this->kelas_id,
                    'user_id' => $user->id,
                ]);

                toast()->success('Berhasil!', 'Siswa berhasil ditambahkan!')->push();
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
            $siswa = Siswa::findOrFail($this->deleteId);

            if ($siswa->user) {
                $siswa->user->delete();
            }

            $siswa->delete();
            toast()->success('Berhasil!', 'Siswa berhasil dihapus!')->push();
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
        $this->siswaId = null;
        $this->nama_siswa = '';
        $this->nisn = '';
        $this->nis = '';
        $this->jenis_kelamin = '';
        $this->tempat_lahir = '';
        $this->tanggal_lahir = '';
        $this->alamat = '';
        $this->no_telepon = '';
        $this->kelas_id = '';
        $this->user_id = '';
        $this->name = '';
        $this->email = '';
        $this->password = '';
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
        $this->selectedSiswa = null;
    }
}