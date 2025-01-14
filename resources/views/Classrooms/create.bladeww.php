@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Classroom</h1>
    <form action="{{ route('classrooms.store') }}" method="POST">
        @csrf

        <!-- Input Nama Kelas -->
        <div class="mb-4">
            <label for="class_name" class="block text-gray-700 font-bold mb-2">Nama Kelas</label>
            <input type="text" id="class_name" name="class_name" value="{{ old('class_name') }}" 
                class="w-full px-3 py-2 border rounded" required>
        </div>

        <!-- Dropdown Guru -->
        <div class="mb-4">
            <label for="teacher_id" class="block text-gray-700 font-bold mb-2">Guru</label>
            <select id="teacher_id" name="teacher_id" class="w-full px-3 py-2 border rounded" required>
                <option value="">Pilih Guru</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
        <a href="{{ route('classrooms.index') }}" class="ml-3 text-gray-700 hover:underline">Batal</a>
    </form>
</div>
@endsection
