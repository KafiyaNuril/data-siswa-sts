<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        // $siswa = Siswa::orderBy('name', 'ASC')->get();
        // return view('index', compact('siswa'));
        // Menghitung total siswa
        $totalSiswa = Siswa::count();

        // Mengambil siswa terbaru (misalnya 5 siswa terakhir)
        $recentSiswa = Siswa::latest()->take(5)->get();

        // Kirim data ke view
        return view('index', compact('totalSiswa', 'recentSiswa'));
    }
}
