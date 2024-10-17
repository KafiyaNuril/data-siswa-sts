<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $siswa = Siswa::where('name', 'LIKE' , '%'.$request->search_data. '%')->orderBy('name', 'ASC')->simplePaginate(5);
        return view('Data.data', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rayons = [
            'Ciawi 1', 'Ciawi 2', 'Ciawi 3', 'Ciawi 4', 'Ciawi 5', 'Ciawi 6',
            'Cibedug 1', 'Cibedug 2', 'Cibedug 3', 'Cibedug 4',
            'Cisarua 1', 'Cisarua 2', 'Cisarua 3', 'Cisarua 4', 'Cisarua 5', 'Cisarua 6', 'Cisarua 7',
            'Cicurug 1', 'Cicurug 2', 'Cicurug 3', 'Cicurug 4', 'Cicurug 5',
            'Cicurug 6', 'Cicurug 7', 'Cicurug 8', 'Cicurug 9', 'Cicurug 10',
            'Wikrama 1', 'Wikrama 2', 'Wikrama 3', 'Wikrama 4', 'Wikrama 5',
            'Tajur 1', 'Tajur 2', 'Tajur 3', 'Tajur 4', 'Tajur 5', 'Tajur 6',
        ];

        return view('Data.tambah', compact('rayons'));
        // return view('Data.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required',
            'nis' => 'required|numeric|unique:siswa,nis',
            'email' => 'required',
            'rayon' => 'required',
        ], [
            'name.required' => 'Nama siswa harus diisi!',
            'nis.required' => 'NIS siswa harus diisi!',
            'email.required' => 'Email siswa harus diisi!',
            'rayon.required' => 'rayon siswa harus diisi!',
            'nis.unique' => 'NIS siswa sudah ada!',
        ]);

        $tambahData = Siswa::create([
            'name' => $request->name,
            'nis' => $request->nis,
            'email' => $request->email,
            'rayon' => $request->rayon,
        ]);
        //redirect() => untuk mengalihkan pengguna ke halaman atau tindakan lain.
        if ($tambahData) {
            return redirect()->back()->with('success', 'Berhasil Menambahkan Data Siswa');
        } else {
            return redirect()->back()->with('failed', 'Gagal Menanmbahkan Data Siswa');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $rayons = [
            'Ciawi 1', 'Ciawi 2', 'Ciawi 3', 'Ciawi 4', 'Ciawi 5', 'Ciawi 6',
            'Cibedug 1', 'Cibedug 2', 'Cibedug 3', 'Cibedug 4',
            'Cisarua 1', 'Cisarua 2', 'Cisarua 3', 'Cisarua 4', 'Cisarua 5', 'Cisarua 6', 'Cisarua 7',
            'Cicurug 1', 'Cicurug 2', 'Cicurug 3', 'Cicurug 4', 'Cicurug 5',
            'Cicurug 6', 'Cicurug 7', 'Cicurug 8', 'Cicurug 9', 'Cicurug 10',
            'Wikrama 1', 'Wikrama 2', 'Wikrama 3', 'Wikrama 4', 'Wikrama 5',
            'Tajur 1', 'Tajur 2', 'Tajur 3', 'Tajur 4', 'Tajur 5', 'Tajur 6',
        ];
        $siswa = Siswa::where('id', $id)->first();
        return view('Data.edit', compact('siswa', 'rayons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'nis' => 'required|numeric',
            'email' => 'required',
            'rayon' => 'required',
        ]);

        Siswa::where('id', $id)->update([
            'name' => $request->name,
            'nis' => $request->nis,
            'email' => $request->email,
            'rayon' => $request->rayon,
        ]);
        //redirect() => untuk mengalihkan pengguna ke halaman atau tindakan lain.
        return redirect()->route('siswa.data')->with('success', 'Berhasil Memperbarui Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteData = Siswa::where('id', $id)->delete();

        if ($deleteData) {
            return redirect()->back()->with('success', 'Berhasil Menghapus Data');
        } else {
            return redirect()->back()->with('failed', 'Gagal Menghapus Data');
        }
    }
}
