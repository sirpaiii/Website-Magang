<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lamaran;
use App\Models\Lowongan;

class LamaranController extends Controller
{   
    // Membuat Lamaran
    public function lamar($lowongan_id)
{
    $user = Auth::user();
    $mahasiswa = $user->mahasiswa;

    if (!$mahasiswa || !$mahasiswa->nama_mhs || !$mahasiswa->nim || !$mahasiswa->jurusan) {
        return back()->with('error', 'Isi profil terlebih dahulu sebelum melamar.');
    }

    $cek = Lamaran::where('mahasiswa_id', $mahasiswa->id)
                  ->where('lowongan_id', $lowongan_id)
                  ->first();

    if ($cek) {
        return back()->with('error', 'Anda sudah melamar lowongan ini.');
    }

    Lamaran::create([
        'mahasiswa_id' => $mahasiswa->id,
        'lowongan_id' => $lowongan_id,
        'status' => 'menunggu',
    ]);

    return back()->with('success', 'Lamaran berhasil dikirim.');
}

    // Menampilkan Lamaran Mahasiswa
    public function indexMahasiswa()
    {
        $mahasiswa = Auth::user()->mahasiswa;

    if (!$mahasiswa || !$mahasiswa->nama_mhs || !$mahasiswa->nim || !$mahasiswa->jurusan) {
        return redirect()->route('mahasiswa.profil')
            ->with('error', 'Isi profil terlebih dahulu untuk melihat riwayat lamaran.');
    }

    $lamarans = $mahasiswa->lamarans()->with('lowongan')->latest()->get();
        return view('mahasiswa.lamaran', compact('lamarans'));
    }
    // Fungsi Menampilakn Lowongan perusahaan
    public function indexPerusahaan()
{
    $user = Auth::user();
    $perusahaan = $user->perusahaan;

    if (!$perusahaan) {
        return back()->with('error', 'Anda belum terdaftar sebagai perusahaan.');
    }

    $lowongans = $perusahaan->lowongans;

    if ($lowongans->isEmpty()) {
        return back()->with('error', 'Anda belum menambahkan lowongan.');
    }

    $lamarans = Lamaran::with(['mahasiswa', 'lowongan'])
        ->whereHas('lowongan', function ($query) use ($perusahaan) {
            $query->where('perusahaan_id', $perusahaan->id);
        })
        ->orderByDesc('tgl_lamaran')
        ->get();

    return view('perusahaan.lamaran', compact('lamarans'));
}

    // Untuk Update Status
    public function updateStatus(Request $request, Lamaran $lamaran)
    {
        $request->validate(['status' => 'required|in:diterima,ditolak']);
        $lamaran->update(['status' => $request->status]);

        return back()->with('success', 'Status lamaran diperbarui.');
    }
}
