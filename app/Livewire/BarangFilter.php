<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Barang;

class BarangFilter extends Component
{
    public $search = '';
    public $categoryFilter = '';
    public $stockStatusFilter = '';
    public $minPrice = null;
    public $maxPrice = null;

    public function render()
    {
        $categories = Barang::distinct()->pluck('kategori');
        return view('livewire.barang-filter', [
            'categories' => $categories,
        ]);
    }

    public function updated($propertyName)
    {
        // This method is called whenever a property is updated
        // We dispatch an event with all current filter values
        $this->dispatch('filter-updated', [
            'search' => $this->search,
            'categoryFilter' => $this->categoryFilter,
            'stockStatusFilter' => $this->stockStatusFilter,
            'minPrice' => $this->minPrice,
            'maxPrice' => $this->maxPrice,
        ]);
    }
}
