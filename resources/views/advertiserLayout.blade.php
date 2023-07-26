<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        @vite(['resources/js/app.js'])
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
                                <h2 class="text-center text-light">Advertiser</h2>
                            </li>

                            <li class="nav-item">
                                @if (auth()->guard('advertiser')->check())
                                    <h4 class="text-center text-light">{{ auth()->guard('advertiser')->user()->advertiser_name }}</h4>
                                @endif
                            </li>

                            <br>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('advertiser.advertiserTest') }}">Dashboard</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('advertiserViewChatList') }}">Chat</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('property.index') }}">Property</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="reportDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Report
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="reportDropdown">
                                    <li><a class="dropdown-item" href="{{ route('viewSummaryReport') }}">Summary Report</a></li>
                                    <li><a class="dropdown-item" href="{{ route('viewVacancyReport') }}">Vacancy Report</a></li>
                                    <li><a class="dropdown-item" href="{{ route('viewCategoryReport') }}">Category Report</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('viewProfileForm') }}">Profile Settings</a>
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
       

        {{-- Include Bootstrap and jQuery libraries --}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        {{-- For alert session message to disappear after 4 sec --}}
        <script type="text/javascript">
            $(document).ready(function() {
              setTimeout(function() {
                $("div.alert").remove();  
              }, 4000);
            })
        </script>

        {{-- for Uploading Images and Preview! --}}
        <script type="text/javascript">
            $('input[name="property_image1"]').change(function() {
            // Get the selected file
            let file = this.files[0];
            if (!file) {
                // reset the preview image if got no file is selected
                $('#preview-img').attr('src', '#').hide();
                return;
            }
    
            // Use the FileReader API to read the selected file
            let reader = new FileReader();
            reader.onload = function(event) {
                // To set the preview image source then display it
                $('#preview-img').attr('src', event.target.result).show();
            };
            reader.readAsDataURL(file);
            });
        </script>

        {{-- For Dropdown list on Report --}}
        <script type="text/javascript">
            $(document).ready(function() {
                // Initialize Bootstrap dropdowns
                var dropdowns = document.querySelectorAll('.dropdown-toggle');
                dropdowns.forEach(function(dropdown) {
                    new bootstrap.Dropdown(dropdown);
                });
            });
        </script>

        

    </body>

    
</html>