<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Teacher</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 py-10">
    <div class="max-w-xl mx-auto bg-white p-5 rounded shadow">
        <h2 class="text-2xl font-bold mb-5">Edit Teacher</h2>

        <form action="{{ route('teachers.update', $teacher->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Input Nama -->
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-bold mb-2">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ $teacher->nama }}"
                    class="w-full px-3 py-2 border rounded" required>
            </div>

            <!-- Input Email -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ $teacher->email }}"
                    class="w-full px-3 py-2 border rounded" required>
            </div>

            <!-- Input Phone -->
            <div class="mb-4">
                <label for="phone" class="block text-gray-700 font-bold mb-2">No telepon</label>
                <input type="text" id="phone" name="phone" value="{{ $teacher->phone }}"
                    class="w-full px-3 py-2 border rounded" required>
            </div>

            <!-- Input Status -->
            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-bold mb-2">Status</label>
                <select id="status" name="status" class="w-full px-3 py-2 border rounded bg-white" required>
                    <option value="aktif" {{ old('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="tidak aktif" {{ old('status') === 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
            <a href="{{ route('teacher') }}" class="ml-3 text-gray-700 hover:underline">Batal</a>
        </form>
    </div>
</body>
</html>
