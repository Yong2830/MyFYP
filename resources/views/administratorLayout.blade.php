<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <style>
            .custom-image {
                height: 100vh;
                object-fit: cover;
            }

            body {
                display: flex;
                flex-direction: column;
                height: 100vh;
                margin-bottom: 40px;
            }

            .container {
                flex: 1;
            }

            footer {
                background-color: #f8f9fa;
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
                height: 20px; /* Height of the footer */
            }

            footer p {
                margin: 0;
            }

            header {
                background-color: #f8f9fa;
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px 40px;
            }

            header h1 {
                margin: 0;
                font-size: 2rem;
                font-weight: bold;
            }

            header p {
                margin: 0;
                font-size: 1rem;
                font-weight: 500;
                color: #6c757d;
            }

            .logout-btn {
                border: none;
                background: none;
                color: inherit;
                font: inherit;
                cursor: pointer;
                padding: 0;
                font-size: 1.2rem;
                color: red;
            }

            nav.sidebar {
                background-color: #36474F;
            }

            .nav-link {
                color: #fff;
            }

            .nav-link:hover {
                color: #fff;
                background-color: #6c757d;
            }
            .active {
                color: #fff;
                background-color: #0d6efd;
            }
        </style>

    </head>

    <body>
        <header>
            <h1>Property Rent System</h1>
            
            <form action="{{ route('logoutAdvertiser') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn" onclick="return confirm('Are you sure you want to logout?')">Logout</button>
            </form>
        </header>

        <div class="container-fluid">
            <div class="row">
                <nav class="col-md-2 d-none d-md-block sidebar vh-100">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">

                            <br>
                            <br>

                            <li class="nav-item">
                                <h2 class="text-center text-light">Admin</h2>
                            </li>

                            <li class="nav-item">
                                @if (auth()->guard('administrator')->check())
                                    <h4 class="text-center text-light">{{ auth()->guard('administrator')->user()->administrator_name }}</h4>
                                @endif
                            </li>

                            <br>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('homepage') }}">Dashboard</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="reportDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    User Management
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="reportDropdown">
                                    <li><a class="dropdown-item" href="{{ route('viewTenant') }}">Tenant</a></li>
                                    <li><a class="dropdown-item" href="{{ route('viewLandlord') }}">Advertiser</a></li>
                                    <li><a class="dropdown-item" href="{{ route('viewAdmin') }}">Admin</a></li>
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="reportDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Registration Management
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="reportDropdown">
                                    <li><a class="dropdown-item" href="{{ route('tenantApproval') }}">Tenant Registration</a></li>
                                    <li><a class="dropdown-item" href="{{ route('landlordApproval') }}">Advertiser Registration</a></li>
                                    <li><a class="dropdown-item" href="{{ route('showAllPropertyApproval') }}">Property Registration</a></li>
                                </ul>
                            </li>
 
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="reportDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Report Generator
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="reportDropdown">
                                    <li><a class="dropdown-item" href="{{ route('viewUserAccManagementReport') }}">User Account Management Report</a></li>
                                    <li><a class="dropdown-item" href="{{ route ('viewPropRegManagementReport') }}">Property Registration Management Report</a></li>
                                    <li><a class="dropdown-item" href="{{ route ('viewContentCheckerReport') }}">Content Checker Report</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('viewCheckerForm') }}">Content Checker</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('adminProfileView') }}">Profile Settings</a>
                            </li>
      
                        </ul>
                    </div>
                </nav>
                <br><br>
                {{-- For all the content --}}
                <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                  @yield('content')
                </main>
            </div>
          </div>

        <br>

        <footer>
            <div class="container">
                <p class="m-0">&copy; 2023 Web-Based Property Rental System</p>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Initialize all dropdowns on the page
            var dropdowns = document.querySelectorAll('.dropdown-toggle');
            dropdowns.forEach(function (dropdown) {
                dropdown.addEventListener('click', function () {
                    dropdown.parentElement.classList.toggle('show');
                });
            });

            // Close dropdown when clicking outside of it
            window.addEventListener('click', function (event) {
                var dropdowns = document.querySelectorAll('.dropdown');
                dropdowns.forEach(function (dropdown) {
                    if (!dropdown.contains(event.target)) {
                        dropdown.classList.remove('show');
                    }
                });
            });
        </script>

    </body>

</html>