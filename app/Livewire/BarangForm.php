<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barang;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class BarangForm extends Component
{
    use WithFileUploads;

    public $showModal = false;
    public $barangId;
    public $nama;
    public $kategori;
    public $stok;
    public $harga;
    public $deskripsi;
    public $foto;
    public $oldFoto; // To store current photo path for editing

    protected $listeners = ['createBarang', 'editBarang'];

    public function createBarang()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function editBarang($barangId)
    {
        $this->barangId = $barangId;
        $barang = Barang::findOrFail($barangId);
        $this->nama = $barang->nama;
        $this->kategori = $barang->kategori;
        $this->stok = $barang->stok;
        $this->harga = $barang->harga;
        $this->deskripsi = $barang->deskripsi;
        $this->oldFoto = $barang->foto;
        $this->showModal = true;
    }

    protected function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function save()
    {
        $this->validate();

        if ($this->barangId) {
            // Update
            $barang = Barang::findOrFail($this->barangId);
            $barang->nama = $this->nama;
            $barang->kategori = $this->kategori;
            $barang->stok = $this->stok;
            $barang->harga = $this->harga;
            $barang->deskripsi = $this->deskripsi;

            if ($this->foto) {
                if ($this->oldFoto) {
                    Storage::disk('public')->delete($this->oldFoto);
                }
                $barang->foto = $this->foto->store('foto_barang', 'public');
            }
            $barang->save();
            $this->dispatch('showNotification', 'Barang berhasil diperbarui!');
        } else {
            // Create
            $barang = new Barang();
            $barang->nama = $this->nama;
            $barang->kategori = $this->kategori;
            $barang->stok = $this->stok;
            $barang->harga = $this->harga;
            $barang->deskripsi = $this->deskripsi;

            if ($this->foto) {
                $barang->foto = $this->foto->store('foto_barang', 'public');
            }
            $barang->save();
            $this->dispatch('showNotification', 'Barang berhasil ditambahkan!');
        }

        $this->showModal = false;
        $this->dispatch('refreshTable'); // Notify table to refresh
    }

    public function resetForm()
    {
        $this->barangId = null;
        $this->nama = '';
        $this->kategori = '';
        $this->stok = '';
        $this->harga = '';
        $this->deskripsi = '';
        $this->foto = null;
        $this->oldFoto = null;
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.barang-form');
    }
}
