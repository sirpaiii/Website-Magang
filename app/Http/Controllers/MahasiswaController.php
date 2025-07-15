<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use App\Models\Lowongan;

class MahasiswaController extends Controller
{
    // Fungsi Menampilkan
    public function show()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if (!$mahasiswa) {
            $mahasiswa = new Mahasiswa(); 
        }

        return view('mahasiswa.profil', compact('mahasiswa'));
    }
    // Fungsi Update
    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_mhs' => 'required',
            'nim' => 'required',
            'jurusan' => 'required',
            'univ' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'foto' => 'image|nullable',
            'cv' => 'file|nullable|mimes:pdf,doc,docx'
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_mahasiswa', 'public');
        }

        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('cv_mahasiswa', 'public');
        }


        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();

        if ($mahasiswa) {
            $mahasiswa->update($data);
        } else {

            $data['user_id'] = Auth::id();
            Mahasiswa::create($data);
        }

        return back()->with('success', 'Profil berhasil disimpan.');
    }
    // Fungsi Pencarian
   public function filter(Request $request)
{
    $query = Lowongan::with('perusahaan');

    $search = trim($request->search);

    if (!empty($search)) {
        $query->where(function ($q) use ($search) {
            $q->where('judul', 'like', "%$search%")
              ->orWhere('lokasi', 'like', "%$search%")
              ->orWhereHas('perusahaan', function ($sub) use ($search) {
                  $sub->where('nama_perusahaan', 'like', "%$search%");
              });
        });
    }

    $lowongans = $query->latest()->get();

    return view('dashboard.mahasiswa', compact('lowongans'));
}


}
