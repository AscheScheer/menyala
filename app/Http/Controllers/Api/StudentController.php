<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all(); // Mengambil semua data student
        return response()->json(['data' => $students], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    try {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'required|string|max:15',
            'status' => 'required|string|in:aktif,tidak aktif',
        ]);

        // Simpan data ke database
        $student = Student::create($validated);

        // Jika berhasil, kembalikan respons sukses
        return response()->json([
            'message' => 'Student created successfully',
            'data' => $student,
        ], 201);
    } catch (\Exception $e) {
        // Jika terjadi kesalahan, kembalikan pesan error
        return response()->json([
            'message' => 'Failed to create student',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        return response()->json(['data' => $student], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $validated = $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:students,email,' . $student->id,
            'phone' => 'sometimes|required|string|max:15',
            'status' => 'nullable|in:aktif,tidak aktif',
        ]);

        $student->update($validated);

        return response()->json(['message' => 'Student updated successfully', 'data' => $student], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json(['message' => 'Student not found'], 404);
        }

        $student->delete();

        return response()->json(['message' => 'Student deleted successfully'], 200);
    }
}
