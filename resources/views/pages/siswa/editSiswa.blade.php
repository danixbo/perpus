@extends('layout/layout-dashboard')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    Edit Siswa
@endsection

@section('title')
    <h1 class="text-2xl font-semibold text-teal-400" style="font-family: 'Helvetica', 'Arial', sans-serif;">Edit Siswa</h1>
@endsection

@section('description')
    <p class="text-gray-400 mt-2" style="font-family: 'Helvetica', 'Arial', sans-serif;">Anda dapat mengedit data siswa di sini</p>
@endsection

@section('content')
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        <form action="{{ route('pages.siswa.update', $siswa->nisn) }}" method="POST">
            @csrf
            @method('POST')
            
            <!-- Tambahkan field konfirmasi password di awal form -->
            <div class="mb-6">
                <label class="block text-gray-300 text-sm font-semibold mb-2" for="current_password">
                    Konfirmasi Password Untuk Mengubah Data
                </label>
                <input
                    class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                    id="current_password" name="current_password" type="password" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="nisn">
                        NISN
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="nisn" name="nisn" type="text" value="{{ $siswa->nisn }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="nama">
                        Nama
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="nama" name="nama" type="text" value="{{ $siswa->nama }}" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="alamat">
                        Alamat
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="alamat" name="alamat" type="text" value="{{ $siswa->alamat }}" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="no_telp">
                        No Telepon
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="no_telp" name="no_telp" type="number" value="{{ $siswa->no_telp }}" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="role">
                        Role
                    </label>
                    <select
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="role" name="role" required>
                        <option value="Siswa" {{ $siswa->role == 'Siswa' ? 'selected' : '' }}>Siswa</option>
                        <option value="Petugas" {{ $siswa->role == 'Petugas' ? 'selected' : '' }}>Petugas</option>
                        <option value="Admin" {{ $siswa->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="kode_kelas">
                        Kode Kelas
                    </label>
                    <select
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="kode_kelas" name="kode_kelas" required>
                        @foreach($kelas as $k)
                            <option value="{{ $k->kode_kelas }}" {{ $siswa->kode_kelas == $k->kode_kelas ? 'selected' : '' }}>
                                {{ $k->tingkat }} {{ $k->jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="username">
                        Username
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="username" name="username" type="text" value="{{ $siswa->username }}" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="password">
                        Password (Kosongkan jika tidak ingin mengubah)
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="password" name="password" type="password">
                </div>
            </div>
            <div class="flex items-center gap-4 mt-8">
                <button
                    class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                    type="submit">
                    Simpan Perubahan
                </button>
                <a href="{{ route('pages.siswa.index') }}"
                    class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                    Batal
                </a>
            </div>
        </form>
    </div>
@endsection

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <strong class="font-bold">Oops!</strong>
        <span class="block sm:inline">Ada beberapa masalah dengan input Anda.</span>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif