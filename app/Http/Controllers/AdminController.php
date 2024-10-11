<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function index()
    {
        $title = 'Dashboard';
        return view('pages.admin.dashboard', compact('title'));
    }

    public function ubahPassword()
    {
        $title = 'Ubah Password';
        return view('pages.admin.ubahPassword', compact('title'));
    }

    public function prosesUbahPassword(Request $request, User $user)
    {

        $request->validate([
            'new_password' => 'required|string|min:8|confirmed',
            'old_password' => 'required',
        ], [
            'new_password.required' => 'Password harus diisi.',
            'new_password.min' => 'Password harus memiliki minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Password lama tidak sesuai.']);
        }


        $user->password = Hash::make($request->input('new_password'));
        $user->update();

        return redirect()->route('ubah-password-admin')->with('swal', ['icon' => 'success', 'title' => 'Success', 'message' => 'Passowrd berhasil diubah']);
    }
}
