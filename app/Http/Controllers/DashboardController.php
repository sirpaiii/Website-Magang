<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Lowongan;


class DashboardController extends Controller
{
    // Menampilkan Dashboard Mahasiswa
    public function mahasiswa() {
    if (auth()->user()->role !== 'mahasiswa') {
        abort(403);
    }

    $lowongans = \App\Models\Lowongan::with('perusahaan')->latest()->get();

    return view('dashboard.mahasiswa', compact('lowongans'));
}

    // Menampilkan Dashboard Perusahaan
    public function perusahaan()
    {
        if (Auth::user()->role !== 'perusahaan') {
            abort(403, 'Unauthorized');
        }

        $perusahaan = Auth::user()->perusahaan;

        $lowongans = $perusahaan
            ? Lowongan::where('perusahaan_id', $perusahaan->id)->latest()->get()
            : collect(); 

        return view('dashboard.perusahaan', compact('lowongans'));
    }

    

    
}

