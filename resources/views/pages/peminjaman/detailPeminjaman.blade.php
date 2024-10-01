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
                <form action="{{ route('peminjaman.selesai', $peminjaman->id) }}" method="POST" id="pengembalianForm">
                    @csrf
                    @method('POST')
                    <table class="w-full text-gray-300" id="buku_table">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 bg-gray-700 text-left">#</th>
                                <th class="py-2 px-4 bg-gray-700 text-left">Kode Buku</th>
                                <th class="py-2 px-4 bg-gray-700 text-left">Judul Buku</th>
                                <th class="py-2 px-4 bg-gray-700 text-left">Penerbit</th>
                                <th class="py-2 px-4 bg-gray-700 text-left">Tahun Terbit</th>
                                <th class="py-2 px-4 bg-gray-700 text-left">Jumlah Buku</th>
                                <th class="py-2 px-4 bg-gray-700 text-left">Kembalikan</th>
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
                                <td class="py-2 px-4">
                                    <input type="checkbox" name="selected_books[]" value="{{ $detail->kode_buku }}">
                                    <input type="hidden" name="kode_buku[]" value="{{ $detail->kode_buku }}">
                                    <input type="hidden" name="jumlah[]" value="{{ $detail->jumlah }}">
                                    {{ $detail->buku->judul }} ({{ $detail->jumlah }})
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <input type="hidden" name="nis" value="{{ $peminjaman->nisn }}">
                    <input type="hidden" name="tanggal_kembali" value="{{ date('Y-m-d') }}">
                    <div class="mt-4"></div>
                        <button type="submit" class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                            Kembalikan Buku Terpilih
                        </button>
                    </div>
                </form>
            </div>

            <div class="flex items-center gap-4 mt-8">
                <a href="{{ route('pages.peminjaman.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 focus:ring-offset-gray-800">
                    Kembali
                </a>
            </div>
        </form>
    </div>


@endsection