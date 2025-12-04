<?php

namespace App\Exports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BarangsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // Kita hanya pilih kolom yang relevan untuk ekspor
        return Barang::select('id', 'nama', 'kategori', 'stok', 'harga', 'created_at', 'updated_at')->get();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Barang',
            'Kategori',
            'Stok',
            'Harga',
            'Tanggal Dibuat',
            'Tanggal Diperbarui',
        ];
    }
}
