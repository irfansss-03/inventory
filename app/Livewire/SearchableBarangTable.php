<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barang;
use Livewire\WithPagination;

class SearchableBarangTable extends Component
{
    use WithPagination;

    public $search = '';
    public $categoryFilter = '';
    public $stockStatusFilter = '';
    public $minPrice = '';
    public $maxPrice = '';

    protected $listeners = ['filter-updated' => 'applyFilters'];

    public function applyFilters($filters)
    {
        $this->search = $filters['search'];
        $this->categoryFilter = $filters['categoryFilter'];
        $this->stockStatusFilter = $filters['stockStatusFilter'];
        $this->minPrice = $filters['minPrice'];
        $this->maxPrice = $filters['maxPrice'];
        $this->resetPage();
    }

    public function render()
    {
        $query = Barang::query();

        // Search
        if ($this->search) {
            $query->where('nama', 'like', '%' . $this->search . '%')
                  ->orWhere('kategori', 'like', '%' . $this->search . '%');
        }

        // Category Filter
        if ($this->categoryFilter) {
            $query->where('kategori', $this->categoryFilter);
        }

        // Stock Status Filter
        if ($this->stockStatusFilter) {
            switch ($this->stockStatusFilter) {
                case 'critical':
                    $query->where('stok', '<', 5);
                    break;
                case 'low':
                    $query->whereBetween('stok', [5, 10]);
                    break;
                case 'safe':
                    $query->where('stok', '>', 10);
                    break;
            }
        }

        // Price Range Filter
        if ($this->minPrice) {
            $query->where('harga', '>=', $this->minPrice);
        }
        if ($this->maxPrice) {
            $query->where('harga', '<=', $this->maxPrice);
        }

        $barangs = $query->latest()->paginate(5);
        $categories = Barang::select('kategori')->distinct()->pluck('kategori');

        return view('livewire.searchable-barang-table', [
            'barangs' => $barangs,
            'categories' => $categories,
        ]);
    }
}
