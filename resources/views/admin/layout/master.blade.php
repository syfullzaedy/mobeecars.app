<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        .sidebar { min-height: 100vh; background-color: #212529; }
        .sidebar .nav-link { color: rgba(255,255,255,0.75); }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { color: #fff; background-color: rgba(255,255,255,0.1); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Navigation -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse p-3">
            <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <i class="bi bi-speedometer2 me-2 fs-4"></i>
                <span class="fs-4">Admin Panel</span>
            </a>
            <hr class="text-secondary">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? 'active' : '' }}" aria-current="page">
                        <i class="bi bi-house-door me-2"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('get_users') }}" class="nav-link {{ Route::is('get_users') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i> Users
                    </a>
                </li>
                <li>
                    <a href="{{ route('get_cars') }}" class="nav-link {{ Route::is('get_cars') ? 'active' : '' }}">
                        <i class="bi bi-graph-up me-2"></i> Cars
                    </a>
                </li>
                <li>
                    <a href="{{ route('get_reports') }}" class="nav-link {{ Route::is('get_reports') ? 'active' : '' }}">
                        <i class="bi bi-gear me-2"></i> Reports
                    </a>
                </li>
            </ul>
        </nav>

        @yield('content')

    </div>
</div>

<!-- Bootstrap 5 Bundle JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
