<?php

namespace App\Http\Controllers;

use App\AdminNotifier;
use App\CriticalStockNotification;
use App\Exports\BarangsExport;
use App\Models\Barang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = \App\Models\Barang::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('nama', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
        }

        $barangs = $query->latest()->paginate(5)->withQueryString();

        return view('barang.index', compact('barangs'));
    }

    public function export() 
    {
        return Excel::download(new BarangsExport, 'barangs.xlsx');
    }

    public function exportPdf()
    {
        $barangs = \App\Models\Barang::all();
        $pdf = Pdf::loadView('barang.pdf', ['barangs' => $barangs]);
        return $pdf->stream('laporan-barang.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the file upload
        $imagePath = null;
        if ($request->hasFile('foto')) {
            $imagePath = $request->file('foto')->store('foto_barang', 'public');
        }

        // Create the new Barang
        $barang = Barang::create([
            'nama' => $validated['nama'],
            'kategori' => $validated['kategori'],
            'stok' => $validated['stok'],
            'harga' => $validated['harga'],
            'deskripsi' => $validated['deskripsi'],
            'foto' => $imagePath,
        ]);

        $this->notifyIfCritical($barang);

        // Redirect with a success message
        session()->flash('success', 'Barang berhasil ditambahkan!');
        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        // Validate the request
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->except(['_token', '_method']);

        // Handle the file upload
        if ($request->hasFile('foto')) {
            // Delete old image if it exists
            if ($barang->foto) {
                Storage::disk('public')->delete($barang->foto);
            }
            // Store new image
            $input['foto'] = $request->file('foto')->store('foto_barang', 'public');
        }

        // Update the Barang
        $barang->update($input);

        $this->notifyIfCritical($barang);

        // Redirect with a success message
        session()->flash('success', 'Barang berhasil diperbarui!');
        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        // Delete the image if it exists
        if ($barang->foto) {
            Storage::disk('public')->delete($barang->foto);
        }

        // Delete the barang record
        $barang->delete();

        // Redirect with a success message
        session()->flash('success', 'Barang berhasil dihapus!');
        return redirect()->route('barang.index');
    }

    protected function notifyIfCritical(Barang $barang): void
    {
        if ($barang->stok < 5) {
            AdminNotifier::send(new CriticalStockNotification($barang));
        }
    }
}
