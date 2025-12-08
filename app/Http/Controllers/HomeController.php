<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $berita = DB::table('berita')
            ->where('status', 'published')
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        return view('pages.home', compact('berita'));
    }

    public function tampilBerita($slug)
    {
        $berita = DB::table('berita')
            ->join('users', 'berita.user_id', '=', 'users.id')
            ->select('berita.*', 'users.name as user_name')
            ->where('berita.slug', $slug)
            ->first();

        abort_if(! $berita, 404);

   
        $prev = DB::table('berita')
            ->where('id', '<', $berita->id)
            ->orderBy('id', 'desc')
            ->first();
            
        $next = DB::table('berita')
            ->where('id', '>', $berita->id)
            ->orderBy('id', 'asc')
            ->first();

        return view('pages.berita.detail_berita', compact('berita', 'prev', 'next'));
    }

}
