<?php

namespace App\Http\Controllers;

use App\Models\Criteria;
use App\Models\Periode;
use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PeriodeController extends Controller
{

    private function _changeToNormalizeWeight($criterias)
    {
        $totalWeight = $criterias->sum('bobot');
        $criterias->load(['periode.vacancy']);
        $currentId = null;

        $counter = 1;

        foreach ($criterias as $criteria) {
            $normalizeWeight = round((float)$criteria->bobot / $totalWeight, 4);
            if ($currentId != $criteria->periode_id) {
                $currentId = $criteria->periode_id;
                $counter = 1;
            }
            $criteria->alias = "C$counter";
            $counter++;
            $criteria->normalize_weight = $normalizeWeight;
            $criteria->normalize_precentage_weight = round($normalizeWeight * 100, 2);
        };

        return $criterias;
    }
    public function hapusPeriode(Periode $periode)
    {
        if ($periode->delete()) {
            return redirect()->back()->with('swal', [
                'message' => 'Data berhasil dihapus',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->back()->with('swal', [
                'message' => 'Data gagal dihapus',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }

    public function tambahPeriode(Request $request)
    {
        $validatedData = $request->validate(['tanggal_periode' => ['required']]);

        $periodeNotUnique = Periode::where('vacancy_id', '=', $request->vacancy_id)->whereYear('tanggal_periode', date('Y', strtotime($request->input('tanggal_periode') . '-01')))
            ->whereMonth('tanggal_periode', date('m', strtotime($request->input('tanggal_periode') . '-01')))
            ->exists();

        if ($periodeNotUnique) {
            return redirect()->back()->withErrors([
                'tanggal_periode' => 'Data pada periode sudah ada.'
            ])->withInput();
        }


        $validatedData['status'] = '0';
        $validatedData['vacancy_id'] = $request->vacancy_id;
        $validatedData['tanggal_periode'] = $validatedData['tanggal_periode'] . '-01';


        $periode =  Periode::create($validatedData);

        if ($periode) {
            return redirect()->back()->with('swal', [
                'message' => 'Data periode berhasil ditambah',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->back()->with('swal', [
                'message' => 'Data periode gagal ditambah',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }


    public function editPeriode(Periode $periode)
    {
        $title = 'Edit Periode';
        $periode = $periode->load(['vacancy']);
        $periode->tanggal_periode = Carbon::parse($periode->tanggal_periode)->format('Y-m');
        return view('pages.periode.edit', compact('title', 'periode'));
    }

    public function prosesEdit(Request $request, Periode $periode)
    {
        $validatedData = $request->validate(['tanggal_periode' => ['required']]);

        if ($periode->tanggal_periode != $request->input('tanggal_periode') . '-01') {

            $periodeNotUnique = Periode::where('vacancy_id', '=', $request->vacancy_id)->whereYear('tanggal_periode', date('Y', strtotime($request->input('tanggal_periode') . '-01')))
                ->whereMonth('tanggal_periode', date('m', strtotime($request->input('tanggal_periode') . '-01')))
                ->exists();

            if ($periodeNotUnique) {
                return redirect()->back()->withErrors([
                    'tanggal_periode' => 'Data pada periode sudah ada.'
                ])->withInput();
            }
        }

        $validatedData['status'] = $request->input('status');
        $validatedData['tanggal_periode'] = $request->input('tanggal_periode') . '-01';
        $periode->update($validatedData);
        return redirect()->route('vacancy.show', ['vacancy' => $periode->vacancy->id])->with('swal', [
            'message' => 'Data periode berhasil diubah',
            'icon' => 'success',
            'title' => 'Success'
        ]);
    }


    public function detailPeriode(Vacancy $vacancy, Periode $periode)
    {
        $namaPeriode = Carbon::parse($periode->tanggal_periode)->format('F Y');
        $title = "Criteria {$vacancy->judul_lowongan} Periode $namaPeriode";
        $allCriteria = Criteria::join('periode', 'criteria.periode_id', '=', 'periode.id')
            ->join('vacancies', 'vacancies.id', '=', 'periode.vacancy_id')
            ->orderBy('criteria.created_at', 'desc')
            ->select(['criteria.*', 'vacancies.judul_lowongan'])
            ->where('periode_id', '=', $periode->id)
            ->get();
        $formattedCriteria = [];
        $currentId = null;
        $counter = 1;

        $allPeriodeVacancy = Periode::where('vacancy_id', '=', $vacancy->id)->get();

        foreach ($allCriteria as $crit) {
            if ($currentId != $crit->vacancy_id) {
                $currentId = $crit->vacancy_id;
                $counter = 1;
            }

            $crit->alias = "C$counter";
            $counter++;
            $formattedCriteria[] = $crit;
        }

        $normalizeCriterias = $this->_changeToNormalizeWeight($allCriteria);

        $totalBobotNormalize = $normalizeCriterias->sum('normalize_weight');
        $totalBobotPersen = $totalBobotNormalize * 100;

        return view('pages.periode.criteria-periode', compact('formattedCriteria', 'title', 'vacancy', 'periode', 'namaPeriode', 'normalizeCriterias', 'totalBobotNormalize', 'totalBobotPersen', 'allPeriodeVacancy'));
    }
}
