<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\HeroPageContent;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroPageContentController extends Controller
{




    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Pengaturan Hero Section';
        $HeroContent = HeroPageContent::first();
        $AboutUs = AboutUs::first();
        $Service = Service::first();
        return view('pages.hero-section.index', compact('title', 'HeroContent', 'AboutUs', 'Service'));
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
            'welcome_text' => 'required|string|max:255',
            'content_text' => 'required|string',
            'image_path1' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
            'image_path2' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
            'image_path3' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
            'image_path4' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
            'image_path5' => 'nullable|image|mimes:jpeg,png,jpg|max:1048',
        ]);

        $heroContent = HeroPageContent::firstOrNew();

        $heroContent->welcome_text = $validatedData['welcome_text'];
        $heroContent->content_text = $validatedData['content_text'];


        for ($i = 1; $i <= 5; $i++) {
            $imagePath = "image_path{$i}";
            if ($request->hasFile($imagePath)) {
                if ($heroContent->{$imagePath}) {
                    Storage::disk('public')->delete($heroContent->{$imagePath});
                }

                $fileName = $request->file($imagePath)->store('hero_images', 'public');
                $heroContent->{$imagePath} = $fileName;
            }
        }

        $heroContent->save();

        return redirect()->back()->with('swal', [
            'message' => 'Data hero berhasil diupdate',
            'icon' => 'success',
            'title' => 'Success'
        ]);
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
