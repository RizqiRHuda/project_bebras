@extends('app')

@section('title', 'Detail Hasil Pengumuman')

@section('content')
<div class="max-w-7xl mx-auto px-3 sm:px-4 py-6 sm:py-10">
    <div class="bg-white rounded-xl sm:rounded-2xl shadow-xl p-4 sm:p-6 md:p-10">

        <!-- Back Button -->
        <div class="mb-4 sm:mb-6">
            <a href="{{ route('kegiatan.pengumuman-hasil', ['tahun' => $hasil['tahun']]) }}" 
                class="inline-flex items-center text-bebrasBlue hover:text-bebrasDarkBlue font-semibold transition text-sm sm:text-base">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar
            </a>
        </div>

        <!-- Header -->
        <div class="border-b pb-4 sm:pb-6 mb-6 sm:mb-8">
            <h1 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-extrabold text-gray-900 tracking-tight mb-3 sm:mb-4">
                @php
                    $kategoriDeskripsi = is_string($hasil['kategori'] ?? null) 
                        ? $hasil['kategori'] 
                        : ($hasil['kategori']['deskripsi'] ?? $hasil['kategori']['nama'] ?? 'Hasil Pengumuman');
                @endphp
                {{ $kategoriDeskripsi }}
            </h1>
            
            <div class="flex flex-wrap gap-4 items-center text-sm text-gray-600">
                <div class="flex items-center">
                    <i class="fas fa-calendar-alt text-bebrasBlue mr-2"></i>
                    <span class="font-medium">Tahun: {{ $hasil['tahun'] }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-layer-group text-bebrasBlue mr-2"></i>
                    <span class="font-medium">
                        Kategori: 
                        <span class="inline-block bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full font-semibold">
                            @php
                                $kategoriNama = is_string($hasil['kategori'] ?? null) 
                                    ? $hasil['kategori'] 
                                    : ($hasil['kategori']['nama'] ?? '-');
                            @endphp
                            {{ $kategoriNama }}
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <!-- Platform Info & Download Button -->
        <div class="mb-4 sm:mb-6 bg-blue-50 border border-blue-200 rounded-lg p-3 sm:p-4 flex flex-col sm:flex-row flex-wrap items-start sm:items-center justify-between gap-3 sm:gap-4">
            <div class="flex items-center text-blue-800">
                @if($hasil['is_uploaded'])
                    <i class="fas fa-file-excel text-2xl mr-3"></i>
                    <div>
                        <p class="font-semibold">File Excel</p>
                        <p class="text-sm">File tersimpan di server</p>
                    </div>
                @else
                    <i class="fas fa-link text-2xl mr-3"></i>
                    <div>
                        <p class="font-semibold">Link Eksternal</p>
                        <p class="text-sm">{{ ucfirst(str_replace('_', ' ', $hasil['platform'] ?? 'External Link')) }}</p>
                    </div>
                @endif
            </div>

            <!-- Download/View Button -->
            @if($hasil['is_uploaded'] && isset($hasil['download_url']))
                <a href="{{ $hasil['download_url'] }}" 
                    class="inline-flex items-center justify-center w-full sm:w-auto bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 sm:px-6 rounded-lg transition duration-200 transform hover:scale-105 shadow-md text-sm sm:text-base"
                    download>
                    <i class="fas fa-download mr-2"></i>Download File
                </a>
            @endif
        </div>

        <!-- Embed/View Section -->
        <div class="bg-gray-50 rounded-lg sm:rounded-xl p-3 sm:p-6 min-h-[400px] sm:min-h-[600px]">
            @if(!empty($hasil['can_embed']) && $hasil['can_embed'])
                <!-- Can Embed: Google Sheets or Uploaded File -->
                @if($hasil['is_uploaded'])
                    <!-- Uploaded Excel File - Use SheetJS -->
                    <div id="excel-container">
                        <div class="text-center py-12">
                            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-bebrasBlue mb-4"></div>
                            <p class="text-gray-600">Memuat file Excel...</p>
                        </div>
                    </div>

                    @push('scripts')
                    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const fileUrl = '{{ route("kegiatan.pengumuman-hasil.file", $hasil["id"]) }}';
                            const container = document.getElementById('excel-container');
                            let currentWorkbook = null;
                            let currentData = null;

                            console.log('🔍 Loading Excel via proxy:', fileUrl);

                            fetch(fileUrl)
                                .then(response => {
                                    console.log('📊 Status:', response.status, response.statusText);
                                    if (!response.ok) throw new Error(`HTTP ${response.status}`);
                                    return response.arrayBuffer();
                                })
                                .then(data => {
                                    console.log('✅ Data loaded:', data.byteLength, 'bytes');
                                    
                                    currentWorkbook = XLSX.read(data, { type: 'array' });
                                    console.log('📑 Sheets:', currentWorkbook.SheetNames);
                                    
                                    renderSheet(0);
                                })
                                .catch(error => {
                                    console.error('Error loading Excel file:', error);
                                    container.innerHTML = `
                                        <div class="text-center py-12">
                                            <i class="fas fa-exclamation-triangle text-red-500 text-4xl mb-4"></i>
                                            <p class="text-red-600 font-semibold mb-2">Gagal memuat file</p>
                                            <p class="text-gray-600">Silakan coba download file atau refresh halaman</p>
                                        </div>
                                    `;
                                });

                            function generateStatistics(data) {
                                if (!data || data.length < 2) {
                                    return { html: '' };
                                }
                                
                                const headers = data[0].map(h => String(h).trim());
                                const rows = data.slice(1);
                                
                                // Helper: Find column index (case-insensitive)
                                const findColumn = (names) => {
                                    for (let name of names) {
                                        const idx = headers.findIndex(h => h.toLowerCase() === name.toLowerCase());
                                        if (idx !== -1) return idx;
                                    }
                                    return -1;
                                };
                                
                                // Helper: Capitalize first letter
                                const capitalize = (str) => str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
                                
                                // Find column indices
                                const colNama = findColumn(['Nama', 'Name']);
                                const colGender = findColumn(['Jenis Kelamin', 'Gender', 'JK']);
                                const colKota = findColumn(['Kota/Kabupaten', 'Kota', 'Kabupaten', 'City']);
                                const colBiro = findColumn(['Bebras Biro', 'Biro', 'Office']);
                                const colNilai = findColumn(['Nilai', 'Score']);
                                const colRank = findColumn(['Rank(%)', 'Rank (%)', 'Ranking(%)', 'Ranking (%)']);
                                
                                // Calculate statistics
                                const totalPeserta = rows.length;
                                
                                // Gender distribution
                                let genderCount = {};
                                if (colGender !== -1) {
                                    rows.forEach(row => {
                                        const gender = String(row[colGender] || '').trim();
                                        if (gender) {
                                            const normalized = gender.toLowerCase().includes('laki') || gender.toLowerCase() === 'l' || gender.toLowerCase() === 'm' 
                                                ? 'Laki-laki' 
                                                : gender.toLowerCase().includes('perempuan') || gender.toLowerCase() === 'p' || gender.toLowerCase() === 'f'
                                                ? 'Perempuan'
                                                : capitalize(gender);
                                            genderCount[normalized] = (genderCount[normalized] || 0) + 1;
                                        }
                                    });
                                }
                                
                                // Top cities
                                let cityCount = {};
                                if (colKota !== -1) {
                                    rows.forEach(row => {
                                        const city = String(row[colKota] || '').trim();
                                        if (city) cityCount[city] = (cityCount[city] || 0) + 1;
                                    });
                                }
                                const topCities = Object.entries(cityCount)
                                    .sort((a, b) => b[1] - a[1])
                                    .slice(0, 3);
                                
                                // Average score (Nilai)
                                let avgNilai = 0;
                                let pesertaAbove80 = 0;
                                if (colNilai !== -1) {
                                    const scores = rows
                                        .map(row => parseFloat(String(row[colNilai] || '0').replace(',', '.')))
                                        .filter(s => !isNaN(s));
                                    avgNilai = scores.length > 0 ? (scores.reduce((a, b) => a + b, 0) / scores.length).toFixed(2) : 0;
                                    pesertaAbove80 = scores.filter(s => s > 80).length;
                                }
                                
                                // Rank distribution
                                let rankCount = {};
                                if (colRank !== -1) {
                                    rows.forEach(row => {
                                        const rank = String(row[colRank] || '').trim();
                                        if (rank) rankCount[rank] = (rankCount[rank] || 0) + 1;
                                    });
                                }
                                const topRanks = Object.entries(rankCount)
                                    .sort((a, b) => b[1] - a[1])
                                    .slice(0, 4);
                                
                                // Top Biro
                                let biroCount = {};
                                if (colBiro !== -1) {
                                    rows.forEach(row => {
                                        const biro = String(row[colBiro] || '').trim();
                                        if (biro) biroCount[biro] = (biroCount[biro] || 0) + 1;
                                    });
                                }
                                const topBiros = Object.entries(biroCount)
                                    .sort((a, b) => b[1] - a[1])
                                    .slice(0, 3);
                                
                                // Build HTML
                                let html = '<div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-lg shadow-md mb-4 border border-blue-200">';
                                html += '<h3 class="text-xl font-bold text-gray-800 mb-5 flex items-center">';
                                html += '<i class="fas fa-chart-bar text-bebrasBlue mr-2"></i>Statistik Data';
                                html += '</h3>';
                                
                                // First Row: Main KPIs (2 columns)
                                html += '<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">';
                                
                                // Total Peserta
                                html += `
                                    <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-blue-500 hover:shadow-md transition-shadow">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <p class="text-xs text-gray-600 font-semibold uppercase tracking-wide mb-2">Total Peserta</p>
                                                <p class="text-3xl font-bold text-gray-800">${totalPeserta}</p>
                                            </div>
                                            <div class="ml-4">
                                                <i class="fas fa-users text-4xl text-blue-500 opacity-20"></i>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                
                                // Peserta Above 80
                                if (pesertaAbove80 >= 0 && colNilai !== -1) {
                                    const percentage = totalPeserta > 0 ? ((pesertaAbove80 / totalPeserta) * 100).toFixed(1) : 0;
                                    html += `
                                        <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-orange-500 hover:shadow-md transition-shadow">
                                            <div class="flex items-start justify-between">
                                                <div class="flex-1">
                                                    <p class="text-xs text-gray-600 font-semibold uppercase tracking-wide mb-2">Nilai > 80</p>
                                                    <p class="text-3xl font-bold text-gray-800">${pesertaAbove80}</p>
                                                    <p class="text-xs text-gray-500 mt-1 font-medium">${percentage}% dari total</p>
                                                </div>
                                                <div class="ml-4">
                                                    <i class="fas fa-star text-4xl text-orange-500 opacity-20"></i>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                }
                                
                                html += '</div>';
                                
                                // Second Row: Gender Distribution (full width if no other stats)
                                const hasGender = Object.keys(genderCount).length > 0;
                                
                                if (hasGender) {
                                    const genderEntries = Object.entries(genderCount);
                                    html += `
                                        <div class="mb-4">
                                            <div class="bg-white p-5 rounded-xl shadow-sm border-l-4 border-purple-500 hover:shadow-md transition-shadow">
                                                <div class="flex items-center justify-between mb-3">
                                                    <p class="text-xs text-gray-600 font-semibold uppercase tracking-wide">Gender</p>
                                                    <i class="fas fa-venus-mars text-2xl text-purple-500 opacity-30"></i>
                                                </div>
                                                <div class="grid grid-cols-2 md:grid-cols-${genderEntries.length} gap-4">
                                                    ${genderEntries.map(([gender, count]) => `
                                                        <div class="text-center p-3 bg-gray-50 rounded-lg">
                                                            <p class="text-sm text-gray-700 font-medium mb-1">${gender}</p>
                                                            <p class="text-2xl font-bold text-gray-800">${count}</p>
                                                        </div>
                                                    `).join('')}
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                }
                                
                                // Third Row: Top Cities and Top Biros (2 columns)
                                if (topCities.length > 0 || topBiros.length > 0) {
                                    html += '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';
                                    
                                    if (topCities.length > 0) {
                                        html += `
                                            <div class="bg-white p-5 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                                <h4 class="text-sm font-bold text-gray-700 mb-4 flex items-center">
                                                    <i class="fas fa-map-marker-alt text-red-500 mr-2 text-lg"></i>
                                                    <span>Top Kota/Kabupaten</span>
                                                </h4>
                                                <div class="space-y-3">
                                                    ${topCities.map(([city, count], idx) => `
                                                        <div class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 transition-colors">
                                                            <div class="flex items-center flex-1 min-w-0">
                                                                <span class="w-7 h-7 rounded-full bg-red-100 text-red-600 text-sm font-bold flex items-center justify-center mr-3 flex-shrink-0">
                                                                    ${idx + 1}
                                                                </span>
                                                                <span class="text-sm text-gray-700 font-medium truncate">${city}</span>
                                                            </div>
                                                            <span class="ml-3 px-3 py-1 bg-red-100 text-red-700 text-sm font-bold rounded-full flex-shrink-0">${count}</span>
                                                        </div>
                                                    `).join('')}
                                                </div>
                                            </div>
                                        `;
                                    }
                                    
                                    if (topBiros.length > 0) {
                                        html += `
                                            <div class="bg-white p-5 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                                                <h4 class="text-sm font-bold text-gray-700 mb-4 flex items-center">
                                                    <i class="fas fa-building text-indigo-500 mr-2 text-lg"></i>
                                                    <span>Top Bebras Biro</span>
                                                </h4>
                                                <div class="space-y-3">
                                                    ${topBiros.map(([biro, count], idx) => `
                                                        <div class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 transition-colors">
                                                            <div class="flex items-center flex-1 min-w-0">
                                                                <span class="w-7 h-7 rounded-full bg-indigo-100 text-indigo-600 text-sm font-bold flex items-center justify-center mr-3 flex-shrink-0">
                                                                    ${idx + 1}
                                                                </span>
                                                                <span class="text-sm text-gray-700 font-medium truncate">${biro}</span>
                                                            </div>
                                                            <span class="ml-3 px-3 py-1 bg-indigo-100 text-indigo-700 text-sm font-bold rounded-full flex-shrink-0">${count}</span>
                                                        </div>
                                                    `).join('')}
                                                </div>
                                            </div>
                                        `;
                                    }
                                    
                                    html += '</div>';
                                }
                                
                                html += '</div>';
                                
                                return { html };
                            }

                            function renderSheet(sheetIndex) {
                                const sheetName = currentWorkbook.SheetNames[sheetIndex];
                                const worksheet = currentWorkbook.Sheets[sheetName];
                                
                                // Convert to JSON for filtering
                                currentData = XLSX.utils.sheet_to_json(worksheet, { header: 1, defval: '' });
                                
                                // Get column headers
                                const headers = currentData[0] || [];
                                
                                // Generate statistics
                                const stats = generateStatistics(currentData);
                                
                                container.innerHTML = `
                                    <div class="space-y-4">
                                        <!-- Statistics Dashboard -->
                                        ${stats.html}
                                        
                                        <!-- Controls Bar -->
                                        <div class="bg-white p-4 rounded-lg shadow-sm space-y-3">
                                            <div class="flex flex-wrap items-center justify-between gap-3">
                                                <h3 class="text-lg font-semibold text-gray-800">
                                                    <i class="fas fa-table mr-2 text-bebrasBlue"></i>Sheet: ${sheetName}
                                                </h3>
                                                ${currentWorkbook.SheetNames.length > 1 ? `
                                                    <select id="sheet-selector" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-bebrasBlue">
                                                        ${currentWorkbook.SheetNames.map((name, idx) => 
                                                            `<option value="${idx}" ${idx === sheetIndex ? 'selected' : ''}>${name}</option>`
                                                        ).join('')}
                                                    </select>
                                                ` : ''}
                                            </div>
                                            
                                            <!-- Search and Filter -->
                                            <div class="flex flex-wrap gap-3">
                                                <div class="flex-1 min-w-[200px]">
                                                    <div class="relative">
                                                        <input type="text" id="search-input" 
                                                            placeholder="Cari data..." 
                                                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bebrasBlue focus:border-bebrasBlue">
                                                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                                    </div>
                                                </div>
                                                
                                                <button id="reset-filter" class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition">
                                                    <i class="fas fa-redo mr-2"></i>Reset
                                                </button>
                                            </div>
                                            
                                            <!-- Results Info -->
                                            <div id="results-info" class="text-sm text-gray-600">
                                                Menampilkan <span id="visible-rows" class="font-semibold">${currentData.length - 1}</span> dari 
                                                <span class="font-semibold">${currentData.length - 1}</span> baris data
                                            </div>
                                        </div>

                                        <!-- Table Container -->
                                        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                                            <div class="overflow-x-auto" style="max-height: 600px;">
                                                <table id="excel-table" class="w-full text-sm text-left border-collapse">
                                                    ${renderTableRows(currentData)}
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                `;

                                // Setup event listeners
                                setupEventListeners(sheetIndex, headers);
                            }

                            function renderTableRows(data, searchTerm = '', columnIndex = '') {
                                if (!data || data.length === 0) return '<tr><td class="p-4 text-center text-gray-500">Tidak ada data</td></tr>';
                                
                                let html = '';
                                let visibleCount = 0;
                                
                                data.forEach((row, rowIndex) => {
                                    const isHeader = rowIndex === 0;
                                    let isVisible = true;
                                    
                                    // Apply search filter
                                    if (searchTerm && !isHeader) {
                                        const searchLower = searchTerm.toLowerCase();
                                        
                                        if (columnIndex === '') {
                                            // Search all columns
                                            isVisible = row.some(cell => 
                                                String(cell).toLowerCase().includes(searchLower)
                                            );
                                        } else {
                                            // Search specific column
                                            const colIdx = parseInt(columnIndex);
                                            isVisible = String(row[colIdx] || '').toLowerCase().includes(searchLower);
                                        }
                                    }
                                    
                                    if (!isVisible) return;
                                    if (!isHeader) visibleCount++;
                                    
                                    const tag = isHeader ? 'th' : 'td';
                                    const cellClass = isHeader 
                                        ? 'border border-gray-300 px-4 py-2 bg-bebrasBlue text-white font-semibold sticky top-0 z-10'
                                        : 'border border-gray-300 px-4 py-2 hover:bg-gray-50';
                                    
                                    html += '<tr>';
                                    row.forEach(cell => {
                                        const cellValue = String(cell || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                                        html += `<${tag} class="${cellClass}">${cellValue}</${tag}>`;
                                    });
                                    html += '</tr>';
                                });
                                
                                // Update results info
                                setTimeout(() => {
                                    const visibleElement = document.getElementById('visible-rows');
                                    if (visibleElement) {
                                        visibleElement.textContent = visibleCount;
                                    }
                                }, 0);
                                
                                return html;
                            }
                            
                            function setupEventListeners(currentSheetIndex, headers) {
                                // Sheet selector
                                const sheetSelector = document.getElementById('sheet-selector');
                                if (sheetSelector) {
                                    sheetSelector.addEventListener('change', function() {
                                        renderSheet(parseInt(this.value));
                                    });
                                }

                                // Search input
                                const searchInput = document.getElementById('search-input');
                                
                                function applyFilter() {
                                    const searchTerm = searchInput.value;
                                    
                                    const table = document.getElementById('excel-table');
                                    if (table) {
                                        table.innerHTML = renderTableRows(currentData, searchTerm);
                                    }
                                }

                                if (searchInput) {
                                    searchInput.addEventListener('input', applyFilter);
                                }

                                // Reset button
                                const resetBtn = document.getElementById('reset-filter');
                                if (resetBtn) {
                                    resetBtn.addEventListener('click', function() {
                                        if (searchInput) searchInput.value = '';
                                        applyFilter();
                                    });
                                }
                            }
                        });
                    </script>
                    @endpush

                @elseif(in_array($hasil['platform'], ['google_sheets', 'excel_online']))
                    <!-- Google Sheets / Excel Online Embed -->
                    <!-- Search Guide -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4 rounded">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex items-start flex-1">
                                <i class="fas fa-info-circle text-blue-500 text-xl mr-3 mt-1"></i>
                                <div>
                                    <h4 class="font-semibold text-blue-900 mb-2">💡 Tips Mencari Data di {{ $hasil['platform'] === 'google_sheets' ? 'Google Sheets' : 'Excel Online' }}</h4>
                                    <ul class="text-sm text-blue-800 space-y-1">
                                        <li><kbd class="px-2 py-1 bg-white border border-blue-300 rounded text-xs font-mono">Ctrl + F</kbd> untuk mencari teks</li>
                                        @if($hasil['platform'] === 'google_sheets')
                                            <li>Klik kolom header lalu pilih <strong>Data → Create a filter</strong> untuk filter data</li>
                                            <li>Gunakan menu <strong>Data → Sort range</strong> untuk mengurutkan data</li>
                                        @else
                                            <li>Gunakan fitur filter dan sort yang tersedia di toolbar</li>
                                            <li>Klik header kolom untuk sorting</li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="{{ $hasil['view_url'] }}" 
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 transform hover:scale-105 shadow-md whitespace-nowrap">
                                    @if($hasil['platform'] === 'google_sheets')
                                        <i class="fab fa-google text-lg mr-2"></i>
                                        <span>Buka di Google Sheets</span>
                                    @else
                                        <i class="fab fa-microsoft text-lg mr-2"></i>
                                        <span>Buka di Excel Online</span>
                                    @endif
                                    <i class="fas fa-external-link-alt text-xs ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="w-full h-[700px]">
                        <iframe 
                            src="{{ $hasil['embed_url'] ?? $hasil['view_url'] }}" 
                            frameborder="0" 
                            class="w-full h-full rounded-lg shadow-inner"
                            allowfullscreen>
                        </iframe>
                    </div>
                @endif

            @else
                <!-- Cannot Embed: OneDrive -->
                <!-- Search Guide for OneDrive -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6 rounded">
                    <div class="flex items-start">
                        <i class="fas fa-info-circle text-blue-600 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-blue-900 mb-2">💡 Tips Mencari Data di OneDrive</h4>
                            <ul class="text-sm text-blue-800 space-y-1">
                                <li><kbd class="px-2 py-1 bg-white border border-blue-300 rounded text-xs font-mono">Ctrl + F</kbd> untuk mencari teks dalam file Excel</li>
                                <li>Gunakan fitur <strong>Filter</strong> di toolbar Excel Online</li>
                                <li>Klik <strong>Data → Filter</strong> untuk mengaktifkan dropdown filter di setiap kolom</li>
                                <li>Gunakan <strong>Sort A-Z</strong> atau <strong>Sort Z-A</strong> untuk mengurutkan data</li>
                                <li>Gunakan <strong>Find & Select</strong> untuk pencarian lanjutan</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="text-center py-16">
                    <div class="inline-block p-8 bg-gradient-to-br from-blue-50 to-blue-100 rounded-full mb-6 shadow-lg">
                        <i class="fab fa-microsoft text-blue-600 text-6xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">
                        Lihat di OneDrive
                    </h3>
                    <p class="text-gray-600 mb-8 max-w-md mx-auto">
                        File ini tersimpan di OneDrive dan tidak dapat ditampilkan langsung di website. 
                        Klik tombol di bawah untuk membuka file di Excel Online.
                    </p>
                    <a href="{{ $hasil['view_url'] }}" 
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-200 transform hover:scale-105 shadow-lg">
                        <i class="fab fa-microsoft mr-3 text-xl"></i>
                        Buka di OneDrive
                        <i class="fas fa-external-link-alt ml-3 text-sm"></i>
                    </a>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection

@push('styles')
<style>
    #excel-table {
        border-collapse: collapse;
    }
    
    #excel-table th {
        position: sticky;
        top: 0;
        background-color: #1e40af;
        z-index: 10;
    }
    
    #excel-table tr:hover td {
        background-color: #f3f4f6;
    }
    
    .overflow-x-auto {
        max-height: 600px;
        overflow-y: auto;
    }
    
    kbd {
        display: inline-block;
        font-family: 'Courier New', monospace;
        box-shadow: 0 1px 2px rgba(0,0,0,0.1);
    }
</style>
@endpush
