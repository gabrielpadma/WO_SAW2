<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class Pelanggan extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('checkAuth', ['store', 'edit']),
        ];
    }


    public function portfolio()
    {

        $breadcrumbs = [['link' => route('user.index'), 'text' => 'Home'], ['text' => 'Portfolio']];
        $title = 'Portfolio';
        $Portfolios = Portfolio::with(['portfolio_details'])->get();

        return view('pages.user.portfolio', compact('breadcrumbs', 'title', 'Portfolios'));
    }


    public function portfolioDetail(Portfolio $portfolio)
    {

        $breadcrumbs = [['link' => route('user.index'), 'text' => 'Home'], ['text' => 'Portfolio'], ['text' => 'Portfolio Detail']];
        $title = 'Portfolio';
        $portfolio = $portfolio->load(['portfolio_details']);

        return view('pages.user.portfolio-detail', compact('breadcrumbs', 'title', 'portfolio'));
    }


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

        $title = 'Ubah Password';
        $breadcrumbs = [['link' => route('user.index'), 'text' => 'Home'], ['text' => 'Ubah Password']];

        return view('pages.user.ubah_password', compact('breadcrumbs', 'title'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'password_daftar_akun' => 'required|string|min:8|confirmed',
            'old_password' => 'required'
        ], [

            'password_daftar_akun.required' => 'Password harus diisi.',
            'password_daftar_akun.min' => 'Password harus memiliki minimal 8 karakter.',
            'password_daftar_akun.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);


        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak sesuai.']);
        }


        $user->password = Hash::make($request->input('password_daftar_akun'));
        $user->update();

        return redirect('/')->with('swal', ['icon' => 'success', 'title' => 'Success', 'message' => 'Passowrd berhasil diubah']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
