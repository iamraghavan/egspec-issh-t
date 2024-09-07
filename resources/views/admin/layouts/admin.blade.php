<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="{{ asset("/assets/admin-user/vendors/mdi/css/materialdesignicons.min.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/admin-user/vendors/ti-icons/css/themify-icons.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/admin-user/vendors/css/vendor.bundle.base.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/admin-user/vendors/font-awesome/css/font-awesome.min.css") }}">

        <link rel="stylesheet" href="{{ asset("/assets/admin-user/vendors/font-awesome/css/font-awesome.min.css") }}" />
        <link rel="stylesheet" href="{{ asset("/assets/admin-user/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css") }}">

        <link rel="stylesheet" href="{{ asset("/assets/admin-user/css/style.css") }}">

        <link rel="shortcut icon" href="{{ asset("/assets/admin-user/images/favicon.png") }}" />

        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">

        @stack('styles')


    </head>
    <body>

        <div class="container-scroller">

            <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">

                </div>
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                  <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                  </button>
                  <div class="search-field d-none d-md-block">
                    <form class="d-flex align-items-center h-100" action="#">
                      <div class="input-group">
                        <div class="input-group-prepend bg-transparent">
                          <i class="input-group-text border-0 mdi mdi-magnify"></i>
                        </div>
                        <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
                      </div>
                    </form>
                  </div>
                  <ul class="navbar-nav navbar-nav-right">
                    <li class="nav-item nav-profile dropdown">
                      <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="nav-profile-img">
                          <img src="https://placehold.co/300x300" alt="{{ $user->name }} Profile">
                          <span id="status" class="availability-status offline"></span>
                        </div>
                        <div class="nav-profile-text">
                          <p class="mb-1 text-black">{{ $user->name }}</p>
                        </div>
                      </a>
                      <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="mdi mdi-server-network me-2 text-secondary"></i> <span id="user-ip"></span> </a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('admin.logout')}}">
                          <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                      </div>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                      <a class="nav-link">
                        <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                      </a>
                    </li>

                    <li class="nav-item nav-logout d-none d-lg-block">
                      <a class="nav-link" href="{{route('admin.logout')}}">
                        <i class="mdi mdi-power"></i>
                      </a>
                    </li>

                  </ul>
                  <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                  </button>
                </div>
              </nav>
              <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_sidebar.html -->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                  <ul class="nav">
                    <li class="nav-item nav-profile">
                      <a href="#" class="nav-link">
                        <div class="nav-profile-image">
                          <img src="https://placehold.co/300x300" alt="{{ $user->name }} profile" />
                          <span class="login-status online"></span>
                          <!--change to offline or busy as needed-->
                        </div>
                        <div class="nav-profile-text d-flex flex-column">
                          <span class="font-weight-bold mb-2">{{ $user->name }}</span>
                          <span class="text-secondary text-small">{{ config('app.name') }} user</span>
                        </div>
                        {{-- <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i> --}}
                      </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.dashboard', ['token' => $token])}}">
                          <span class="menu-title">Dashboard</span>

                        </a>
                      </li>




                      <li class="nav-item">
                        <a class="nav-link" data-toggle="collapse" href="#sessions-menu" aria-expanded="true" aria-controls="sessions-menu">
                            <span class="menu-title">Session</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                        </a>
                        <div class="collapse show" id="sessions-menu">
                            <ul class="nav flex-column sub-menu">
                                <!-- Link to the index page -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('sessions.index', ['token' => $token]) }}">
                                        All Sessions
                                    </a>
                                </li>

                                <!-- Link to create a new session -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('sessions.create', ['token' => $token]) }}">
                                        Create New Session
                                    </a>
                                </li>


                            </ul>
                        </div>


                        <a class="nav-link" data-toggle="collapse" href="#sessions-menu" aria-expanded="true" aria-controls="sessions-menu">
                            <span class="menu-title">Speaker</span>
                            <i class="menu-arrow"></i>
                            <i class="mdi mdi-crosshairs-gps menu-icon"></i>
                        </a>

                        <div class="collapse show" id="sessions-menu">
                            <ul class="nav flex-column sub-menu">
                                <!-- Link to the index page -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('speaker.index', ['token' => $token]) }}">
                                    Speaker Profile
                                    </a>
                                </li>

                                <!-- Link to create a new session -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('speaker.create', ['token' => $token]) }}">
                                        Create Speaker Profile
                                    </a>
                                </li>


                            </ul>
                        </div>
                    </li>



                      <li class="nav-item">
                        <a class="nav-link" href="#">
                          <span class="menu-title">Laravel v{{ Illuminate\Foundation\Application::VERSION }}</span>

                        </a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.logout') }}">
                          <span class="menu-title">Logout</span>

                        </a>
                      </li>

                  </ul>
                </nav>
                <div class="main-panel">
                    <div class="content-wrapper">

                        @yield('admin_content')



                    </div>


                    <footer class="footer">
                        <div class="container-fluid clearfix">
                            <span class="float-none float-sm-right d-block mt-1 mb-1 mt-sm-0 text-center">
                                Developed By Raghavan Jeeva
                             </span>
                            <span class="text-muted float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                                Copyright © 2006 - {{ date('Y') }} All Rights Reserved by EGS Pillay Group of Institutions
                            </span>

                        </div>
                    </footer>

                </div>

              </div>


        </div>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stack('scripts')
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>


        <script src="{{ asset("/assets/admin-user/vendors/js/vendor.bundle.base.js") }}"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="{{ asset("/assets/admin-user/vendors/chart.js/chart.umd.js") }}"></script>
        <script src="{{ asset("/assets/admin-user/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js") }}"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="{{ asset("/assets/admin-user/js/off-canvas.js") }}"></script>
        <script src="{{ asset("/assets/admin-user/js/misc.js") }}"></script>
        <script src="{{ asset("/assets/admin-user/js/settings.js") }}"></script>
        <script src="{{ asset("/assets/admin-user/js/todolist.js") }}"></script>
        <script src="{{ asset("/assets/admin-user/js/jquery.cookie.js") }}"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="{{ asset("/assets/admin-user/js/dashboard.js") }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

        <script>
            // Error Handling
            function handleAccessDeniedError() {
                if ({{ $errors->has('restricted_area') ? 'true' : 'false' }}) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Access Denied',
                        text: '{{ $errors->first('restricted_area') }}',
                    });
                }
            }

            // Login Success Notification
            function showLoginSuccessNotification() {
                const urlParams = new URLSearchParams(window.location.search);
                const loginSuccess = urlParams.get('login_success');
                if (loginSuccess === 'true') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Welcome!',
                        text: 'You have successfully logged in as an Event Organizer.',
                        confirmButtonText: 'OK'
                    });
                }
            }

            // Fetch User IP Address
            async function fetchUserIP() {
                try {
                    const response = await fetch('https://api.ipify.org?format=json');
                    const data = await response.json();
                    document.getElementById('user-ip').innerText = data.ip;
                } catch (error) {
                    console.error('Error fetching IP address:', error);
                    document.getElementById('user-ip').innerText = 'Unable to retrieve IP address';
                }
            }

            // Update Online/Offline Status
            function updateStatus() {
                const statusElement = document.getElementById('status');
                if (document.hidden) {
                    statusElement.className = 'availability-status offline';
                } else {
                    statusElement.className = navigator.onLine ? 'availability-status online' : 'availability-status offline';
                }
            }

            function initialize() {
                handleAccessDeniedError();
                showLoginSuccessNotification();
                fetchUserIP();
                updateStatus();

                window.addEventListener('online', updateStatus);
                window.addEventListener('offline', updateStatus);
                document.addEventListener('visibilitychange', updateStatus);
            }

            document.addEventListener('DOMContentLoaded', initialize);
        </script>

    </body>
</html>



