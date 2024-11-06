<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Testimonial';
        $allTestimonial = Testimonial::all();
        return view('pages.testimonial.index', compact('title',  'allTestimonial'));
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
            'testimonial_customer_name' => 'required|string|max:255',
            'testimonial_desc' => 'required|string|max:255',
            'testimonial_image' => 'required|mimes:pdf,jpeg,png,jpg|max:2048',
        ], [
            // Custom pesan kesalahan
            'testimonial_customer_name.required' => 'Judul lowongan wajib diisi.',
            'testimonial_desc.required' => 'Deskripsi lowongan wajib diisi.',
            'testimonial_image.required' => 'Lampiran wajib diunggah.',
            'testimonial_image.mimes' => 'Lampiran harus berupa file PDF, JPG, JPEG, atau PNG.',
            'testimonial_image.max' => 'Ukuran file maksimal 2MB.',
        ]);

        if ($request->hasFile('testimonial_image')) {
            $filePath = $request->file('testimonial_image')->store('testimonial_image', 'public');
            $validatedData['testimonial_image'] = $filePath;
        }

        $Testimonial = Testimonial::create($validatedData);
        if ($Testimonial) {
            return redirect()->route('testimonial.index')->with('swal', [
                'message' => 'Data berhasil ditambahkan',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('testimonial.index')->with('swal', [
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
    public function edit(Testimonial $testimonial)
    {
        $title = 'Edit Testimonial';
        return view('pages.testimonial.edit', compact('title', 'testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimonial $testimonial)
    {

        $validator = Validator::make($request->all(), [
            'testimonial_customer_name' => 'required|string|max:255',
            'testimonial_desc' => 'required|string|max:255',
            'testimonial_image' => 'mimes:pdf,jpeg,png,jpg|max:2048',
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

        if ($request->hasFile('testimonial_image')) {
            if ($testimonial->testimonial_image && Storage::disk('public')->exists($testimonial->testimonial_image)) {
                Storage::disk('public')->delete($testimonial->testimonial_image);
            }

            $filePath = $request->file('testimonial_image')->store('testimonial_image', 'public');
            $validatedData['testimonial_image'] = $filePath;
        } else {

            unset($validatedData['testimonial_image']);
        }

        $condition = $testimonial->update($validatedData);

        if ($condition) {
            return redirect()->route('testimonial.index')->with('swal', [
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
    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->berkas_persyaratan && Storage::disk('public')->exists($testimonial->berkas_persyaratan)) {
            Storage::disk('public')->delete($testimonial->berkas_persyaratan);
        }
        if ($testimonial->delete()) {
            return redirect()->route('testimonial.index')->with('swal', [
                'message' => 'Data berhasil dihapus',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('testimonial.index')->with('swal', [
                'message' => 'Data gagal dihapus',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }
}
