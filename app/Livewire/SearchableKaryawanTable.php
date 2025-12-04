<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Karyawan;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class SearchableKaryawanTable extends Component
{
    use WithPagination;

    public $search = '';
    public $jabatan = '';
    public $minUmur = '';
    public $maxUmur = '';
    public $tglMasukDari = '';
    public $tglMasukSampai = '';

    protected $listeners = ['filter-updated' => 'applyFilters'];

    public function applyFilters($filters)
    {
        $this->search = $filters['search'];
        $this->jabatan = $filters['jabatan'];
        $this->minUmur = $filters['minUmur'];
        $this->maxUmur = $filters['maxUmur'];
        $this->tglMasukDari = $filters['tglMasukDari'];
        $this->tglMasukSampai = $filters['tglMasukSampai'];
        $this->resetPage();
    }

    public function render()
    {
        $query = Karyawan::query();

        // Pencarian umum
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('jabatan', 'like', '%' . $this->search . '%');
            });
        }

        // Filter Jabatan
        if ($this->jabatan) {
            $query->where('jabatan', $this->jabatan);
        }

        // Filter Umur
        if ($this->minUmur) {
            $query->where(DB::raw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE())'), '>=', $this->minUmur);
        }
        if ($this->maxUmur) {
            $query->where(DB::raw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE())'), '<=', $this->maxUmur);
        }

        // Filter Tanggal Masuk
        if ($this->tglMasukDari) {
            $query->where('tanggal_masuk', '>=', $this->tglMasukDari);
        }
        if ($this->tglMasukSampai) {
            $query->where('tanggal_masuk', '<=', $this->tglMasukSampai);
        }

        $karyawans = $query->latest()->paginate(10);

        return view('livewire.searchable-karyawan-table', [
            'karyawans' => $karyawans,
        ]);
    }
}
