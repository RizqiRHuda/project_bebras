<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunPengumuman extends Model
{
    use HasFactory;

    protected $table = 'tahun_pengumuman';

    protected $fillable = [
        'tahun',
    ];

    /**
     * Relasi ke hasil pengumuman
     */
    public function hasilPengumuman()
    {
        return $this->hasMany(HasilPengumuman::class, 'tahun_id');
    }
}
