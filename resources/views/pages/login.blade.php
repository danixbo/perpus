<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Login</title>
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
        .content-wrapper {
            position: relative;
            z-index: 1;
        }
    </style>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
</head>
<body class="flex items-center justify-center min-h-screen p-4">
    <div class="blob-container" id="blobContainer"></div>

    <div class="content-wrapper flex justify-center items-center min-h-screen">
        <div class="bg-gray-800 bg-opacity-80 backdrop-blur-lg py-8 px-5 rounded-lg shadow-xl relative z-10">
            <h2 class="text-2xl font-bold mb-1 text-center text-teal-400" style="font-family: 'Poppins', sans-serif;">Selamat Datang</h2>
            <p class="text-gray-400 text-xs mb-8 text-center" style="font-family: 'Poppins', sans-serif;">Masukkan details anda untuk login</p>

            @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">{{ $errors->first('username') }}</span>
            </div>
            @endif

            @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-teal-400 text-xs font-medium mb-1">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username..." value="{{ old('username') }}" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-xs text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-teal-400 transition-colors focus:border-teal-400 duration-300 focus:placeholder-teal-400 ease-in-out">
                </div>
                <div class="mb-8">
                    <label for="password" class="block text-teal-400 text-xs font-medium mb-1">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-xs text-white placeholder-gray-400 focus:outline-none focus:ring-1 focus:ring-teal-400 transition-colors focus:border-teal-400 duration-300 focus:placeholder-teal-400 ease-in-out">
                </div>
                <button type="submit" class="w-full bg-teal-600 text-white py-2 rounded-lg hover:bg-teal-700 text-sm font-medium transition-colors duration-300 ease-in-out">Login</button>
            </form>
            <p class="text-gray-400 text-xs text-center mt-8" style="font-family: 'Poppins', sans-serif;">Belum punya akun? <a href="{{ route('register') }}" class="text-teal-400 hover:text-teal-500">Daftar</a></p>
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