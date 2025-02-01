<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{

    public function kelolaAdmin()
    {
        $title = "Kelola Admin";
        $allAdmin = User::where('role', '=', 'admin')->get();

        return view('pages.admin.kelola-admin', compact('title', 'allAdmin'));
    }


    public function simpanAdmin(Request $request)
    {
        $validatedData = $request->validate(['name' => 'required', 'password' => 'required', 'email' => 'required|email|unique:users,email']);

        $validatedData['role'] = 'admin';
        User::create($validatedData);
        return redirect()->route('kelola-admin')->with('swal', ['icon' => 'success', 'title' => 'Success', 'message' => 'Data berhasil ditambah']);
    }

    public function editAdmin(User $admin)
    {
        $title = 'Edit Admin';
        return view('pages.admin.edit-admin', compact('title', 'admin'));
    }

    public function prosesEditAdmin(Request $request, User $Admin)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'email' =>
            ['required', 'email', Rule::unique('users', 'email')->ignore($Admin->id)],
            'password' => 'confirmed'
        ]);

        if ($request->filled('password')) {
            $Admin->password = $validatedData['password'];
        } else {
            unset($validatedData['password']);
        }


        $Admin->update($validatedData);
        return redirect()->route('kelola-admin')->with('swal', ['icon' => 'success', 'title' => 'Success', 'message' => 'Data berhasil diubah']);
    }

    public function prosesEditAkunAdmin(Request $request)
    {
        $Admin = Auth::user();
        $validatedData = $request->validate([
            'name' => 'required',
            'email' =>
            ['required', 'email', Rule::unique('users', 'email')->ignore($Admin->id)],
        ]);
        $Admin->update($validatedData);
        return redirect()->route('kelola-admin')->with('swal', ['icon' => 'success', 'title' => 'Success', 'message' => 'Data berhasil diubah']);
    }





    public function hapusAdmin(User $admin)
    {
        $admin->delete();

        return redirect()->back()->with('swal', ['icon' => 'success', 'title' => 'Success', 'message' => 'Data berhasil dihapus']);
    }



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

    public function editInfoAkun()
    {
        $title = 'Edit Akun';
        $admin = Auth::user();
        return view('pages.admin.edit-akun-admin', compact('title', 'admin'));
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

        return redirect()->route('dashboard')->with('swal', ['icon' => 'success', 'title' => 'Success', 'message' => 'Passowrd berhasil diubah']);
    }


    public function kelolaPengguna()
    {
        $title = 'Kelola User';
        $Users = User::where('role', '=', 'user')->get();
        return view('pages.admin.kelola-user', compact('title', 'Users'));
    }

    public function ubahPasswordPengguna(User $user)
    {
        $title = "Ubah Password {$user->name}";
        return view('pages.admin.ubah-password-pengguna', compact('title', 'user'));
    }


    public function prosesUbahPasswordPengguna(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update($validatedData);
        return redirect()->route('kelola-pengguna')->with('swal', ['icon' => 'success', 'title' => 'Success', 'message' => 'Passowrd berhasil diubah']);
    }

    public function hapusPengguna(User $user)
    {
        $user->delete();
        return redirect()->back()->with('swal', ['icon' => 'success', 'title' => 'Success', 'message' => 'Data berhasil dihapus']);
    }
}
