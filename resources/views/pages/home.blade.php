@extends('app')

@section('title', 'Beranda - Bebras Indonesia')

@section('content')
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <!-- Carousel -->
        <div id="default-carousel" class="relative" data-carousel="static">
            <div class="overflow-hidden relative h-56 rounded-lg sm:h-64 xl:h-80 m-2">
                <!-- Item 1 -->
                <div class="carousel-item duration-700 ease-in-out absolute inset-0 transition-all transform opacity-1 z-10"
                    data-carousel-item>
                    <img src="{{ asset('/img/banner1.jpg ') }}"
                        class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2 h-full"
                        alt="Bebras Challenge">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                        <div class="text-center text-white px-4">
                            <h2 class="text-2xl md:text-3xl font-bold mb-2">Bebras Challenge {{ date('Y') }} </h2>
                            <p class="max-w-2xl">Ajang tahunan untuk mengasah kemampuan computational thinking siswa</p>
                        </div>
                    </div>
                </div>
                <!-- Item 2 -->
                <div class="carousel-item duration-700 ease-in-out absolute inset-0 transition-all transform opacity-0"
                    data-carousel-item>
                    <img src="{{ asset('/img/banner2.jpg ') }}"
                        class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2 h-full"
                        alt="Workshop Bebras">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                        <div class="text-center text-white px-4">
                            <h2 class="text-2xl md:text-3xl font-bold mb-2">Workshop Guru</h2>
                            <p class="max-w-2xl">Meningkatkan kapasitas guru dalam pembelajaran computational thinking</p>
                        </div>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="carousel-item duration-700 ease-in-out absolute inset-0 transition-all transform opacity-0"
                    data-carousel-item>
                    <img src="{{ asset('/img/banner3.jpg') }}"
                        class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2 h-full"
                        alt="Kompetisi Bebras">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                        <div class="text-center text-white px-4">
                            <h2 class="text-2xl md:text-3xl font-bold mb-2">Kompetisi Nasional</h2>
                            <p class="max-w-2xl">Tunjukkan kemampuan problem solving terbaik dan raih penghargaan</p>
                        </div>
                    </div>
                </div>
                <!-- Item 4 -->
                <div class="carousel-item duration-700 ease-in-out absolute inset-0 transition-all transform opacity-0"
                    data-carousel-item>
                    <img src="{{ asset('/img/banner4.jpg') }}"
                        class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2 h-full"
                        alt="Tujuan Bebras">
                    <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                        <div class="text-center text-white px-4">
                            <h2 class="text-2xl md:text-3xl font-bold mb-2">Tujuan Bebras</h2>
                            <p class="max-w-2xl">Mempromosikan informatika dan berpikir komputasi kepada para guru</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Slider indicators -->
            <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
                <button type="button" class="w-3 h-3 rounded-full bg-white" aria-label="Slide 1"
                    data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50" aria-label="Slide 2"
                    data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50" aria-label="Slide 3"
                    data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-full bg-white/50" aria-label="Slide 4"
                    data-carousel-slide-to="3"></button>
            </div>

            <!-- Slider controls -->
            <button type="button"
                class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                data-carousel-prev>
                <span
                    class="inline-flex justify-center items-center w-8 h-8 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                    <i class="fas fa-chevron-left text-white"></i>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button"
                class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none"
                data-carousel-next>
                <span
                    class="inline-flex justify-center items-center w-8 h-8 rounded-full bg-white/30 group-hover:bg-white/50 group-focus:ring-4 group-focus:ring-white">
                    <i class="fas fa-chevron-right text-white"></i>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>

    </div>

    <section class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 md:p-8">
                    <div class="flex flex-row justify-between">
                        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 flex items-center">
                            <div class="h-1 w-24 bg-bebrasBlue mr-3"></div>
                            Tentang Bebras
                        </h2>
                        <div class=" items-start mid:w-1/5 ms-5">
                            <img src="{{ asset('/img/logo.jpg') }}" alt="" class="w-20 h-20">
                        </div>
                    </div>


                    <div class="flex flex-col md:flex-row">

                        <div class="w-full md:w-4/5 pr-0 md:pr-8">
                            <p class="text-gray-600 mb-4 text-justify">
                                Bebras pertama kali digelar di Lithuania (www.bebras.org), merupakan aktivitas ekstra
                                kurikuler yang
                                mengedukasi kemampuan problem solving dalam informatika dengan jumlah peserta terbanyak di
                                dunia. Siswa
                                peserta akan mengikuti kompetisi bebras di bawah supervisi guru, yang dapat mengintegrasikan
                                tantangan
                                tersebut dalam aktivitas mengajar guru. Kompetisi ini dilakukan setiap tahun secara online
                                melalui komputer.
                            </p>
                            <p class="text-gray-600 mb-6 text-justify">
                                Yang dilombakan dalam kompetisi adalah sekumpulan soal yang disebut Bebras task. Bebras task
                                disajikan dalam
                                bentuk uraian persoalan yang dilengkapi dengan gambar yang menarik, sehingga siswa dapat
                                lebih mudah
                                memahami soal. Soal-soal tersebut dapat dijawab tanpa perlu belajar informatika terlebih
                                dahulu, tapi soal
                                tersebut sebetulnya terkait pada konsep tertentu dalam informatika dan computational
                                thinking. Bebras task
                                sekaligus menunjukkan aspek informatika dan computational thinking.
                            </p>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-bebrasLightBlue/40 rounded-2xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-800 mb-14">
                Event Bebras Indonesia
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 place-items-center">

                @foreach ($berita as $item)
                    <div
                        class="bg-white w-full max-w-xs p-6 rounded-2xl shadow-sm border border-gray-100
                           transition-all duration-300 hover:shadow-xl hover:-translate-y-1
                           flex flex-col min-h-[430px]">

                        @if ($item->gambar)
                            <div class="h-44 w-full mb-4">
                                <img src="{{ $item->gambar }}" class="rounded-xl h-full w-full object-cover shadow-sm">
                            </div>
                        @endif

                        <h3 class="text-lg font-bold text-gray-900 mb-2 leading-tight min-h-[48px]">
                            {{ Str::limit($item->title, 55) }}
                        </h3>

                        <p class="text-gray-600 text-sm leading-relaxed min-h-[60px]">
                            {{ Str::limit(strip_tags($item->konten), 95) }}
                        </p>

                        <div class="mt-auto">

                            <div class="flex items-center justify-between mt-3">
                                <span class="text-xs text-gray-400">
                                    {{ date('d M Y', strtotime($item->created_at)) }}
                                </span>

                                <a href="{{ route('berita.detail', $item->slug) }}"
                                    class="text-bebrasBlue font-semibold text-sm hover:underline">
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <div class="flex flex-col md:flex-row items-center p-6 mt-4 rounded-md">

        <div class="w-full md:w-4/4 text-center md:text-left md:pl-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Bebras Indonesia Challenge {{ date('Y') }} </h1>
            <p class="mt-2 text-lg text-gray-600">Bebras Indonesia Challenge 2025 akan digelar pada 10-15 November 2025.
                Daftarkan diri Anda segera.</p>
            <div class="mt-4 flex flex-wrap justify-center md:justify-start gap-3">
                {{-- <a href="#"
                    class="btn-primary text-white px-5 py-2 rounded-full text-sm font-semibold inline-flex items-center">
                    <span>Daftar Sekarang</span>
                    <i class="fas fa-arrow-right ml-2 text-xs"></i>
                </a> --}}
                <a href="#"
                    class="border border-bebrasBlue text-bebrasBlue px-5 py-2 rounded-full text-sm font-semibold inline-flex items-center hover:text-[#F97A00] hover:border-[#F97A00] active:scale-95 active:text-[#F97A00] active:border-[#F97A00]"">
                    <span>Info Lengkap</span>
                    <i class="fas fa-info-circle ml-2 text-xs"></i>
                </a>
            </div>
        </div>
    </div>
    @push('scripts')
        @vite('resources/js/script.js')
    @endpush

@endsection
