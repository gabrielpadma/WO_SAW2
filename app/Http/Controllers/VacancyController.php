<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Lowongan';
        $allVacancies = Vacancy::all();
        return view('pages.vacancy.index', compact('title', 'allVacancies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul_lowongan' => 'required|string|max:255',
            'deskripsi_lowongan' => 'required|string',
            'berkas_persyaratan' => 'mimes:pdf,jpeg,png,jpg|max:2048',
        ], [
            // Custom pesan kesalahan
            'judul_lowongan.required' => 'Judul lowongan wajib diisi.',
            'deskripsi_lowongan.required' => 'Deskripsi lowongan wajib diisi.',
            'berkas_persyaratan.required' => 'Lampiran wajib diunggah.',
            'berkas_persyaratan.mimes' => 'Lampiran harus berupa file PDF, JPG, JPEG, atau PNG.',
            'berkas_persyaratan.max' => 'Ukuran file maksimal 2MB.',
        ]);


        try {
            if ($request->hasFile('berkas_persyaratan')) {
                $filePath = $request->file('berkas_persyaratan')->store('berkas_persyaratan', 'public');
                $validatedData['berkas_persyaratan'] = $filePath;
            }

            $Vacancy = Vacancy::create($validatedData);
            if ($Vacancy) {

                $validatedPeriode = $request->validate(['tanggal_periode' => ['required', 'date_format:Y-m', Rule::unique('periode')->where(function ($query) use ($Vacancy, $request) {
                    $query->where('vacancy_id', $Vacancy->id)->where('tanggal_periode', $request->input('tanggal_periode') . '-01');
                })]]);
                $validatedPeriode['status'] = 0;
                $validatedPeriode['vacancy_id'] = $Vacancy->id;
                $validatedPeriode['tanggal_periode'] = Carbon::createFromFormat('Y-m', $validatedPeriode['tanggal_periode'])->startOfMonth();
                Periode::create($validatedPeriode);


                return redirect()->route('vacancy.index')->with('swal', [
                    'message' => 'Data berhasil ditambahkan',
                    'icon' => 'success',
                    'title' => 'Success'
                ]);
            } else {
                return redirect()->route('vacancy.index')->with('swal', [
                    'message' => 'Data gagal ditambahkan',
                    'icon' => 'error',
                    'title' => 'Error'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('swal', ['message' => "Data gagal ditambahkan {$e->getMessage()}", 'icon' => 'error', 'title' => 'Error']);
        }
    }

    /**
     * Display the specified resource. untuk kelola PERIODE
     */
    public function show(Vacancy $vacancy)
    {
        $title = "Periode Lowongan {$vacancy->name}";
        return view('pages.vacancy.show', compact('title', 'vacancy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vacancy $vacancy)
    {
        $title = 'Edit Lowongan';
        $vacancy = $vacancy->load(['periode']);
        return view('pages.vacancy.edit', compact('title', 'vacancy'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vacancy $vacancy)
    {


        $validator = Validator::make($request->all(), [
            'judul_lowongan' => 'required|string|max:255',
            'deskripsi_lowongan' => 'required|string',
            'berkas_persyaratan' => 'nullable|mimes:pdf,jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator)
                ->with('swal', [
                    'message' => 'Data gagal diupdate. Validasi gagal.',
                    'icon' => 'error',
                    'title' => 'Error'
                ]);
        }


        $validatedData = $validator->validated();

        if ($request->hasFile('berkas_persyaratan')) {
            if ($vacancy->berkas_persyaratan && Storage::disk('public')->exists($vacancy->berkas_persyaratan)) {
                Storage::disk('public')->delete($vacancy->berkas_persyaratan);
            }

            $filePath = $request->file('berkas_persyaratan')->store('berkas_persyaratan', 'public');
            $validatedData['berkas_persyaratan'] = $filePath;
        } else {

            unset($validatedData['berkas_persyaratan']);
        }

        $condition = $vacancy->update($validatedData);

        if ($condition) {
            return redirect()->route('vacancy.index')->with('swal', [
                'message' => 'Data berhasil diupdate',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->back()->withInput()->with('swal', [
                'message' => 'Data gagal diupdate',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vacancy $vacancy)
    {
        if ($vacancy->berkas_persyaratan && Storage::disk('public')->exists($vacancy->berkas_persyaratan)) {
            Storage::disk('public')->delete($vacancy->berkas_persyaratan);
        }
        if ($vacancy->delete()) {
            return redirect()->route('vacancy.index')->with('swal', [
                'message' => 'Data berhasil dihapus',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('vacancy.index')->with('swal', [
                'message' => 'Data gagal dihapus',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }
}
