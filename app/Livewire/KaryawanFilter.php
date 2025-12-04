<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Karyawan;

class KaryawanFilter extends Component
{
    public $search = '';
    public $jabatan = '';
    public $minUmur = '';
    public $maxUmur = '';
    public $tglMasukDari = '';
    public $tglMasukSampai = '';

    public function updated($propertyName)
    {
        $this->dispatch('filter-updated', [
            'search' => $this->search,
            'jabatan' => $this->jabatan,
            'minUmur' => $this->minUmur,
            'maxUmur' => $this->maxUmur,
            'tglMasukDari' => $this->tglMasukDari,
            'tglMasukSampai' => $this->tglMasukSampai,
        ]);
    }

    public function render()
    {
        $jabatans = Karyawan::select('jabatan')->distinct()->whereNotNull('jabatan')->pluck('jabatan');
        return view('livewire.karyawan-filter', compact('jabatans'));
    }
}
