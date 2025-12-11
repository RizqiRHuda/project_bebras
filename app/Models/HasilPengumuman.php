<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPengumuman extends Model
{
    use HasFactory;

    protected $table = 'hasil_pengumuman';

    protected $fillable = [
        'id_kategori',
        'id_tahun',
        'description',
        'platform',
        'file_path',
        'file_url',
        'embed_url',
        'is_uploaded',
    ];

    /**
     * Relasi ke kategori pengumuman
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriPengumuman::class, 'id_kategori');
    }

    /**
     * Relasi ke tahun pengumuman
     */
    public function tahun()
    {
        return $this->belongsTo(TahunPengumuman::class, 'id_tahun');
    }

    /**
     * Check if file is uploaded (stored locally)
     */
    public function getIsUploadedAttribute()
    {
        return $this->platform === 'uploaded' && !empty($this->file_path);
    }

    /**
     * Check if file can be embedded
     */
    public function getCanEmbedAttribute()
    {
        return in_array($this->platform, ['uploaded', 'google_sheets', 'excel_online']);
    }

    /**
     * Get download URL via API
     */
    public function getDownloadUrlAttribute()
    {
        if ($this->is_uploaded) {
            return config('services.bebras_admin.api_url', 'http://127.0.0.1:8000/api') 
                   . '/files/download/' . $this->id;
        }
        return null;
    }

    /**
     * Get view URL (for embed or direct view)
     */
    public function getViewUrlAttribute()
    {
        // Untuk platform eksternal (Google Sheets, OneDrive, Excel Online)
        // Gunakan embed_url dari database
        if (in_array($this->platform, ['google_sheets', 'onedrive', 'excel_online'])) {
            // Gunakan embed_url dari database (bukan accessor getEmbedUrlAttribute)
            $embedUrl = $this->attributes['embed_url'] ?? null;
            if (!empty($embedUrl)) {
                return $embedUrl;
            }
        }

        // Untuk file yang di-upload, akses via API
        if ($this->is_uploaded && $this->platform === 'uploaded') {
            return config('services.bebras_admin.api_url', 'http://127.0.0.1:8000/api') 
                   . '/files/view/' . $this->id;
        }

        return null;
    }

    /**
     * Get embed URL for Google Sheets and Excel Online
     * Note: embed_url sudah tersimpan di database, langsung return
     */
    public function getEmbedUrlAttribute()
    {
        // Return embed_url dari database untuk platform eksternal
        if (in_array($this->platform, ['google_sheets', 'excel_online', 'onedrive'])) {
            return $this->attributes['embed_url'] ?? null;
        }
        
        return null;
    }
}
