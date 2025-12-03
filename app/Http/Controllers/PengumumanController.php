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
        
        // Set default tahun ke tahun pertama jika tidak ada filter
        if (!$tahun && !empty($years)) {
            $tahun = $years[0];
        }
        
        // Get pengumuman list (without kategori filter, we'll get all for the year)
        $pengumumanListAll = $this->pengumumanService->getPengumuman($tahun, null);
        
        // Extract categories from the pengumuman data
        $categories = $this->pengumumanService->getCategories($pengumumanListAll);
        
        // Get filtered pengumuman list if kategori is selected
        $pengumumanList = $kategoriId 
            ? $this->pengumumanService->getPengumuman($tahun, $kategoriId)
            : $pengumumanListAll;
        
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
     * Proxy file dari API admin untuk menghindari CORS
     */
    public function proxyFile($id)
    {
        $hasil = $this->pengumumanService->getPengumumanDetail($id);
        
        if (!$hasil || empty($hasil['view_url'])) {
            abort(404, 'File tidak ditemukan');
        }

        try {
            // Fetch file dari API admin
            $response = \Illuminate\Support\Facades\Http::timeout(30)->get($hasil['view_url']);
            
            if (!$response->successful()) {
                abort(404, 'File tidak dapat diakses');
            }

            // Tentukan content type
            $contentType = $response->header('Content-Type') ?? 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
            
            // Return file dengan header CORS
            return response($response->body(), 200)
                ->header('Content-Type', $contentType)
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Cache-Control', 'public, max-age=3600');
                
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error proxying file', [
                'id' => $id,
                'url' => $hasil['view_url'] ?? null,
                'error' => $e->getMessage()
            ]);
            
            abort(500, 'Terjadi kesalahan saat memuat file');
        }
    }

    /**
     * Get preview data untuk card di halaman list
     */
    public function preview($id)
    {
        $hasil = $this->pengumumanService->getPengumumanDetail($id);
        
        if (!$hasil || empty($hasil['view_url'])) {
            return response()->json(['success' => false, 'message' => 'File tidak ditemukan'], 404);
        }

        try {
            // Fetch file dari API admin
            $response = \Illuminate\Support\Facades\Http::timeout(30)->get($hasil['view_url']);
            
            if (!$response->successful()) {
                return response()->json(['success' => false, 'message' => 'File tidak dapat diakses'], 404);
            }

            // Return raw file data untuk diproses di frontend
            return response()->json([
                'success' => true,
                'data' => base64_encode($response->body()),
                'contentType' => $response->header('Content-Type')
            ]);
                
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error loading preview', [
                'id' => $id,
                'error' => $e->getMessage()
            ]);
            
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan'], 500);
        }
    }
}
