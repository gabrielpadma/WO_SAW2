<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Application;
use App\Models\Pengumuman;
use App\Models\Periode;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

class Pelanggan extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('checkAuth', ['edit']),
        ];
    }


    public function portfolio()
    {

        $breadcrumbs = [['link' => route('user.index'), 'text' => 'Home'], ['text' => 'Portfolio']];
        $title = 'Portfolio';
        $Portfolios = Portfolio::with(['portfolio_details'])->get();
        $Testimonials = Testimonial::get();

        return view('pages.user.portfolio', compact('breadcrumbs', 'title', 'Portfolios', 'Testimonials'));
    }

    public function aboutUs()
    {

        $breadcrumbs = [['link' => route('user.index'), 'text' => 'Home'], ['text' => 'About-Us']];
        $title = 'About Us';
        $AboutUs = AboutUs::first();
        $Testimonials = Testimonial::get();
        return view('pages.user.about-us', compact('breadcrumbs', 'title', 'AboutUs', 'Testimonials'));
    }


    public function ourServices()
    {
        $Service = Service::first();
        $title = 'Layanan Kami';
        return view('pages.user.our-services', compact('title', 'Service'));
    }



    public function lowongan()
    {
        $title = 'Lowongan Pekerjaan';
        // $vacancies = Vacancy::whereHas('periode', function ($query) {
        //     $query->where('status', '1');
        // })->with(['periode'])->get();

        $periodeVacancies = Periode::where('status', '1')->with('vacancy')->get();

        $userApplications = Auth::user()?->applications?->pluck('periode_id')->toArray();
        return view('pages.user.lowongan', compact('title', 'periodeVacancies', 'userApplications'));
    }



    public function daftarLamaran(Vacancy $vacancy)
    {
        $title = 'Daftar Lamaran';
        return view('pages.user.daftar-lowongan', compact('title', 'vacancy'));
    }



    public function portfolioDetail(Portfolio $portfolio)
    {

        $breadcrumbs = [['link' => route('user.index'), 'text' => 'Home'], ['text' => 'Portfolio'], ['text' => 'Portfolio Detail']];
        $title = 'Portfolio';
        $portfolio = $portfolio->load(['portfolio_details']);

        return view('pages.user.portfolio-detail', compact('breadcrumbs', 'title', 'portfolio'));
    }




    public function simpanDataDiri(Request $request)
    {
        $validatedData = $request->validate([
            'tanggal_lahir' => 'required|date',
            'tempat_lahir' => 'required|string',
            'email' => 'required|email',
            'name' => 'required',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|string',
            'status_pernikahan' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'no_hp' => 'required',
            'pendidikan_terakhir' => 'required|string',
            'jurusan' => 'required|string',
            'agama' => 'required|string',
            'foto' => 'nullable|mimes:pdf,jpeg,png,jpg|max:1048',
            'lampiran_ijazah' => 'nullable|mimes:pdf,jpeg,png,jpg|max:1048',
            'lampiran_cv' => 'nullable|mimes:pdf,jpeg,png,jpg|max:1048',
            'lampiran_keterangan_sehat' => 'nullable|mimes:pdf,jpeg,png,jpg|max:1048',
            'lampiran_skck' => 'nullable|mimes:pdf,jpeg,png,jpg|max:1048',
            'lampiran_ktp' => 'nullable|mimes:pdf,jpeg,png,jpg|max:1048',
        ]);

        $User = Auth::user();

        // Simpan file baru atau gunakan file lama
        if ($request->hasFile('foto')) {
            $filePath = $request->file('foto')->store('foto-lamaran', 'public');
            $validatedData['foto'] = $filePath;
        } else {
            $validatedData['foto'] = $User->foto; // Gunakan file lama
        }

        if ($request->hasFile('lampiran_ijazah')) {
            $filePath = $request->file('lampiran_ijazah')->store('lampiran/lampiran-ijazah', 'public');
            $validatedData['lampiran_ijazah'] = $filePath;
        } else {
            $validatedData['lampiran_ijazah'] = $User->lampiran_ijazah;
        }

        if ($request->hasFile('lampiran_cv')) {
            $filePath = $request->file('lampiran_cv')->store('lampiran/lampiran-cv', 'public');
            $validatedData['lampiran_cv'] = $filePath;
        } else {
            $validatedData['lampiran_cv'] = $User->lampiran_cv;
        }

        if ($request->hasFile('lampiran_keterangan_sehat')) {
            $filePath = $request->file('lampiran_keterangan_sehat')->store('lampiran/lampiran-keterangan-sehat', 'public');
            $validatedData['lampiran_keterangan_sehat'] = $filePath;
        } else {
            $validatedData['lampiran_keterangan_sehat'] = $User->lampiran_keterangan_sehat;
        }

        if ($request->hasFile('lampiran_skck')) {
            $filePath = $request->file('lampiran_skck')->store('lampiran/lampiran-skck', 'public');
            $validatedData['lampiran_skck'] = $filePath;
        } else {
            $validatedData['lampiran_skck'] = $User->lampiran_skck;
        }

        if ($request->hasFile('lampiran_ktp')) {
            $filePath = $request->file('lampiran_ktp')->store('lampiran/lampiran-ktp', 'public');
            $validatedData['lampiran_ktp'] = $filePath;
        } else {
            $validatedData['lampiran_ktp'] = $User->lampiran_ktp;
        }

        // Update data
        $updateStatus = $User->update($validatedData);

        if ($updateStatus) {
            return redirect()->back()->with('swal', ['icon' => 'success', 'title' => 'Success', 'message' => 'Ubah akun berhasil']);
        } else {
            return redirect()->back()->with('swal', ['icon' => 'error', 'title' => 'Error', 'message' => 'Ubah akun gagal']);
        }
    }



    public function simpanLamaran(Request $request, Periode $periode)
    {

        $missingFields = [];
        $periode->load(['vacancy']);


        if (!Auth::user()->tanggal_lahir) {
            $missingFields[] = 'Tanggal Lahir';
        }
        if (!Auth::user()->tempat_lahir) {
            $missingFields[] = 'Tempat Lahir';
        }
        if (!Auth::user()->alamat) {
            $missingFields[] = 'Alamat';
        }
        if (!Auth::user()->jenis_kelamin) {
            $missingFields[] = 'Jenis Kelamin';
        }

        if (!Auth::user()->status_pernikahan) {
            $missingFields[] = 'Status Pernikahan';
        }
        if (!Auth::user()->pendidikan_terakhir) {
            $missingFields[] = 'Pendidikan Terakhir';
        }

        if (!Auth::user()->foto) {
            $missingFields[] = 'Foto';
        }
        if (!Auth::user()->lampiran_ijazah) {
            $missingFields[] = 'Lampiran Ijazah';
        }
        if (!Auth::user()->lampiran_cv) {
            $missingFields[] = 'Lampiran CV';
        }
        if (!Auth::user()->lampiran_keterangan_sehat) {
            $missingFields[] = 'Lampiran Keterangan Sehat';
        }
        if (!Auth::user()->lampiran_skck) {
            $missingFields[] = 'Lampiran SKCK';
        }
        if (!Auth::user()->lampiran_ktp) {
            $missingFields[] = 'Lampiran KTP';
        }


        if (count($missingFields) > 0) {

            return redirect()->route('data-diri')->with('swal', [
                'message' =>  'Data diri belum lengkap: ' . implode(', ', $missingFields),
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }



        $validatedData['user_id'] = $request->user()->id;
        $validatedData['vacancy_id'] = $periode->vacancy->id;
        $validatedData['periode_id'] = $periode->id;
        $validatedData['status'] = 'pending';


        $Application = Application::create($validatedData);
        if ($Application) {
            return redirect('/')->with('swal', [
                'message' => 'Data berhasil ditambahkan',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect('/')->with('swal', [
                'message' => 'Data gagal ditambahkan',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }



    public function pengumuman(Request $request)
    {
        $user = $request->user()->load(['applications.vacancy']);
        // dd($user);

        $title = 'Penumuman seleksi ' . $user->name;
        return view('pages.user.pengumuman', compact('title', 'user'));
    }



    public function dataDiri()
    {
        $title = 'Data Diri';
        $breadcrumbs = [['link' => route('user.index'), 'text' => 'Home'], ['text' => 'Data Diri']];
        $User = Auth::user();
        return view('pages.user.data-diri', compact('breadcrumbs', 'title', 'User'));
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


    public function detailPengumuman(Request $request, Application $application)
    {

        $application->load(['vacancy']);
        $title = 'Detail Pengumuman ' . $application->vacancy->judul_lowongan;
        $pengumuman = Pengumuman::first();

        return view('pages.user.detail_pengumuman', compact('title', 'application', 'pengumuman'));
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
