<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit classroom</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-xl mx-auto bg-white p-5 rounded shadow">
        <h2 class="text-2xl font-bold mb-5">Edit classroom</h2>

        <form action="{{ route('classrooms.update', $classroom->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Input Nama -->
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-bold mb-2">Nama Kelas</label>
                <input type="text" id="class_name" name="class_name" value="{{ $classroom->class_name }}"
                    class="w-full px-3 py-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label for="teacher_id" class="block text-gray-700 font-bold mb-2">Guru</label>
                <select id="teacher_id" name="teacher_id" class="w-full px-3 py-2 border rounded" required>
                    <option value="{{ $classroom->teacher->nama ?? 'Guru tidak ditemukan' }}">Pilih Guru</option>
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('classroom') }}" class="ml-3 text-gray-700 hover:underline">Batal</a>
        </form>
    </div>
</body>
</html>
