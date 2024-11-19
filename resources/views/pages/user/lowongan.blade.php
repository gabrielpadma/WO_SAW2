<x-user.layout.layout>
    @push('additional-header-styles')
        <style>
            .btn-login {
                border-radius: 30px;
                background-color: #34bf49;
                color: #ffffff;
                border: 1px solid #34bf49;
                transition: all 0.3s;
            }

            .btn-login:hover {
                background-color: #ffffff;
                color: #34bf49;
                border: 1px solid #34bf49;
            }
        </style>
    @endpush

    <x-slot:title>
        {{ $title }}
    </x-slot>

    <main class="main">
        <div class="page-title light-background">
            <div class="container">
                <h1>Lowongan</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Lowongan</a></li>
                        <li class="current">Semua Lowongan</li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- About 2 Section -->
        <section id="about-2" class="about-2 section">

            <div class="container">
                <div class="card">
                    <div class="card-body">
                        <table class="table" id="tabelLowongan">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Judul Lowongan</th>
                                    <th>Deskripsi Lowongan</th>
                                    <th>Persyaratan</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Tanggal Upload</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vacancies as $vacancy)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $vacancy->judul_lowongan }}</td>
                                        <td>{!! $vacancy->deskripsi_lowongan !!}</td>
                                        <td><a href="{{ Storage::url($vacancy->berkas_persyaratan) }}" target="blank"><i
                                                    class="bi bi-file-earmark-text-fill"></i></a>
                                        </td>
                                        <td>{{ $vacancy->created_at->format('d-m-Y') }}</td>

                                        @auth
                                            <td class="d-flex gap-1">
                                                <a href="{{ route('daftar-lamaran', ['vacancy' => $vacancy->id]) }}"
                                                    class="btn btn-primary btn-circle"><i
                                                        class="bi bi-pencil-square"></i></a>

                                            </td>
                                        @endauth
                                        @guest

                                            <td class="d-flex gap-1">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#loginModal"
                                                    class="btn btn-primary btn-circle"><i
                                                        class="bi bi-pencil-square"></i></a>

                                            </td>
                                        @endguest


                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section><!-- /About 2 Section -->


    </main>

    @push('additional-scripts')
        <script>
            $(document).ready(function() {
                $('#tabelLowongan').DataTable();
            });
        </script>
    @endpush


    </x-user.layout.index>
