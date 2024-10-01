@extends('layout/layout-dashboard')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
@endsection

@section('title-halaman')
    Tambah Peminjaman
@endsection

@section('title')
    <h1 class="text-2xl font-semibold text-teal-400" style="font-family: 'Helvetica', 'Arial', sans-serif;">Tambah Peminjaman</h1>
@endsection

@section('description')
    <p class="text-gray-400 mt-2" style="font-family: 'Helvetica', 'Arial', sans-serif;">Anda dapat menambahkan data peminjaman di sini</p>
@endsection

@section('content')
    <div id="alert" class="hidden fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg">
        <div class="flex items-center justify-between">
            <span id="alertMessage"></span>
            <button onclick="closeAlert()" class="ml-4 text-white hover:text-gray-200 focus:outline-none">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>

    <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
        <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="nisn">
                        NISN
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="nisn" type="text" placeholder="22001" onblur="getSiswaData()">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="tanggal_pinjam">
                        Tanggal Pinjam
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="tanggal_pinjam" type="date" readonly>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="nama">
                        Nama
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="nama" type="text" placeholder="Rizal" readonly>
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="tanggal_kembali">
                        Tanggal Kembali
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="tanggal_kembali" type="date">
                </div>
                <div>
                    <label class="block text-gray-300 text-sm font-semibold mb-2" for="kode_kelas">
                        Kode Kelas
                    </label>
                    <input
                        class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-200"
                        id="kode_kelas" type="text" placeholder="X-AK" readonly>
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
                            <th class="py-2 px-4 bg-gray-700 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="buku_tbody">
                        <tr>
                            <td class="py-2 px-4">1</td>
                            <td class="py-2 px-4"><input type="text" class="kode_buku w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-1 px-2" placeholder="B-001" onblur="getBukuData(this)"></td>
                            <td class="py-2 px-4"><input type="text" class="judul_buku w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-1 px-2" placeholder="Judul Buku" readonly></td>
                            <td class="py-2 px-4"><input type="text" class="penerbit w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-1 px-2" placeholder="Penerbit" readonly></td>
                            <td class="py-2 px-4"><input type="text" class="tahun_terbit w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-1 px-2" placeholder="2024" readonly></td>
                            <td class="py-2 px-4"><input type="number" class="jumlah_buku w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-1 px-2" placeholder="1"></td>
                            <td class="py-2 px-4">
                                <button type="button" onclick="addNewRow()" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded-md">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="flex items-center gap-4 mt-8">
                <button
                    type="button"
                    class="bg-teal-500 hover:bg-teal-600 text-white font-semibold py-2 px-4 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 focus:ring-offset-gray-800"
                    onclick="simpanPeminjaman()">
                    Simpan
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
        function showAlert(message) {
            const alert = document.getElementById('alert');
            const alertMessage = document.getElementById('alertMessage');
            alertMessage.textContent = message;
            alert.classList.remove('hidden');
            setTimeout(() => {
                closeAlert();
            }, 5000);
        }

        function closeAlert() {
            const alert = document.getElementById('alert');
            alert.classList.add('hidden');
        }

        function getSiswaData() {
            const nisn = document.getElementById('nisn').value;
            axios.get(`{{ route('siswa.getByNisn', '') }}/${nisn}`)
                .then(function (response) {
                    const data = response.data;
                    document.getElementById('nama').value = data.nama;
                    document.getElementById('kode_kelas').value = data.kode_kelas;
                })
                .catch(function (error) {
                    console.error('Error:', error);
                    showAlert('Siswa tidak ditemukan');
                });
        }

        function getBukuData(input) {
            const kodeBuku = input.value;
            const row = input.closest('tr');
            axios.get(`{{ route('buku.getByKode', '') }}/${kodeBuku}`)
                .then(function (response) {
                    const data = response.data;
                    row.querySelector('.judul_buku').value = data.judul;
                    row.querySelector('.penerbit').value = data.penerbit;
                    row.querySelector('.tahun_terbit').value = data.tahun_terbit;
                })
                .catch(function (error) {
                    console.error('Error:', error);
                    showAlert('Buku tidak ditemukan');
                });
        }

        function setTanggalPinjam() {
            const today = new Date();
            const year = today.getFullYear();
            const month = String(today.getMonth() + 1).padStart(2, '0');
            const day = String(today.getDate()).padStart(2, '0');
            const formattedDate = `${year}-${month}-${day}`;
            document.getElementById('tanggal_pinjam').value = formattedDate;
        }

        function setTanggalKembali() {
            const today = new Date();
            const returnDate = new Date(today.setDate(today.getDate() + 7));
            const formattedDate = returnDate.toISOString().split('T')[0];
            document.getElementById('tanggal_kembali').value = formattedDate;
        }

        document.addEventListener('DOMContentLoaded', function() {
            setTanggalPinjam();
            setTanggalKembali();
        });

        function Hapus() {
            document.getElementById('nisn').value = '';
            document.getElementById('nama').value = '';
            document.getElementById('kode_kelas').value = '';
            setTanggalPinjam();
            document.getElementById('tanggal_kembali').value = '';
            const inputs = document.querySelectorAll('#buku_table input');
            inputs.forEach(input => input.value = '');
        }

        function addNewRow() {
            const tbody = document.getElementById('buku_tbody');
            const newRow = tbody.insertRow();
            const rowCount = tbody.rows.length;

            newRow.innerHTML = `
                <td class="py-2 px-4">${rowCount}</td>
                <td class="py-2 px-4"><input type="text" class="kode_buku w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-1 px-2" placeholder="B-001" onblur="getBukuData(this)"></td>
                <td class="py-2 px-4"><input type="text" class="judul_buku w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-1 px-2" placeholder="Judul Buku" readonly></td>
                <td class="py-2 px-4"><input type="text" class="penerbit w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-1 px-2" placeholder="Penerbit" readonly></td>
                <td class="py-2 px-4"><input type="text" class="tahun_terbit w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-1 px-2" placeholder="2024" readonly></td>
                <td class="py-2 px-4"><input type="number" class="jumlah_buku w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-md py-1 px-2" placeholder="1"></td>
                <td class="py-2 px-4 flex items-center">
                    <button type="button" onclick="addNewRow()" class="bg-green-500 hover:bg-green-600 text-white px-2 py-1 rounded-md mr-3 items-center">
                        <i class="fas fa-plus"></i>
                    </button>
                    <button type="button" onclick="removeRow(this)" class="bg-red-500 hover:bg-red-600 text-white px-2 py-1 rounded-md">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            `;
        }

        function removeRow(button) {
            const row = button.closest('tr');
            row.remove();
            updateRowNumbers();
        }

        function updateRowNumbers() {
            const tbody = document.getElementById('buku_tbody');
            const rows = tbody.rows;
            for (let i = 0; i < rows.length; i++) {
                rows[i].cells[0].textContent = i + 1;
            }
        }

        function simpanPeminjaman() {
            const nisn = document.getElementById('nisn').value;
            const tanggalPinjam = document.getElementById('tanggal_pinjam').value;

            const bukuList = [];
            const bukuRows = document.querySelectorAll('#buku_tbody tr');
            bukuRows.forEach(row => {
                const kodeBuku = row.querySelector('.kode_buku').value;
                const jumlahBuku = row.querySelector('.jumlah_buku').value;
                if (kodeBuku && jumlahBuku) {
                    bukuList.push({ kode_buku: kodeBuku, jumlah: jumlahBuku });
                }
            });

            const data = {
                nisn: nisn,
                tanggal_pinjam: tanggalPinjam,
                buku_list: bukuList
            };

            axios.post('{{ route("pages.peminjaman.store") }}', data)
                .then(function (response) {
                    showAlert('Peminjaman berhasil disimpan', 'success');
                    window.location.href = '{{ route("pages.peminjaman.index") }}';
                })
                .catch(function (error) {
                    console.error('Error:', error);
                    if (error.response) {
                        showAlert('Gagal menyimpan peminjaman: ' + error.response.data.message, 'error');
                    } else if (error.request) {
                        showAlert('Gagal menyimpan peminjaman: Tidak ada respon dari server', 'error');
                    } else {
                        showAlert('Gagal menyimpan peminjaman: ' + error.message, 'error');
                    }
                });
        }
    </script>
@endsection