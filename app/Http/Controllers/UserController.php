<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;

class UserController extends Controller
{
    public function exportExcel()
    {
        return Excel::download(new UserExport, 'rekap-data-siswa.xlsx');
    }

    /**
     * Display a listing of the resource.
     * php artisan migrate untuk
     * fungsi where untuk
     */
    public function index(Request $request)
    {
        //compact() => membuat array yang berisi variabel dan nilainya, lalu melewatkannya ke view
        $users = User::where('name', 'LIKE' , '%'.$request->search_data. '%')->orderBy('name', 'ASC')->simplePaginate(5);
        return view('user.user', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //memvalidasi data
        $request->validate([
            'name' => "required",
            'email' => "required|email|unique:users,email",
            'role' => "required",
            'password' => "nullable",
        ], [
            'name.required' => 'Nama Pengguna harus diisi!',
            'email.required' => 'Email Pengguna harus diisi!',
            'role.required' => 'Role Pengguna harus diisi!',
        ]);

        $User = User::create([
            'name' => $request->name,
            'email' => $request->email,
            //bcrypy() => untuk enkripsi password
            'password' => bcrypt($request->password),
            'role' => $request->role
        ]);
        if ($User) {
            return redirect()->back()->with('success', 'Berhasil menambahkan data user');
        } else {
            return redirect()->back()->with('failed', 'Gagal menambahkan data user');
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
        //first() : mengambil data pertama
        // where => mengambil data spesifik
        $user = User::where('id', $id)->first();
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            // $id diambil dari route
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'password' => 'nullable', // Password bersifat opsional
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        // Redirect setelah update berhasil
        return redirect()->route('user.data')->with('success', 'Berhasil mengubah data Pengguna!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleteData = User::where('id', $id)->delete();

        if ($deleteData) {
            return redirect()->back()->with('success', 'Berhasil Menghapus Data');
        } else {
            return redirect()->back()->with('failed', 'Gagal Menghapus Data');
        }
    }
}
