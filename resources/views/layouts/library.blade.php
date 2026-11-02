
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Perpustakaan')</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            line-height: 1.6;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 24px;
        }

        /* Navigation */
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 24px;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            margin-bottom: 32px;
        }

        .brand {
            font-size: 18px;
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.5px;
        }

        .nav-links {
            display: flex;
            gap: 8px;
        }

        nav a {
            text-decoration: none;
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 14px;
            border-radius: 7px;
            transition: .2s;
        }

        nav a:hover {
            background: #eff6ff;
            color: #2563eb;
        }

        /* Content */
        main {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 28px;
        }

        h1, h2, h3 {
            color: #0f172a;
            line-height: 1.3;
            margin-bottom: 18px;
            letter-spacing: -0.5px;
        }

        h1 {
            font-size: 26px;
        }

        h2 {
            font-size: 21px;
        }

        p {
            color: #64748b;
        }

        /* Alerts */
        .alert {
            padding: 13px 16px;
            margin-bottom: 20px;
            border-radius: 8px;
            font-size: 14px;
            border: 1px solid transparent;
        }

        .ok {
            background: #f0fdf4;
            color: #15803d;
            border-color: #bbf7d0;
        }

        .err {
            background: #fef2f2;
            color: #dc2626;
            border-color: #fecaca;
        }

        small.err {
            display: block;
            background: none;
            border: none;
            padding: 0;
            margin-top: 5px;
            font-size: 12px;
        }

        /* Forms */
        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 7px;
        }

        .field input,
        .field select,
        .field textarea {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #ffffff;
            color: #1e293b;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: .2s;
        }

        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .12);
        }

        /* Buttons */
        button, .btn {
            display: inline-block;
            padding: 10px 17px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: #ffffff;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: .2s;
        }

        button:hover, .btn:hover {
            background: #1d4ed8;
        }

        a {
            transition: .2s;
        }

        /* Tables */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
        }

        th {
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-align: left;
        }

        th, td {
            padding: 13px 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        td {
            color: #475569;
        }

        tr:hover td {
            background: #f8fafc;
        }

        form.inline {
            display: inline;
        }

        /* Lists */
        ul {
            padding-left: 20px;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .container {
                padding: 20px 14px;
            }

            nav {
                padding: 14px;
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }

            main {
                padding: 18px;
            }

            h1 {
                font-size: 22px;
            }

            table {
                font-size: 12px;
            }

            th, td {
                padding: 9px;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <nav>
            <div class="brand">Library<span style="color:#2563eb">.</span></div>

            <div class="nav-links">
                <a href="{{ route('library.books.index') }}">Buku</a>
                <a href="{{ route('library.authors.index') }}">Penulis</a>
            </div>
        </nav>

        @if (session('success'))
            <div class="alert ok">
                ✓ {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert err">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert err">
                <strong>Terdapat kesalahan pada input:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <main>
            @yield('content')
        </main>

    </div>
</body>
</html>
