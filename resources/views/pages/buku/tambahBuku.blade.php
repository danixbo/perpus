@extends('layout/layout-dashboard')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    Tambah Buku
@endsection

@section('title')
    <h1 class="text-2xl font-semibold text-teal-400" style="font-family: 'Helvetica', 'Arial', sans-serif;">Tambah Buku</h1>
@endsection

@section('description')
    <p class="text-gray-400 mt-2" style="font-family: 'Helvetica', 'Arial', sans-serif;">Anda dapat menambahkan data buku di sini</p>
@endsection

@section('content')
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-md mb-6">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pages.buku.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="foto">
                        Foto
                    </label>
                    <div class="relative">
                        <input type="file" id="foto" name="foto" accept="image/*" class="hidden" onchange="updateFileName(this)">
                        <label for="foto" class="cursor-pointer flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span id="file-name">Pilih foto</span>
                        </label>
                    </div>
                    <p class="mt-1 text-sm text-gray-400">PNG, JPG, atau GIF (Maks. 2MB)</p>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="kode_buku">
                        Kode Buku
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="kode_buku" name="kode_buku" type="text" placeholder="K00" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="judul">
                        Judul
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="judul" name="judul" type="text" placeholder="Judul Buku" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="penerbit">
                        Penerbit
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="penerbit" name="penerbit" type="text" placeholder="Nama Penerbit" required>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="tahun_terbit">
                        Tahun Terbit
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="tahun_terbit" name="tahun_terbit" type="number" placeholder="2001" required>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="deskripsi">
                        Deskripsi
                    </label>
                    <textarea
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="deskripsi" name="deskripsi" rows="4" placeholder="Deskripsi buku" required></textarea>
                </div>
            </div>
            <div class="flex items-center gap-4 mt-8">
                <button
                    class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                    type="submit">
                    Tambah Data
                </button>
                <button
                    class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                    type="button"
                    onclick="resetForm()">
                    Mulai Ulang
                </button>
            </div>
        </form>
    </div>

    <script>
        function updateFileName(input) {
            const fileName = input.files[0]?.name || 'Pilih foto';
            document.getElementById('file-name').textContent = fileName;
        }

        function resetForm() {
            document.getElementById('foto').value = '';
            document.getElementById('file-name').textContent = 'Pilih foto';
            document.getElementById('kode_buku').value = '';
            document.getElementById('judul').value = '';
            document.getElementById('penerbit').value = '';
            document.getElementById('tahun_terbit').value = '';
            document.getElementById('deskripsi').value = '';
        }
    </script>
@endsection