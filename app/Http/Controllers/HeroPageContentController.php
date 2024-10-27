<?php

namespace App\Http\Controllers;

use App\Models\HeroPageContent;
use Illuminate\Http\Request;

class HeroPageContentController extends Controller
{




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pengaturan Hero Section';
        $HeroContent = HeroPageContent::all();

        return view('pages.hero-section.index', compact('title', 'HeroContent'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HeroPageContent $hero_content)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeroPageContent $hero_content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HeroPageContent $hero_content)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeroPageContent $hero_content)
    {
        //
    }
}
