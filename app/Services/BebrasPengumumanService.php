<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BebrasPengumumanService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.bebras_admin.api_url');
    }

    /**
     * Get daftar tahun pengumuman
     */
    public function getYears()
    {
        return Cache::remember('bebras_years', 3600, function () {
            try {
                $response = Http::timeout(10)->get("{$this->apiUrl}/pengumuman/tahun");
                
                if ($response->successful()) {
                    return $response->json()['data'] ?? [];
                }
                
                Log::warning('Failed to fetch years from Bebras API', [
                    'status' => $response->status()
                ]);
                
                return [];
            } catch (\Exception $e) {
                Log::error('Error fetching years from Bebras API', [
                    'error' => $e->getMessage()
                ]);
                return [];
            }
        });
    }

    /**
     * Get daftar kategori
     * Note: Kategori extracted from pengumuman data, not separate endpoint
     */
    public function getCategories($pengumumanList = [])
    {
        if (empty($pengumumanList)) {
            return [];
        }
        
        // Extract unique categories from pengumuman data
        $categories = [];
        $seen = [];
        
        foreach ($pengumumanList as $pengumuman) {
            $kategori = $pengumuman['kategori'] ?? null;
            
            if ($kategori) {
                // Handle if kategori is a string (convert to object-like array)
                if (is_string($kategori)) {
                    if (!in_array($kategori, $seen)) {
                        $categories[] = [
                            'id' => $kategori,
                            'nama' => $kategori,
                            'deskripsi' => null
                        ];
                        $seen[] = $kategori;
                    }
                }
                // Handle if kategori is already an object/array
                elseif (is_array($kategori) && isset($kategori['id'])) {
                    if (!in_array($kategori['id'], $seen)) {
                        $categories[] = $kategori;
                        $seen[] = $kategori['id'];
                    }
                }
            }
        }
        
        return $categories;
    }

    /**
     * Get list pengumuman dengan filter
     */
    public function getPengumuman($tahun = null, $kategoriId = null)
    {
        $cacheKey = "bebras_pengumuman_{$tahun}_{$kategoriId}";
        
        return Cache::remember($cacheKey, 1800, function () use ($tahun, $kategoriId) {
            try {
                // Use /pengumuman/hasil/{tahun} endpoint
                if (!$tahun) {
                    return [];
                }
                
                $url = "{$this->apiUrl}/pengumuman/hasil/{$tahun}";
                $response = Http::timeout(10)->get($url);
                
                if ($response->successful()) {
                    $responseData = $response->json();
                    $hasilPengumuman = $responseData['data']['hasil_pengumuman'] ?? [];
                    
                    // Add tahun to each item since API doesn't include it
                    $hasilPengumuman = array_map(function($item) use ($tahun) {
                        $item['tahun'] = $tahun;
                        return $item;
                    }, $hasilPengumuman);
                    
                    // Filter by kategori if specified
                    if ($kategoriId) {
                        $hasilPengumuman = array_filter($hasilPengumuman, function($item) use ($kategoriId) {
                            $kategori = $item['kategori'] ?? null;
                            
                            // Handle string kategori
                            if (is_string($kategori)) {
                                return $kategori == $kategoriId;
                            }
                            // Handle object/array kategori
                            elseif (is_array($kategori)) {
                                return isset($kategori['id']) && $kategori['id'] == $kategoriId;
                            }
                            
                            return false;
                        });
                        return array_values($hasilPengumuman);
                    }
                    
                    return $hasilPengumuman;
                }
                
                Log::warning('Failed to fetch pengumuman from Bebras API', [
                    'status' => $response->status(),
                    'tahun' => $tahun,
                    'url' => $url ?? null
                ]);
                
                return [];
            } catch (\Exception $e) {
                Log::error('Error fetching pengumuman from Bebras API', [
                    'error' => $e->getMessage(),
                    'tahun' => $tahun,
                    'kategori_id' => $kategoriId
                ]);
                return [];
            }
        });
    }

    /**
     * Get detail pengumuman by ID
     * Note: Based on /pengumuman/hasil/{tahun} response structure
     */
    public function getPengumumanDetail($id)
    {
        $cacheKey = "bebras_pengumuman_detail_{$id}";
        
        return Cache::remember($cacheKey, 1800, function () use ($id) {
            try {
                // Try to get from pengumuman list across all years
                $years = $this->getYears();
                
                foreach ($years as $tahun) {
                    $response = Http::timeout(10)->get("{$this->apiUrl}/pengumuman/hasil/{$tahun}");
                    
                    if ($response->successful()) {
                        $responseData = $response->json();
                        $hasilPengumuman = $responseData['data']['hasil_pengumuman'] ?? [];
                        
                        foreach ($hasilPengumuman as $item) {
                            if ($item['id'] == $id) {
                                // Add tahun to item since API doesn't include it
                                $item['tahun'] = $tahun;
                                return $item;
                            }
                        }
                    }
                }
                
                Log::warning('Pengumuman detail not found', [
                    'id' => $id
                ]);
                
                return null;
            } catch (\Exception $e) {
                Log::error('Error fetching pengumuman detail from Bebras API', [
                    'error' => $e->getMessage(),
                    'id' => $id
                ]);
                return null;
            }
        });
    }

    /**
     * Get download URL for pengumuman
     */
    public function getDownloadUrl($id)
    {
        return "{$this->apiUrl}/pengumuman/download/{$id}";
    }

    /**
     * Clear all cache
     */
    public function clearCache()
    {
        Cache::forget('bebras_years');
        Cache::forget('bebras_categories');
        
        // Clear pengumuman cache (might need more sophisticated approach in production)
        foreach (range(2020, now()->year) as $year) {
            Cache::forget("bebras_pengumuman_{$year}_");
        }
    }
}
