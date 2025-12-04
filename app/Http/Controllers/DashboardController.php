<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Karyawan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $selectedBarangRange = $request->query('barang_range', 'all');

        // Summary Data
        $totalBarang = Barang::count();
        $totalKaryawan = Karyawan::count();

        // Barang by Category (for Pie Chart)
        $barangCategoryQuery = Barang::query();

        switch ($selectedBarangRange) {
            case 'today':
                $barangCategoryQuery->whereDate('created_at', Carbon::today());
                break;
            case 'last_week':
                $barangCategoryQuery->whereBetween('created_at', [
                    Carbon::now()->subWeek()->startOfWeek(),
                    Carbon::now()->subWeek()->endOfWeek(),
                ]);
                break;
            case 'last_month':
                $barangCategoryQuery->whereBetween('created_at', [
                    Carbon::now()->subMonth()->startOfMonth(),
                    Carbon::now()->subMonth()->endOfMonth(),
                ]);
                break;
            default:
                // 'all' - no additional filter
                break;
        }

        $barangByCategory = $barangCategoryQuery
            ->select('kategori', \DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->get();

        $colorPalette = ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40', '#C084FC', '#34D399'];
        $barangChartLabels = [];
        $barangChartData = [];
        $barangChartColors = [];
        $barangLegend = [];

        foreach ($barangByCategory as $index => $item) {
            $label = $item->kategori ?? 'Tidak diketahui';
            $color = $colorPalette[$index % count($colorPalette)];

            $barangChartLabels[] = $label;
            $barangChartData[] = $item->total;
            $barangChartColors[] = $color;
            $barangLegend[] = [
                'label' => $label,
                'value' => $item->total,
                'color' => $color,
            ];
        }

        // Barang Stock Status
        $stokKritis = Barang::where('stok', '<', 5)->count();
        $stokMenipis = Barang::whereBetween('stok', [5, 10])->count();
        $stokAman = Barang::where('stok', '>', 10)->count();

        // Karyawan by Jabatan (for Bar Chart)
        $karyawanByJabatan = Karyawan::select('jabatan', \DB::raw('count(*) as total'))
                                     ->groupBy('jabatan')
                                     ->pluck('total', 'jabatan');

        $karyawanColors = ['#36A2EB', '#FFCE56', '#FF6384', '#4BC0C0', '#9966FF', '#FF9F40', '#F472B6', '#34D399'];
        $karyawanLegend = [];
        $karyawanChartColors = [];
        foreach ($karyawanByJabatan as $jabatan => $total) {
            $color = $karyawanColors[count($karyawanLegend) % count($karyawanColors)];
            $karyawanLegend[] = [
                'label' => $jabatan ?? 'Tidak diketahui',
                'value' => $total,
                'color' => $color,
            ];
            $karyawanChartColors[] = $color;
        }

        return view('dashboard', [
            'totalBarang' => $totalBarang,
            'totalKaryawan' => $totalKaryawan,
            'barangChartLabels' => $barangChartLabels,
            'barangChartData' => $barangChartData,
            'barangChartColors' => $barangChartColors,
            'barangLegend' => $barangLegend,
            'stokKritis' => $stokKritis,
            'stokMenipis' => $stokMenipis,
            'stokAman' => $stokAman,
            'karyawanByJabatan' => $karyawanByJabatan,
            'karyawanLegend' => $karyawanLegend,
            'karyawanChartColors' => $karyawanChartColors,
            'selectedBarangRange' => $selectedBarangRange,
        ]);
    }
}
