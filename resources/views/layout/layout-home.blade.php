<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @yield('custom-link')
    <title>@yield('title-halaman')</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
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
</head>

<body class="text-gray-300">
    <div class="blob-container" id="blobContainer"></div>

    <div class="content-wrapper">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex justify-between items-center h-16">
                <a href="#"
                    class="font-semibold text-xl text-teal-400 hover:text-teal-300 transition duration-300">perpus.id</a>
                <div class="flex items-center space-x-6">
                    <a href="{{ route('home') }}"
                        class="nav-link font-medium text-gray-300 hover:text-teal-400 transition duration-300">Home</a>
                    <a href="{{ route('kategori') }}"
                        class="nav-link font-medium text-gray-300 hover:text-teal-400 transition duration-300">Kategori</a>
                    <a href="#footer"
                        class="nav-link font-medium text-gray-300 hover:text-teal-400 transition duration-300">Tentang
                        Kami</a>
                </div>
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="font-medium bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-300 ease-in-out">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="font-medium bg-teal-500 text-white px-4 py-2 rounded-md hover:bg-teal-600 transition duration-300 ease-in-out">Login</a>
                @endauth
            </nav>

            <main class="mt-16">
                <div class="grid grid-cols-1 gap-8 items-center">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <footer id="footer" class="mt-16 text-gray-300 tentang-kami">
        <div class="backdrop-blur-md bg-gray-800/30 rounded-t-3xl" data-aos="fade-up">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div data-aos="fade-right" data-aos-delay="100">
                        <h3 class="text-lg font-semibold text-teal-400 mb-4">perpus.id</h3>
                        <p class="text-sm">Perpustakaan digital untuk semua</p>
                    </div>
                    <div data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-lg font-semibold mb-4">Tautan</h3>
                        <ul class="space-y-2">
                            <li><a href="{{ route('home') }}"
                                    class="text-sm hover:text-teal-400 transition duration-300">Home</a></li>
                            <li><a href="#" class="text-sm hover:text-teal-400 transition duration-300">Kategori</a>
                            </li>
                            <li><a href="#" class="text-sm hover:text-teal-400 transition duration-300">Tentang
                                    Kami</a></li>
                        </ul>
                    </div>
                    <div data-aos="fade-left" data-aos-delay="300">
                        <h3 class="text-lg font-semibold mb-4">Kontak</h3>
                        <p class="text-sm">Email: support@perpus.id</p>
                        <p class="text-sm">Telepon: (+62) 859-4091-9034</p>
                    </div>
                </div>
                <div class="mt-8 pt-8 border-t border-gray-700/50 text-center text-sm" data-aos="fade-up" data-aos-delay="400">
                    <p>&copy; {{ date('Y') }} perpus.id. Dibuat oleh <a href="https://www.instagram.com/danixd_9/" class="text-teal-400 hover:text-teal-300 transition duration-300">DaniXD</a></p>
                </div>
            </div>
        </div>
    </footer>

    @yield('custom-js')
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

        function scrollToFooter() {
            const footerElement = document.getElementById('footer');
            if (footerElement) {
                footerElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }

        if (window.location.hash === '#footer') {
            setTimeout(scrollToFooter, 0);
        }
    </script>
</body>

</html>
