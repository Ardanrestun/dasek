<?php

namespace App\Livewire\List;

use App\Models\Data\Kelas;
use Livewire\Component;
use Livewire\WithPagination;
use Usernotnull\Toast\Concerns\WireToast;

class KelasGuru extends Component
{
    use WithPagination, WireToast;

    public $search = '';
    public $perPage = 10;
    public $showDetailModal = false;
    public $selectedKelas = null;

    protected $queryString = ['search'];

    public function render()
    {
        $kelasWithGuru = Kelas::with(['guru' => function ($query) {
            $query->orderBy('nama_guru');
        }])
            ->withCount('guru')
            ->when($this->search, function ($query) {
                $query->where('nama_kelas', 'like', '%' . $this->search . '%')
                    ->orWhereHas('guru', function ($q) {
                        $q->where('nama_guru', 'like', '%' . $this->search . '%')
                            ->orWhere('nip', 'like', '%' . $this->search . '%');
                    });
            })
            ->orderBy('nama_kelas')
            ->paginate($this->perPage);

        return view('livewire.list.kelas-guru', compact('kelasWithGuru'))->layout('layouts.app');
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
            $this->selectedKelas = Kelas::with(['guru' => function($query) {
                $query->orderBy('nama_guru');
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