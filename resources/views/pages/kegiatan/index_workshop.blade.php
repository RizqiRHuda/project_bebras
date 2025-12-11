@extends('app')

@section('title', $tahun ? 'Workshop ' . $tahun->tahun : 'Daftar Workshop')
@section('content')
    <div class="max-w-7xl mx-auto px-4 py-10">
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-10">

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b pb-6 mb-8">
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-4 md:mb-0">
                    {{ $tahun ? 'Workshop ' . $tahun->tahun : 'Daftar Workshop' }}
                </h1>
                <img src="{{ asset('img/done.png') }}" alt="Workshop Bebras" class="w-16 h-16 mx-auto md:mx-0">
            </div>

            <!-- Deskripsi -->
            @if ($tahun)
                <div class="mb-6 text-gray-700">
                    <h4 class="text-lg md:text-xl font-semibold mb-3">
                        Kegiatan Workshop Bebras {{ $tahun->tahun }} adalah sebagai berikut:
                    </h4>
                </div>
            @else
                <p class="text-gray-700">Silakan pilih tahun workshop pada menu.</p>
            @endif

            <!-- Grid Kegiatan -->
            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">

                @forelse($workshops as $item)
                    <div
                        class="group bg-gray-50 rounded-xl shadow hover:shadow-2xl transition duration-300 overflow-hidden">

                        <!-- Gambar -->
                        <div class="overflow-hidden">
                            <img src="{{ $item->gambar }}" alt="Workshop Bebras"
                                class="w-full h-48 object-cover transform group-hover:scale-105 transition duration-500">

                        </div>

                        <div class="p-5">

                            <!-- Lokasi -->
                            <span class="text-xs font-medium text-blue-600 bg-blue-100 px-2 py-1 rounded-full">
                                {{ $item->lokasi }}
                            </span>

                            <!-- Judul -->
                            <h5 class="mt-3 text-lg font-bold text-gray-800 line-clamp-2">
                                {{ $item->title }}
                            </h5>

                            <!-- Konten HTML -->
                            @if (!empty($item->konten['html']))
                                <div class="text-gray-600 text-sm mt-2 leading-relaxed">
                                    {!! $item->konten['html'] !!}
                                </div>
                            @else
                                <p class="text-gray-500 text-sm mt-2">Tidak ada konten</p>
                            @endif


                            <!-- Tanggal -->
                            <p class="text-gray-600 text-sm mt-2 leading-relaxed">
                                {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d F Y') }}
                            </p>

                        </div>

                    </div>
                @empty

                    @if ($tahun)
                        <p class="text-gray-500">Belum ada data workshop untuk tahun ini.</p>
                    @endif
                @endforelse

            </div>
        </div>
    </div>
@endsection
