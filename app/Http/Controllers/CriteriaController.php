<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $totalWeight = $criterias->sum('bobot');

        return $criterias->map(function ($criteria) use ($totalWeight) {
            $normalizeWeight = round((float)$criteria->bobot / $totalWeight, 2);
            return [
                ...$criteria->toArray(),
                'vacancy' => $criteria->vacancy,
                'normalize_weight' => $normalizeWeight,
                'normalize_precentage_weight' => round($normalizeWeight * 100, 2)
            ];
        });
    }




    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Criteria';
        $allCriteria = Criteria::join('vacancies', 'criteria.vacancy_id', '=', 'vacancies.id')
            ->orderBy('vacancies.judul_lowongan')
            ->select('criteria.*')
            ->get();
        $formattedCriteria = [];
        $currentId = null;
        $counter = 1;

        foreach ($allCriteria as $crit) {
            if ($currentId != $crit->vacancy_id) {
                $currentId = $crit->vacancy_id;
                $counter = 1;
            }

            $crit->alias = "C$counter";
            $counter++;
            $formattedCriteria[] = $crit;
        }

        $allVacancies = Vacancy::all();


        return view('pages.criteria.index', compact('title', 'formattedCriteria',  'allVacancies'));
    }


    public function detailNormalisasi(Vacancy $vacancy)
    {
        $title = 'Normalisasi Criteria';

        $vacancy->load('criterias');

        $normalizeCriterias = $this->_changeToNormalizeWeight($vacancy->criterias);
        $totalBobotNormalize = $normalizeCriterias->sum('normalize_weight');
        $totalBobotPersen = $totalBobotNormalize * 100;

        return view('pages.criteria.detail-normalisasi', compact(
            'title',
            'normalizeCriterias',
            'totalBobotNormalize',
            'totalBobotPersen',
            'vacancy'
        ));
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
            'vacancy_id' => 'required'
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
    public function edit(Criteria $criterion)
    {
        $title = 'Edit Criteria';
        $allVacancies = Vacancy::all();
        $criterion = $criterion->load(['vacancy']);
        return view('pages.criteria.edit', compact('title', 'criterion', 'allVacancies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criteria $criterion)
    {
        $validator = Validator::make($request->all(), [
            'nama_criteria' => 'required|string|max:255',
            'bobot' => 'required',
            'jenis_criteria' => 'required',
            'vacancy_id' => 'required'
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
        $condition = $criterion->update(attributes: $validatedData);

        if ($condition) {
            return redirect()->route('criteria.index')->with('swal', [
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