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
        $allVacancies = Vacancy::with(['periode.criterias'])->get();

        return view('pages.criteria.index', compact('title', 'allVacancies'));
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
            'periode_id' => 'required'
        ]);


        $periode_id = $request->input('periode_id');
        $vacancy_id = $request->input('vacancy_id');

        $Criteria = Criteria::create($validatedData);
        // $this->_normalizeWeights();
        if ($Criteria) {
            return redirect()->route('detail-periode', ['vacancy' => $vacancy_id, 'periode' => $periode_id])->with('swal', [
                'message' => 'Data berhasil ditambahkan',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('detail-periode', ['vacancy' => $vacancy_id, 'periode' => $periode_id])->with('swal', [
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
        $criterion = $criterion->load(['periode.vacancy']);
        return view('pages.criteria.edit', compact('title', 'criterion', 'allVacancies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criteria $criterion)
    {

        $criterion->load(['periode.vacancy']);
        $validator = Validator::make($request->all(), [
            'nama_criteria' => 'required|string|max:255',
            'bobot' => 'required',
            'jenis_criteria' => 'required',
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
        $condition = $criterion->update($validatedData);

        if ($condition) {
            return redirect()->route('detail-periode', ['vacancy' => $criterion->periode->vacancy->id, 'periode' => $criterion->periode->id])->with('swal', [
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

    public function copyCriteria(Request $request)
    {
        $periodeId = $request->input('periode_id');
        $vacancyId = $request->input('vacancy_id');
        $periode_vacancy = $request->input('periode_vacancy');

        $criterias = Criteria::where('periode_id', '=', $periode_vacancy)->get();

        foreach ($criterias as $criteria) {
            $newCriteria = $criteria->replicate();

            $newCriteria->periode_id = $periodeId;
            $newCriteria->save();
        }

        return back()->with('swal', ['message' => 'Criteria berhasil disalin', 'icon' => 'success', 'title' => 'Success']);
    }
}
