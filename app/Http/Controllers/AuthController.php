<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan halaman register
    public function tampilRegister() {
        return view('auth.register');
    }

    // Proses data register
    public function dataRegister(Request $request) 
    {
        $request->validate([
            'email' => 'required|string|max:100',
            'password' => 'required|max:50|min:8',
        ]);

        // Cek apakah email sudah terdaftar
        $email = User::where('email', $request->email)->first();
        if ($email) {
            return back()->with('failed', 'Email sudah terdaftar');
        }

        $request['status'] = "active";
        $request['role'] = 'pembeli';
        $user = User::create($request->all());

        Auth::login($user);
        return redirect()->route('tampilLogin');
    }

    // Menampilkan halaman login
    public function tampilLogin() {
        return view('auth.login');
    }

    // Proses data login
    public function dataLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:100',
            'password' => 'required|max:50'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            // Cek berhasil login
            if ($user->role === 'pembeli') {
                return redirect('/home_page');
            } else {
                return redirect('/dashboard');
            }
        } else {
            return back()->with('failed', 'Email atau kata sandi salah');
        }
    }

    // Menampilkan halaman logout
    public function logout() {
        Auth::logout();
        return redirect()->route('tampilLogin')->with('success', 'Anda telah berhasil logout');
    }
}
