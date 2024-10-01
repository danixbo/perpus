@extends('layout/layout-dashboard')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    Dashboard
@endsection

@section('title')
    <h1 class="text-2xl font-semibold text-teal-400" style="font-family: 'Helvetica', 'Arial', sans-serif;">Dashboard</h1>
@endsection

@section('description')
    <p class="text-gray-400 mt-2" style="font-family: 'Helvetica', 'Arial', sans-serif;">Semua jumlah data muncul di bidang
        ini</p>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-medium mb-10 text-gray-300">Jumlah Data Siswa</h2>
                <p class="text-4xl font-semibold text-center text-teal-400 mt-4">
                    <i class="fa-solid fa-user-group mr-3"></i>
                    {{ $siswa }}
                </p>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-medium mb-10 text-gray-300">Jumlah Peminjaman Hari Ini</h2>
                <p class="text-4xl font-semibold text-center text-teal-400 mt-4">
                    <i class="fa-solid fa-calendar-day mr-3"></i>
                    {{ $peminjaman_hari_ini }}
                </p>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-medium mb-10 text-gray-300">Jumlah Data Buku</h2>
                <p class="text-4xl font-semibold text-center text-teal-400 mt-4">
                    <i class="fa-solid fa-book-open mr-3"></i>
                    {{ $buku }}
                </p>
            </div>
            <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                <h2 class="text-lg font-medium mb-10 text-gray-300">Jumlah Buku Belum Kembali</h2>
                <p class="text-4xl font-semibold text-center text-teal-400 mt-4">
                    <i class="fa-solid fa-book mr-3"></i>
                    000.000
                </p>
            </div>
        </div>

        <div class="bg-gray-800 p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-medium mb-6 text-gray-300">Buku Terfavorit</h2>
            <div class="flex flex-col md:flex-row">
                <img src="https://cdn.gramedia.com/uploads/picture_meta/2023/12/4/mvmhrefupabqn9owyqgtee.jpg"
                    alt="Random book cover"
                    class="w-full md:w-1/2 h-auto object-cover rounded-md mb-4 md:mb-0 md:mr-6">
                <div class="flex-1">
                    <p class="mb-3">
                        <span class="font-semibold text-gray-400">Nama Buku:</span>
                        <span class="text-gray-300 block mt-1">Komi Sulit Berkomunikasi</span>
                    </p>
                    <p class="mb-3">
                        <span class="font-semibold text-gray-400">ID Buku:</span>
                        <span class="text-gray-300 block mt-1">999</span>
                    </p>
                    <p>
                        <span class="font-semibold text-gray-400">Total Favorit:</span>
                        <span class="text-gray-300 block mt-1">999</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection