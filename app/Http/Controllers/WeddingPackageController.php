<?php

namespace App\Http\Controllers;

use App\Models\WeddingPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WeddingPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Paket Wedding';
        $allWeddingPackage = WeddingPackage::all();
        return view('pages.wedding-packages.index', compact('title',  'allWeddingPackage'));
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
            'package_title' => 'required|string|max:255',
            'features' => 'required|string',
            'price' => 'required|min:0',
            'is_active' => 'required|boolean',
            'is_recommend' => 'required|boolean',
        ], [
            'package_title.required' => 'Judul paket wajib diisi.',
            'features.required' => 'Fitur wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'price.min' => 'Harga tidak boleh kurang dari 0.',
            'is_active.required' => 'Status wajib dipilih.',
            'is_active.boolean' => 'Status tidak valid.',
            'is_recommend.required' => 'Rekomendasi wajib dipilih.',
            'is_recommend.boolean' => 'Pilihan rekomendasi tidak valid.',
        ]);


        $price = (int) str_replace('.', '', $validatedData['price']);

        $features = array_map('trim', explode(',', $validatedData['features']));


        $WeddingPackage = WeddingPackage::create([
            'package_title' => $validatedData['package_title'],
            'features' => json_encode($features), // Simpan sebagai JSON
            'price' => $price,
            'is_active' => $validatedData['is_active'],
            'is_recommend' => $validatedData['is_recommend'],
        ]);


        if ($WeddingPackage) {
            return redirect()->route('wedding-package.index')->with('swal', [
                'message' => 'Data berhasil ditambahkan',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('wedding-package.index')->with('swal', [
                'message' => 'Data gagal ditambahkan',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(WeddingPackage $wedding_package) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WeddingPackage $wedding_package)
    {
        $title = 'Edit Paket Wedding';
        $wedding_package->features = implode(', ', json_decode($wedding_package->features, true));
        $wedding_package->price = number_format($wedding_package->price, 0, ',', '.');


        return view('pages.wedding-packages.edit', compact('title', 'wedding_package'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WeddingPackage $wedding_package)
    {
        $validator = Validator::make($request->all(), [
            'package_title' => 'required|string|max:255',
            'features' => 'required|string',
            'price' => 'required|min:0',
            'is_active' => 'required|boolean',
            'is_recommend' => 'required|boolean',
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

        $validatedData['price'] = (int) str_replace('.', '', $validatedData['price']);

        $validatedData['features'] = array_map('trim', explode(',', $validatedData['features']));


        $condition = $wedding_package->update($validatedData);

        if ($condition) {
            return redirect()->route('wedding-package.index')->with('swal', [
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
    public function destroy(WeddingPackage $wedding_package)
    {
        if ($wedding_package->delete()) {
            return redirect()->route('wedding-package.index')->with('swal', [
                'message' => 'Data berhasil dihapus',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('wedding-package.index')->with('swal', [
                'message' => 'Data gagal dihapus',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }
}
