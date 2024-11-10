<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validatedData =  $request->validate([
            'service_title' => 'required|max:255',
            'service_desc' => 'required',
            'icon_service_1' => 'nullable|string',
            'service_text_1' => 'nullable|string|max:255',
            'icon_service_2' => 'nullable|string',
            'service_text_2' => 'nullable|string|max:255',
            'icon_service_3' => 'nullable|string',
            'service_text_3' => 'nullable|string|max:255',
            'icon_service_4' => 'nullable|string',
            'service_text_4' => 'nullable|string|max:255',
            'icon_service_5' => 'nullable|string',
            'service_text_5' => 'nullable|string|max:255',
            'icon_service_6' => 'nullable|string',
            'service_text_6' => 'nullable|string|max:255',
            'icon_title_1' => 'nullable|string|max:255',
            'icon_title_2' => 'nullable|string|max:255',
            'icon_title_3' => 'nullable|string|max:255',
            'icon_title_4' => 'nullable|string|max:255',
            'icon_title_5' => 'nullable|string|max:255',
            'icon_title_6' => 'nullable|string|max:255',
        ]);

        $Service = Service::firstOrNew();
        $Service->service_title = $validatedData['service_title'];
        $Service->service_desc = $validatedData['service_desc'];
        $Service->icon_service_1 = $validatedData['icon_service_1'];
        $Service->service_text_1 = $validatedData['service_text_1'];
        $Service->icon_service_2 = $validatedData['icon_service_2'];
        $Service->service_text_2 = $validatedData['service_text_2'];
        $Service->icon_service_3 = $validatedData['icon_service_3'];
        $Service->service_text_3 = $validatedData['service_text_3'];
        $Service->icon_service_4 = $validatedData['icon_service_4'];
        $Service->service_text_4 = $validatedData['service_text_4'];
        $Service->icon_service_5 = $validatedData['icon_service_5'];
        $Service->service_text_5 = $validatedData['service_text_5'];
        $Service->icon_service_6 = $validatedData['icon_service_6'];
        $Service->service_text_6 = $validatedData['service_text_6'];
        $Service->icon_title_1 = $validatedData['icon_title_1'];
        $Service->icon_title_2 = $validatedData['icon_title_2'];
        $Service->icon_title_3 = $validatedData['icon_title_3'];
        $Service->icon_title_4 = $validatedData['icon_title_4'];
        $Service->icon_title_5 = $validatedData['icon_title_5'];
        $Service->icon_title_6 = $validatedData['icon_title_6'];


        $Service->save();
        return redirect()->back()->with('swal', [
            'message' => 'Data layanan berhasil diupdate',
            'icon' => 'success',
            'title' => 'Success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        //
    }
}