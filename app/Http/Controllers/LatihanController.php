<?php

namespace App\Http\Controllers;

use App\Models\Latihan;
use Illuminate\Http\Request;

class LatihanController extends Controller
{
    public function index()
    {
        $latihan = Latihan::all();
        return view('pages.latihan.index', [
            'latihan' => $latihan
        ]);
    }
}
