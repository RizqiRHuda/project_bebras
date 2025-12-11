<?php

namespace App\Http\Controllers;

use App\Services\BebrasPengumumanService;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    protected $pengumumanService;

    public function __construct(BebrasPengumumanService $pengumumanService)
    {
        $this->pengumumanService = $pengumumanService;
    }

    /**
     * Tampilkan halaman list pengumuman hasil
     */
    public function index(Request $request)
    {
        $tahun = $request->get('tahun');
        $kategoriId = $request->get('kategori');
        
        // Get data
        $years = $this->pengumumanService->getYears();
        
        // Debug logging
        \Log::info('PengumumanController::index', [
            'tahun_requested' => $tahun,
            'kategori_requested' => $kategoriId,
            'years_available' => $years
        ]);
        
        // Set default tahun ke tahun pertama jika tidak ada filter
        if (!$tahun && !empty($years)) {
            $tahun = $years[0];
        }
        
        // Get pengumuman list (without kategori filter, we'll get all for the year)
        $pengumumanListAll = $this->pengumumanService->getPengumuman($tahun, null);
        
        \Log::info('PengumumanController::pengumumanListAll', [
            'count' => count($pengumumanListAll),
            'tahun' => $tahun
        ]);
        
        // Extract categories from the pengumuman data
        $categories = $this->pengumumanService->getCategories($pengumumanListAll);
        
        \Log::info('PengumumanController::categories', [
            'count' => count($categories),
            'categories' => $categories
        ]);
        
        // Get filtered pengumuman list if kategori is selected
        $pengumumanList = $kategoriId 
            ? $this->pengumumanService->getPengumuman($tahun, $kategoriId)
            : $pengumumanListAll;
        
        \Log::info('PengumumanController::finalData', [
            'years_count' => count($years),
            'categories_count' => count($categories),
            'pengumumanList_count' => count($pengumumanList)
        ]);
        
        return view('pages.kegiatan.pengumuman_hasil', [
            'years' => $years,
            'categories' => $categories,
            'pengumumanList' => $pengumumanList,
            'selectedYear' => $tahun,
            'selectedCategory' => $kategoriId,
        ]);
    }

    /**
     * Tampilkan detail pengumuman hasil
     */
    public function show($id)
    {
        $hasil = $this->pengumumanService->getPengumumanDetail($id);
        
        if (!$hasil) {
            abort(404, 'Hasil pengumuman tidak ditemukan');
        }
        
        return view('pages.kegiatan.pengumuman_detail', [
            'hasil' => $hasil,
        ]);
    }

    /**
     * Proxy file dari API admin (new API endpoint)
     * Hanya untuk file uploaded, platform eksternal langsung redirect
     */
    public function proxyFile($id)
    {
        $hasil = $this->pengumumanService->getPengumumanDetail($id);
        
        if (!$hasil) {
            abort(404, 'File tidak ditemukan');
        }
        
        // Untuk platform eksternal (Google Sheets, OneDrive, Excel Online)
        // Redirect langsung ke URL eksternal
        if (in_array($hasil['platform'], ['google_sheets', 'onedrive', 'excel_online'])) {
            if (!empty($hasil['view_url'])) {
                return redirect($hasil['view_url']);
            }
            abort(404, 'URL tidak tersedia');
        }
        
        // Untuk file uploaded, proxy dari API
        if (!$hasil['is_uploaded']) {
            abort(404, 'File tidak ditemukan');
        }

        try {
            // Use new API endpoint /api/files/view/{id}
            $apiUrl = config('services.bebras_admin.api_url', 'http://127.0.0.1:8000/api');
            $fileApiUrl = $apiUrl . '/files/view/' . $id;
            
            $response = \Illuminate\Support\Facades\Http::timeout(30)->get($fileApiUrl);
            
            if (!$response->successful()) {
                abort(404, 'File tidak dapat diakses');
            }

            // Untuk file uploaded, API akan return binary file langsung
            $fileContent = $response->body();
            $contentType = $response->header('Content-Type') ?? 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            
            // Return file dengan header CORS
            return response($fileContent, 200)
                ->header('Content-Type', $contentType)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Cache-Control', 'public, max-age=3600');
                
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error proxying file', [
                'id' => $id,
                'api_url' => $fileApiUrl ?? null,
                'error' => $e->getMessage()
            ]);
            
            abort(500, 'Terjadi kesalahan saat memuat file');
        }
    }

    /**
     * Get preview data untuk card di halaman list (new API endpoint)
     * Hanya untuk file uploaded, platform eksternal tidak perlu preview
     */
    public function preview($id)
    {
        $hasil = $this->pengumumanService->getPengumumanDetail($id);
        
        if (!$hasil) {
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        }
        
        // Platform eksternal tidak perlu preview (tidak bisa di-parse di frontend)
        if (in_array($hasil['platform'], ['google_sheets', 'onedrive', 'excel_online'])) {
            return response()->json(['success' => false, 'message' => 'Preview tidak tersedia untuk platform eksternal'], 400);
        }
        
        // Hanya untuk file uploaded
        if (!$hasil['is_uploaded']) {
            return response()->json(['success' => false, 'message' => 'File tidak ditemukan'], 404);
        }

        try {
            // Use new API endpoint /api/files/view/{id}
            $apiUrl = config('services.bebras_admin.api_url', 'http://127.0.0.1:8000/api');
            $fileApiUrl = $apiUrl . '/files/view/' . $id;
            
            $response = \Illuminate\Support\Facades\Http::timeout(30)->get($fileApiUrl);
            
            if (!$response->successful()) {
                return response()->json(['success' => false, 'message' => 'File tidak dapat diakses'], 404);
            }

            // API akan return binary file langsung untuk uploaded files
            $fileContent = $response->body();
            $contentType = $response->header('Content-Type') ?? 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            
            // Return raw file data untuk diproses di frontend
            return response()->json([
                'success' => true,
                'data' => base64_encode($fileContent),
                'contentType' => $contentType
            ]);
                
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error loading preview', [
                'id' => $id,
                'api_url' => $fileApiUrl ?? null,
                'error' => $e->getMessage()
            ]);
            
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan'], 500);
        }
    }
}
