@extends('layout/layout-dashboard')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    Edit Pengembalian
@endsection

@section('title')
    <h1 class="text-2xl font-semibold text-teal-400" style="font-family: 'Helvetica', 'Arial', sans-serif;">Edit Pengembalian</h1>
@endsection

@section('description')
    <p class="text-gray-400 mt-2" style="font-family: 'Helvetica', 'Arial', sans-serif;">Anda dapat mengedit data pengembalian di sini</p>
@endsection

@section('content')
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="id">
                        ID
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="id" type="text" placeholder="22200193716">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="nisn">
                        NISN
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="nisn" type="text" placeholder="John Doe">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="tanggal_kembali">
                        Tanggal Kembali
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="tanggal_kembali" type="text" placeholder="Gang Mawar III">
                </div>
            </div>
            <div class="flex items-center gap-4 mt-8">
                <button
                    class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                    type="button">
                    Simpan Data
                </button>
                <button
                    class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                    type="button"
                    onclick="Hapus()">
                    Mulai Ulang
                </button>
            </div>
        </form>
    </div>

    <script>
        function Hapus() {
            document.getElementById('nisn').value = '';
            document.getElementById('nama').value = '';
            document.getElementById('alamat').value = '';
            document.getElementById('no_telp').value = '';
            document.getElementById('kode_kelas').value = '';
        }
    </script>
@endsection