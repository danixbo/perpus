@extends('layout/layout-dashboard')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    Dashboard Buku
@endsection

@section('title')
    <h1 class="text-xl font-semibold" style="font-family: 'Helvetica', 'Arial', sans-serif;">Data Buku</h1>
@endsection

@section('description')
    <p class="text-gray-600" style="font-family: 'Helvetica', 'Arial', sans-serif;">Semua jumlah data buku muncul di bidang ini</p>
@endsection

@section('content')
<div class="rounded-lg">
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('pages.buku.tambah') }}">
            <button class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out">
                + Tambah Data
            </button>
        </a>
        <div class="relative">
            <input type="text" id="searchInput" placeholder="Search..." class="bg-gray-700 text-gray-100 rounded-md pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-300 ease-in-out">
            <button onclick="performSearch()" class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-teal-500 transition-colors duration-300 ease-in-out">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </div>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-md mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded-md mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="w-full bg-gray-800 rounded-lg overflow-hidden">
        <thead class="bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Gambar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Kode Buku</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Judul</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Penerbit</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tahun Terbit</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
            @forelse ($bukus as $buku)
                <tr class="hover:bg-gray-700 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        <img src="{{ asset($buku->foto) }}" alt="{{ $buku->judul }}" style="width: 100px; height: auto;">
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $buku->kode_buku }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $buku->judul }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $buku->penerbit }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $buku->tahun_terbit }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        <a href="{{ route('pages.buku.edit', $buku->kode_buku) }}">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md mr-2">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                        </a>
                        <button onclick="openDeleteModal('{{ $buku->kode_buku }}', '{{ $buku->judul }}')" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-md mr-2">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 text-center">Tidak ada data buku</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 overflow-y-auto h-full w-full hidden flex items-center justify-center">
        <div class="relative py-10 px-6 w-full max-w-sm mx-auto rounded-lg shadow-lg bg-gray-800">
            <div class="mt-0 text-center">
                <h3 class="text-xl leading-6 font-bold text-gray-100">Konfirmasi Penghapusan</h3>
                <div class="mt-4 px-2">
                    <p class="text-sm text-gray-300">
                        Apakah Anda yakin ingin menghapus buku <span id="bookTitle" class="font-bold text-teal-400"></span>?
                    </p>
                </div>
                <div class="mt-6 flex flex-col space-y-3">
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button id="deleteButton" type="submit" class="w-full px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75 transition-colors duration-200">
                            Hapus
                        </button>
                    </form>
                    <button id="cancelButton" class="w-full px-4 py-2 bg-gray-700 text-gray-200 text-sm font-medium rounded-lg shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-75 transition-colors duration-200">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function openDeleteModal(kodeBuku, judul) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('bookTitle').textContent = judul;
        document.getElementById('deleteForm').action = "{{ route('pages.buku.hapus', '') }}/" + kodeBuku;
    }

    document.getElementById('cancelButton').addEventListener('click', function() {
        document.getElementById('deleteModal').classList.add('hidden');
    });

    function performSearch() {
        // Implement your search functionality here
        console.log('Search functionality to be implemented');
    }
</script>
@endsection
