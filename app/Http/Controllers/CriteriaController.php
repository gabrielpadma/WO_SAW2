<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use Illuminate\Http\Request;

class CriteriaController extends Controller
{


    private function _normalizeWeights()
    {
        $criteriaList = Criteria::all();
        $totalWeight = $criteriaList->sum('bobot');
        if ($totalWeight > 0) {
            foreach ($criteriaList as $criteria) {
                $criteria->bobot = $criteria->bobot / $totalWeight;
                $criteria->save();
            }
        }
    }

    private function _changeToNormalizeWeight($criterias)
    {
        $totalWeight = Criteria::all()->sum('bobot');
        return $criterias->map(function ($criteria) use ($totalWeight) {
            $normalizeWeight = round((float)$criteria->bobot / $totalWeight, 2);
            return [...$criteria->toArray(), 'normalize_weight' => $normalizeWeight, 'normalize_precentage_weight' => round($normalizeWeight * 100, 2)];
        });
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Criteria';
        $allCriteria = Criteria::all();
        $totalBobotNormalize = $this->_changeToNormalizeWeight($allCriteria)->sum('normalize_weight');
        $totalBobotPersen = $totalBobotNormalize * 100;
        $normalizeCriterias = $this->_changeToNormalizeWeight($allCriteria);


        return view('pages.criteria.index', compact('title', 'allCriteria', 'normalizeCriterias', 'totalBobotNormalize', 'totalBobotPersen'));
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
            'nama_criteria' => 'required|string|max:255',
            'bobot' => 'required|numeric',
            'jenis_criteria' => 'required',
        ]);


        $Criteria = Criteria::create($validatedData);
        // $this->_normalizeWeights();
        if ($Criteria) {
            return redirect()->route('criteria.index')->with('swal', [
                'message' => 'Data berhasil ditambahkan',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('criteria.index')->with('swal', [
                'message' => 'Data gagal ditambahkan',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Criteria $criteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criteria $criteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criteria $criteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Criteria $criterion)
    {

        if ($criterion->delete()) {
            return redirect()->route('criteria.index')->with('swal', [
                'message' => 'Data berhasil dihapus',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('criteria.index')->with('swal', [
                'message' => 'Data gagal dihapus',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }
}
