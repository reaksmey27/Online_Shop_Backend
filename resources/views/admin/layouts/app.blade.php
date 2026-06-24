<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel — @yield('title', 'Online Shop')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        html, body {
            height: 100%;
            overflow: hidden;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            letter-spacing: -0.01em;
            background-color: #f8f9fa !important;
        }

        .sidebar-nav .nav-link {
            color: #495057;
            font-weight: 500;
            font-size: 0.9rem;
            padding: 0.625rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s ease-in-out;
        }

        .sidebar-nav .nav-link:hover {
            background-color: #f1f3f5;
            color: #212529;
        }

        .sidebar-nav .nav-link.active {
            background-color: #e7f5ff !important;
            color: #0d6efd !important;
            font-weight: 600;
        }

        .sidebar-nav .nav-link i {
            font-size: 1.1rem;
            line-height: 1;
        }

        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #dee2e6;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #ced4da;
        }
    </style>
</head>
<body>

<div class="d-flex w-100 h-100">

    <div class="d-flex flex-column flex-shrink-0 p-4 bg-white border-end h-100" style="width: 260px;">

        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center mb-4 text-decoration-none text-dark gap-2">
            <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-2 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                <i class="bi bi-shop fs-5"></i>
            </div>
            <span class="fs-6 fw-bold tracking-tight text-uppercase text-secondary" style="font-size: 0.8rem !important; letter-spacing: 0.05em;">Online Shop</span>
        </a>

        <ul class="nav nav-pills flex-column mb-auto gap-1 sidebar-nav">
            <li class="nav-small-cap text-uppercase text-muted fw-bold mb-2" style="font-size: 0.65rem; letter-spacing: 0.05em; padding-left: 0.5rem;">Core</li>
            <li>
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2 me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-small-cap text-uppercase text-muted fw-bold mt-3 mb-2" style="font-size: 0.65rem; letter-spacing: 0.05em; padding-left: 0.5rem;">Management</li>
            <li>
                <a href="{{ route('admin.categories.index') }}"
                   class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="bi bi-folder me-2"></i> Categories
                </a>
            </li>
            <li>
                <a href="{{ route('admin.products.index') }}"
                   class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam me-2"></i> Products
                </a>
            </li>
            <li>
                <a href="{{ route('admin.orders.index') }}"
                   class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt me-2"></i> Orders
                </a>
            </li>

            <li class="nav-small-cap text-uppercase text-muted fw-bold mt-3 mb-2" style="font-size: 0.65rem; letter-spacing: 0.05em; padding-left: 0.5rem;">Users & Settings</li>
            <li>
                <a href="{{ route('admin.users.index') }}"
                   class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i> Users
                </a>
            </li>
        </ul>

        <hr class="text-muted opacity-25 my-3">

        <form method="POST" action="{{ route('admin.logout') }}" class="mb-0 sidebar-nav">
            @csrf
            <button type="submit" class="nav-link text-danger w-100 text-start border-0 bg-transparent d-flex align-items-center">
                <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
        </form>
    </div>

    <div class="flex-grow-1 d-flex flex-column h-100 overflow-hidden">

        <nav class="navbar navbar-expand bg-white border-bottom px-4 flex-shrink-0" style="height: 65px;">
            <div class="container-fluid px-0 d-flex align-items-center justify-content-between">

                <div class="d-flex align-items-center gap-2">
                    <span class="text-muted small">Admin</span>
                    <span class="text-muted small opacity-50">/</span>
                    <span class="fw-semibold text-dark small">Overview</span>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-sm-block">
                        <span class="fw-semibold text-dark d-block small lh-1 mb-1">Admin User</span>
                        <span class="text-muted small" style="font-size: 0.75rem;">Store Manager</span>
                    </div>
                    <div class="rounded-circle bg-dark text-white d-flex align-items-center justify-content-center fw-bold shadow-sm"
                         style="width:38px; height:38px; font-size:0.85rem; letter-spacing: 0.02em;">
                        AU
                    </div>
                </div>
            </div>
        </nav>

        <main class="flex-grow-1 p-4 overflow-y-auto">

            <div class="container-fluid px-2">
                @if(session('success'))
                    <div class="alert alert-success border-0 alert-dismissible fade show shadow-sm rounded-3 p-3 mb-4 d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-2 fs-5 text-success"></i>
                        <div class="text-dark fw-medium small">{{ session('success') }}</div>
                        <button type="button" class="btn-close small ms-auto" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger border-0 alert-dismissible fade show shadow-sm rounded-3 p-3 mb-4 d-flex align-items-center">
                        <i class="bi bi-exclamation-circle-fill me-2 fs-5 text-danger"></i>
                        <div class="text-dark fw-medium small">{{ session('error') }}</div>
                        <button type="button" class="btn-close small ms-auto" data-bs-dismiss="alert"></button>
                    </div>
                @endif
            </div>

            @yield('content')
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
