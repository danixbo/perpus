@extends('layout/layout-dashboard')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    Edit Buku
@endsection

@section('title')
    <h1 class="text-2xl font-semibold text-teal-400" style="font-family: 'Helvetica', 'Arial', sans-serif;">Edit Buku</h1>
@endsection

@section('description')
    <p class="text-gray-400 mt-2" style="font-family: 'Helvetica', 'Arial', sans-serif;">Anda dapat mengedit data buku di sini</p>
@endsection

@section('content')
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-md mb-6">
                <strong>Terjadi kesalahan:</strong>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('pages.buku.update', $buku->kode_buku) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="gambar">
                        Gambar Sebelumnya
                    </label>
                    <div class="relative">
                        @if($buku->foto)
                            <img src="{{ asset($buku->foto) }}" alt="{{ $buku->judul }}" class="mb-4 w-full h-64 object-cover rounded-md">
                        @endif
                        <input type="file" id="foto" name="foto" accept="gambar/*" class="hidden" onchange="updateFileName(this)">
                        <label for="foto" class="cursor-pointer flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-300 bg-gray-700 border border-gray-600 rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 transition duration-300">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span id="file-name">{{ $buku->foto ? 'Ganti gambar' : 'Pilih gambar' }}</span>
                        </label>
                    </div>
                    <p class="mt-1 text-sm text-gray-400">PNG, JPG, atau GIF (Maks. 2MB)</p>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="kode_buku">
                        Kode Buku (Tidak dapat diubah)
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="kode_buku" name="kode_buku" type="text" placeholder="K00" value="{{ $buku->kode_buku }}" readonly>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="judul">
                        Judul
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="judul" name="judul" type="text" placeholder="Judul Buku" value="{{ $buku->judul }}">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="penerbit">
                        Penerbit
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="penerbit" name="penerbit" type="text" placeholder="Nama Penerbit" value="{{ $buku->penerbit }}">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="tahun_terbit">
                        Tahun Terbit
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="tahun_terbit" name="tahun_terbit" type="number" min="1900" max="{{ date('Y') + 1 }}" placeholder="2001" value="{{ $buku->tahun_terbit }}">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="deskripsi">
                        Deskripsi
                    </label>
                    <textarea
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="deskripsi" name="deskripsi" rows="3" placeholder="Deskripsi buku">{{ $buku->deskripsi }}</textarea>
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
                    type="button"
                    onclick="resetForm()">
                    Mulai Ulang
                </button>
            </div>
        </form>
    </div>

    <script>
        function updateFileName(input) {
            const fileName = input.files[0]?.name || 'Pilih gambar';
            document.getElementById('file-name').textContent = fileName;
        }

        function resetForm() {
            document.getElementById('gambar').value = '';
            document.getElementById('file-name').textContent = 'Pilih gambar';
            document.getElementById('kode_buku').value = '';
            document.getElementById('judul').value = '';
            document.getElementById('penerbit').value = '';
            document.getElementById('tahun_terbit').value = '';
        }
    </script>
@endsection