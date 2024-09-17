<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Pelanggan extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $breadcrumbs = [['link' => route('user.index'), 'text' => 'Home'], ['text' => 'Daftar Akun']];
        $title = 'Daftar Title';

        return view('pages.user.daftar_akun', compact('breadcrumbs', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Lakukan validasi
        $validatedData = $request->validate([
            'name' => 'required|string|max:100|min:3',
            'email_daftar_akun' => 'required|email|unique:users,email|max:255',
            'password_daftar_akun' => 'required|string|min:8|confirmed',
        ]);


        $userData = [
            'name' => $validatedData['name'],
            'email' => $validatedData['email_daftar_akun'],
            'password' => Hash::make($validatedData['password_daftar_akun']),
            'role' => 'user'
        ];

        $user = User::create($userData);

        if (!$user) {
            return redirect()->route('user.index')->with('swal', ['icon' => 'success', 'title' => 'Success', 'message' => 'Gagal Mendaftarkan Akun']);
        }

        // Redirect atau kembalikan respons
        return redirect()->route('user.index')->with('swal', ['icon' => 'success', 'title' => 'Success', 'message' => 'Daftar akun berhasil']);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        dd($user);

        $title = 'Ubah Password';
        $breadcrumbs = [['link' => route('user.index'), 'text' => 'Home'], ['text' => 'Ubah Password']];

        return view('pages.user.daftar_akun', compact('breadcrumbs', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
