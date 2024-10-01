@extends('layout/layout-home')

@section('custom-link')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('title-halaman')
    perpus.id - {{ $book->judul }}
@endsection

@section('content')
    <main class="mt-4 container mx-auto px-4 text-gray-100">
        <div class="flex flex-col md:flex-row gap-8 py-12">
            <!-- Book Image -->
            <div class="md:w-1/2" data-aos="fade-right">
                <div class="aspect-w-3 aspect-h-4 w-full rounded-2xl overflow-hidden items-center justify-center flex">
                    @if($book->foto)
                        <img src="{{ asset($book->foto) }}" alt="{{ $book->judul }} cover" class="object-cover w-4/5 h-3/5 rounded-md">
                    @else
                        <img src="{{ asset('images/default-book.jpg') }}" alt="{{ $book->judul }} cover" class="object-cover w-4/5 h-3/5 rounded-md">
                    @endif
                </div>
            </div>
            
            <!-- Book Details -->
            <div class="md:w-1/2" data-aos="fade-left">
                <div class="flex justify-between">
                    <div class="flex flex-col">
                        <h1 class="text-3xl font-bold mb-3 text-teal-400">{{ $book->judul }}</h1>
                        <p class="text-gray-400 mb-4 text-lg">Ditulis oleh {{ $book->penerbit }}</p>
                    </div>
                    <div class="flex">
                        <p class="text-xl font-bold mb-6 text-white">{{ $book->tahun_terbit }}</p>
                    </div>
                </div>
                <div class="flex flex-col">
                    <p class="mb-4 text-gray-300 leading-relaxed">{{ $book->deskripsi ?? 'Deskripsi buku tidak tersedia.' }}</p>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('home') }}">
                        <button class="bg-gray-700 hover:bg-gray-600 text-white px-8 py-3 rounded-xl transition duration-300 shadow-lg">Kembali</button>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('custom-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
        });
    </script>
@endsection