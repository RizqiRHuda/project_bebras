<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPengumuman extends Model
{
    use HasFactory;

    protected $table = 'kategori_pengumuman';

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    /**
     * Relasi ke hasil pengumuman
     */
    public function hasilPengumuman()
    {
        return $this->hasMany(HasilPengumuman::class, 'kategori_id');
    }
}
