@extends('app')

@section('title', 'Pengumuman Hasil Challenge')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="bg-white rounded-2xl shadow-xl p-6 md:p-10">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b pb-6 mb-8">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-4 md:mb-0">
                Pengumuman Hasil Challenge
            </h1>
        </div>

        <!-- Filter Section -->
        <div class="mb-8 bg-gray-50 p-6 rounded-xl">
            <form action="{{ route('kegiatan.pengumuman-hasil') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                
                <!-- Filter Tahun -->
                <div>
                    <label for="tahun" class="block text-sm font-semibold text-gray-700 mb-2">Tahun</label>
                    <select name="tahun" id="tahun" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bebrasBlue focus:border-bebrasBlue transition">
                        <option value="">-- Pilih Tahun --</option>
                        @foreach($years as $year)
                            <option value="{{ $year }}" {{ $selectedYear == $year ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Kategori -->
                <div>
                    <label for="kategori" class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                    <select name="kategori" id="kategori" 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-bebrasBlue focus:border-bebrasBlue transition">
                        <option value="">-- Semua Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}" {{ $selectedCategory == $category['id'] ? 'selected' : '' }}>
                                {{ $category['nama'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Button Submit -->
                <div class="flex items-end">
                    <button type="submit" 
                        class="w-full bg-bebrasBlue hover:bg-bebrasDarkBlue text-white font-semibold py-2 px-6 rounded-lg transition duration-200 transform hover:scale-105">
                        <i class="fas fa-search mr-2"></i>Tampilkan
                    </button>
                </div>
            </form>
        </div>

        <!-- Results Section -->
        @if(count($pengumumanList) > 0)
            <div class="space-y-6">
                @foreach($pengumumanList as $pengumuman)
                    <div class="group bg-gradient-to-br from-white to-gray-50 rounded-xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden border border-gray-200">
                        
                        <!-- Header Card -->
                        <div class="bg-bebrasBlue p-4">
                            <h3 class="text-white font-bold text-lg">
                                {{ $pengumuman['description'] ?? 'Hasil Pengumuman' }}
                            </h3>
                        </div>

                        <!-- Content -->
                        <div class="p-5">
                            <!-- Info -->
                            <div class="mb-4 space-y-2">
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-calendar-alt text-bebrasBlue mr-2"></i>
                                    <span class="text-sm font-medium">Tahun: {{ $pengumuman['tahun'] }}</span>
                                </div>
                                <div class="flex items-center text-gray-700">
                                    <i class="fas fa-layer-group text-bebrasBlue mr-2"></i>
                                    <span class="text-sm font-medium">
                                        Kategori: 
                                        <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full font-semibold">
                                            @php
                                                $kategoriNama = is_string($pengumuman['kategori'] ?? null) 
                                                    ? $pengumuman['kategori'] 
                                                    : ($pengumuman['kategori']['nama'] ?? '-');
                                            @endphp
                                            {{ $kategoriNama }}
                                        </span>
                                    </span>
                                </div>
                                
                                @if($pengumuman['is_uploaded'])
                                    <div class="flex items-center text-green-600">
                                        <i class="fas fa-file-excel mr-2"></i>
                                        <span class="text-xs font-medium">File Excel Tersedia</span>
                                    </div>
                                @else
                                    <div class="flex items-center text-blue-600">
                                        <i class="fas fa-link mr-2"></i>
                                        <span class="text-xs font-medium">Link Eksternal</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Preview Section (hanya untuk uploaded files) -->
                            @if($pengumuman['is_uploaded'])
                                <div class="mb-4 bg-gray-50 rounded-lg p-3 border border-gray-200">
                                    <div class="mb-2">
                                        <h4 class="text-xs font-semibold text-gray-700 uppercase tracking-wide">
                                            <i class="fas fa-eye text-bebrasBlue mr-1"></i>Preview Data
                                        </h4>
                                    </div>
                                    <div id="preview-{{ $pengumuman['id'] }}" class="preview-container" data-pengumuman-id="{{ $pengumuman['id'] }}">
                                        <div class="text-center py-4">
                                            <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-bebrasBlue mb-2"></div>
                                            <p class="text-xs text-gray-600">Memuat preview...</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="mb-4 bg-blue-50 rounded-lg p-3 border border-blue-200">
                                    <div class="flex items-center text-blue-700 text-xs">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        <span>Preview hanya tersedia untuk file Excel yang diupload</span>
                                    </div>
                                </div>
                            @endif

                            <!-- Action Button -->
                            <a href="{{ route('kegiatan.pengumuman-hasil.show', $pengumuman['id']) }}" 
                                class="block w-full text-center bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold py-3 px-4 rounded-lg transition duration-200 transform group-hover:scale-95 shadow-md">
                                <i class="fas fa-eye mr-2"></i>Lihat Selengkapnya
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="inline-block p-6 bg-gray-100 rounded-full mb-4">
                    <i class="fas fa-inbox text-gray-400 text-5xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Data</h3>
                <p class="text-gray-500">
                    @if($selectedYear)
                        Tidak ada hasil pengumuman untuk tahun {{ $selectedYear }}
                        @if($selectedCategory)
                            dan kategori yang dipilih
                        @endif
                    @else
                        Silakan pilih tahun untuk melihat hasil pengumuman
                    @endif
                </p>
            </div>
        @endif

    </div>
</div>
@endsection

@push('styles')
<style>
    .active {
        background-color: #1e40af;
        color: white;
    }
    
    .preview-container {
        max-height: 400px;
        overflow-y: auto;
        overflow-x: auto;
    }
    
    .preview-table {
        width: 100%;
        font-size: 0.75rem;
        border-collapse: collapse;
        background: white;
    }
    
    .preview-table th,
    .preview-table td {
        border: 1px solid #d1d5db;
        padding: 0.5rem 0.75rem;
        text-align: left;
        white-space: nowrap;
    }
    
    .preview-table th {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        font-weight: 600;
        position: sticky;
        top: 0;
        z-index: 10;
        text-transform: uppercase;
        font-size: 0.65rem;
        letter-spacing: 0.05em;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .preview-table tbody tr {
        transition: all 0.2s ease;
    }
    
    .preview-table tbody tr:nth-child(even) {
        background-color: #f9fafb;
    }
    
    .preview-table tbody tr:hover {
        background-color: #dbeafe !important;
        transform: scale(1.01);
        box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
    }
    
    .preview-table td {
        color: #374151;
        font-size: 0.75rem;
    }
    
    /* Scrollbar styling */
    .preview-container::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    .preview-container::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 4px;
    }
    
    .preview-container::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 4px;
    }
    
    .preview-container::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-load semua preview saat halaman dimuat
        const previewContainers = document.querySelectorAll('.preview-container[data-pengumuman-id]');
        
        previewContainers.forEach(container => {
            const id = container.getAttribute('data-pengumuman-id');
            loadPreview(id, container);
        });
    });
    
    function loadPreview(id, container = null) {
        if (!container) {
            container = document.getElementById(`preview-${id}`);
        }
        
        if (!container) return;
        
        // Fetch preview data
        fetch(`/kegiatan/pengumuman-hasil/${id}/preview`)
            .then(response => response.json())
            .then(result => {
                if (!result.success) {
                    throw new Error(result.message || 'Gagal memuat preview');
                }
                
                // Decode base64 dan parse Excel
                const binaryString = atob(result.data);
                const bytes = new Uint8Array(binaryString.length);
                for (let i = 0; i < binaryString.length; i++) {
                    bytes[i] = binaryString.charCodeAt(i);
                }
                
                const workbook = XLSX.read(bytes, { type: 'array' });
                const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
                const data = XLSX.utils.sheet_to_json(firstSheet, { header: 1, defval: '' });
                
                // Batasi preview hanya 6 baris pertama
                const previewData = data.slice(0, 6);
                
                // Render table dengan struktur yang lebih baik
                let html = '<div class="rounded-lg overflow-hidden shadow-sm border border-gray-200">';
                html += '<table class="preview-table">';
                
                // Render thead
                if (previewData.length > 0) {
                    html += '<thead><tr>';
                    previewData[0].forEach(cell => {
                        const value = String(cell || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                        html += `<th>${value}</th>`;
                    });
                    html += '</tr></thead>';
                    
                    // Render tbody
                    html += '<tbody>';
                    previewData.slice(1).forEach(row => {
                        html += '<tr>';
                        row.forEach(cell => {
                            const value = String(cell || '').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                            html += `<td>${value}</td>`;
                        });
                        html += '</tr>';
                    });
                    html += '</tbody>';
                }
                
                html += '</table></div>';
                
                // Tampilkan info jumlah total data dengan styling lebih baik
                const totalRows = data.length - 1; // minus header
                html += `<div class="mt-3 px-3 py-2 bg-blue-50 border border-blue-200 rounded-lg flex items-center justify-between text-xs">
                    <div class="flex items-center text-blue-700">
                        <i class="fas fa-info-circle mr-2"></i>
                        <span class="font-medium">Menampilkan 5 dari ${totalRows} baris data</span>
                    </div>
                    <div class="text-blue-600">
                        <i class="fas fa-table mr-1"></i>
                        <span class="font-semibold">${totalRows} total</span>
                    </div>
                </div>`;
                
                container.innerHTML = html;
            })
            .catch(error => {
                console.error('Error loading preview:', error);
                container.innerHTML = `
                    <div class="text-center py-4 text-red-500 text-xs">
                        <i class="fas fa-exclamation-triangle text-xl mb-2"></i>
                        <p>Gagal memuat preview</p>
                        <button onclick="loadPreview(${id})" class="mt-2 text-bebrasBlue hover:underline">
                            Coba Lagi
                        </button>
                    </div>
                `;
            });
    }
</script>
@endpush
