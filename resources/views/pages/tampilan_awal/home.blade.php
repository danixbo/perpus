@extends('layout/layout-home')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .smooth-scroll {
            scroll-behavior: smooth;
        }

        .text-gradient {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            background-image: linear-gradient(45deg, #4fd1c5, #4299e1);
        }

        .hover-lift {
            transition: transform 0.3s ease;
        }

        .hover-lift:hover {
            transform: translateY(-5px);
        }
    </style>
@endsection

@section('title-halaman')
    perpus.id
@endsection

@section('content')
    <main class="mt-16 container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center" data-aos="zoom-in" data-aos-duration="1000">
            <h1 class="text-5xl font-bold text-gray-100 leading-tight mb-6">
                Jelajahi <span class="italic text-gradient">dunia pengetahuan</span><br>
                dengan perpustakaan kami
            </h1>
            <p class="text-gray-300 mb-10 text-base leading-relaxed" data-aos="fade-up" data-aos-delay="200">
                Akses ribuan buku dan sumber daya dengan mudah. Tingkatkan wawasan <br>
                dan produktivitas Anda melalui platform digital kami yang inovatif!
            </p>
            <a href="#mulai-membaca" class="bg-teal-500 text-white px-8 py-4 rounded-full inline-flex items-center justify-center space-x-3 hover:bg-teal-600 text-lg transition duration-300 ease-in-out transform hover:scale-105 hover-lift"
                data-aos="fade-up" data-aos-delay="400">
                <span>Mulai Membaca</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>

        <div class="mt-32 grid grid-cols-1 md:grid-cols-3 gap-10">
            <div class="bg-white/5 backdrop-blur-md p-8 rounded-2xl shadow-lg border border-white/10 transition-all duration-300 ease-in-out hover:bg-white/10 hover:scale-105 hover:shadow-xl group"
                data-aos="fade-right" data-aos-delay="200">
                <i
                    class="fas fa-book text-5xl text-teal-400 mb-6 transition-transform duration-300 group-hover:scale-110"></i>
                <h3 class="text-2xl font-semibold text-white mb-4">Koleksi Lengkap</h3>
                <p class="text-gray-300">Temukan dunia baru dalam setiap halaman. Ribuan buku menanti petualangan Anda!</p>
            </div>
            <div class="bg-white/5 backdrop-blur-md p-8 rounded-2xl shadow-lg border border-white/10 transition-all duration-300 ease-in-out hover:bg-white/10 hover:scale-105 hover:shadow-xl group"
                data-aos="fade-up" data-aos-delay="400">
                <i
                    class="fas fa-mobile-alt text-5xl text-teal-400 mb-6 transition-transform duration-300 group-hover:scale-110"></i>
                <h3 class="text-2xl font-semibold text-white mb-4">Akses Mudah</h3>
                <p class="text-gray-300">Baca di mana saja, kapan saja. Perpustakaan dalam genggaman, siap menginspirasi!
                </p>
            </div>
            <div class="bg-white/5 backdrop-blur-md p-8 rounded-2xl shadow-lg border border-white/10 transition-all duration-300 ease-in-out hover:bg-white/10 hover:scale-105 hover:shadow-xl group"
                data-aos="fade-left" data-aos-delay="600">
                <i
                    class="fas fa-users text-5xl text-teal-400 mb-6 transition-transform duration-300 group-hover:scale-110"></i>
                <h3 class="text-2xl font-semibold text-white mb-4">Komunitas Pembaca</h3>
                <p class="text-gray-300">Bergabung, diskusi, dan tumbuh bersama. Biarkan buku menyatukan kita!</p>
            </div>
        </div>

        <div class="mt-40">
            <h1 id="mulai-membaca" class="text-4xl font-bold mb-40 text-center text-gradient" data-aos="fade-up" data-aos-duration="1000">
                Mulai petualangan membaca Anda hari ini
            </h1>

            <h2 class="text-3xl font-bold text-gray-100 mb-8" data-aos="fade-up" data-aos-delay="200">Buku Terbaru</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($books as $index => $book)
                    <a href="{{ route('halaman_buku', ['kode_buku' => $book->kode_buku]) }}"
                        class="cursor-pointer bg-white/5 backdrop-blur-md p-6 rounded-2xl shadow-lg border border-white/10 transition-all duration-300 ease-in-out hover:bg-white/10 hover:scale-105 hover:shadow-xl group hover-lift"
                        data-aos="fade-up" data-aos-delay="{{ 150 + $index * 50 }}">
                        @if($book->foto)
                            <img src="{{ asset($book->foto) }}" alt="{{ $book->judul }}"
                                class="w-full h-64 object-cover rounded-xl mb-6 transition-transform duration-300 group-hover:scale-105">
                        @else
                            <img src="{{ asset('images/default-book.jpg') }}" alt="{{ $book->judul }}"
                                class="w-full h-64 object-cover rounded-xl mb-6 transition-transform duration-300 group-hover:scale-105">
                        @endif
                        <p class="text-sm text-teal-400 mb-2 transition-colors duration-300 group-hover:text-teal-300">
                            {{ $book->penerbit }}</p>
                        <h3
                            class="text-xl font-semibold text-white mb-2 transition-colors duration-300 group-hover:text-teal-100">
                            {{ $book->judul }}</h3>
                        <p class="text-sm text-gray-300 transition-colors duration-300 group-hover:text-gray-200">
                            {{ $book->tahun_terbit }}</p>
                    </a>
                @endforeach
            </div>

            <div class="mt-16 flex justify-center" data-aos="fade-up" data-aos-delay="200">
                <nav class="inline-flex rounded-md shadow-sm" aria-label="Pagination">
                    @if ($books->onFirstPage())
                        <span
                            class="px-3 py-2 rounded-l-md border border-gray-700 bg-gray-800 text-gray-500 cursor-not-allowed flex items-center">
                            <i class="fas fa-chevron-left mr-2"></i> Previous
                        </span>
                    @else
                        <a href="{{ $books->previousPageUrl() }}"
                            class="px-3 py-2 rounded-l-md border border-gray-700 bg-gray-800 text-teal-400 hover:bg-gray-700 transition duration-150 ease-in-out flex items-center hover-lift">
                            <i class="fas fa-chevron-left mr-2"></i> Previous
                        </a>
                    @endif

                    @for ($i = 1; $i <= $books->lastPage(); $i++)
                        @if ($i == $books->currentPage())
                            <span class="px-3 py-2 border border-gray-700 bg-teal-500 text-white">{{ $i }}</span>
                        @else
                            <a href="{{ $books->url($i) }}"
                                class="px-3 py-2 border border-gray-700 bg-gray-800 text-gray-300 hover:bg-gray-700 hover:text-teal-400 transition duration-150 ease-in-out hover-lift">{{ $i }}</a>
                        @endif
                    @endfor

                    @if ($books->hasMorePages())
                        <a href="{{ $books->nextPageUrl() }}"
                            class="px-3 py-2 rounded-r-md border border-gray-700 bg-gray-800 text-teal-400 hover:bg-gray-700 transition duration-150 ease-in-out flex items-center hover-lift">
                            Next <i class="fas fa-chevron-right ml-2"></i>
                        </a>
                    @else
                        <span
                            class="px-3 py-2 rounded-r-md border border-gray-700 bg-gray-800 text-gray-500 cursor-not-allowed flex items-center">
                            Next <i class="fas fa-chevron-right ml-2"></i>
                        </span>
                    @endif
                </nav>
            </div>
    </main>
@endsection

@section('custom-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            mirror: true,
        });

        document.documentElement.classList.add('smooth-scroll');
    </script>
@endsection
