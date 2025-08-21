<nav class="fixed top-0 left-0 w-full z-50 bg-bebrasBlue shadow-md rounded-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            {{-- Logo --}}
            <div class="flex-shrink-0 flex items-center">
                <img src="{{ asset('img/bebras.png') }}" alt="Logo Bebras" class="h-10">
                {{-- <span class="ml-2 text-white font-semibold text-xl hidden sm:block">Bebras Indonesia</span> --}}
            </div>

            {{-- Desktop Menu --}}
            <div class="hidden md:block">
                <div class="ml-10 flex items-baseline space-x-6">
                    <a href="{{ route('home') }}"
                        class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('home') ? 'active' : '' }}">
                        Home
                    </a>

                    <div class="relative inline-block dropdown">
                        <!-- Parent -->
                        <button
                            class="dropdown-btn nav-link text-white px-3 py-2 rounded-md text-sm font-medium flex items-center cursor-pointer hover:bg-bebrasDarkBlue transition">
                            Tentang Bebras
                            <svg class="w-4 h-4 ml-1 transform transition duration-200" fill="none"
                                stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div
                            class="dropdown-menu absolute left-0 hidden bg-white text-black mt-2 rounded-md shadow-lg w-48 z-50">
                            <ul class="py-2 text-sm">
                                <li>
                                    <a href="{{ route('tentangBebras.dd_1') }}"
                                        class="nav-link block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_1') ? 'active' : '' }}">
                                        Apa itu Berpikir Komputasional?
                                    </a>
                                </li>
                                <li><a href="{{ route('tentangBebras.dd_2') }}"
                                        class="nav-link block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_2') ? 'active' : '' }}">Apa
                                        itu Bebras?</a></li>
                                <li><a href="{{ route('tentangBebras.dd_3') }}"
                                        class="nav-link block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_3') ? 'active' : '' }}">Tujuan
                                        Kami</a></li>
                                <li><a href="{{ route('tentangBebras.dd_4') }}"
                                        class="nav-link block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_4') ? 'active' : '' }}">Ruang
                                        Lingkup</a></li>
                                <li><a href="{{ route('tentangBebras.dd_5') }}"
                                        class="nav-link block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_5') ? 'active' : '' }}">Kegiatan
                                        Bebras</a></li>
                                 <li><a href="{{ route('tentangBebras.dd_6') }}"
                                        class="nav-link block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_6') ? 'active' : '' }}">Sejarah
                                        Bebras Indonesia</a></li>
                            </ul>
                        </div>
                    </div>
                    <a href="#" class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Soal</a>
                    <a href="#" class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Kegiatan</a>
                    <a href="#" class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Latihan</a>
                    <a href="#" class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Kontak</a>
                </div>
            </div>

            {{-- Search + Mobile --}}
            <div class="flex items-center">
                <div class="hidden md:block relative mr-4">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text"
                        class="block w-48 pl-10 pr-3 py-2 border border-transparent rounded-md leading-5 bg-white text-white placeholder-gray-200 focus:outline-none focus:bg-white focus:text-gray-900 focus:ring-0"
                        placeholder="Cari...">
                </div>

                <div class="md:hidden">
                    <button type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-bebrasDarkBlue focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        id="mobile-menu-button">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div class="md:hidden hidden bg-bebrasDarkBlue shadow-lg" id="mobile-menu">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('home') }}" class="text-white block px-3 py-2 rounded-md text-base font-medium">Home</a>
            <div class="relative inline-block dropdown group">
                <!-- Parent -->
                <button
                    class="dropdown-btn nav-link text-white px-3 py-2 rounded-md text-sm font-medium flex items-center cursor-pointer hover:bg-bebrasDarkBlue transition">
                    Tentang Bebras
                    <svg class="w-4 h-4 ml-1 transform transition duration-200 group-hover:rotate-180" fill="none"
                        stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown -->
                <div
                    class="dropdown-menu absolute left-0 hidden group-hover:block bg-white text-black mt-2 rounded-md shadow-lg w-48 z-50">
                    <ul class="py-2 text-sm">
                        <li>
                            <a href="{{ route('tentangBebras.dd_1') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_1') ? 'active' : '' }}">
                                Apa itu Berpikir Komputasional?
                            </a>
                        </li>
                        <li><a href="{{ route('tentangBebras.dd_2') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_2') ? 'active' : '' }}">Apa
                                itu Bebras?</a></li>
                        <li><a href="{{ route('tentangBebras.dd_3') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_3') ? 'active' : '' }}">Tujuan
                                Kami</a></li>
                        <li><a href="{{ route('tentangBebras.dd_4') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_4') ? 'active' : '' }}">Ruang
                                Lingkup</a></li>
                        <li><a href="{{ route('tentangBebras.dd_5') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_5') ? 'active' : '' }}">Kegiatan
                                Bebras</a></li>
                        <li><a href="{{ route('tentangBebras.dd_6') }}"
                                class="block px-4 py-2 text-gray-800 hover:bg-gray-100 {{ request()->routeIs('tentangBebras.dd_6') ? 'active' : '' }}">Sejarah
                                Bebras Indonesia</a></li>
                        </li>
                    </ul>
                </div>
            </div>

            <a href="#" class="text-white block px-3 py-2 rounded-md text-base font-medium">Soal</a>
            <a href="#" class="text-white block px-3 py-2 rounded-md text-base font-medium">Kegiatan</a>
            <a href="#" class="nav-link text-white px-3 py-2 rounded-md text-sm font-medium">Latihan</a>
            <a href="#" class="text-white block px-3 py-2 rounded-md text-base font-medium">Kontak</a>

            <div class="relative mt-4 px-3">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400 ms-2"></i>
                </div>
                <input type="text"
                    class="block w-full pl-10 pr-3 py-2 border border-transparent rounded-md leading-5 bg-white text-white placeholder-gray-200 focus:outline-none focus:bg-white focus:text-gray-900 focus:ring-0"
                    placeholder="Cari...">
            </div>
        </div>
    </div>

</nav>
