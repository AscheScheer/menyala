<x-app-layout>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg container">
        <div class="relative p-3">
            {{ $teachers->links() }}
            <a href="{{ route('teachers.create') }}"
                style="margin-bottom: 10px; display: inline-block;">
            <button class="btn btn-primary">Tambah Data</button>
            </a>
        </div>
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

                @if ($teachers->isEmpty())
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
                            <span>nama</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            <span>Email</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            <span>No tlp</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            <span>status</span>
                        </th>
                        <th scope="col" class="px-6 py-3 text-center">
                            <span>Action</span>
                        </th>
                    </tr>
            </thead>
            <tbody>

                @forelse ($teachers as $teacher)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                            {{ $loop->iteration + ($teachers->currentPage() - 1) * $teachers->perPage() }}
                            {{-- nomer --}}
                        </td>
                        <td class="px-6 py-2 text-center">
                            {{ $teacher->nama }}
                            {{-- ini nama --}}
                        </td>
                        <td class="px-6 py-2 text-center">
                            {{ $teacher->email }}
                            {{-- ini email --}}
                        </td>
                        <td class="px-6 py-2 text-center">
                            {{ $teacher->phone }}
                            {{-- ini hp --}}
                        </td>
                        <td class="px-6 py-2 text-center">
                            {{ $teacher->status }}
                            {{-- ini status --}}
                        <td class="px-6 py-2 text-center">
                            <a href="{{ route('teachers.edit', $teacher->id) }}"
                                class="text-blue-600 hover:text-blue-900">Edit</a>
                            <form action="{{ route('teachers.destroy', $teacher->id) }}" method="POST"
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

    </div>
</x-app-layout>
