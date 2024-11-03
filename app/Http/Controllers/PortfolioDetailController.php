<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Models\PortfolioDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PortfolioDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Portfolio $portfolio)
    {
        $title = 'Detail Portfolio' . $portfolio->portfolio_title;
        $portfolio =  $portfolio->load(['portfolio_details']);

        return view('pages.portfolio-details.index', compact('title', 'portfolio'));
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
    public function store(Request $request, Portfolio $portfolio)
    {

        $validatedData = $request->validate([
            'portfolio_detail_desc' => 'required|string',
            'project_date' => 'required|date',
            'google_maps_url' => 'required|string',
            'detail_image1' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
            'detail_image2' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
            'detail_image3' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
            'detail_image4' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $PortfolioDetail = PortfolioDetail::firstOrNew();

        $PortfolioDetail->portfolio_detail_desc = $validatedData['portfolio_detail_desc'];
        $PortfolioDetail->project_date = $validatedData['project_date'];
        $PortfolioDetail->google_maps_url = $validatedData['google_maps_url'];
        $PortfolioDetail->portfolio_id = $portfolio->id;

        for ($i = 1; $i <= 5; $i++) {
            $imagePath = "detail_image{$i}";
            if ($request->hasFile($imagePath)) {
                if ($PortfolioDetail->{$imagePath}) {
                    Storage::disk('public')->delete($PortfolioDetail->{$imagePath});
                }

                $fileName = $request->file($imagePath)->store('portfolio-detail', 'public');
                $PortfolioDetail->{$imagePath} = $fileName;
            }
        }

        $PortfolioDetail->save();

        return redirect()->back()->with('swal', [
            'message' => 'Data hero berhasil ditambahkan',
            'icon' => 'success',
            'title' => 'Success'
        ]);
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