<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Method untuk menampilkan halaman login
    public function loginForm()
    {
        return view('admin.login');
    }

    // Method untuk login admin
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Regenerasi session untuk keamanan
            $request->session()->regenerate();

            // Redirect ke dashboard admin setelah login berhasil
            return redirect()->route('admin.dashboard');
        }

        // Jika login gagal, kembali ke halaman login dengan pesan error
        return redirect()->route('admin.login')->with('error', 'Email atau Password salah!');
    }

    // Method untuk menampilkan halaman dashboard admin
    public function dashboard()
    {
        return view('admin.dashboard'); // Ganti dengan nama view yang sesuai
    }

    // Method untuk logout admin
    public function logout(Request $request)
    {
        // Logout admin dan invalidate session
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect ke halaman login setelah logout
        return redirect()->route('admin.login');
    }
    // Di dalam AdminController.php

public function laporanDiterima()
{
    // Logika untuk menampilkan laporan yang diterima
    // Misalnya, kamu bisa memanggil data laporan diterima dari database
    return view('admin.laporan_diterima'); // Ganti dengan view yang sesuai
}

}
