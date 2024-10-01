@extends('layout/layout-dashboard')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    Dashboard Peminjaman
@endsection

@section('title')
    <h1 class="text-xl font-semibold" style="font-family: 'Helvetica', 'Arial', sans-serif;">Data Peminjaman</h1>
@endsection

@section('description')
    <p class="text-gray-600" style="font-family: 'Helvetica', 'Arial', sans-serif;">Semua jumlah data peminjaman muncul di bidang ini</p>
@endsection

@section('content')
<div class="rounded-lg">
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('pages.peminjaman.tambah') }}">
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
    <table class="w-full bg-gray-800 rounded-lg overflow-hidden">
        <thead class="bg-gray-700">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">NISN</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Nama Siswa</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tanggal Pinjam</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tanggal Kembali</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
            @forelse ($peminjaman as $peminjamen)
                <tr class="hover:bg-gray-700 transition-colors duration-200">
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $peminjamen->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $peminjamen->nisn }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $peminjamen->siswa->nama ?? 'N/A' }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $peminjamen->tanggal_pinjam }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $peminjamen->tanggal_kembali }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">
                        <a href="{{ route('pages.peminjaman.detail', $peminjamen->id) }}"><button class="bg-blue-500 hover:bg-blue-600 text-white px-2 py-1 rounded-md mr-2"><i class="fa-solid fa-info"></i></button></a>
                        <a href="{{ route('pages.peminjaman.edit', $peminjamen->id) }}"><button class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded-md mr-2"><i class="fa-solid fa-pencil"></i></button></a>
                        <button onclick="confirmDelete({{ $peminjamen->id }})" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-md mr-2"><i class="fa-solid fa-trash"></i></button>
                        {{-- <a href="{{ route('pages.peminjaman.detail', $peminjamen->id) }}"><button class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-md"><i class="fa-solid fa-info"></i></button></a> --}}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 text-center">Tidak ada data peminjaman</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Hapus Peminjaman
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Apakah Anda yakin ingin menghapus data peminjaman ini? Tindakan ini tidak dapat dibatalkan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="confirmDeleteButton" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Hapus
                </button>
                <button type="button" onclick="closeDeleteModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Batal
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    let deleteId = null;

    function confirmDelete(id) {
        deleteId = id;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    document.getElementById('confirmDeleteButton').addEventListener('click', function() {
        if (deleteId) {
            // Kirim permintaan hapus ke server
            axios.delete(`{{ route('pages.peminjaman.hapus', '') }}/${deleteId}`)
                .then(function (response) {
                    // Tutup modal
                    closeDeleteModal();
                    // Refresh halaman atau hapus baris dari tabel
                    location.reload();
                })
                .catch(function (error) {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus data.');
                });
        }
    });
</script>
@endsection

