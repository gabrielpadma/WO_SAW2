<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/criteria') || Request::is('admin/all-criteria-subcriteria') ? '' : 'collapsed' }}"
                data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gear"></i><span>Criteria</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('criteria.index') }}">
                        <i class="bi bi-circle"></i><span>Criteria</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('criteria-subcriteria.index') }}">
                        <i class="bi bi-circle"></i><span>Sub Criteria</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Components Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/vacancy') || Request::is('admin/pelamar') ? '' : 'collapsed' }}"
                data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-text"></i><span>Lamaran</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('vacancy.index') }}">
                        <i class="bi bi-circle"></i><span>Data Lowongan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pelamar.index') }}">
                        <i class="bi bi-circle"></i><span>Data Pelamar</span>
                    </a>
                </li>

            </ul>
        </li><!-- End Forms Nav -->

        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/penilaian') ? '' : 'collapsed' }}" href="{{ route('penilaian') }}">
                <i class="bi bi-layout-text-window-reverse"></i><span>Penilaian</span>
            </a>
        </li><!-- End Profile Page Nav -->
        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/pengumuman') ? '' : 'collapsed' }}"
                href="{{ route('pengumuman.index') }}">
                <i class="bi bi-megaphone"></i><span>Setting Pengumuman</span>
            </a>
        </li><!-- End Profile Page Nav -->

        {{-- <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-layout-text-window-reverse"></i><span>Penilaian</span><i
                    class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="tables-general.html">
                        <i class="bi bi-circle"></i><span>General Tables</span>
                    </a>
                </li>
                <li>
                    <a href="tables-data.html">
                        <i class="bi bi-circle"></i><span>Data Tables</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Tables Nav --> --}}



        <li class="nav-heading">Pengaturan Website</li>

        <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/hero-content') || Request::is('admin/portfolio') || Request::is('admin/testimonial') || Request::is('admin/wedding-package') ? '' : 'collapsed' }}"
                data-bs-target="#pengaturan-website" data-bs-toggle="collapse" href="#">
                <i class="bi bi-wrench"></i><span>Pengaturan Website</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="pengaturan-website" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('hero-content.index') }}">
                        <i class="bi bi-circle"></i><span>Pengaturan umum</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('portfolio.index') }}">
                        <i class="bi bi-circle"></i><span>Portfolio</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('testimonial.index') }}">
                        <i class="bi bi-circle"></i><span>Testimonials</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('wedding-package.index') }}">
                        <i class="bi bi-circle"></i><span>Paket Pernikahan</span>
                    </a>
                </li>
            </ul>
        </li>


    </ul>

</aside>
