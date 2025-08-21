<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Bebras Indonesia')</title>

    {{-- Font Awesome & Tailwind --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css'])

</head>

<body class="bg-gray-50">

    {{-- Navbar --}}
    @include('components.navbar')

    {{-- Main Content --}}
    <main class="mt-16">
        <!-- Hero Section with Carousel -->
        <section class="relative">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col md:flex-row items-center p-4 md:gap-x-0">
                    <div class="flex justify-center md:justify-start mb-6 md:mb-0   ">
                        <img src="{{ asset('img/logo.jpg') }}" alt="Logo Bebras Indonesia"
                            class="w-20 h-20 md:w-30 md:h-30 rounded-md object-cover">
                    </div>
                    <div class="w-full md:w-3/4 text-center md:text-left ms-2">
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-800">Bebras Indonesia</h1>
                        <p class="mt-2 text-lg text-gray-600">Mengembangkan Kemampuan Computational Thinking Siswa
                            Indonesia</p>
                    </div>
                </div>
                @yield('content')
            </div>
        </section>
    </main>

    {{-- Footer --}}
    @include('components.footer')
    @stack('scripts')

</body>

</html>
