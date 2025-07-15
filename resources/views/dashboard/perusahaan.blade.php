@extends('layouts.dashboard')

@section('content')

<style>
    body {
        background-color: #f9f9ff !important;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

.welcome-section {
    display: flex;
    flex-direction: column;
    align-items: stretch;
    gap: 1rem;
    margin-bottom: 2rem;
}

.welcome-text {
    display: flex;
    flex-direction: column;
}

.dashboard-label {
    font-weight: 500;
    font-size: 14px;
    margin: 0 0 4px 0;
}

.welcome-title {
    font-size: 2rem;
    font-weight: 700;
    margin: 0;
}

.button-wrapper {
    display: flex;
    justify-content: flex-end;
    margin-top: 0.5rem;
}

.btn-tambah {
    background-color: #3c00d0;
    color: white;
    padding: 10px 18px;
    border-radius: 6px;
    border: none;
    font-size: 0.95rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 2px 6px rgba(60, 0, 208, 0.25);
    transition: background 0.3s;
}

.btn-tambah i {
    font-size: 1.1rem;
}

.btn-tambah:hover {
    background-color: #2a00aa;
}

    .grid-lowongan {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
        gap: 20px;
    }

    .card-lowongan {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        border-top: 4px solid #5b4bff;
        border-radius: 12px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        padding: 1.6rem 2rem 2.2rem;
        display: flex;
        flex-direction: column;
        min-height: 260px;
    }

    .card-lowongan h5 {
        font-size: 1.375rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #0f172a;
    }

    .card-lowongan p {
        font-size: 0.95rem;
        color: #444;
        margin: 4px 0;
        line-height: 1.4;
    }

    .card-lowongan strong {
        color: #111827;
    }

    .card-lowongan form {
        margin-top: auto;
        display: flex;
        justify-content: flex-end;
    }

    .btn-danger.btn-sm {
        background-color: #5b4bff;
        border: none;
        color: #fff;
        padding: 8px 16px;
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: 8px;
    }

    .btn-danger.btn-sm:hover {
        background-color: #4338ca;
    }

    .alert-info {
        grid-column: 1 / -1;
        border-radius: 8px;
        font-size: .95rem;
        padding: 1rem;
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #b91c1c;
        text-align: center;
    }

    @media (max-width: 768px) {
        .grid-lowongan {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="welcome-section">
    <div class="welcome-text">
        <p class="dashboard-label">Dashboard</p>
        <h1 class="welcome-title">Selamat Datang di Platform Magang</h1>
    </div>
    <div class="button-wrapper">
        <a href="{{ route('lowongan.create') }}" class="btn-tambah">
            <i class="bi bi-plus-circle"></i> Tambah Lowongan
        </a>
    </div>
</div>


<div class="grid-lowongan">
    @forelse ($lowongans as $lowongan)
        <div class="card-lowongan">
            <h5>{{ $lowongan->judul }}</h5>
            <p><strong>Deskripsi :</strong><br>{{ $lowongan->deskripsi_lowongan }}</p>
            <p><strong>Lokasi :</strong> {{ $lowongan->lokasi }}</p>
            <p><strong>Tanggal :</strong> {{ $lowongan->created_at->format('d M Y') }}</p>

            <form action="{{ route('lowongan.destroy', $lowongan->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus lowongan ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </div>
    @empty
        <div class="alert alert-info col-12">Belum ada lowongan yang Anda buat.</div>
    @endforelse
</div>

@endsection
