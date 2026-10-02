<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    /**
     * Jumlah karyawan yang dibangkitkan.
     */
    private int $jumlah = 25;

    private array $namaDepan = [
        'Budi', 'Siti', 'Agus', 'Dewi', 'Rizky', 'Putri', 'Andi', 'Nur', 'Fajar', 'Indah',
        'Bayu', 'Maya', 'Eko', 'Rina', 'Doni', 'Sari', 'Hendra', 'Lestari', 'Yoga', 'Ayu',
        'Wahyu', 'Fitri', 'Arif', 'Mega', 'Ilham', 'Nadia', 'Reza', 'Intan', 'Hasan', 'Wulan',
    ];

    private array $namaBelakang = [
        'Santoso', 'Wijaya', 'Pratama', 'Nugroho', 'Saputra', 'Hidayat', 'Setiawan', 'Ramadhan',
        'Permata', 'Kusuma', 'Maulana', 'Firmansyah', 'Anggraini', 'Utami', 'Siregar', 'Simatupang',
        'Halim', 'Gunawan', 'Hartono', 'Purnomo',
    ];

    private array $gelar = ['', '', '', '', 'S.T.', 'S.Kom.', 'A.Md.', 'S.E.', 'S.Kom'];

    private array $jabatan = [
        'Staff Gudang', 'Admin', 'Teknisi', 'Supervisor', 'Manajer Operasional', 'Kasir',
        'Driver', 'Security', 'Operator Produksi', 'Staff IT', 'Staff HRD', 'Quality Control',
    ];

    public function run(): void
    {
        if (Karyawan::count() > 0) {
            $this->command?->warn('Tabel karyawan sudah berisi data — KaryawanSeeder dilewati.');
            return;
        }

        $dipakai = [];

        for ($i = 0; $i < $this->jumlah; $i++) {
            $nama = $this->namaUnik($dipakai);

            // Usia realistis: lahir 1980–2004.
            $tanggalLahir = Carbon::createFromTimestamp(
                random_int(Carbon::create(1980, 1, 1)->timestamp, Carbon::create(2004, 12, 31)->timestamp)
            );

            // Masuk kerja antara 2018 dan sekarang, minimal 18 tahun saat masuk.
            $tanggalMasuk = Carbon::createFromTimestamp(
                random_int(Carbon::create(2018, 1, 1)->timestamp, Carbon::now()->timestamp)
            );

            if ($tanggalMasuk->lt($tanggalLahir->copy()->addYears(18))) {
                $tanggalMasuk = $tanggalLahir->copy()->addYears(20)->addDays(random_int(0, 365));
            }

            Karyawan::create([
                'nama' => $nama,
                'jabatan' => $this->jabatan[array_rand($this->jabatan)],
                'tanggal_lahir' => $tanggalLahir->toDateString(),
                'tanggal_masuk' => $tanggalMasuk->toDateString(),
            ]);
        }

        $this->command?->info("KaryawanSeeder: {$this->jumlah} karyawan berhasil dibuat.");
    }

    /**
     * Bentuk nama lengkap (opsional bergelar) dan jaga agar tidak duplikat.
     */
    private function namaUnik(array &$dipakai): string
    {
        for ($percobaan = 0; $percobaan < 50; $percobaan++) {
            $nama = $this->namaDepan[array_rand($this->namaDepan)] . ' ' . $this->namaBelakang[array_rand($this->namaBelakang)];

            $gelar = $this->gelar[array_rand($this->gelar)];
            $lengkap = $gelar !== '' ? "{$nama}, {$gelar}" : $nama;

            if (! in_array($lengkap, $dipakai, true)) {
                $dipakai[] = $lengkap;
                return $lengkap;
            }
        }

        // Fallback: tambahkan inisial agar tetap unik.
        $lengkap = $nama . ' ' . chr(random_int(65, 90)) . '.';
        $dipakai[] = $lengkap;

        return $lengkap;
    }
}
