<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Register</title>
    <link rel="icon" href="https://api.iconify.design/noto:blue-book.svg" type="image/svg+xml">
    <style>
        * {
            font-family: 'Inter', sans-serif; 
        }
        body {
            background-color: #121212;
            color: #e0e0e0;
            overflow-x: hidden;
        }
        .blob-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            z-index: -1;
            overflow: hidden;
        }
        .blob {
            position: absolute;
            background-color: #1e293b;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.7;
        }
    </style>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</head>
<body class="">
    <div class="blob-container" id="blobContainer"></div>

    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-gray-800 bg-opacity-80 backdrop-blur-lg py-8 px-12 rounded-lg shadow-xl w-full max-w-xl">
            <h2 class="text-2xl font-bold mb-1 text-center text-teal-400 font-poppins">Daftar Akun</h2>
            <p class="text-gray-400 text-xs mb-6 text-center font-poppins">Masukkan details anda untuk mendaftar</p>
            
            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="grid grid-cols-2 gap-4">
                @csrf
                <div class="mb-4">
                    <label for="nisn" class="block text-teal-400 text-xs font-medium mb-1">NISN</label>
                    <input type="text" id="nisn" name="nisn" placeholder="Masukkan NISN..." value="{{ old('nisn') }}"
                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-xs text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-teal-400 transition-colors focus:border-teal-400 duration-300 focus:placeholder-teal-400 ease-in-out">
                </div>
                <div class="mb-4">
                    <label for="nama" class="block text-teal-400 text-xs font-medium mb-1">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap..." value="{{ old('nama') }}"
                           class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-xs text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-teal-400 transition-colors focus:border-teal-400 duration-300 focus:placeholder-teal-400 ease-in-out">
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block text-teal-400 text-xs font-medium mb-1">Alamat</label>
                    <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat..." value="{{ old('alamat') }}"
                           class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-xs text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-teal-400 transition-colors focus:border-teal-400 duration-300 focus:placeholder-teal-400 ease-in-out">
                </div>
                <div class="mb-4">
                    <label for="no_telp" class="block text-teal-400 text-xs font-medium mb-1">No. Telepon</label>
                    <input type="text" id="no_telp" name="no_telp" placeholder="Masukkan nomor telepon..." value="{{ old('no_telp') }}"
                           class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-xs text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-teal-400 transition-colors focus:border-teal-400 duration-300 focus:placeholder-teal-400 ease-in-out">
                </div>
                <div class="mb-4">
                    <label for="kode_kelas" class="block text-teal-400 text-xs font-medium mb-1">Kode Kelas</label>
                    <select id="kode_kelas" name="kode_kelas" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-xs text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-teal-400 transition-colors focus:border-teal-400 duration-300 focus:placeholder-teal-400 ease-in-out">
                        <option value="" disabled selected>Pilih Kelas</option>
                        @foreach($kelas as $k)
                            <option value="{{ $k->kode_kelas }}" {{ old('kode_kelas') == $k->kode_kelas ? 'selected' : '' }}>
                                {{ $k->tingkat }} {{ $k->jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-teal-400 text-xs font-medium mb-1">Username</label>
                    <input type="text" id="username" name="username" placeholder="Masukkan username..." value="{{ old('username') }}"
                           class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-xs text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-teal-400 transition-colors focus:border-teal-400 duration-300 focus:placeholder-teal-400 ease-in-out">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-teal-400 text-xs font-medium mb-1">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••"
                           class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-xs text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-teal-400 transition-colors focus:border-teal-400 duration-300 focus:placeholder-teal-400 ease-in-out">
                </div>
                <button type="submit" class="col-span-2 bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700 text-sm font-medium transition-colors duration-300 ease-in-out">Daftar</button>
            </form>
            <p class="text-gray-400 text-xs text-center mt-4 font-poppins">Sudah punya akun? <a href="{{ route('login') }}" class="text-teal-400 hover:text-teal-500">Login</a></p>
        </div>
    </div>

    <script>
        function createBlob() {
            const blob = document.createElement('div');
            blob.classList.add('blob');
            
            const size = Math.random() * 150 + 50;
            blob.style.width = `${size}px`;
            blob.style.height = `${size}px`;
            
            const startX = Math.random() * window.innerWidth;
            const startY = Math.random() * window.innerHeight;
            blob.style.left = `${startX}px`;
            blob.style.top = `${startY}px`;
            
            return blob;
        }

        function moveBlob(blob) {
            const newX = Math.random() * window.innerWidth;
            const newY = Math.random() * window.innerHeight;
            const duration = Math.random() * 10 + 5;

            blob.style.transition = `all ${duration}s ease-in-out`;
            blob.style.left = `${newX}px`;
            blob.style.top = `${newY}px`;

            setTimeout(() => moveBlob(blob), duration * 1000);
        }

        const blobContainer = document.getElementById('blobContainer');
        const blobCount = 5;

        for (let i = 0; i < blobCount; i++) {
            const blob = createBlob();
            blobContainer.appendChild(blob);
            moveBlob(blob);
        }
    </script>
</body>
</html>