<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Portfolio';
        $allPortfolio = Portfolio::all();
        return view('pages.portfolio.index', compact('title',  'allPortfolio'));
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
            'portfolio_title' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'portfolio_thumbnail' => 'required|mimes:jpeg,png,jpg|max:2048',
            'portfolio_detail_desc' => 'required|string',
            'project_date' => 'required|date',
            'google_maps_url' => 'required|string',
        ], [
            // Custom pesan kesalahan
            'portfolio_title.required' => 'Judul portfolio wajib diisi.',
            'portfolio_thumbnail.mimes' => 'Thumnail harus berupa file , JPG, JPEG, atau PNG.',
            'portfolio_thumbnail.max' => 'Ukuran file maksimal 2MB.',
        ]);

        if ($request->hasFile('portfolio_thumbnail')) {
            $filePath = $request->file('portfolio_thumbnail')->store('portfolio_thumbnail', 'public');
            $validatedData['portfolio_thumbnail'] = $filePath;
        }

        $Portfolio = Portfolio::create($validatedData);
        if ($Portfolio) {
            return redirect()->route('portfolio.index')->with('swal', [
                'message' => 'Data berhasil ditambahkan',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('portfolio.index')->with('swal', [
                'message' => 'Data gagal ditambahkan',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Portfolio $portfolio)
    {
        $title = 'Edit Portfolio';
        return view('pages.portfolio.edit', compact('title', 'portfolio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Portfolio $portfolio)
    {

        $validator = Validator::make($request->all(), [
            'client_name' => 'required|string|max:255',
            'portfolio_title' => 'required|string|max:255',
            'portfolio_thumbnail' => 'mimes:jpeg,png,jpg|max:2048',
            'portfolio_detail_desc' => 'required|string',
            'project_date' => 'required|date',
            'google_maps_url' => 'required|string',
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

        if ($request->hasFile('portfolio_thumbnail')) {
            if ($portfolio->berkas_persyaratan && Storage::disk('public')->exists($portfolio->berkas_persyaratan)) {
                Storage::disk('public')->delete($portfolio->berkas_persyaratan);
            }

            $filePath = $request->file('portfolio_thumbnail')->store('portfolio_thumbnail', 'public');
            $validatedData['portfolio_thumbnail'] = $filePath;
        } else {
            unset($validatedData['portfolio_thumbnail']);
        }

        $condition = $portfolio->update($validatedData);

        if ($condition) {
            return redirect()->route('portfolio.index')->with('swal', [
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
    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->berkas_persyaratan && Storage::disk('public')->exists($portfolio->berkas_persyaratan)) {
            Storage::disk('public')->delete($portfolio->berkas_persyaratan);
        }
        if ($portfolio->delete()) {
            return redirect()->route('portfolio.index')->with('swal', [
                'message' => 'Data berhasil dihapus',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('portfolio.index')->with('swal', [
                'message' => 'Data gagal dihapus',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }
}
