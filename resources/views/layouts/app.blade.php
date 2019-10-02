<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('title')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> -->

    <!-- Styles -->
    <link href="{{ asset('assets/datatables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/fontawesome/css/all.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/select2/dist/css/select2.min.css') }}">

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.addons.css') }}">
    <link href="{{ asset('assets/sweet-alert/sweetalert.css') }}" rel="stylesheet">

    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    @yield('css')
    <style>
        #DataTables_Table_0_filter .form-control.form-control-sm{
            border: 1px solid #f2f2f2;
            font-family: "Poppins", sans-serif;
            font-size: 0.75rem;
            padding: 0.56rem 0.75rem;
            line-height: 14px;
            font-weight: 300;
        }
        .modal .modal-content{
            background-color: #fff;
        }
        .has-error input,
        .has-error .input-group-text
        {
            border-color: red !important;
        }
        .has-error input{
            color: red !important;
        }
        .has-error .help-block strong{
            font-size: .7em;
            color: red;
        }
        .navbar.default-layout .navbar-brand-wrapper .navbar-brand img {
    width: calc(255px - 80px);
    max-width: 100%;
    height: 45px;
    margin: auto;
    vertical-align: middle;
}
.navbar.default-layout .navbar-brand-wrapper .brand-logo-mini img {

    width: calc(255px - 210px);
    max-width: 100%;
    height: 45px;
    margin: auto;
    </style>

</head>
<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
                <a class="navbar-brand brand-logo" href="{{ url('/') }}">
                    <img style="width: 50px !important; height: 50px;" src="http://smkn1mas.sch.id/po-includes/images/logo.png" alt="logo" />
                </a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo-mini.png') }}" alt="logo" />
                </a>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center">                
                <ul class="navbar-nav navbar-nav-right">                                                        
                    <li class="nav-item dropdown d-none d-xl-inline-block">
                        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                            <span>{{ Auth::user()->nama_petugas }} - ( {{ Auth::user()->level->nama_level }} )</span>
                            <img class="img-xs rounded-circle" src="{{ Auth::user()->thumb_image }}" alt="Profile image">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" style="padding: 5px" aria-labelledby="UserDropdown">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form2').submit();" class="dropdown-item">
                            Log Out
                        </a>
                    </div>
                    <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form> 
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('_sidebar_menu')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">                   
                @include('_flash_notification_message')
                @yield('content')
            </div>
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="container-fluid clearfix">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019 {{-- Inventaris Sekolah. All rights reserved. <span></span>--}}</span>                                
                </div>
            </footer>
            <!-- partial -->
            <!-- main-panel ends -->
        </div>

    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('assets/vendors/js/vendor.bundle.addons.js') }}"></script>

<script src="{{ asset('assets/datatables/datatables.min.js') }}"></script>

<!-- endinject -->
<!-- Plugin js for this page-->
<script src="{{ asset('assets/sweet-alert/sweetalert.min.js') }}"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ asset('assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('assets/js/misc.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('assets/js/dashboard.js') }}"></script>
<!-- End custom js for this page-->
<script>
    $(document).ready(function () {        
        $(document.body).on('click', '.js-submit-confirm', function (event) {
            event.preventDefault()
            var $form = $(this).closest('form')
            swal({
                title: "Are you sure?",
                text: "You can not undo this process!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: "Cancel",
                closeOnConfirm: true
            },
            function () {
                $form.submit()
            });
        })
    })
</script>
<script>
        $('.simpleDataTables').DataTable({
            "responsive": true,
            "lengthMenu": [
            [5, 10, 15, 20, -1],
                        [5, 10, 15, 20, "All"] // change per page values here
                        ],

                    // set the initial value
                    "pageLength": 5,

                    "language": {
                        "lengthMenu": " _MENU_ records"
                    },
                    "columnDefs": [{ // set default column settings
                        'orderable': true,
                        'targets': [0]
                    }, {
                        "searchable": true,
                        "targets": [0]
                    }],
                    "order": [
                    [0, "asc"]
                    ]
                });
    $(document).ready(function() {        


    
        $('.select2').select2();
    } );
    $(document).ready(function () {

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });

    });
</script>
@yield('js')

</body>
</html>
