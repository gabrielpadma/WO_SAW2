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
                <h1>Pengumuman</h1>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li class="current">Semua Pengumuman</li>
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
                                    <th>Status</th>
                                    <th data-type="date" data-format="YYYY/DD/MM">Terakhir Update</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user->applications as $application)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $application->vacancy->judul_lowongan }}</td>
                                        <td>{!! $application->vacancy->deskripsi_lowongan !!}</td>
                                        <td><span
                                                class="badge rounded-pill bg-{{ ($application->status == 'pending' ? 'warning' : $application->status == 'ditolak') ? 'danger' : 'success' }}">{{ $application->status }}</span>
                                        </td>
                                        <td>{{ $application->updated_at->format('d-m-Y') }}</td>

                                        @auth
                                            @if ($application->status == 'diterima')
                                                <td class="d-flex gap-1">
                                                    <a href="{{ route('detail-pengumuman', ['application' => $application->id]) }}"
                                                        class="btn btn-primary btn-circle"><i
                                                            class="bi bi-info-circle"></i></a>

                                                </td>
                                            @else
                                                <td>-</td>
                                            @endif
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

            var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
            var popoverList = popoverTriggerList.map(function(popoverTriggerEl) {
                return new bootstrap.Popover(popoverTriggerEl)
            })
        </script>
    @endpush


    </x-user.layout.index>
