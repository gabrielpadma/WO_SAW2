<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\SubCriteria;
use Illuminate\Http\Request;

class SubCriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Sub Criteria';
        $allCriteria = Criteria::with(relations: 'sub_criterias')->get();

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
    public function store(Request $request)
    {
        //
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
    public function edit(SubCriteria $subCriteria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubCriteria $subCriteria)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubCriteria $subCriteria)
    {
        //
    }
}
