<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        // Ambil data teacher dengan pagination, 20 data per halaman
        $teachers = Teacher::paginate(20);

        // Kirim data ke view
        return view('teacher', compact('teachers'));
    }

    public function destroy($id)
    {
        try {
            // Temukan user berdasarkan ID
            $teacher = Teacher::findOrFail($id);

            // Hapus data user
            $teacher->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('teacher')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            // Redirect dengan pesan gagal
            return redirect()->route('teacher')->with('error', 'Gagal menghapus user. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        // Temukan user berdasarkan ID
        $teacher = Teacher::findOrFail($id);

        // Tampilkan view edit dengan data user
        return view('teachers.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:255',
            'status' => 'required|string|in:aktif,tidak aktif',
        ]);

        // Temukan user berdasarkan ID
        $teacher = Teacher::findOrFail($id);

        // Perbarui data user
        $teacher->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('teacher')->with('success', 'Data berhasil diperbarui.');
    }

    public function create()
    {
        return view('teachers.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'nullable|string|max:15',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        // Simpan data ke database
        Teacher::create($validated);

        // Redirect ke halaman daftar teacher dengan pesan sukses
        return redirect()->route('teacher')->with('success', 'Data berhasil ditambahkan.');
    }
}
