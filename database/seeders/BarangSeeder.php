<?php

namespace Database\Seeders;

use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Jumlah barang yang dibangkitkan.
     */
    private int $jumlah = 60;

    /**
     * Katalog sumber: tiap kategori punya pool merek, jenis, spesifikasi,
     * dan rentang harga. Nama barang dibentuk dengan mengombinasikan pool
     * ini secara acak, jadi datanya tergenerate (bukan daftar tetap).
     */
    private array $katalog = [
        'Elektronik' => [
            'merek' => ['Samsung', 'LG', 'Polytron', 'Sharp', 'Panasonic', 'Xiaomi', 'Advance', 'Sanken', 'Miyako', 'Cosmos'],
            'jenis' => ['Televisi LED', 'Kipas Angin', 'Setrika', 'Rice Cooker', 'Blender', 'Dispenser', 'Kulkas', 'Air Cooler', 'Mesin Cuci'],
            'spesifikasi' => ['32 Inch', '43 Inch', '50 Inch', '1 Pintu', '2 Pintu', '350 Watt', '450 Watt', '1.5 Liter', 'Low Watt'],
            'harga' => [350000, 6500000],
        ],
        'Komputer & Aksesoris' => [
            'merek' => ['Asus', 'Lenovo', 'Acer', 'HP', 'Dell', 'Logitech', 'Epson', 'Canon', 'TP-Link', 'Sandisk'],
            'jenis' => ['Laptop', 'Mouse', 'Keyboard', 'Monitor', 'Printer', 'Flashdisk', 'Hardisk Eksternal', 'Proyektor', 'Webcam', 'Speaker'],
            'spesifikasi' => ['Core i3', 'Core i5', '8GB RAM', '16GB RAM', '512GB SSD', '1TB', '1080p', 'Wireless', 'USB 3.0'],
            'harga' => [75000, 12000000],
        ],
        'Peralatan Listrik' => [
            'merek' => ['Philips', 'Panasonic', 'Broco', 'Hannochs', 'Schneider', 'Legrand', 'Supreme', 'Eterna'],
            'jenis' => ['Lampu LED', 'Kabel NYM', 'Stop Kontak', 'Saklar', 'MCB', 'Fitting', 'Terminal Kabel', 'Lampu Downlight'],
            'spesifikasi' => ['5 Watt', '9 Watt', '12 Watt', '18 Watt', '2x1.5mm', '2x2.5mm', '10A', '16A', '32A'],
            'harga' => [15000, 450000],
        ],
        'Jaringan & Telekomunikasi' => [
            'merek' => ['TP-Link', 'Mikrotik', 'Ubiquiti', 'Cisco', 'Huawei', 'ZTE', 'Ruijie', 'Tenda'],
            'jenis' => ['Router', 'Switch', 'Access Point', 'Kabel UTP', 'Patch Panel', 'ONT', 'Media Converter', 'Rack Server'],
            'spesifikasi' => ['8 Port', '16 Port', '24 Port', 'Cat6', 'Gigabit', 'Dual Band', '305 Meter', '1U', 'POE'],
            'harga' => [85000, 8500000],
        ],
        'Alat Tulis Kantor' => [
            'merek' => ['Faber-Castell', 'Snowman', 'Standard', 'Joyko', 'Bantex', 'Kenko', 'Binder', 'Sidu'],
            'jenis' => ['Pulpen', 'Pensil', 'Buku Tulis', 'Map Folder', 'Stabilo', 'Spidol', 'Penghapus', 'Lem Kertas', 'Gunting'],
            'spesifikasi' => ['0.5mm', '0.7mm', '2B', 'HB', 'A4', 'F4', '100 Lembar', 'Warna Hitam', 'Warna Biru'],
            'harga' => [3000, 120000],
        ],
        'Peralatan Kebersihan' => [
            'merek' => ['Wipol', 'So Klin', 'Nagata', 'Sunlight', 'Bayclin', 'Stella', 'Kispray', 'Mama Lemon'],
            'jenis' => ['Pembersih Lantai', 'Sapu', 'Pel', 'Tempat Sampah', 'Sabun Cuci', 'Pembersih Kaca', 'Tissue', 'Kain Lap'],
            'spesifikasi' => ['1 Liter', '5 Liter', 'Jumbo', 'Medium', 'Refill', 'Anti Bakteri', 'Wangi Lemon', 'Isi 10'],
            'harga' => [8000, 250000],
        ],
        'Otomotif' => [
            'merek' => ['Shell', 'Castrol', 'Yamalube', 'Aspira', 'IRC', 'FDR', 'Yuasa', 'Bosch'],
            'jenis' => ['Oli Mesin', 'Ban Motor', 'Aki', 'Busi', 'Filter Udara', 'Kampas Rem', 'Lampu Sein', 'Rantai'],
            'spesifikasi' => ['10W-40', '20W-50', '80/90-14', '90/90-17', '12V 5Ah', '1 Liter', '0.8 Liter', 'Tubeless'],
            'harga' => [25000, 1500000],
        ],
        'Furniture' => [
            'merek' => ['Chitose', 'Olympic', 'Fantoni', 'Modera', 'Lion', 'Informa', 'IKEA'],
            'jenis' => ['Meja Kerja', 'Kursi Kantor', 'Lemari Arsip', 'Rak Buku', 'Filing Cabinet', 'Sofa', 'Meja Rapat'],
            'spesifikasi' => ['120x60cm', '140x70cm', '4 Pintu', '3 Tingkat', 'Rangka Besi', 'Kayu', 'Jaring', 'Pintu Geser'],
            'harga' => [250000, 4500000],
        ],
        'Safety & K3' => [
            'merek' => ['Kings', 'Blue Eagle', 'Safety Jogger', '3M', 'Leopard', 'Golden', 'CIG'],
            'jenis' => ['Helm Proyek', 'Sepatu Safety', 'Sarung Tangan', 'Masker', 'Rompi', 'Kacamata Safety', 'Ear Plug', 'Body Harness'],
            'spesifikasi' => ['Warna Kuning', 'Warna Putih', 'Size 40', 'Size 42', 'Katun', 'Karet', 'N95', 'SNI', 'Anti Gores'],
            'harga' => [12000, 900000],
        ],
        'Konsumabel' => [
            'merek' => ['Cap Gajah', 'Sedap', 'Aqua', 'Indomilk', 'Nescafe', 'Sariwangi', 'Tropicana', 'ABC'],
            'jenis' => ['Kopi Sachet', 'Air Mineral', 'Susu Kental', 'Gula Pasir', 'Teh Celup', 'Minyak Goreng', 'Biskuit', 'Mie Instan'],
            'spesifikasi' => ['Dus 20', 'Karton 48', '1 Kg', '500 gram', 'Gelas 50', 'Botol 600ml', 'Sachet', 'Renceng'],
            'harga' => [10000, 300000],
        ],
    ];

    public function run(): void
    {
        if (Barang::count() > 0) {
            $this->command?->warn('Tabel barang sudah berisi data — BarangSeeder dilewati.');
            return;
        }

        // Sebar kategori secara merata supaya grafik dashboard proporsional.
        $kategoris = array_keys($this->katalog);
        $perKategori = intdiv($this->jumlah, count($kategoris));
        $daftarKategori = [];

        foreach ($kategoris as $k) {
            $daftarKategori = array_merge($daftarKategori, array_fill(0, $perKategori, $k));
        }

        while (count($daftarKategori) < $this->jumlah) {
            $daftarKategori[] = $kategoris[array_rand($kategoris)];
        }

        shuffle($daftarKategori);

        for ($i = 0; $i < $this->jumlah; $i++) {
            $kategori = $daftarKategori[$i];
            $pool = $this->katalog[$kategori];

            $merek = $pool['merek'][array_rand($pool['merek'])];
            $jenis = $pool['jenis'][array_rand($pool['jenis'])];
            $spesifikasi = $pool['spesifikasi'][array_rand($pool['spesifikasi'])];

            // Harga acak dalam rentang kategori, dibulatkan ke Rp500.
            $harga = (int) (round(random_int($pool['harga'][0], $pool['harga'][1]) / 500) * 500);

            $barang = Barang::create([
                'nama' => "{$merek} {$jenis} {$spesifikasi}",
                'kategori' => $kategori,
                'stok' => $this->stokRealistis(),
                'harga' => $harga,
                'deskripsi' => $this->deskripsi($jenis, $merek, $kategori),
            ]);

            // Sebar tanggal input agar filter waktu di dashboard terlihat beragam.
            $tanggal = Carbon::now()
                ->subDays(random_int(0, 330))
                ->setTime(random_int(7, 20), random_int(0, 59), random_int(0, 59));

            $barang->timestamps = false;
            $barang->created_at = $tanggal;
            $barang->updated_at = $tanggal;
            $barang->save();
        }

        $this->command?->info("BarangSeeder: {$this->jumlah} barang berhasil dibuat.");
    }

    /**
     * Distribusi stok: sebagian sengaja kritis/menipis supaya status stok
     * dan notifikasi di dashboard ikut terpicu.
     */
    private function stokRealistis(): int
    {
        $roll = random_int(1, 100);

        if ($roll <= 12) {
            return random_int(0, 4);   // kritis
        }

        if ($roll <= 27) {
            return random_int(5, 10);  // menipis
        }

        return random_int(11, 250);    // aman
    }

    private function deskripsi(string $jenis, string $merek, string $kategori): string
    {
        $kondisi = ['Baru, segel utuh', 'Baru, stok gudang', 'Baru, garansi resmi', 'Baru, siap kirim'];
        $garansi = ['garansi 1 bulan', 'garansi 3 bulan', 'garansi 1 tahun', 'tanpa garansi'];

        return sprintf(
            '%s %s untuk kebutuhan %s. Kondisi %s, %s. Satuan per unit.',
            $jenis,
            $merek,
            $kategori,
            $kondisi[array_rand($kondisi)],
            $garansi[array_rand($garansi)]
        );
    }
}
