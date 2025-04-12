<?php

namespace App\Http\Controllers;

use App\ApplicantStatusEnum;
use App\Models\ApplicantScore;
use App\Models\Application;
use App\Models\Criteria;
use App\Models\MatriksKeputusan;
use App\Models\Periode;
use App\Models\Vacancy;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PelamarController extends Controller
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


    private function _normalizeScores($scores, $criteria)
    {
        $normalizedScores = [];
        $formattedMatrix = []; // Tambahan array untuk data per alternatif

        foreach ($criteria as $key => $criterion) {
            $criterionId = $criterion->id;
            $scoresByCriterion = $scores->where('criteria_id', $criterionId);

            $max = $scoresByCriterion->max('raw_score');
            $min = $scoresByCriterion->min('raw_score');

            // $matriksNormalisasi[$key] = [
            //     'criteria_name' => $criterion->nama_criteria,
            //     'alternatif' => []
            // ];

            foreach ($scoresByCriterion as $score) {
                $normalizedScore = 0;

                if ($criterion->jenis_criteria->value === 'benefit') {
                    $normalizedScore = $score->raw_score / $max;
                    // $normalizedScore = number_format($score->raw_score / $max, 2);
                } elseif ($criterion->jenis_criteria->value === 'cost') {
                    $normalizedScore = $min / $score->raw_score;
                    // $normalizedScore = number_format($min / $score->raw_score, 2);
                }

                $normalizedScores[] = [
                    'application_id' => $score->application_id,
                    'criteria_id' => $criterionId,
                    'normalized_score' => $normalizedScore
                ];

                $userName = $score->application->user->name;


                if (!isset($formattedMatrix[$userName])) {
                    $formattedMatrix[$userName] = [];
                }
                $formattedMatrix[$userName][$criterion->nama_criteria] = $normalizedScore;
            }
        }

        return [$normalizedScores, $formattedMatrix];
    }



    private function _calculateWeightedScores($normalizedScores, $criteria)
    {
        $weightedScores = [];

        foreach ($normalizedScores as $normalized) {
            // $criterion = $criteria->where('id', $normalized['criteria_id'])->first();
            $criterion = $criteria->filter(function ($criteria) use ($normalized) {
                return $criteria['id'] == $normalized['criteria_id'];
            })->first();


            $weightedScores[] = [
                'application_id' => $normalized['application_id'],
                'criteria_id' => $normalized['criteria_id'],
                'weighted_score' => $normalized['normalized_score'] * $criterion['normalize_weight']
            ];
        }
        return $weightedScores;
    }


    private function _calculateFinalScores($weightedScores)
    {
        $finalScores = [];

        foreach ($weightedScores as $score) {
            $applicationId = $score['application_id'];

            if (!isset($finalScores[$applicationId])) {
                $finalScores[$applicationId] = 0;
            }

            $finalScores[$applicationId] += $score['weighted_score'];
        }

        return $finalScores;
    }





    function calculateSAW(Request $request, Vacancy $vacancy, Periode $periode)
    {
        $namaPeriode = Carbon::parse($periode->tanggal_periode)->format('F Y');
        $title = "Hitung SAW {$vacancy->judul_loongan} {$namaPeriode}";

        $criteria = Criteria::with(['periode'])->where('periode_id', '=', $periode->id)->get();

        $normalizedWeight = $this->_changeToNormalizeWeight($criteria);

        $applicantScores = ApplicantScore::with(['application.user'])->where('periode_id', $periode->id)->get();
        [$normalizedScores, $formattedMatrix] = $this->_normalizeScores($applicantScores, $criteria);


        // $weightedScores = $this->_calculateWeightedScores($normalizedScores, $criteria);
        $weightedScores = $this->_calculateWeightedScores($normalizedScores, $normalizedWeight);

        $finalScores = $this->_calculateFinalScores($weightedScores);

        $hasilSAW = collect($finalScores)->map(function ($value, $key) {
            $application = Application::with(['user'])->find($key);
            if ($application) {
                $application->saw_score = $value;
            }
            return $application;
        })->filter()->sortByDesc('saw_score');

        $groupedResults = $hasilSAW->groupBy('saw_score');

        // Opsional: jika ingin mengurutkan group berdasarkan skor secara descending
        $groupedResults = $hasilSAW->groupBy(function ($item) {
            return (string) $item->saw_score;
        });

        $applicantStatus = ApplicantStatusEnum::cases();
        return view('pages.pelamar.perhitungan', compact('title', 'vacancy', 'formattedMatrix', 'criteria', 'hasilSAW', 'applicantStatus', 'normalizedWeight', 'periode', 'groupedResults'));
    }


    public function simpanSAW(Request $request)
    {
        $applicationIds = $request->input('application_id');
        $idPeriode = $request->input('periode_id');

        $validatedData = $request->validate([
            'status' => 'required',
            'status.*' => 'required',
            'total_score' => 'required',
            'total_score.*' => 'required'
        ]);

        try {

            $criteria = Criteria::with(['periode'])->where('periode_id', $idPeriode)->get();
            $applicantScores = ApplicantScore::with(['application.user'])->where('periode_id', $idPeriode)->get();
            [$normalizedScores] = $this->_normalizeScores($applicantScores, $criteria);

            foreach ($normalizedScores as $matrixPenentuan) {
                if (!isset($matrixPenentuan['application_id'], $matrixPenentuan['criteria_id'], $matrixPenentuan['normalized_score'])) {
                    continue;
                }
                MatriksKeputusan::updateOrCreate(
                    [
                        'periode_id' => $idPeriode,
                        'applicant_id' => $matrixPenentuan['application_id'],
                        'criteria_id' => $matrixPenentuan['criteria_id'],
                    ],
                    [
                        'periode_id' => $idPeriode,
                        'applicant_id' => $matrixPenentuan['application_id'],
                        'criteria_id' => $matrixPenentuan['criteria_id'],
                        'hasil' => $matrixPenentuan['normalized_score'],
                    ]
                );
            }

            foreach ($applicationIds as $key => $id) {
                $application = Application::with(['vacancy'])->findOrFail($id);

                $application->update([
                    'status' => $request->input('status')[$key],
                    'total_score' => $request->input('total_score')[$key]
                ]);
            }

            return redirect()->route('penilaian')->with('swal', [
                'message' => 'Data perhitungan berhasil disimpan',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('swal', [
                'message' => 'Data perhitungan gagal disimpan \n ' . $e->getMessage(),
                'icon' => 'success',
                'title' => 'Success'
            ]);
        }
    }


    public function dataPeriodeLowonganLamaran(Request $request, Vacancy $vacancy)
    {
        $title = "Periode Lowongan {$vacancy->name}";
        $vacancy->load(['periode.applications']);

        foreach ($vacancy->periode as $periode) {
            $periode->jumlahPelamar = $periode->applications->count();
        }

        return view('pages.pelamar.periode-pelamar', compact('title', 'vacancy'));
    }



    public function penilaian()
    {
        $title = 'Penilaian SAW';
        $allVacancies = Vacancy::withCount(['applications'])->get();
        return view('pages.pelamar.penilaian', compact('title', 'allVacancies'));
    }




    public function hitungSawPeriode(Vacancy $vacancy)
    {
        $title = "Periode {$vacancy->judul_lowongan}";

        $vacancy->load(['periode.applications']);

        foreach ($vacancy->periode as $periode) {
            $periode->jumlahPelamar = $periode->applications->count();
        }

        return view('pages.pelamar.periode-hitung-saw', compact('title', 'vacancy'));
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $title = 'Lowongan';
        $allVacancies = Vacancy::withCount(['applications'])->get();
        return view('pages.pelamar.index', compact('title', 'allVacancies'));
    }

    public function hapusPelamar(Request $request, Application $application)
    {
        $application = $application->load(['vacancy']);
        if ($application->delete()) {
            return redirect()->route('data-lamaran', ['vacancy' => $application->vacancy->id])->with('swal', [
                'message' => 'Data berhasil dihapus',
                'icon' => 'success',
                'title' => 'Success'
            ]);
        } else {
            return redirect()->route('data-lamaran', ['vacancy' => $application->vacancy->id])->with('swal', [
                'message' => 'Data gagal dihapus',
                'icon' => 'error',
                'title' => 'Error'
            ]);
        }
    }



    public function dataLamaran(Request $request, Vacancy $vacancy, Periode $periode)
    {
        // $vacancy = $vacancy->load(['applications.user', 'applications.applicant_scores']);

        $applications = Application::with(['user', 'applicant_scores', 'periode', 'vacancy'])->where('periode_id', '=', $periode->id)->where('vacancy_id', '=', $vacancy->id)->get();

        $tanggalPeriode = Carbon::parse($periode->tanggal_periode)->format('F Y');
        $title = "Data Pelamar {$vacancy->judul_lowongan} Periode {$tanggalPeriode}";
        return view('pages.pelamar.data-pelamar', compact('title', 'applications', 'vacancy', 'periode'));
    }


    public function seleksiPelamar(Request $request, Periode $periode, Application $application)
    {
        $application = $application->load(['periode.criterias.sub_criterias', 'user']);
        $periode = $periode->load(['vacancy']);

        $criterias = $application->periode->criterias;

        $normalizedCriterias = $this->_changeToNormalizeWeight($criterias);

        $applicantScore = ApplicantScore::where('periode_id', $periode->id)
            ->where('application_id', $application->id)
            ->get();

        $title = "Seleksi SAW " . $application->user->name;
        return view('pages.pelamar.seleksi-pelamar', compact('title', 'application', 'normalizedCriterias', 'periode', 'applicantScore'));
    }


    public function simpanDataAlternatif(Request $request, Periode $periode, Application $application)
    {

        $validatedData = $request->validate([
            'periode_id' => 'required|integer',
            'application_id' => 'required|integer',
            'criteria_id' => 'required',
            'criteria_id.*' => 'required|min:1',
            'sub_criteria_id' => 'required|array',
            'sub_criteria_id.*' => 'required|numeric|min:1', // Validasi setiap elemen array
            'raw_score' => 'required|array',
            'raw_score.*' => 'required|numeric', // Validasi setiap elemen array
        ]);


        foreach ($request->criteria_id as $key => $criteria) {
            $attributes = [
                'periode_id' => $request->periode_id,
                'application_id' => $request->application_id,
                'criteria_id' => $criteria,
            ];

            $data = [
                'periode_id' => $request->periode_id,
                'application_id' => $request->application_id,
                'criteria_id' => $criteria,
                'sub_criteria_id' => $request->sub_criteria_id[$key], // Ambil dari sub_criteria_id
                'raw_score' => $request->raw_score[$key],
            ];

            ApplicantScore::updateOrCreate($attributes, $data);
        }
        return redirect()->route('data-lamaran.vacancy.periode.pelamar', ['vacancy' => $periode->vacancy->id, 'periode' => $periode->id])->with('swal', [
            'message' => 'Data Alternatif berhasil ditambah/diupdate',
            'icon' => 'success',
            'title' => 'Success'
        ]);
    }




    public function detailPelamar(Request $request, $vacancy,) {}



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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
