<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        return view('pages.user.index');
    }


    public function authenticate(Request $request)
    {
        $routeName = $request->route()->getName();
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($routeName == 'loginUser') {
                return redirect()->intended('/')->with('login', ['message' => 'Login Success', 'icon' => 'success', 'title' => 'Login berhasil']);
            } else {
                return redirect()->intended('/dashboard')->with('login', ['message' => 'Login Success', 'icon' => 'success', 'title' => 'Login berhasil']);
            }
        }
        return back()->with('login', ['message' => 'Email atau password anda salah !!!', 'icon' => 'error', 'title' => 'Login gagal']);
    }
}
