<?php

namespace App\Livewire\List;

use App\Models\Data\Kelas;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class KelasSiswa extends Component
{
    use WithPagination, WireToast;

    public $search = '';
    public $perPage = 10;
    public $showDetailModal = false;
    public $selectedKelas = null;

    protected $queryString = ['search'];

    public function render()
    {
        $kelasWithSiswa = Kelas::with(['siswa' => function ($query) {
            $query->orderBy('nama_siswa');
        }])
            ->withCount('siswa')
            ->when($this->search, function ($query) {
                $query->where('nama_kelas', 'like', '%' . $this->search . '%')
                    ->orWhereHas('siswa', function ($q) {
                        $q->where('nama_siswa', 'like', '%' . $this->search . '%')
                            ->orWhere('nisn', 'like', '%' . $this->search . '%')
                            ->orWhere('nis', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('nama_kelas')
            ->paginate($this->perPage);

        return view('livewire.list.kelas-siswa', compact('kelasWithSiswa'))->layout('layouts.app');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function showDetail($kelasId)
    {
        try {
            $this->selectedKelas = Kelas::with(['siswa' => function ($query) {
                $query->orderBy('nama_siswa');
            }])->findOrFail($kelasId);
            $this->showDetailModal = true;
        } catch (\Exception $e) {
            toast()->danger('Error!', 'Kelas tidak ditemukan!')->push();
        }
    }

    public function closeDetailModal()
    {
        $this->showDetailModal = false;
        $this->selectedKelas = null;
    }
}
