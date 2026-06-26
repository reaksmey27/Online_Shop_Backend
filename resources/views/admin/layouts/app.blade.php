<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel — @yield('title', 'Online Shop')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        /* ─── Layout ─────────────────────────────────────────────── */
        html, body { height: 100%; overflow: hidden; }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            letter-spacing: -0.01em;
            transition: background-color .2s, color .2s;
        }

        /* ─── Light tokens ───────────────────────────────────────── */
        :root {
            --bg:            #f4f6f8;
            --surface:       #ffffff;
            --surface-2:     #f1f3f5;
            --surface-3:     #e9ecef;
            --text:          #1a1d23;
            --text-muted:    #6c757d;
            --border:        rgba(0, 0, 0, .09);
            --border-strong: rgba(0, 0, 0, .15);
            --sidebar-w:     260px;
            --topbar-h:      60px;
            --link:          #495057;
            --link-hover-bg: #f1f3f5;
            --link-active-bg:#e7f5ff;
            --link-active:   #0d6efd;
            --scroll-thumb:  #ced4da;
            --scroll-hover:  #adb5bd;
            --input-bg:      #ffffff;
            --avatar-bg:     #343a40;
            --avatar-text:   #ffffff;
            --focus-ring:    rgba(13, 110, 253, .25);
            --focus-border:  #86b7fe;
        }

        /* ─── Dark tokens ────────────────────────────────────────── */
        body.theme-dark {
            color-scheme: dark;
            --bg:            #0d1117;
            --surface:       #161b27;
            --surface-2:     #1e2433;
            --surface-3:     #252d3d;
            --text:          #e2e8f0;
            --text-muted:    #94a3b8;
            --border:        rgba(255, 255, 255, .08);
            --border-strong: rgba(255, 255, 255, .14);
            --link:          #94a3b8;
            --link-hover-bg: rgba(255, 255, 255, .05);
            --link-active-bg:rgba(59, 130, 246, .15);
            --link-active:   #60a5fa;
            --scroll-thumb:  rgba(255, 255, 255, .15);
            --scroll-hover:  rgba(255, 255, 255, .25);
            --input-bg:      rgba(255, 255, 255, .04);
            --avatar-bg:     #334155;
            --avatar-text:   #e2e8f0;
            --focus-ring:    rgba(96, 165, 250, .25);
            --focus-border:  rgba(96, 165, 250, .7);
        }

        /* ─── Scrollbar ──────────────────────────────────────────── */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--scroll-thumb); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--scroll-hover); }

        /* ─── Global surface resets ──────────────────────────────── */
        body {
            background-color: var(--bg) !important;
            color: var(--text);
        }

        .bg-white, .bg-light, .bg-light-subtle,
        .card, .modal-content, .dropdown-menu,
        .popover, .toast, .offcanvas {
            background-color: var(--surface) !important;
            color: var(--text) !important;
        }

        .card-header, .card-footer {
            background-color: var(--surface-2) !important;
            border-color: var(--border) !important;
        }

        /* ─── Borders ────────────────────────────────────────────── */
        .border, .border-top, .border-end, .border-bottom, .border-start,
        .border-light, .border-light-subtle {
            border-color: var(--border) !important;
        }

        /* ─── Typography ─────────────────────────────────────────── */
        .text-dark, .text-body, .fw-semibold.text-dark, .fw-medium.text-dark { color: var(--text) !important; }
        .text-muted, small.text-muted { color: var(--text-muted) !important; }
        .text-white { color: #fff !important; }

        /* ─── Sidebar ────────────────────────────────────────────── */
        .sidebar {
            width: var(--sidebar-w);
            background-color: var(--surface);
            border-right: 1px solid var(--border);
            transition: background-color .2s;
        }

        .sidebar-brand-icon {
            background-color: rgba(13, 110, 253, .12);
            color: #0d6efd;
        }
        body.theme-dark .sidebar-brand-icon {
            background-color: rgba(96, 165, 250, .15);
            color: #60a5fa;
        }

        .sidebar-section-label {
            font-size: 0.65rem;
            letter-spacing: 0.06em;
            font-weight: 600;
            color: var(--text-muted);
            padding: 0 .5rem;
            text-transform: uppercase;
        }

        .sidebar-nav .nav-link {
            color: var(--link);
            font-weight: 500;
            font-size: .9rem;
            padding: .6rem 1rem;
            border-radius: .5rem;
            transition: background-color .15s, color .15s;
        }
        .sidebar-nav .nav-link:hover {
            background-color: var(--link-hover-bg);
            color: var(--text);
        }
        .sidebar-nav .nav-link.active {
            background-color: var(--link-active-bg) !important;
            color: var(--link-active) !important;
            font-weight: 600;
        }
        .sidebar-nav .nav-link i { font-size: 1.05rem; line-height: 1; }

        .sidebar-logout {
            color: #dc3545 !important;
            font-weight: 500;
            font-size: .9rem;
            padding: .6rem 1rem;
            border-radius: .5rem;
            transition: background-color .15s;
        }
        .sidebar-logout:hover { background-color: rgba(220, 53, 69, .08); }
        body.theme-dark .sidebar-logout:hover { background-color: rgba(248, 113, 113, .1); }

        /* ─── Topbar ─────────────────────────────────────────────── */
        .topbar {
            height: var(--topbar-h);
            background-color: var(--surface);
            border-bottom: 1px solid var(--border);
        }

        .topbar-breadcrumb .sep { color: var(--border-strong); }
        .topbar-breadcrumb .crumb-active { color: var(--text); font-weight: 600; }

        /* ─── Theme toggle button ────────────────────────────────── */
        .theme-toggle-btn {
            background-color: var(--surface-2) !important;
            border: 1px solid var(--border-strong) !important;
            color: var(--text) !important;
            border-radius: 999px;
        }
        .theme-toggle-btn:hover { background-color: var(--surface-3) !important; }

        /* ─── Avatars ────────────────────────────────────────────── */
        .topbar-avatar,
        .user-avatar {
            background-color: var(--avatar-bg);
            color: var(--avatar-text);
            border: 1px solid var(--border-strong);
        }

        /* ─── Tables ─────────────────────────────────────────────── */
        .table { --bs-table-bg: transparent; border-color: var(--border) !important; }
        .table > :not(caption) > * > * { color: var(--text) !important; background-color: transparent !important; }
        .table-light, thead.table-light th, thead.bg-light th {
            background-color: var(--surface-2) !important;
            color: var(--text-muted) !important;
            border-color: var(--border) !important;
        }
        .table-hover tbody tr:hover td { background-color: var(--surface-2) !important; }
        .table-striped > tbody > tr:nth-of-type(odd) > * { background-color: rgba(128,128,128,.04) !important; }
        .table-responsive { background-color: transparent !important; }

        /* ─── Forms ──────────────────────────────────────────────── */
        .form-control, .form-select, .input-group-text {
            background-color: var(--input-bg) !important;
            border-color: var(--border-strong) !important;
            color: var(--text) !important;
        }
        .form-control::placeholder { color: var(--text-muted) !important; opacity: .7; }
        .form-control:focus, .form-select:focus {
            background-color: var(--input-bg) !important;
            border-color: var(--focus-border) !important;
            box-shadow: 0 0 0 .2rem var(--focus-ring) !important;
            color: var(--text) !important;
        }
        .form-check-input {
            background-color: var(--input-bg) !important;
            border-color: var(--border-strong) !important;
        }
        .form-check-input:checked { background-color: var(--link-active) !important; border-color: var(--link-active) !important; }
        .form-label { color: var(--text-muted); }

        /* ─── Buttons ────────────────────────────────────────────── */
        .btn-light {
            background-color: var(--surface-2) !important;
            border-color: var(--border-strong) !important;
            color: var(--text) !important;
        }
        .btn-light:hover { background-color: var(--surface-3) !important; }
        .btn-dark {
            background-color: var(--surface-3) !important;
            border-color: var(--border-strong) !important;
            color: var(--text) !important;
        }

        /* ─── Alerts ─────────────────────────────────────────────── */
        .alert-success { background-color: rgba(25, 135, 84, .1) !important; border-color: rgba(25, 135, 84, .2) !important; }
        .alert-danger  { background-color: rgba(220, 53, 69, .1)  !important; border-color: rgba(220, 53, 69, .2)  !important; }
        .alert-warning { background-color: rgba(255, 193, 7, .1)  !important; border-color: rgba(255, 193, 7, .2)  !important; }
        .alert-info    { background-color: rgba(13, 202, 240, .1)  !important; border-color: rgba(13, 202, 240, .2) !important; }

        body.theme-dark .alert-success { background-color: rgba(34, 197, 94, .12)  !important; border-color: rgba(34, 197, 94, .2)  !important; }
        body.theme-dark .alert-danger  { background-color: rgba(248, 113, 113, .12) !important; border-color: rgba(248, 113, 113, .2) !important; }
        body.theme-dark .alert-warning { background-color: rgba(251, 191, 36, .12)  !important; border-color: rgba(251, 191, 36, .2)  !important; }
        body.theme-dark .alert-info    { background-color: rgba(56, 189, 248, .12)  !important; border-color: rgba(56, 189, 248, .2)  !important; }

        .alert .btn-close { filter: var(--close-filter, none); }
        body.theme-dark .alert .btn-close { --close-filter: invert(1) brightness(.7); }

        /* ─── Badges ─────────────────────────────────────────────── */
        .badge { font-weight: 500; }
        .badge.bg-light, .badge.bg-light-subtle {
            background-color: var(--surface-3) !important;
            color: var(--text) !important;
            border: 1px solid var(--border) !important;
        }
        .badge.bg-primary-subtle   { background-color: rgba(13,110,253,.12) !important; color: #0d6efd !important; }
        .badge.bg-success-subtle   { background-color: rgba(25,135,84,.12)  !important; color: #198754 !important; }
        .badge.bg-warning-subtle   { background-color: rgba(255,193,7,.12)  !important; color: #997404 !important; }
        .badge.bg-danger-subtle    { background-color: rgba(220,53,69,.12)  !important; color: #dc3545 !important; }
        .badge.bg-info-subtle      { background-color: rgba(13,202,240,.12) !important; color: #087990 !important; }

        body.theme-dark .badge.bg-primary-subtle   { color: #93c5fd !important; }
        body.theme-dark .badge.bg-success-subtle   { color: #86efac !important; }
        body.theme-dark .badge.bg-warning-subtle   { color: #fde68a !important; }
        body.theme-dark .badge.bg-danger-subtle    { color: #fca5a5 !important; }
        body.theme-dark .badge.bg-info-subtle      { color: #67e8f9 !important; }

        /* ─── Dropdowns ──────────────────────────────────────────── */
        .dropdown-menu {
            border-color: var(--border) !important;
            box-shadow: 0 4px 16px rgba(0,0,0,.12);
        }
        .dropdown-item { color: var(--text) !important; }
        .dropdown-item:hover, .dropdown-item:focus { background-color: var(--surface-2) !important; }
        .dropdown-divider { border-color: var(--border) !important; }

        /* ─── Pagination ─────────────────────────────────────────── */
        .page-link {
            background-color: var(--surface) !important;
            border-color: var(--border) !important;
            color: var(--text) !important;
        }
        .page-link:hover { background-color: var(--surface-2) !important; }
        .page-item.active .page-link {
            background-color: var(--link-active-bg) !important;
            border-color: rgba(59,130,246,.35) !important;
            color: var(--link-active) !important;
        }
        .page-item.disabled .page-link { color: var(--text-muted) !important; }

        /* ─── Misc ───────────────────────────────────────────────── */
        code {
            background-color: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: .25rem;
            padding: .1em .4em;
            font-size: .85em;
            color: var(--text);
        }
        hr { border-color: var(--border) !important; }

        .bg-primary.bg-opacity-10  { background-color: rgba(13,110,253,.1)  !important; }
        .bg-success.bg-opacity-10  { background-color: rgba(25,135,84,.1)   !important; }
        .bg-warning.bg-opacity-10  { background-color: rgba(255,193,7,.1)   !important; }
        .bg-info.bg-opacity-10     { background-color: rgba(13,202,240,.1)  !important; }
        .bg-danger.bg-opacity-10   { background-color: rgba(220,53,69,.1)   !important; }

        /* ─── Pagination clean utility ───────────────────────────── */
        .pagination-clean .pagination { margin-bottom: 0; }
        .pagination-clean .page-link {
            padding: .375rem .75rem;
            font-size: .85rem;
            border-radius: .375rem;
            margin: 0 2px;
        }

        /* ─── Form focus (shared across all pages) ───────────────── */
        .form-control:focus,
        .form-select:focus,
        .form-check-input:focus {
            border-color: var(--focus-border) !important;
            box-shadow: 0 0 0 .2rem var(--focus-ring) !important;
        }

        /* ─── Switch toggle surface ──────────────────────────────── */
        .switch-surface {
            background-color: var(--surface-2);
            border: 1px solid var(--border);
            border-radius: .5rem;
        }

        /* ─── btn-outline-primary in image toggles ───────────────── */
        .btn-outline-primary {
            color: var(--link-active) !important;
            border-color: var(--link-active) !important;
        }
        .btn-check:checked + .btn-outline-primary {
            background-color: var(--link-active) !important;
            color: #fff !important;
        }
    </style>
</head>

<body>

    <div class="d-flex w-100 h-100">

        {{-- ── Sidebar ──────────────────────────────────────────────── --}}
        <div class="sidebar d-flex flex-column flex-shrink-0 p-3 h-100">

            <a href="{{ route('admin.dashboard') }}"
                class="d-flex align-items-center mb-4 px-1 text-decoration-none gap-2">
                <div class="sidebar-brand-icon rounded-3 p-2 d-flex align-items-center justify-content-center flex-shrink-0"
                    style="width:36px; height:36px;">
                    <i class="bi bi-shop fs-5"></i>
                </div>
                <span style="font-size:.75rem; font-weight:700; letter-spacing:.06em; text-transform:uppercase; color:var(--text-muted);">
                    Online Shop
                </span>
            </a>

            <ul class="nav nav-pills flex-column mb-auto gap-1 sidebar-nav">
                <li class="sidebar-section-label mb-2">Core</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}"
                        class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid-1x2 me-2"></i> Dashboard
                    </a>
                </li>

                <li class="sidebar-section-label mt-3 mb-2">Management</li>
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

                <li class="sidebar-section-label mt-3 mb-2">Users &amp; Settings</li>
                <li>
                    <a href="{{ route('admin.users.index') }}"
                        class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i> Users
                    </a>
                </li>
            </ul>

            <hr class="my-3">

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit"
                    class="sidebar-logout border-0 bg-transparent w-100 text-start d-flex align-items-center">
                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                </button>
            </form>
        </div>

        {{-- ── Main column ──────────────────────────────────────────── --}}
        <div class="flex-grow-1 d-flex flex-column h-100 overflow-hidden">

            {{-- Topbar --}}
            <nav class="topbar navbar navbar-expand px-4 flex-shrink-0">
                <div class="container-fluid px-0 d-flex align-items-center justify-content-between">

                    <div class="topbar-breadcrumb d-flex align-items-center gap-2 small">
                        <span style="color:var(--text-muted);">Admin</span>
                        <span class="sep" aria-hidden="true">/</span>
                        <span class="crumb-active">@yield('breadcrumb', 'Overview')</span>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <button type="button"
                            class="btn btn-sm theme-toggle-btn d-flex align-items-center gap-2 px-3 py-1"
                            id="adminThemeToggle" aria-label="Toggle dark mode">
                            <i class="bi" id="adminThemeToggleIcon" style="font-size:1rem;"></i>
                            <span class="d-none d-md-inline small" id="adminThemeToggleText">Dark</span>
                        </button>

                        <div class="text-end d-none d-sm-block">
                            <span class="d-block small lh-1 mb-1" style="font-weight:600; color:var(--text);">
                                Admin User
                            </span>
                            <span class="small" style="font-size:.75rem; color:var(--text-muted);">
                                Store Manager
                            </span>
                        </div>

                        <div class="topbar-avatar rounded-circle d-flex align-items-center justify-content-center fw-bold"
                            style="width:36px; height:36px; font-size:.8rem;">
                            AU
                        </div>
                    </div>
                </div>
            </nav>

            {{-- Page content --}}
            <main class="flex-grow-1 p-4 overflow-y-auto" style="background-color:var(--bg);">
                <div class="container-fluid px-0">

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-3 p-3 mb-4 d-flex align-items-center border-0 shadow-sm">
                            <i class="bi bi-check-circle-fill me-2 fs-5 text-success flex-shrink-0"></i>
                            <div class="small fw-medium">{{ session('success') }}</div>
                            <button type="button" class="btn-close small ms-auto" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-3 p-3 mb-4 d-flex align-items-center border-0 shadow-sm">
                            <i class="bi bi-exclamation-circle-fill me-2 fs-5 text-danger flex-shrink-0"></i>
                            <div class="small fw-medium">{{ session('error') }}</div>
                            <button type="button" class="btn-close small ms-auto" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                </div>

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        (function () {
            const KEY  = 'admin_theme';
            const btn  = document.getElementById('adminThemeToggle');
            const icon = document.getElementById('adminThemeToggleIcon');
            const label = document.getElementById('adminThemeToggleText');

            function apply(theme) {
                const dark = theme === 'dark';
                document.body.classList.toggle('theme-dark', dark);
                if (icon)  icon.className   = 'bi ' + (dark ? 'bi-sun-fill' : 'bi-moon-stars-fill');
                if (label) label.textContent = dark ? 'Light' : 'Dark';
            }

            function saved() {
                const v = localStorage.getItem(KEY);
                if (v === 'light' || v === 'dark') return v;
                return matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }

            apply(saved());

            btn && btn.addEventListener('click', function () {
                const next = document.body.classList.contains('theme-dark') ? 'light' : 'dark';
                localStorage.setItem(KEY, next);
                apply(next);
            });
        })();
    </script>

    @stack('scripts')
</body>

</html>
