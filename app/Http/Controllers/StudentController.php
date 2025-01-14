<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // Ambil data student dengan pagination, 20 data per halaman
        $students = Student::paginate(20);

        // Kirim data ke view
        return view('student', compact('students'));
    }

    public function destroy($id)
    {
        try {
            // Temukan user berdasarkan ID
            $student = Student::findOrFail($id);

            // Hapus data user
            $student->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('student')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            // Redirect dengan pesan gagal
            return redirect()->route('user')->with('error', 'Gagal menghapus user. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        // Temukan user berdasarkan ID
        $student = Student::findOrFail($id);

        // Tampilkan view edit dengan data user
        return view('students.edit', compact('student'));
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
        $student = Student::findOrFail($id);

        // Perbarui data user
        $student->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->status
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('student')->with('success', 'data berhasil diupdate.');
    }

    // Menampilkan form tambah data
    public function create()
    {
        return view('students.create');
    }

    // Menyimpan data baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'nullable|string|max:15',
            'status' => 'required|in:aktif,tidak aktif',
        ]);

        // Simpan data ke database
        Student::create($validated);

        // Redirect ke halaman daftar student dengan pesan sukses
        return redirect()->route('student')->with('success', 'Data berhasil ditambahkan.');
    }
}
