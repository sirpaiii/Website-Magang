<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;
use App\Models\Perusahaan;
use Illuminate\Support\Facades\Auth;

class LowonganController extends Controller
{
    // Fungsi Menambahkan Lowongan
    public function index()
    {
        $lowongans = Lowongan::with('perusahaan')->latest()->get();
        return view('lowongan.index', compact('lowongans'));
    }

    public function create()
    {
        return view('perusahaan.tambah_lowongan');
    }
// Fungsi Tambah Lowongan
public function store(Request $request)
{
    $validated = $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi_lowongan' => 'required|string',
        'lokasi' => 'required|string|max:255',
    ]);

    $perusahaan = Auth::user()->perusahaan;

    if (!$perusahaan) {
        return back()->with('error', 'Profil perusahaan belum ditemukan.');
    }

    $validated['perusahaan_id'] = $perusahaan->id;


    Lowongan::create($validated);

    return redirect()->route('dashboard.perusahaan')->with('success', 'Lowongan berhasil ditambahkan.');
}
// funsgi hapus lowongan
public function destroy($id)
    {
        $lowongan = Lowongan::findOrFail($id);

        $perusahaan = Auth::user()->perusahaan;
        if ($perusahaan->id !== $lowongan->perusahaan_id) {
            return redirect()->back()->with('error', 'Anda tidak memiliki izin untuk menghapus lowongan ini.');
        }

        $lowongan->delete();

        return redirect()->back()->with('success', 'Lowongan berhasil dihapus.');
    }
}



