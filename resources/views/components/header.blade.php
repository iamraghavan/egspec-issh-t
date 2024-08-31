<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="https://www.townscript.com/v2/assets/images/ts-logo.svg" alt="Eventsss Logo" width="120" height="30">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Schedule</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Speakers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Communities</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Code of Conduct</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">

                        <li>
                            <a class="dropdown-item" href="{{ route('user.dashboard', ['google_uid' => Auth::user()->google_id]) }}">
                                Dashboard
                            </a>
                        </li>
                        <li><a class="dropdown-item" href="#"><span id="user-ip">Loading...</span></a></li>

                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>


                    </ul>
                </li>
                @else
                <li class="nav-item">
                    <a class="login-with-google-btn" href="{{ route('google.login') }}">

          Login with Google
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
.login-with-google-btn {
  transition: background-color .3s, box-shadow .3s;

  padding: 12px 16px 12px 42px;
  border: none;
  border-radius: 3px;
  box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 1px 1px rgba(0, 0, 0, .25);

  color: #757575;
  font-size: 14px;
  font-weight: 500;
  font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen,Ubuntu,Cantarell,"Fira Sans","Droid Sans","Helvetica Neue",sans-serif;

  background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTgiIGhlaWdodD0iMTgiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMTcuNiA5LjJsLS4xLTEuOEg5djMuNGg0LjhDMTMuNiAxMiAxMyAxMyAxMiAxMy42djIuMmgzYTguOCA4LjggMCAwIDAgMi42LTYuNnoiIGZpbGw9IiM0Mjg1RjQiIGZpbGwtcnVsZT0ibm9uemVybyIvPjxwYXRoIGQ9Ik05IDE4YzIuNCAwIDQuNS0uOCA2LTIuMmwtMy0yLjJhNS40IDUuNCAwIDAgMS04LTIuOUgxVjEzYTkgOSAwIDAgMCA4IDV6IiBmaWxsPSIjMzRBODUzIiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNNCAxMC43YTUuNCA1LjQgMCAwIDEgMC0zLjRWNUgxYTkgOSAwIDAgMCAwIDhsMy0yLjN6IiBmaWxsPSIjRkJCQzA1IiBmaWxsLXJ1bGU9Im5vbnplcm8iLz48cGF0aCBkPSJNOSAzLjZjMS4zIDAgMi41LjQgMy40IDEuM0wxNSAyLjNBOSA5IDAgMCAwIDEgNWwzIDIuNGE1LjQgNS40IDAgMCAxIDUtMy43eiIgZmlsbD0iI0VBNDMzNSIgZmlsbC1ydWxlPSJub256ZXJvIi8+PHBhdGggZD0iTTAgMGgxOHYxOEgweiIvPjwvZz48L3N2Zz4=);
  background-color: white;
  background-repeat: no-repeat;
  background-position: 12px 11px;

  &:hover {
    box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 2px 4px rgba(0, 0, 0, .25);
  }

  &:active {
    background-color: #eeeeee;
  }

  &:focus {
    outline: none;
    box-shadow:
      0 -1px 0 rgba(0, 0, 0, .04),
      0 2px 4px rgba(0, 0, 0, .25),
      0 0 0 3px #c8dafc;
  }

  &:disabled {
    filter: grayscale(100%);
    background-color: #ebebeb;
    box-shadow: 0 -1px 0 rgba(0, 0, 0, .04), 0 1px 1px rgba(0, 0, 0, .25);
    cursor: not-allowed;
  }
}










/* Navbar background and link styling */
.navbar {
    background-color: #343a40; /* Dark background */
}
.navbar .navbar-nav .nav-item {
    margin: 0 1rem;
    font-weight: 700;
    text-transform: uppercase;
}

.navbar .navbar-brand img {
    max-height: 40px; /* Adjust logo size */
    width: auto;
}

.navbar .nav-link {
    color: #000; /* White text color */
    padding: 10px 15px;
    font-weight: 600;
    font-size: 1rem;
    transition: color 0.3s ease;
}

.navbar .nav-link:hover,
.navbar .nav-link.active {
    color: #fc5a1b; /* Highlight color */
}




/* Dropdown menu styling */
.navbar .dropdown-menu {
    background-color: #fff; /* Match the navbar background */
    border: none;
}

.navbar .dropdown-menu .dropdown-item {
    color: #000;
    transition: background-color 0.3s ease;
}

.navbar .dropdown-menu .dropdown-item:hover {
    background-color: #495057;
}

/* Toggle button styling */
.navbar-toggler {
    border: none;
}

.navbar-toggler-icon {
    background-image: url('data:image/svg+xml;charset=UTF8,%3Csvg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"%3E%3Cpath stroke="rgba%2888, 88, 88, 0.7%29" stroke-width="2" linecap="round" linejoin="round" d="M4 7h22M4 15h22M4 23h22"/%3E%3C/svg%3E');
}

/* Mobile dropdown styling */
@media (max-width: 991.98px) {
    .navbar .navbar-brand {
        margin-left: 0; /* Remove any automatic centering */
        margin-right: auto; /* Ensure it stays left */
    }
    .navbar .navbar-nav {
        background-color: #ffffff;
    }

    .navbar .navbar-nav .nav-item {
        padding: 0.5rem;
        border-bottom: 2px solid #bfbfbf;
    }

    .navbar .dropdown-menu {
        position: static;
        float: none;
        width: auto;
        margin-top: 0;
        background-color: #cfcfcf;
    }
}
</style>
