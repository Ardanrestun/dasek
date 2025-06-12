<?php


namespace App\Livewire\Data;

use App\Models\Data\Kelas;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Usernotnull\Toast\Concerns\WireToast;

class KelasManager extends Component
{
    use WithPagination, WireToast;

    public $search = '';
    public $perPage = 10;
    public $showModal = false;
    public $showDetailModal = false;
    public $editMode = false;
    public $showDeleteConfirm = false;
    public $deleteId = null;

    public $kelasId;
    public $nama_kelas = '';

    public $selectedKelas;

    protected function rules()
    {
        return [
            'nama_kelas' => [
                'required',
                'string',
                'min:3',
                'max:50',
                Rule::unique('kelas', 'nama_kelas')->ignore($this->kelasId),
            ],
        ];
    }

    protected function createRules()
    {
        return [
            'nama_kelas' => [
                'required',
                'string',
                'min:3',
                'max:50',
                Rule::unique('kelas', 'nama_kelas'),
            ],
        ];
    }

    protected function updateRules()
    {
        return [
            'nama_kelas' => [
                'required',
                'string',
                'min:3',
                'max:50',
                Rule::unique('kelas', 'nama_kelas')->ignore($this->kelasId),
            ],
        ];
    }

    protected $messages = [
        'nama_kelas.required' => 'Nama kelas harus diisi.',
        'nama_kelas.string' => 'Nama kelas harus berupa teks.',
        'nama_kelas.min' => 'Nama kelas minimal 3 karakter.',
        'nama_kelas.max' => 'Nama kelas maksimal 50 karakter.',
        'nama_kelas.unique' => 'Nama kelas sudah digunakan.',
    ];

    public function render()
    {
        $kelas = Kelas::withCount(['siswa', 'guru'])
            ->when($this->search, function ($query) {
                $query->where('nama_kelas', 'like', '%' . $this->search . '%');
            })
            ->orderBy('nama_kelas')
            ->paginate($this->perPage);

        return view('livewire.data.kelas-manager', compact('kelas'))->layout('layouts.app');
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
            $kelas = Kelas::findOrFail($id);
            $this->kelasId = $kelas->id;
            $this->nama_kelas = $kelas->nama_kelas;
            $this->editMode = true;
            $this->showModal = true;
        } catch (\Exception $e) {
            toast()->danger('Error!', 'Kelas tidak ditemukan!')->push();
        }
    }

    public function show($id)
    {
        try {
            $this->selectedKelas = Kelas::with(['siswa', 'guru'])->findOrFail($id);
            $this->showDetailModal = true;
        } catch (\Exception $e) {
            toast()->danger('Error!', 'Kelas tidak ditemukan!')->push();
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
                $kelas = Kelas::findOrFail($this->kelasId);
                $kelas->update([
                    'nama_kelas' => $this->nama_kelas,
                ]);
                toast()->success('Berhasil!', 'Kelas berhasil diperbarui!')->push();
            } else {
                Kelas::create([
                    'nama_kelas' => $this->nama_kelas,
                ]);
                toast()->success('Berhasil!', 'Kelas berhasil ditambahkan!')->push();
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
            $kelas = Kelas::findOrFail($this->deleteId);

            if ($kelas->siswa()->count() > 0) {
                toast()->warning('Peringatan!', 'Kelas tidak dapat dihapus karena masih memiliki siswa!')->push();
                $this->showDeleteConfirm = false;
                return;
            }

            if ($kelas->guru()->count() > 0) {
                toast()->warning('Peringatan!', 'Kelas tidak dapat dihapus karena masih memiliki guru!')->push();
                $this->showDeleteConfirm = false;
                return;
            }

            $kelas->delete();
            toast()->success('Berhasil!', 'Kelas berhasil dihapus!')->push();
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
        $this->kelasId = null;
        $this->nama_kelas = '';
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
        $this->selectedKelas = null;
    }
}