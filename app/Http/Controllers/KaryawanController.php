<?php

namespace App\Http\Controllers;

use App\AdminNotifier;
use App\Exports\KaryawansExport;
use App\Models\Karyawan;
use App\NewEmployeeNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('karyawan.index');
    }

    public function export()
    {
        return Excel::download(new KaryawansExport, 'karyawans.xlsx');
    }

    public function exportPdf()
    {
        $karyawans = Karyawan::all();
        $pdf = Pdf::loadView('karyawan.pdf', ['karyawans' => $karyawans]);
        return $pdf->stream('laporan-karyawan.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'tanggal_masuk' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('foto_karyawan', 'public');
        }

        $karyawan = Karyawan::create($validated);

        AdminNotifier::send(new NewEmployeeNotification($karyawan));

        session()->flash('success', 'Karyawan berhasil ditambahkan!');
        return redirect()->route('karyawan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Karyawan $karyawan)
    {
        return view('karyawan.edit', compact('karyawan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Karyawan $karyawan)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'tanggal_masuk' => 'nullable|date',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // Delete old image
            if ($karyawan->foto) {
                Storage::disk('public')->delete($karyawan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('foto_karyawan', 'public');
        }

        $karyawan->update($validated);

        session()->flash('success', 'Data karyawan berhasil diperbarui!');
        return redirect()->route('karyawan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Karyawan $karyawan)
    {
        abort_unless(auth()->user()?->isAdmin(), 403);

        // Delete the image if it exists
        if ($karyawan->foto) {
            Storage::disk('public')->delete($karyawan->foto);
        }

        // Delete the karyawan record
        $karyawan->delete();

        session()->flash('success', 'Karyawan berhasil dihapus!');
        return redirect()->route('karyawan.index');
    }
}
