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
                          <img src="{{ $user->profile_url }}" alt="{{ $user->name }} Profile">
                          <span id="status" class="availability-status offline"></span>
                        </div>
                        <div class="nav-profile-text">
                          <p class="mb-1 text-black">{{ $user->name }}</p>
                        </div>
                      </a>
                      <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="mdi mdi-server-network me-2 text-secondary"></i> <span id="user-ip"></span> </a>
                        <a class="dropdown-item" href="{{route('user.activityLogs',['google_uid' => Auth::user()->google_id])}}">
                          <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{route('logout')}}">
                          <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                      </div>
                    </li>
                    <li class="nav-item d-none d-lg-block full-screen-link">
                      <a class="nav-link">
                        <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                      </a>
                    </li>

                    <li class="nav-item nav-logout d-none d-lg-block">
                      <a class="nav-link" href="{{route('logout')}}">
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
                          <img src="{{ $user->profile_url }}" alt="{{ $user->name }} profile" />
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

                  </ul>
                </nav>
                <div class="main-panel">
                    <div class="content-wrapper">

        @yield('user-content')


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

        <script>
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

        window.onload = fetchUserIP;

        const statusElement = document.getElementById('status');

function updateStatus() {
    if (document.hidden) {
        statusElement.className = 'availability-status offline';
    } else {
        statusElement.className = navigator.onLine ? 'availability-status online' : 'availability-status offline';
    }
}

window.addEventListener('online', updateStatus);
window.addEventListener('offline', updateStatus);
document.addEventListener('visibilitychange', updateStatus);

// Initial status update
updateStatus();
        </script>
    </body>
</html>



