<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // 1. Menampilkan Halaman Login
    public function index()
    {
        return view('auth.login');
    }

    // 2. Memproses Validasi & Aksi Login
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Email atau password salah!');
    }

    // 3. Menampilkan Halaman Register
    public function register()
    {
        return view('auth.register');
    }

    // 4. Memproses Penyimpanan User Baru
    public function storeRegister(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255',
        ]);

        // Enkripsi password menggunakan bcrypt hash
        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // 5. Memproses Aksi Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}