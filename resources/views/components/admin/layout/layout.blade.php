<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ url('assets/admin/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ url('assets/admin/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('assets/admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ url('assets/admin/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/admin/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ url('assets/admin/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
    <link href="{{ url('assets/admin/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ url('assets/admin/assets/vendor/simple-datatables/style.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Template Main CSS File -->
    <link href="{{ url('assets/admin/assets/css/style.css') }}" rel="stylesheet">




    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/vfs_fonts.js"></script>



    @stack('additional-header-scripts')
    @stack('additional-header-styles')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</head>

<body>

    <x-admin.header />

    <x-admin.sidebar />

    {{ $slot }}

    <x-admin.footer />


    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ url('assets/admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ url('assets/admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/admin/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ url('assets/admin/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ url('assets/admin/assets/vendor/quill/quill.js') }}"></script>
    <script src="{{ url('assets/admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ url('assets/admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ url('assets/admin/assets/vendor/php-email-form/validate.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="{{ url('assets/admin/assets/js/main.js') }}"></script>

    @if (session()->has('login'))
        <script>
            Swal.fire({
                icon: '{{ session('login')['icon'] }}',
                title: '{{ session('login')['title'] }}',
                text: '{{ session('login')['message'] }}',
            });
        </script>
    @endif
    @if (session()->has('swal'))
        <script>
            Swal.fire({
                icon: '{{ session('swal')['icon'] }}',
                title: '{{ session('swal')['title'] }}',
                text: '{{ session('swal')['message'] }}',
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            const myModal = new bootstrap.Modal(document.getElementById('modalTambahData'));
            myModal.show();
        </script>
    @endif




    <script>
        $(document).ready(function() {

            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-toggle="tooltip"]'));
            tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });


            $('#form-logout').on('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Apakah anda yakin ?',
                    text: "Anda akan logout !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Logout !'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit form secara manual
                        this.submit();
                    }
                });
            });



            document.querySelectorAll('.nav-link').forEach(link => {
                link.addEventListener('click', function() {
                    this.classList.remove('collapsed');
                });
            });



        });
    </script>


</body>

</html>
