<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\HeroPageContent;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\WeddingPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index()
    {
        $title = 'Alucia Wedding Organizer';
        $heroData = HeroPageContent::first();
        $AboutUs = AboutUs::first();
        $Service = Service::first();
        $Testimonials = Testimonial::get();
        $WeddingPackages = WeddingPackage::all()->map(function ($package) {
            $package->features =  json_decode($package->features, true);
            $package->price = number_format($package->price, 0, ',', '.');
            return $package;
        });

        return view('pages.user.index', compact('title', 'heroData', 'AboutUs', 'Service', 'Testimonials', 'WeddingPackages'));
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
    public function authenticateAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role == 'admin') {
                // Redirect ke dashboard admin jika role admin
                return redirect()->intended('admin/dashboard')->with('login', [
                    'message' => 'Login Success',
                    'icon' => 'success',
                    'title' => 'Login berhasil'
                ]);
            } else if (Auth::user()->role == 'user') {
                // Jika bukan admin, logout user dan beri pesan error
                // Auth::logout();
                return back()->with('login', [
                    'message' => 'Akses ditolak! Anda bukan admin.',
                    'icon' => 'error',
                    'title' => 'Login gagal'
                ]);
            }
        }
        return back()->with('login', ['message' => 'Email atau password anda salah !!!', 'icon' => 'error', 'title' => 'Login gagal']);
    }


    public function loginAdmin()
    {
        return view('pages.admin.login');
    }


    public function logout(Request $request)
    {
        $redirectTo = Auth::user()->role == 'admin' ? 'admin/login' : '/';
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect($redirectTo)->with('login', ['message' => 'Logout berhasil', 'icon' => 'success', 'title' => 'Logout berhasil']);
    }
}
