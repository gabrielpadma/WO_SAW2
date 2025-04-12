<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>

    <style>
        .custom-img {
            height: 50%;
            width: auto;
            object-fit: cover;
        }
    </style>


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Input Penilaian {{ $application->user->name }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('vacancy.index') }}">Lowongan</a></li>
                    <li class="breadcrumb-item ">{{ $periode->vacancy->id }}</li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('data-lamaran.vacancy.periode', ['vacancy' => $periode->vacancy->id]) }}">Periode</a>
                    </li>
                    <li class="breadcrumb-item ">{{ $periode->id }}</li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('data-lamaran.vacancy.periode.pelamar', ['vacancy' => $periode->vacancy->id, 'periode' => $periode->id]) }}">Pelamar</a>
                    </li>
                    <li class="breadcrumb-item active">Input Data Alternatif</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabel Alternatif</h5>
                            <p class="fw-bold">Nama : {{ $application->user->name }}</p>
                            <div class="lampiran-wrapper d-flex gap-2 mb-4">


                                @if (
                                    $application->user?->lampiran_ijazah != null &&
                                        Storage::disk('public')->exists($application->user?->lampiran_ijazah))
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ Storage::url($application->user?->lampiran_ijazah) }}" target="blank"
                                        role="button">Lampiran Ijazah</a>
                                @endif
                                @if ($application->user?->lampiran_cv != null && Storage::disk('public')->exists($application->user?->lampiran_cv))
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ Storage::url($application->user?->lampiran_cv) }}" target="blank"
                                        role="button">Lampiran CV</a>
                                @endif
                                @if ($application->user?->lampiran_ktp != null && Storage::disk('public')->exists($application->user?->lampiran_ktp))
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ Storage::url($application->user?->lampiran_ktp) }}" target="blank"
                                        role="button">Lampiran KTP</a>
                                @endif
                                @if (
                                    $application->user?->lampiran_keterangan_sehat != null &&
                                        Storage::disk('public')->exists($application->user?->lampiran_keterangan_sehat))
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ Storage::url($application->user?->lampiran_keterangan_sehat) }}"
                                        target="blank" role="button">Lampiran Keterangan Sehat</a>
                                @endif
                                @if ($application->user?->lampiran_skck != null && Storage::disk('public')->exists($application->user?->lampiran_skck))
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ Storage::url($application->user?->lampiran_skck) }}" target="blank"
                                        role="button">Lampiran SKCK</a>
                                @endif

                            </div>

                            <!-- Table with stripped rows -->
                            <form action="" method="post">
                                <input type="hidden" name="periode_id" value="{{ $periode->id }}">
                                <input type="hidden" name="application_id" value="{{ $application->id }}">
                                @csrf
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kriteria</th>
                                            <th>Analisis</th>
                                            <th>Sub Kriteria</th>
                                            <th>Bobot Kriteria Ternormalisasi</th>
                                            <th>Nilai Alternatif</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        {{-- @dd($application->periode?->criterias) --}}

                                        @foreach ($application->periode?->criterias as $key => $criteria)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $criteria?->nama_criteria }}
                                                    <input type="hidden" name='criteria_id[]'
                                                        value={{ $criteria?->id }}>
                                                </td>
                                                <td> <select
                                                        class="form-select select-sub-criteria @error('sub_criteria_id.' . $key) is-invalid @enderror"
                                                        aria-label="Default select example" name="sub_criteria_id[]"
                                                        required>
                                                        <option value='' selected>--Pilih Nilai Dari Alternatif--
                                                        </option>
                                                        @foreach ($criteria->sub_criterias as $sub_criteria)
                                                            <option data-object='@json(['id' => $sub_criteria->id, 'value' => $sub_criteria->value])'
                                                                value={{ $sub_criteria->id }}
                                                                {{ old('sub_criteria_id.' . $key, $applicantScore[$key]->sub_criteria_id ?? '') == $sub_criteria->id ? 'selected' : '' }}>
                                                                {{ $sub_criteria->sub_criteria_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('sub_criteria_id.' . $key)
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <ul>
                                                        @foreach ($criteria->sub_criterias as $sub_criteria)
                                                            <li>{{ $sub_criteria->sub_criteria_name }} =
                                                                {{ $sub_criteria->value }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>{{ $normalizedCriterias[$loop->index]->normalize_weight }}</td>
                                                <td> <input type="text"
                                                        class="form-control nilai-alternatif @error('raw_score.' . $key) is-invalid @enderror"
                                                        readonly name="raw_score[]"
                                                        value="{{ old('raw_score.' . $key, $applicantScore[$key]->raw_score ?? '') }}"
                                                        required>
                                                    {{-- <input type="hidden" class="form-control sub_criteria_id"
                                                        name='sub_criteria_id[]' class="sub_criteria_id[]"
                                                        value="{{ old('sub_criteria_id.' . $key, $applicantScore[$key]->sub_criteria_id ?? '') }}"
                                                        required> --}}
                                                    @error('raw_score.' . $key)
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <script>
            $(document).ready(function() {

                // $('[data-toggle="tooltip"]').tooltip()

                $('.datatable').DataTable({
                    dom: 'Bfrtip', // Mengaktifkan tombol export
                    buttons: [{
                            extend: 'excelHtml5',
                            title: 'Seleksi Pelamar',
                        },
                        {
                            extend: 'csvHtml5',
                            title: 'Seleksi Pelamar',
                        },
                        {
                            extend: 'pdfHtml5',
                            title: 'Seleksi Pelamar',
                            orientation: 'portrait',
                            pageSize: 'A4',
                        },
                        {
                            extend: 'print',
                            title: 'Seleksi Pelamar',
                        }
                    ]
                });

                $('.btn-hapus').on('click', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Data ini akan dihapus!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(e.target).closest('form').submit();
                        }
                    });
                });

                $('.select-sub-criteria').on('change', function() {
                    const selectedOption = $(this).find('option:selected');
                    const dataObject = selectedOption.data('object');

                    if (dataObject) {
                        const {
                            id,
                            value
                        } = dataObject;
                        console.log(`ID: ${id}, Value: ${value}`);
                        $(this).closest('tr').find('.nilai-alternatif').val(value);
                        // $(this).closest('tr').find('.sub_criteria_id').val(id);
                    }


                });


            });
        </script>

    </main>
</x-admin.layout.layout>
