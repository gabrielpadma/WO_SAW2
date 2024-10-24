<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\SubCriteria;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Criteria $criterion)
    {
        $title = 'Sub Criteria ' . $criterion->nama_criteria;
        $allSubCriteria = $criterion->load(['sub_criterias'])->sub_criterias;

        return view('pages.sub-criteria.criteria-sub-criteria', compact('title', 'allSubCriteria', 'criterion'));
    }


    public function showAll()
    {
        $title = 'Sub Criteria';

        $allCriteria = Criteria::join('vacancies', 'vacancies.id', '=', 'criteria.vacancy_id')
            ->select('criteria.*')
            ->with(['vacancy'])
            ->orderBy('vacancies.judul_lowongan', 'asc')
            ->get();

        return view('pages.sub-criteria.index', compact('title', 'allCriteria'));
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
    public function store(Request $request, Criteria $criterion)
    {
        $validatedData = $request->validate([
            'sub_criteria_name' => 'required|string|max:255',
            'value' => 'required|numeric',

        ]);


        $SubCriteria = SubCriteria::create([...$validatedData, 'criteria_id' => $criterion->id]);

        if ($SubCriteria) {
            return redirect()->route('criteria.sub-criteria.index', ['criterion' => $criterion->id])->with('swal', [
                'message' => 'Data berhasil ditambahkan',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('criteria.sub-criteria.index', ['criterion' => $criterion->id])->with('swal', [
                'message' => 'Data gagal ditambahkan',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCriteria $subCriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Criteria $criterion, SubCriteria $sub_criterion)
    {
        $title = 'Edit Sub Criteria';
        return view('pages.sub-criteria.edit', compact('title', 'criterion', 'sub_criterion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Criteria $criterion, SubCriteria $sub_criterion)
    {
        $validator = Validator::make($request->all(), [
            'sub_criteria_name' => 'required|string|max:255',
            'value' => 'required|numeric',
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
        $condition = $sub_criterion->update(attributes: $validatedData);

        if ($condition) {
            return redirect()->route('criteria.sub-criteria.index', ['criterion' => $criterion->id])->with('swal', [
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
    public function destroy(Criteria $criterion, SubCriteria $sub_criterion)
    {
        if ($sub_criterion->delete()) {
            return redirect()->route('criteria.sub-criteria.index', ['criterion' => $criterion->id])->with('swal', [
                'message' => 'Data berhasil dihapus',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('criteria.sub-criteria.index', ['criterion' => $criterion->id])->with('swal', [
                'message' => 'Data gagal dihapus',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }
}
