<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // ---------------------------------------
    // HALAMAN LOGIN
    // ---------------------------------------
    public function loginPage()
    {
        return view('auth.login');
    }

    // ---------------------------------------
    // PROSES LOGIN
    // ---------------------------------------
    public function loginProcess(Request $request)
    {
        // Validasi input login
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('tanah.index')->with('success', 'Berhasil login!');
        }

        // Jika gagal login
        return back()->with('error', 'Email atau password salah!');
    }

    // ---------------------------------------
    // HALAMAN REGISTER
    // ---------------------------------------
    public function registerPage()
    {
        return view('auth.register');
    }

    // ---------------------------------------
    // PROSES REGISTER (nama + email + password)
    // ---------------------------------------
    public function registerProcess(Request $request)
    {
        // Validasi input register
        $validated = $request->validate([
            'name'     => 'required|string|min:3',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        // Simpan user ke database
        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role'     => 'user',
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    // ---------------------------------------
    // LOGOUT
    // ---------------------------------------
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}