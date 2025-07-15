<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    //  Fungsi Login
   public function showLoginForm() {
    return view('auth.login');
}

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role === 'mahasiswa') {
                return redirect('/mahasiswa/dashboard');
            } elseif ($user->role === 'perusahaan') {
                return redirect('/perusahaan/dashboard');
            }
        }

        return back()->withErrors(['email' => 'Login gagal.']);
    }

    public function showRegisterForm() {
        return view('auth.register');
    }
    //  Fungsi Register
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'role' => 'required|in:mahasiswa,perusahaan',
       ],   [
        'name.required' => 'Nama wajib diisi.',
        'email.required' => 'Email wajib diisi.',
        'email.email' => 'Format email tidak valid.',
        'email.unique' => 'Email sudah digunakan.',
        'password.required' => 'Password wajib diisi.',
        'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        'password.min' => 'Password minimal 6 karakter.',
        
    ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    // Fungsi Logout
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }
}
