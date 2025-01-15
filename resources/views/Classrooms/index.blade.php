<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="relative p-3 container">
            {{ $classrooms->links() }}
            <a href="
            {{ route('classrooms.create') }}
            "
                style="margin-bottom: 10px; display: inline-block;">
                <button class="btn btn-primary">Tambah Data</button>
            </a>
        </div>
        <form method="GET" action="{{ route('classroom') }}" class="mb-4">
            <div class="flex items-center container">
                <!-- Input Start Date -->
                <div class="mr-4">
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Input End Date -->
                <div class="mr-4">
                    <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="btn btn-danger">
                        Filter
                    </button>
                    
                </div>
                
            </div>
        </form>
        <!-- Form Export -->
        
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 container">
            <thead class="text-sm text-gray-700 uppercase bg-white dark:bg-gray-800 ">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($classrooms->isEmpty())
                    <div class="text-black p-3 rounded mb-3">
                        Data belum tersedia!
                    </div>
                @else
                    <tr
                        class="bg-white border-t border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="col" class="px-6 py-3 text-center">
                            <span>NO</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            <span>Nama Kelas</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            <span>Wali kelas</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            <span>Waktu di update</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            <span>Action</span>
                        </th>
                    </tr>
            </thead>
            <tbody>

                @forelse ($classrooms as $classroom)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            {{ $loop->iteration + ($classrooms->currentPage() - 1) * $classrooms->perPage() }}
                            {{-- nomer --}}
                        </td>
                        <td class="px-6 py-2 text-center">
                            {{ $classroom->class_name }}
                            {{-- ini nama --}}
                        </td>
                        <td class="px-6 py-2 text-center">
                            {{ $classroom->teacher->nama ?? 'Guru tidak ditemukan' }}
                            {{-- ini email --}}
                        </td>
                        <td class="px-6 py-2 text-center">
                            {{ $classroom->updated_at ?? 'Null' }}
                            {{-- ini email --}}
                        </td>
                        <td class="px-6 py-2 text-center">
                            <a href="{{ route('classrooms.edit', $classroom->id) }}"
                                class="text-blue-600 hover:text-blue-900">Edit</a>
                            <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST"
                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center p-3 bg-yellow-100 text-yellow-700">
                            Data belum tersedia!
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
        @endif

        <div id="exportForm" class="container my-2">
            <form method="GET" action="{{ route('classrooms.export.xml') }}" class="mb-4">
                <!-- Tombol Export -->
                <button type="submit" class="btn btn-success">
                    Export to XML
                </button>
            </form>
        </div>
        

    </div>
</x-app-layout>
