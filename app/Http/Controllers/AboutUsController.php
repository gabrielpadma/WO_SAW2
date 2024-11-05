<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutUsController extends Controller
{

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
        $validatedData =  $request->validate([
            'mission' => 'required|string|max:255',
            'mission_title' => 'required|string|max:255',
            'mission_desc' => 'required|string',
            'mission_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'why_us_title' => 'required|string|max:255',
            'why_us_desc' => 'required|string',
            'why_us_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'total_project' => 'required|integer|min:0',
            'total_vendor' => 'required|integer|min:0',
            'team_members' => 'required|integer|min:0',
        ]);

        $AboutUs = AboutUs::firstOrNew();
        $AboutUs->mission = $validatedData['mission'];
        $AboutUs->mission_title = $validatedData['mission_title'];
        $AboutUs->mission_desc = $validatedData['mission_desc'];
        $AboutUs->why_us_title = $validatedData['why_us_title'];
        $AboutUs->why_us_desc = $validatedData['why_us_desc'];
        $AboutUs->total_project = $validatedData['total_project'];
        $AboutUs->total_vendor = $validatedData['total_vendor'];
        $AboutUs->team_members = $validatedData['team_members'];

        if ($request->hasFile('mission_image')) {
            if ($AboutUs->mission_image) {
                Storage::disk('public')->delete($AboutUs->mission_image);
            }

            $fileName = $request->file('mission_image')->store('about_us', 'public');
            $AboutUs->mission_image = $fileName;
        }

        if ($request->hasFile('why_us_image')) {
            if ($AboutUs->why_us_image) {
                Storage::disk('public')->delete($AboutUs->why_us_image);
            }

            $fileName = $request->file('why_us_image')->store('about_us', 'public');
            $AboutUs->why_us_image = $fileName;
        }


        $AboutUs->save();
        return redirect()->back()->with('swal', [
            'message' => 'Data about us berhasil diupdate',
            'icon' => 'success',
            'title' => 'Success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutUs $aboutUs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutUs $aboutUs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUs $aboutUs)
    {
        //
    }
}
