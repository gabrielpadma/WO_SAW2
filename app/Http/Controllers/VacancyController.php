<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Lowongan';
        return view('pages.vacancy.index', compact('title'));
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
            'judul_lowongan' => 'required|string|max:255',
            'deskripsi_lowongan' => 'required|string',
            'berkas_persyaratan' => 'required|mimes:pdf,jpeg,png,jpg|max:2048',
        ], [
            // Custom pesan kesalahan
            'judul_lowongan.required' => 'Judul lowongan wajib diisi.',
            'deskripsi_lowongan.required' => 'Deskripsi lowongan wajib diisi.',
            'berkas_persyaratan.required' => 'Lampiran wajib diunggah.',
            'berkas_persyaratan.mimes' => 'Lampiran harus berupa file PDF, JPG, JPEG, atau PNG.',
            'berkas_persyaratan.max' => 'Ukuran file maksimal 2MB.',
        ]);

        $Vacancy = Vacancy::create($validatedData);
        if ($Vacancy) {
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}