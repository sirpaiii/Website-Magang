<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - {{ ucfirst(Auth::user()->role) }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root{
            --sidebar-width: 220px;
            --sidebar-bg: #2200c9;           /* biru tua, tidak mencolok */
            --sidebar-link: #ffffffd9;       /* putih 85 % */
            --sidebar-link-active: #fff;
        }

        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background:#f5f9fc;
            margin:0;
        }

        /* ===== Sidebar ===== */
        .sidebar{
            position:fixed;
            top:0; left:0;
            width:var(--sidebar-width);
            height:100vh;
            background:var(--sidebar-bg);
            padding:1.25rem 1rem;
            display:flex;
            flex-direction:column;
        }
        .sidebar h4{
            color:#fff;
            font-weight:700;
            font-size:1.1rem;
            margin-bottom:2rem;
        }
        .sidebar small{
            color:#ffffffa6;
            letter-spacing:.2px;
            font-size:.72rem;
            margin-bottom:1rem;
            display:block;
        }
        .sidebar a{
            display:flex;
            align-items:center;
            gap:.75rem;
            padding:.55rem .9rem;
            color:var(--sidebar-link);
            text-decoration:none;
            border-radius:.35rem;
            font-size:.90rem;
            transition:background .2s;
        }
        .sidebar a:hover,
        .sidebar a.active{
            background:rgba(255,255,255,.12);
            color:var(--sidebar-link-active);
        }
        .sidebar .logout-btn{
            margin-top:auto;
        }
        .sidebar .logout-btn button{
            width:100%;
            font-size:.85rem;
        }

        /* ===== Page wrapper ===== */
        .page-wrapper{
            margin-left:var(--sidebar-width);
            padding:1.5rem 2rem;
        }

        /* Card / heading style yang sudah ada */
        h2, h3, h4 { font-weight:700; color:#0083b0; }
        .card{ border:none; border-radius:16px; box-shadow:0 6px 18px rgba(0,0,0,.03); }
        .btn-primary{
            background:#ff85d8;
            border:none;
            font-weight:bold;
            border-radius:10px;
            padding:.5rem 1.2rem;
            font-size:.95rem;
        }
        .btn-primary:hover{ background:#ff85d8; }
        .alert{ font-size:.9rem; border-radius:10px; }
    </style>
</head>
<body>

    <!-- ===== Sidebar ===== -->
    <nav class="sidebar">
        <h4>Magang Platform</h4>

        <small>{{ ucfirst(Auth::user()->role) }}</small>

        <a href="{{ Auth::user()->role === 'mahasiswa' ? route('dashboard.mahasiswa') : route('dashboard.perusahaan') }}"
           class="{{ request()->is('dashboard*') ? 'active' : '' }}">
            <i class="bi bi-house-door-fill"></i> Dashboard
        </a>

        <a href="{{ Auth::user()->role === 'mahasiswa' ? route('lamaran.mahasiswa') : route('lamaran.perusahaan') }}"
           class="{{ request()->is('lamaran*') ? 'active' : '' }}">
            <i class="bi bi-briefcase-fill"></i> Lamaran
        </a>

        <a href="{{ Auth::user()->role === 'mahasiswa' ? route('mahasiswa.profil') : route('perusahaan.profil') }}"
           class="{{ request()->routeIs('mahasiswa.*') || request()->routeIs('perusahaan.*') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i> Profil
        </a>

        <div class="logout-btn">
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-light text-primary fw-bold mt-4">
                    <i class="bi bi-box-arrow-right me-1"></i> Logout
                </button>
            </form>
        </div>
    </nav>

    <!-- ===== Main content ===== -->
    <div class="page-wrapper">
        @if(session('success'))   <div class="alert alert-success">{{ session('success') }}</div> @endif
        @if(session('error'))     <div class="alert alert-danger">{{ session('error') }}</div>   @endif
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
