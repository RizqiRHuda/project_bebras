@extends('app')

@section('title', $berita->title)

@section('content')

    <section class="py-10 bg-gray-100">
        <div class="max-w-4xl mx-auto px-4">

            {{-- Breadcrumb --}}
            <nav class="text-sm mb-6 text-gray-500">
                <a href="{{ route('home') }}" class="hover:underline">Home</a> /
                <a href="" class="hover:underline">Berita</a> /
                <span class="text-gray-700">{{ $berita->title }}</span>
            </nav>

            {{-- Judul --}}
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight mb-4">
                {{ $berita->title }}
            </h1>

            {{-- Info --}}
            <div class="flex items-center text-sm text-gray-500 mb-6">
                <span>{{ date('d M Y', strtotime($berita->created_at)) }}</span>
                <span class="mx-2">•</span>
                <span>{{ $berita->nama_biro ?? 'Author' }}</span>
            </div>

            {{-- Gambar Utama --}}
            @if ($berita->gambar)
                <div class="w-full mb-8">
                    <img src="{{ $berita->gambar }}" class="rounded-xl w-full h-80 object-cover shadow-md">
                </div>
            @endif

            {{-- Konten --}}
            <article
                class="prose max-w-none prose-lg prose-headings:text-gray-900 prose-p:text-gray-700 prose-img:rounded-xl">
                {!! $berita->konten !!}
            </article>

            {{-- Divider --}}
            <hr class="my-10 border-gray-300">

            {{-- Navigasi Sebelumnya & Selanjutnya --}}
            <div class="mt-12 pt-6 border-t flex justify-between">

                {{-- Tombol Prev --}}
                @if ($prev)
                    <a href="{{ route('berita.detail', $prev->slug) }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
                        ← Sebelumnya
                    </a>
                @else
                    <span></span>
                @endif

                {{-- Tombol Next --}}
                @if ($next)
                    <a href="{{ route('berita.detail', $next->slug) }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg">
                        Berikutnya →
                    </a>
                @else
                    <span></span>
                @endif

            </div>
        </div>
    </section>

@endsection
