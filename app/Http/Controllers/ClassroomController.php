<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ClassroomController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query untuk classrooms dengan relasi ke tabel teachers
        $query = Classroom::with('teacher');

        // Filter berdasarkan tanggal jika parameter diberikan
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('updated_at', [
                $request->start_date,
                $request->end_date,
            ]);
        } elseif ($request->has('start_date')) {
            $query->whereDate('updated_at', '>=', $request->start_date);
        } elseif ($request->has('end_date')) {
            $query->whereDate('updated_at', '<=', $request->end_date);
        }

        // Pagination dengan 20 data per halaman
        $classrooms = $query->paginate(20);

        // Kirim data ke view
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


    public function exportXml(Request $request)
    {
        // Mulai query untuk classrooms
        $query = Classroom::with('teacher');

        // Filter berdasarkan tanggal jika parameter diberikan
        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('updated_at', [
                $request->start_date,
                $request->end_date,
            ]);
        } elseif ($request->has('start_date')) {
            $query->whereDate('updated_at', '>=', $request->start_date);
        } elseif ($request->has('end_date')) {
            $query->whereDate('updated_at', '<=', $request->end_date);
        }

        // Ambil data classrooms
        $classrooms = $query->get();

        // Buat struktur XML
        $xml = new \SimpleXMLElement('<classrooms/>');

        foreach ($classrooms as $classroom) {
            $classroomNode = $xml->addChild('classroom');
            $classroomNode->addChild('id', $classroom->id);
            $classroomNode->addChild('class_name', $classroom->class_name);
            $classroomNode->addChild('teacher', $classroom->teacher->name ?? 'Unknown');
            $classroomNode->addChild('updated_at', $classroom->updated_at);
        }

        // Konversi XML ke string
        $xmlString = $xml->asXML();

        // Kirim response XML
        return Response::make($xmlString, 200, [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename="classrooms.xml"',
        ]);
    }
}
