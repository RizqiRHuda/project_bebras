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
        return in_array($this->platform, ['uploaded', 'google_sheets']);
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
        // If external link (Google Sheets, OneDrive), return file_url
        if (!empty($this->file_url)) {
            return $this->file_url;
        }

        // If uploaded file, get via API
        if ($this->is_uploaded) {
            return config('services.bebras_admin.api_url', 'http://127.0.0.1:8000/api') 
                   . '/files/view/' . $this->id;
        }

        return null;
    }

    /**
     * Get embed URL for Google Sheets
     */
    public function getEmbedUrlAttribute()
    {
        if ($this->platform === 'google_sheets' && !empty($this->file_url)) {
            // Convert Google Sheets view URL to embed URL
            if (strpos($this->file_url, '/edit') !== false) {
                return str_replace('/edit', '/preview', $this->file_url);
            }
            return $this->file_url;
        }
        return null;
    }
}
