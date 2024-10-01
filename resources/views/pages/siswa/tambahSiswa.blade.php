@extends('layout/layout-dashboard')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    Tambah Siswa
@endsection

@section('title')
    <h1 class="text-2xl font-semibold text-teal-400" style="font-family: 'Helvetica', 'Arial', sans-serif;">Tambah Siswa</h1>
@endsection

@section('description')
    <p class="text-gray-400 mt-2" style="font-family: 'Helvetica', 'Arial', sans-serif;">Anda dapat menambahkan data siswa di sini</p>
@endsection

@section('content')
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-4">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pages.siswa.tambah') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="nisn">
                        NISN
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="nisn" name="nisn" type="text" placeholder="22200193716" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="nama">
                        Nama
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="nama" name="nama" type="text" placeholder="John Doe" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="alamat">
                        Alamat
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="alamat" name="alamat" type="text" placeholder="Gang Mawar III" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="no_telp">
                        No Telepon
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="no_telp" name="no_telp" type="number" placeholder="081234567890" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="kode_kelas">
                        Kode Kelas
                    </label>
                    <select
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="kode_kelas" name="kode_kelas" required>
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->kode_kelas }}">{{ $k->tingkat }} {{ $k->jurusan }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="role">
                        Role
                    </label>
                    <select
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="role" name="role" required>
                        <option value="" disabled selected>Pilih Role</option>
                        <option value="Siswa">Siswa</option>
                        <option value="Petugas">Petugas</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="username">
                        Username
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="username" name="username" type="text" placeholder="JohnDoe123" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="password">
                        Password
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="password" type="password" name="password" placeholder="********" required>
                </div>
            </div>
            <div class="flex items-center gap-4 mt-8">
                <button
                    class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                    type="submit">
                    Simpan Data
                </button>
                <button
                    class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                    type="reset">
                    Mulai Ulang
                </button>
            </div>
        </form>
    </div>
@endsection