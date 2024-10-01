@extends('layout/layout-home')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    perpus.id
@endsection

@section('content')
    <main class="mt-16 container mx-auto px-4 text-white">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="md:col-span-1">
                <div class="p-6 bg-gray-800 rounded-lg">
                    <h2 class="text-xl font-bold mb-6 text-teal-400">Filter</h2>
                    <div class="mb-4">
                        <h3 class="font-medium mb-4 text-white">Kategori</h3>
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                class="w-full bg-gray-700 text-left px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-300 ease-in-out">
                                <span class="text-white">Pilih Kategori</span>
                                <svg class="h-5 w-5 text-gray-400 float-right transition-transform duration-300"
                                    :class="{ 'transform rotate-180': open }" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 transform translate-y-0"
                                x-transition:leave-end="opacity-0 transform -translate-y-2" @click.away="open = false"
                                class="absolute z-10 w-full mt-2 rounded-md bg-gray-700 shadow-lg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="md:col-span-3">
                <div class="mb-8 flex justify-end">
                    <form action="{{ route('kategori') }}" method="GET" class="relative w-64">
                        <input type="text" name="search" id="searchInput" placeholder="Search..." value="{{ request('search') }}"
                            class="w-full bg-gray-700 text-white rounded-md pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-teal-500 transition duration-300 ease-in-out">
                        <button type="submit"
                            class="absolute left-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-teal-400 transition-colors duration-300 ease-in-out">
                            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($books as $index => $book)
                    <div class="cursor-pointer bg-white/5 backdrop-blur-md p-6 rounded-2xl shadow-lg border border-white/10 transition-all duration-300 ease-in-out hover:bg-white/10 hover:scale-105 hover:shadow-xl group"
                        data-aos="fade-up" data-aos-delay="{{ 150 + $index * 50 }}">
                        <img src="https://picsum.photos/300/400?random={{ $index }}" alt="{{ $book->judul }}"
                            class="w-full h-64 object-cover rounded-xl mb-6 transition-transform duration-300 group-hover:scale-105">
                        <p class="text-sm text-teal-400 mb-2 transition-colors duration-300 group-hover:text-teal-300">{{ $book->penerbit }}</p>
                        <h3 class="text-xl font-semibold text-white mb-2 transition-colors duration-300 group-hover:text-teal-100">{{ $book->judul }}</h3>
                        <p class="text-sm text-gray-300 transition-colors duration-300 group-hover:text-gray-200">{{ $book->tahun_terbit }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection

@section('custom-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>
@endsection