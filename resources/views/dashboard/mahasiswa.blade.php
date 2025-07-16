@extends('layouts.dashboard')
@section('content')

<style>
.main-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 2rem 2.5rem;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 2.5rem;
}

.title-block h1 {
    font-size: 2.8rem;
    font-weight: 700;
    margin: 0 0 .8rem 0;
}

.title-block p {
    font-size: 1rem;
    color: #444;
    margin: 0;
}

.search-wrapper {
    width: 340px;
}

.search-wrapper form {
    display: flex;
}

.search-wrapper input {
    flex: 1;
    border: 1.6px solid #000;
    border-radius: 8px;
    padding: .7rem 1rem;
    font-size: 1rem;
    outline: none;
}

.job-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Dua kolom */
    gap: 2rem 1.8rem;
}

.card-lowongan {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-top: 4px solid #5b4bff;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    padding: 1.6rem 2rem 2.2rem;
    display: flex;
    flex-direction: column;
    min-height: 260px;
}

.card-lowongan h3 {
    font-size: 1.375rem;
    font-weight: 700;
    margin: 0 0 .3rem 0;
    color: #0f172a;
}

.card-lowongan h4 {
    font-size: 1.125rem;
    font-weight: 600;
    margin: 0 0 1rem 0;
    color: #6366f1;
}

.loc {
    display: flex;
    align-items: center;
    font-size: .95rem;
    margin-bottom: .6rem;
    color: #555;
}

.loc i {
    color: #ef4444;
    margin-right: .4rem;
    font-size: .9rem;
}

.badges {
    display: flex;
    gap: .5rem;
    margin-bottom: .9rem;
    flex-wrap: wrap;
}

.badge {
    background: #eef2ff;
    color: #6366f1;
    font-size: .8rem;
    font-weight: 600;
    padding: .25rem .7rem;
    border-radius: 9999px;
}

.desc {
    font-size: .95rem;
    color: #444;
    line-height: 1.45;
    margin-bottom: 1.4rem;
    white-space: pre-line;
}

.card-lowongan form {
    margin-top: auto;
    display: flex;
    justify-content: flex-end;
}

.btn-lamar {
    background: linear-gradient(90deg, #6366f1 0%, #5b4bff 100%);
    color: #fff;
    font-size: .95rem;
    font-weight: 600;
    padding: .65rem 2.2rem;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.btn-lamar:hover {
    opacity: .9;
}

.alert {
    grid-column: 1/-1;
    border-radius: 8px;
    font-size: .95rem;
    padding: 1rem;
    background: #fef2f2;
    border: 1px solid #fecaca;
    color: #b91c1c;
}

@media(max-width: 768px) {
    .job-grid {
        grid-template-columns: 1fr;
    }

    .section-header {
        flex-direction: column;
        align-items: flex-start;
        gap: .8rem;
    }

    .search-wrapper {
        width: 100%;
    }
}
</style>

<div class="main-container">

    <!-- Header -->
    <div class="section-header">
        <div class="title-block">
            <p style="font-weight: 600; margin: 0 0 1rem 0;">Dashboard</p>
            <h1>Lowongan Magang Tersedia</h1>
            <p>Cari Lowongan Magang Sesuai Skill dan Minatmu</p>
        </div>

        <div class="search-wrapper">
            <form action="{{ route('mahasiswa.filter') }}" method="GET" id="searchForm">
                <input type="text" name="search" id="searchInput" placeholder="Cari Lowongan…" value="{{ request('search') }}">
            </form>
        </div>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');

        let timer;
        searchInput.addEventListener('input', function () {
            clearTimeout(timer);
            timer = setTimeout(() => {
                searchForm.submit();
            }, 1000);
        });
    </script>

    <!-- Grid Lowongan -->
    <div class="job-grid">
        @forelse ($lowongans as $lowongan)
            <div class="card-lowongan">
                <h3>{{ $lowongan->judul }}</h3>
                <h4>{{ $lowongan->perusahaan->nama_perusahaan ?? '-' }}</h4>

                <div class="loc">
                    <i class="bi bi-geo-alt-fill"></i>
                    {{ $lowongan->lokasi }}
                </div>

                <div class="badges">
                    {{-- Tambahkan badge jika perlu --}}
                </div>

                <div class="desc">{!! nl2br(e($lowongan->deskripsi_lowongan)) !!}</div>

                <form action="{{ route('lamaran.kirim', $lowongan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-lamar">Lamar Sekarang</button>
                </form>
            </div>
        @empty
            <div class="alert">Belum ada lowongan tersedia.</div>
        @endforelse
    </div>
</div>
@endsection
