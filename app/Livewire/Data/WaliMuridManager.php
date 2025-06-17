<?php

namespace App\Livewire\Data;

use App\Models\Data\Siswa;
use App\Models\Data\WaliMurid;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class WaliMuridManager extends Component
{

    use WithPagination, WireToast;
    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $showDetailModal = false;
    public $editMode = false;
    public $showDeleteConfirm = false;
    public $deleteId = null;

    public $waliMuridId;
    public $nama_walimurid = '';
    public $hubungan = '';
    public $pekerjaan = '';
    public $jenis_kelamin = '';
    public $no_telepon = '';
    public $siswa_id = '';
    public $selectedWaliMurid;


    protected function rules()
    {
        return [
            'nama_walimurid' => [
                'required',
                'string',
                'min:3',
                'max:50',
            ],
            'hubungan' => [
                'required',
                'string',
                'min:3',
                'max:50',
            ],
            'pekerjaan' => [
                'nullable',
                'string',
                'max:50',
            ],
            'jenis_kelamin' => [
                'required',
                'string',
                'in:Laki-laki,Perempuan',
            ],
            'no_telepon' => [
                'required',
                'string',
                'max:15',
            ],
            'siswa_id' => [
                'required',
                'exists:siswa,id'
            ]
        ];
    }

    protected function createRules()
    {
        return [
            'nama_walimurid' => [
                'required',
                'string',
                'min:3',
                'max:50',
            ],
            'hubungan' => [
                'required',
                'string',
                'min:3',
                'max:50',
            ],
            'pekerjaan' => [
                'nullable',
                'string',
                'max:50',
            ],
            'jenis_kelamin' => [
                'required',
                'string',
                'in:Laki-laki,Perempuan',
            ],
            'no_telepon' => [
                'required',
                'string',
                'max:15',
            ],
            'siswa_id' => [
                'required',
            ]
        ];
    }
    protected function updateRules()
    {
        return [
            'nama_walimurid' => [
                'required',
                'string',
                'min:3',
                'max:50',
            ],
            'hubungan' => [
                'required',
                'string',
                'min:3',
                'max:50',
            ],
            'pekerjaan' => [
                'nullable',
                'string',
                'max:50',
            ],
            'jenis_kelamin' => [
                'required',
                'string',
                'in:Laki-laki,Perempuan',
            ],
            'no_telepon' => [
                'required',
                'string',
                'max:15',
            ],
            'siswa_id' => [
                'required',
            ]
        ];
    }
    protected $messages = [
        'nama_walimurid.required' => 'Nama wali murid harus diisi.',
        'nama_walimurid.string' => 'Nama wali murid harus berupa teks.',
        'nama_walimurid.min' => 'Nama wali murid minimal 3 karakter.',
        'nama_walimurid.max' => 'Nama wali murid maksimal 50 karakter.',
        'hubungan.required' => 'Hubungan wali murid harus diisi.',
        'hubungan.string' => 'Hubungan wali murid harus berupa teks.',
        'hubungan.min' => 'Hubungan wali murid minimal 3 karakter.',
        'hubungan.max' => 'Hubungan wali murid maksimal 50 karakter.',
        'pekerjaan.string' => 'Pekerjaan wali murid harus berupa teks.',
        'pekerjaan.max' => 'Pekerjaan wali murid maksimal 50 karakter.',
        'jenis_kelamin.required' => 'Jenis kelamin harus diisi.',
        'jenis_kelamin.in' => 'Jenis kelamin harus Laki-laki atau Perempuan.',
        'no_telepon.required' => 'Nomor telepon harus diisi.',
        'no_telepon.string' => 'Nomor telepon harus berupa teks.',
        'no_telepon.max' => 'Nomor telepon maksimal 15 karakter.',
        'siswa_id.required' => 'Siswa harus dipilih.',
        'siswa_id.exists' => 'Siswa tidak ditemukan.'
    ];



    public function render()
    {
        $waliMurid = WaliMurid::with('siswa')
            ->when($this->search, function ($query) {
                $query->where('nama_walimurid', 'like', '%' . $this->search . '%')
                    ->orWhereHas('siswa', function ($siswa) {
                        $siswa->where('nama_siswa', 'like', '%' . $this->search . '%');
                    });
            })->orderBy('nama_walimurid')
            ->paginate($this->perPage);
        $siswaList = Siswa::orderBy('nama_siswa')->get();;


        return view('livewire.data.wali-murid-manager', compact('waliMurid', 'siswaList'))->layout('layouts.app');
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
            $waliMurid = WaliMurid::with('siswa')->findOrFail($id);

            $this->waliMuridId = $waliMurid->id;
            $this->nama_walimurid = $waliMurid->nama_walimurid;
            $this->hubungan = $waliMurid->hubungan;
            $this->pekerjaan = $waliMurid->pekerjaan;
            $this->jenis_kelamin = $waliMurid->jenis_kelamin;
            $this->no_telepon = $waliMurid->no_telepon;
            $this->siswa_id = $waliMurid->siswa_id;


            $this->editMode = true;
            $this->showModal = true;
        } catch (\Throwable $e) {
            toast()->danger('Error!', 'Wali murid tidak ditemukan!')->push();
        }
    }


    public function show($id)
    {
        try {
            $this->selectedWaliMurid = WaliMurid::with('siswa')->findOrFail($id);
            $this->showDetailModal = true;
        } catch (\Throwable $e) {
            toast()->danger('Error!', 'Wali murid tidak ditemukan!')->push();
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
                $waliMurid = WaliMurid::findOrFail($this->waliMuridId);
                $waliMurid->update([
                    'nama_walimurid' => $this->nama_walimurid,
                    'hubungan' => $this->hubungan,
                    'pekerjaan' => $this->pekerjaan,
                    'jenis_kelamin' => $this->jenis_kelamin,
                    'no_telepon' => $this->no_telepon,
                    'siswa_id' => $this->siswa_id
                ]);
                toast()->success('Success!', 'Wali murid berhasil diperbarui!')->push();
            } else {
                WaliMurid::create([
                    'nama_walimurid' => $this->nama_walimurid,
                    'hubungan' => $this->hubungan,
                    'pekerjaan' => $this->pekerjaan,
                    'jenis_kelamin' => $this->jenis_kelamin,
                    'no_telepon' => $this->no_telepon,
                    'siswa_id' => $this->siswa_id
                ]);
                toast()->success('Success!', 'Wali murid berhasil ditambahkan!')->push();
            }
          
            $this->resetForm();
            $this->showModal = false;
        } catch (\Throwable $e) {
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
        $waliMurid = WaliMurid::findOrFail($this->deleteId);
        $waliMurid->delete();
        toast()->success('Success!', 'Wali murid berhasil dihapus!')->push();
        $this->showDeleteConfirm = false;
        $this->deleteId = null;
    } catch (\Throwable $e) {
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
        $this->waliMuridId = null;
        $this->nama_walimurid = '';
        $this->hubungan = '';
        $this->pekerjaan = '';
        $this->jenis_kelamin = '';
        $this->no_telepon = '';
        $this->siswa_id = '';
        $this->editMode = false;
        $this->showModal = false;
        $this->showDetailModal = false;
        $this->selectedWaliMurid = null;
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
        $this->selectedWaliMurid = null;
    }
}
