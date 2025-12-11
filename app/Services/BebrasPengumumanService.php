<?php

namespace App\Services;

use App\Models\HasilPengumuman;
use App\Models\KategoriPengumuman;
use App\Models\TahunPengumuman;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class BebrasPengumumanService
{
    /**
     * Get daftar tahun pengumuman dari database
     */

    public function getYears()
    {
        try {
            return TahunPengumuman::orderBy('tahun', 'desc')
                ->pluck('tahun')
                ->toArray();
        } catch (\Exception $e) {
            Log::error('Error fetching years from database', [
                'error' => $e->getMessage()
            ]);
            return [];
        }
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
        try {
            // Use /pengumuman/hasil/{tahun} endpoint
            if (!$tahun) {
                return [];
            }
            
            $query = HasilPengumuman::with(['kategori', 'tahun']);
            
            // Filter by tahun
            if ($tahun) {
                $query->whereHas('tahun', function ($q) use ($tahun) {
                    $q->where('tahun', $tahun);
                });
            }
            
            // Filter by kategori
            if ($kategoriId) {
                $query->where('id_kategori', $kategoriId);
            }
            
            $results = $query->orderBy('created_at', 'desc')->get();
            
            // Transform to array format untuk compatibility dengan view
            return $results->map(function ($item) {
                return [
                    'id' => $item->id,
                    'kategori' => [
                        'id' => $item->kategori->id,
                        'nama' => $item->kategori->nama_kategori,
                        'deskripsi' => $item->kategori->deskripsi,
                    ],
                    'tahun' => $item->tahun->tahun,
                    'description' => $item->description,
                    'platform' => $item->platform,
                    'is_uploaded' => $item->is_uploaded,
                    'can_embed' => $item->can_embed,
                    'view_url' => $item->view_url,
                    'download_url' => $item->download_url,
                    'embed_url' => $item->embed_url,
                ];
            })->toArray();
            
        } catch (\Exception $e) {
            Log::error('Error fetching pengumuman from database', [
                'error' => $e->getMessage(),
                'tahun' => $tahun,
                'kategori_id' => $kategoriId
            ]);
            return [];
        }
    }

    /**
     * Get detail pengumuman by ID
     * Note: Based on /pengumuman/hasil/{tahun} response structure
     */
    public function getPengumumanDetail($id)
    {
        try {
            $item = HasilPengumuman::with(['kategori', 'tahun'])->find($id);
            
            if (!$item) {
                Log::warning('Pengumuman detail not found', ['id' => $id]);
                return null;
            }
            
            // Transform to array format
            return [
                'id' => $item->id,
                'kategori' => [
                    'id' => $item->kategori->id,
                    'nama' => $item->kategori->nama_kategori,
                    'deskripsi' => $item->kategori->deskripsi,
                ],
                'tahun' => $item->tahun->tahun,
                'description' => $item->description,
                'platform' => $item->platform,
                'is_uploaded' => $item->is_uploaded,
                'can_embed' => $item->can_embed,
                'view_url' => $item->view_url,
                'download_url' => $item->download_url,
                'embed_url' => $item->embed_url,
            ];
            
        } catch (\Exception $e) {
            Log::error('Error fetching pengumuman detail from database', [
                'error' => $e->getMessage(),
                'id' => $id
            ]);
            return null;
        }
    }

}
