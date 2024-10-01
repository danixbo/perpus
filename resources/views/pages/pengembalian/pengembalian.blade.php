@extends('layout/layout-dashboard')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    Dashboard Pengembalian
@endsection

@section('title')
    <h1 class="text-xl font-semibold" style="font-family: 'Helvetica', 'Arial', sans-serif;">Data Pengembalian</h1>
@endsection

@section('description')
    <p class="text-gray-600" style="font-family: 'Helvetica', 'Arial', sans-serif;">Semua jumlah data pengembalian muncul di bidang ini</p>
@endsection

@section('content')
<div class="rounded-lg">
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('pages.pengembalian.tambah') }}">
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
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tanggal Kembali</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-700">
            @forelse ($pengembalian as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nisn }}</td>
                    <td>{{ $item->siswa->nama ?? 'N/A' }}</td>
                    <td>{{ $item->tanggal_kembali }}</td>
                    <td>
                        @foreach ($item->detailPengembalian as $detail)
                            {{ $detail->buku->judul ?? 'N/A' }} ({{ $detail->jumlah }})<br>
                        @endforeach
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-gray-300 text-center">Tidak ada data pengembalian</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
