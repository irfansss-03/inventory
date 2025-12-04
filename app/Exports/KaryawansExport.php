<?php

namespace App\Exports;

use App\Models\Karyawan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KaryawansExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Karyawan::all();
    }

    /**
    * @return array
    */
    public function headings(): array
    {
        return [
            'ID',
            'Nama Karyawan',
            'Jabatan',
            'Tanggal Lahir',
            'Umur',
            'Tanggal Masuk',
        ];
    }

    /**
    * @param mixed $karyawan
    * @return array
    */
    public function map($karyawan): array
    {
        return [
            $karyawan->id,
            $karyawan->nama,
            $karyawan->jabatan,
            $karyawan->tanggal_lahir,
            $karyawan->umur, // Menggunakan accessor 'umur' dari model
            $karyawan->tanggal_masuk,
        ];
    }
}
