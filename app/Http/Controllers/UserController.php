<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Ambil data user dengan pagination, 20 data per halaman
        $users = User::paginate(20);

        // Kirim data ke view
        return view('user', compact('users'));
    }

    public function destroy($id)
    {
        try {
            // Temukan user berdasarkan ID
            $user = User::findOrFail($id);

            // Hapus data user
            $user->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('user')->with('success', 'User berhasil dihapus.');
        } catch (\Exception $e) {
            // Redirect dengan pesan gagal
            return redirect()->route('user')->with('error', 'Gagal menghapus user. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);

        // Tampilkan view edit dengan data user
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        // Temukan user berdasarkan ID
        $user = User::findOrFail($id);

        // Perbarui data user
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('user')->with('success', 'User berhasil diperbarui.');
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);
    
        // Simpan data ke database dengan enkripsi password
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']), // Enkripsi password
        ]);
    
        // Redirect dengan pesan sukses
        return redirect()->route('user')->with('success', 'Data berhasil ditambahkan.');
    }
}
