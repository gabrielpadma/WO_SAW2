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
            'detail_image1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'detail_image2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'detail_image3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'detail_image4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $PortfolioDetail = PortfolioDetail::firstOrNew();
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
    public function edit(Request $request, Portfolio $portfolio, PortfolioDetail $portfolio_detail)
    {

        $title = 'Detail Portfolio' . $portfolio->portfolio_title;
        return view('pages.portfolio-details.edit', compact('title', 'portfolio', 'portfolio_detail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  Portfolio $portfolio, PortfolioDetail $portfolio_detail)
    {
        $validatedData = $request->validate([
            'detail_image1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'detail_image2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'detail_image3' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'detail_image4' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        for ($i = 1; $i <= 5; $i++) {
            $imagePath = "detail_image{$i}";
            if ($request->hasFile($imagePath)) {
                if ($portfolio_detail->{$imagePath}) {
                    Storage::disk('public')->delete($portfolio_detail->{$imagePath});
                }

                $fileName = $request->file($imagePath)->store('portfolio-detail', 'public');
                $portfolio_detail->{$imagePath} = $fileName;
            }
        }

        $portfolio_detail->update();
        return redirect()->route('portfolio.portfolio-detail.index', ['portfolio' => $portfolio->id])->with('swal', [
            'message' => 'Gambar detail portfolio berhasil diubah',
            'icon' => 'success',
            'title' => 'Success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio, PortfolioDetail $portfolio_detail)
    {

        for ($i = 1; $i <= 5; $i++) {
            $imagePath = "detail_image{$i}";

            if ($portfolio_detail->{$imagePath}) {
                Storage::disk('public')->delete($portfolio_detail->{$imagePath});
            }
        }


        if ($portfolio_detail->delete()) {
            return redirect()->route('portfolio.portfolio-detail.index', ['portfolio' => $portfolio->id])->with('swal', [
                'message' => 'Data berhasil dihapus',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('portfolio.portfolio-detail.index', ['portfolio' => $portfolio->id])->with('swal', [
                'message' => 'Data gagal dihapus',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }
}
