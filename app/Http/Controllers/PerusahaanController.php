<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Perusahaan;

class PerusahaanController extends Controller
{
    // Funsgi Menampilkan
   public function show()
{
    $perusahaan = Perusahaan::where('user_id', Auth::id())->first();

    if (!$perusahaan) {
        $perusahaan = new Perusahaan(); 
    }

    return view('perusahaan.profil', compact('perusahaan'));
}
    // Funsgi Update
    public function update(Request $request)
    {
        $data = $request->validate([
            'nama_perusahaan' => 'required',
            'alamat' => 'required',
            'profil_perusahaan' => 'required'
        ]);

        $perusahaan = Perusahaan::where('user_id', Auth::id())->first();

        if ($perusahaan) {
            $perusahaan->update($data);
        } else {

            $data['user_id'] = Auth::id();
            Perusahaan::create($data);
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
