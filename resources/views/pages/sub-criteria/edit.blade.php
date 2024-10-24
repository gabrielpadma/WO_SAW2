<x-admin.layout.layout>
    <x-slot:title>
        {{ $title }}
    </x-slot>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Data Sub Criteria</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('criteria.index') }}">Criteria</a> </li>
                    <li class="breadcrumb-item">{{ $criterion->id }}</li>
                    <li class="breadcrumb-item">Sub Criteria</li>
                    <li class="breadcrumb-item active">{{ $sub_criterion->id }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit Sub Criteria</h5>
                            <form
                                action="{{ route('criteria.sub-criteria.update', ['sub_criterion' => $sub_criterion->id, 'criterion' => $criterion->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label for="sub_criteria_name" class="form-label">Nama Sub Criteria</label>
                                            <input type="text" @class([
                                                'form-control ',
                                                'is-invalid' => $errors->has('sub_criteria_name'),
                                            ]) id="sub_criteria_name"
                                                name="sub_criteria_name" aria-describedby="judulLowongan" required
                                                value="{{ old('sub_criteria_name', $sub_criterion->sub_criteria_name) }}">
                                            @error('sub_criteria_name')
                                                <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group mb-3">
                                                <label for="value" class="form-label">Bobot Sub Criteria</label>
                                                <input type="number" @class(['form-control ', 'is-invalid' => $errors->has('value')]) id="value"
                                                    name="value" aria-describedby="value" required
                                                    value="{{ old('value', $sub_criterion->value) }}">
                                                @error('value')
                                                    <div id="validationServerPasswordFeedback" class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Ubah</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </section>



    </main>
</x-admin.layout.layout>
