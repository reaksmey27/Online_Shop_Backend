<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Sign In')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --bg:         #f4f6f8;
            --surface:    #ffffff;
            --text:       #1a1d23;
            --text-muted: #6c757d;
            --border:     rgba(0,0,0,.1);
            --input-bg:   #ffffff;
            --focus-ring:   rgba(13,110,253,.25);
            --focus-border: #86b7fe;
        }

        body.theme-dark {
            color-scheme: dark;
            --bg:         #0f172a;
            --surface:    #111827;
            --text:       #e5e7eb;
            --text-muted: rgba(229,231,235,.7);
            --border:     rgba(255,255,255,.1);
            --input-bg:   rgba(17,24,39,.65);
            --focus-ring:   rgba(96,165,250,.25);
            --focus-border: rgba(96,165,250,.65);
        }

        body {
            background-color: var(--bg) !important;
            color: var(--text);
        }

        .card {
            background-color: var(--surface) !important;
            border-color: var(--border) !important;
            color: var(--text) !important;
        }

        .text-dark, .fw-semibold.text-dark { color: var(--text) !important; }
        .text-muted { color: var(--text-muted) !important; }

        .form-control, .form-select {
            background-color: var(--input-bg) !important;
            border-color: var(--border) !important;
            color: var(--text) !important;
        }
        .form-control::placeholder { color: var(--text-muted) !important; }
        .form-control:focus, .form-select:focus {
            border-color: var(--focus-border) !important;
            box-shadow: 0 0 0 .25rem var(--focus-ring) !important;
            background-color: var(--input-bg) !important;
            color: var(--text) !important;
        }

        .alert {
            background-color: rgba(220,53,69,.1) !important;
            border-color: rgba(220,53,69,.2) !important;
            color: var(--text) !important;
        }
    </style>
</head>

<body id="adminAuthBody">

    <div class="min-vh-100 d-flex align-items-center justify-content-center">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        (function () {
            const saved = localStorage.getItem('admin_theme');
            const dark  = saved === 'dark' ||
                (!saved && matchMedia('(prefers-color-scheme: dark)').matches);
            if (dark) document.body.classList.add('theme-dark');
            document.documentElement.style.colorScheme = dark ? 'dark' : 'light';
        })();
    </script>
</body>

</html>
