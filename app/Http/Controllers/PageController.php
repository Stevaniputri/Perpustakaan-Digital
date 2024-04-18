<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Book;

class PageController extends Controller
{
    //
    public function authPage()
    {
        return view('Auth.auth');
    }

    public function dashboard()
    {
        // Ambil semua buku
        $books = Book::all();
        $adminsCount = User::where('role', 'admin')->count();
        $officersCount = User::where('role', 'petugas')->count();
        $borrowersCount = User::where('role', 'peminjam')->count();
        // Perbarui status buku berdasarkan status peminjaman
        foreach ($books as $book) {
            $book->status = $book->borrows()->where('status', 'borrowed')->exists() ? 'borrowed' : 'available';
        }

        return view('dashboard', compact('adminsCount', 'officersCount', 'borrowersCount','books'));
    }

    public function dashboardUser()
    {
        $books = Book::all();
        return view('dashboardUser', compact('books'));
    }
    
    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ], [
            'username.exists' => "This username is exists",
            'password.exists' => "This password is required"
        ]);

        $user = $request->only('username', 'password');
        if (Auth::attempt($user)) {
            // Periksa peran pengguna setelah berhasil login
            $role = Auth::user()->role;

            // Arahkan ke halaman dashboard
            if ($role === 'admin' || $role === 'petugas') {
                return redirect()->route('dashboard');
            } else {
                // Arahkan pengguna dengan peran lain ke halaman default
                return redirect()->route('dashboarduser');
            }
        } else {
            return redirect('/');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'fullname' => 'required|min:3|max:30',
            'username' => 'required',
            'email' => 'required',
            'address' => 'required',
            'password' => 'required',
        ]);

        User::create([
            'fullname' => $request->fullname,
            'username' => $request->username,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'peminjam'
        ]);

        return redirect('/')->with('success', "Berhasil mmebuat akun");
    }

    public function logout()
    {
        // menghapus history login
        Auth::logout();
        // mengarahkan ke halaman login lagi
        return redirect('/');
    }

    public function error()
    {
        return view('error');
    }
}
