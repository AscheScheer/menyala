<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    public function index()
    {
        // Ambil semua data classrooms beserta nama guru
        $classrooms = Classroom::with('teacher')->paginate(20);
        return view('classrooms.index', compact('classrooms'));
    }

    public function create()
    {
        // Ambil semua data guru untuk digunakan di form
        $teachers = Teacher::all();
        return view('classrooms.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'class_name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        Classroom::create($validated);

        return redirect()->route('classroom')->with('success', 'Data classroom berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        try {
            // Temukan user berdasarkan ID
            $classroom = Classroom::findOrFail($id);

            // Hapus data user
            $classroom->delete();

            // Redirect dengan pesan sukses
            return redirect()->route('classroom')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            // Redirect dengan pesan gagal
            return redirect()->route('classroom')->with('error', 'Gagal menghapus user. Silakan coba lagi.');
        }
    }

    public function edit($id)
    {
        // Ambil data classroom berdasarkan ID
        $classroom = Classroom::findOrFail($id);

        // Ambil semua data guru untuk digunakan di dropdown
        $teachers = Teacher::all();

        return view('classrooms.edit', compact('classroom', 'teachers'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'class_name' => 'required|string|max:255',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        // Cari classroom berdasarkan ID
        $classroom = Classroom::findOrFail($id);

        // Update data classroom
        $classroom->update($validated);

        // Redirect dengan pesan sukses
        return redirect()->route('classroom')->with('success', 'Data classroom berhasil diupdate.');
    }
}
