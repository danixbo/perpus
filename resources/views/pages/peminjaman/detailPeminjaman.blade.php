@extends('layout/layout-dashboard')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    Detail Peminjaman
@endsection

@section('title')
    <h1 class="text-2xl font-semibold text-teal-400" style="font-family: 'Helvetica', 'Arial', sans-serif;">Detail Peminjaman</h1>
@endsection

@section('description')
    <p class="text-gray-400 mt-2" style="font-family: 'Helvetica', 'Arial', sans-serif;">Informasi detail peminjaman</p>
@endsection

@section('content')
    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="nisn">
                        NISN
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="nisn" type="text" readonly value="{{ $peminjaman->nisn }}">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="tanggal_pinjam">
                        Tanggal Pinjam
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="tanggal_pinjam" type="date" readonly value="{{ $peminjaman->tanggal_pinjam }}">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="nama">
                        Nama
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="nama" type="text" readonly value="{{ $peminjaman->siswa->nama ?? 'N/A' }}">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="tanggal_kembali">
                        Tanggal Kembali
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="tanggal_kembali" type="date" readonly value="{{ $peminjaman->tanggal_kembali }}">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="kode_kelas">
                        Kode Kelas
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="kode_kelas" type="text" readonly value="{{ $peminjaman->siswa->kode_kelas ?? 'N/A' }}">
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-gray-300 text-sm font-semibold mb-2" for="buku_table">
                    Buku
                </label>
                <table class="w-full text-gray-300" id="buku_table">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 bg-gray-700 text-left">#</th>
                            <th class="py-2 px-4 bg-gray-700 text-left">Kode Buku</th>
                            <th class="py-2 px-4 bg-gray-700 text-left">Judul Buku</th>
                            <th class="py-2 px-4 bg-gray-700 text-left">Penerbit</th>
                            <th class="py-2 px-4 bg-gray-700 text-left">Tahun Terbit</th>
                            <th class="py-2 px-4 bg-gray-700 text-left">Jumlah Buku</th>
                        </tr>
                    </thead>
                    <tbody id="buku_tbody">
                        @foreach($peminjaman->detailPeminjaman as $index => $detail)
                        <tr>
                            <td class="py-2 px-4">{{ $index + 1 }}</td>
                            <td class="py-2 px-4">{{ $detail->kode_buku }}</td>
                            <td class="py-2 px-4">{{ $detail->buku->judul ?? 'N/A' }}</td>
                            <td class="py-2 px-4">{{ $detail->buku->penerbit ?? 'N/A' }}</td>
                            <td class="py-2 px-4">{{ $detail->buku->tahun_terbit ?? 'N/A' }}</td>
                            <td class="py-2 px-4">{{ $detail->jumlah }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="flex items-center gap-4 mt-8">
                <a href="{{ route('pages.peminjaman.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                    Kembali
                </a>
                <form action="{{ route('peminjaman.selesai', $peminjaman->id) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                        Serahkan Buku
                    </button>
                </form>
            </div>
        </form>
    </div>

    <!-- Alert Notification -->
    <div id="alert" class="fixed bottom-5 right-5 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg transform transition-all duration-500 translate-y-full opacity-0">
        <div class="flex items-center">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <span id="alertMessage"></span>
        </div>
    </div>
@endsection

@section('custom-script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const selesaiButton = document.getElementById('selesaiButton');
    
    if (selesaiButton) {
        selesaiButton.addEventListener('click', function() {
            console.log('Button clicked');
            axios.post('{{ route("peminjaman.selesai", $peminjaman->id) }}', {}, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(function (response) {
                console.log('Success:', response.data);
                alert('Peminjaman berhasil diselesaikan');
                window.location.href = '{{ route("pages.peminjaman.index") }}';
            })
            .catch(function (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyelesaikan peminjaman');
            });
        });
    } else {
        console.error('Selesai button not found');
    }
});
</script>
@endsection