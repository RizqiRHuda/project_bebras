<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class WorkshopController extends Controller
{
    public function index()
{
    $workshopYears = DB::table('tahun_workshop')->orderBy('tahun', 'desc')->get();

    return view('pages.kegiatan.index_workshop', [
        'tahun'        => null,
        'workshops'    => [],
        'workshopYears'=> $workshopYears,
    ]);
}

public function byTahun($slug)
{
    $tahun = DB::table('tahun_workshop')
        ->where('slug', $slug)
        ->first();

    if (! $tahun) {
        abort(404);
    }

    $workshops = DB::table('workshop')
        ->where('id_tahun', $tahun->id)
        ->orderBy('tanggal', 'asc')
        ->get()
        ->map(function ($item) {
            $item->konten = json_decode($item->konten, true); // ← WAJIB!
            return $item;
        });

    $workshopYears = DB::table('tahun_workshop')->orderBy('tahun', 'desc')->get();

    return view('pages.kegiatan.index_workshop', [
        'tahun'         => $tahun,
        'workshops'     => $workshops,
        'workshopYears' => $workshopYears,
    ]);
}


}
