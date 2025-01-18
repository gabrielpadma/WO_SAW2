<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //
    public function index(Request $request)
    {
        $title = 'Dashboard';
        $totalPelamar = Application::all()->count();


        $filter = $request->input('filter', 'today');

        // Query untuk total pelamar berdasarkan filter
        switch ($filter) {
            case 'month':
                $totalPelamar = Application::whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month)
                    ->count();
                break;
            case 'year':
                $totalPelamar = Application::whereYear('created_at', now()->year)->count();
                break;
            default: // 'today'
                $totalPelamar = Application::whereDate('created_at', now()->toDateString())->count();
                break;
        }


        $totalAlternatifBelumDiisi = Application::doesntHave('applicant_scores')->count();
        $totalAlternatifDiisi = Application::has('applicant_scores')->count();
        $statusCounts = Application::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $totalUser = User::all()->count();


        $recentApplicant = Application::with(['user', 'applicant_scores', 'vacancy'])->latest()->take(5)->get();


        return view('pages.admin.dashboard', compact('title', 'totalPelamar', 'filter', 'totalAlternatifBelumDiisi', 'totalAlternatifDiisi', 'statusCounts', 'totalUser', 'recentApplicant'));
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
