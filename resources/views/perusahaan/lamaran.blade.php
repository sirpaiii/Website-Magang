@extends('layouts.dashboard')

@section('content')

<style>
    body {
        background-color: #f5f7fa;
        font-family: 'Segoe UI', Roboto, sans-serif;
        color: #1e293b;
    }

    h3 {
        font-weight: 600;
        font-size: 1.75rem;
        margin-bottom: 2rem;
        color: #111827;
    }

    .lamaran-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
        gap: 20px;
    }

    .card-lamaran {
        background-color: #ffffff;
        padding: 1.5rem;
        border-radius: 14px;
        border: 1px solid #e5e7eb;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        gap: 1rem;
        transition: box-shadow 0.2s ease;
    }

    .card-lamaran:hover {
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        gap: 1rem;
    }

    .foto-box,
    .card-header img {
        width: 64px;
        height: 80px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #d1d5db;
        background-color: #f3f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #6b7280;
        font-size: 0.8rem;
    }

    .card-lamaran h5 {
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #0f172a;
    }

    .card-lamaran p {
        font-size: 0.9rem;
        margin: 2px 0;
        color: #4b5563;
    }

    .cv-line {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
        margin-top: 0.5rem;
        color: #374151;
    }

   .btn-action {
    background-color: #4f46e5;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 0.8rem;
    font-weight: 500;
    border: none;
    transition: 0.3s ease;
    margin-right: 6px;
}

.btn-action:hover {
    background-color: #4338ca;
}


    .btn-cv {
        background-color: #4f46e5;
        color: white;
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.8rem;
        text-decoration: none;
        font-weight: 500;
        transition: 0.3s ease;
    }

    .btn-cv:hover {
        background-color: #4338ca;
    }

    .mt-3 {
        margin-top: 1.25rem;
    }

    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="container">
    <h3>Lowongan Masuk</h3>

    <div class="lamaran-grid">
        @foreach ($lamarans as $lamaran)
            <div class="card-lamaran">
                <div class="card-header">
                    <div>
                        <h5>{{ $lamaran->lowongan->judul }}</h5>
                        <p><strong>Pelamar:</strong> {{ $lamaran->mahasiswa->nama_mhs ?? '-' }}</p>
                        <p><strong>NIM:</strong> {{ $lamaran->mahasiswa->nim ?? '-' }}</p>
                        <p><strong>Jurusan:</strong> {{ $lamaran->mahasiswa->jurusan ?? '-' }}</p>
                        <p><strong>Tanggal Lamar:</strong> {{ \Carbon\Carbon::parse($lamaran->tgl_lamaran)->format('d M Y') }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($lamaran->status) }}</p>
                    </div>
                    <div>
                        @if ($lamaran->mahasiswa->foto)
                            <img src="{{ asset('storage/' . $lamaran->mahasiswa->foto) }}" alt="Foto Mahasiswa">
                        @else
                            <div class="foto-box">Tidak ada Foto</div>
                        @endif
                    </div>
                </div>

                <div class="cv-line">
                    <strong>CV:</strong>
                    @if ($lamaran->mahasiswa->cv)
                        <a href="{{ asset('storage/' . $lamaran->mahasiswa->cv) }}" target="_blank" class="btn-cv">Download CV</a>
                    @else
                        <span>-</span>
                    @endif
                </div>

                @if ($lamaran->status === 'menunggu')
                    <div class="mt-3">
    <form action="{{ route('lamaran.status', $lamaran->id) }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        <input type="hidden" name="status" value="diterima">
        <button class="btn-action" type="submit">Terima</button>
    </form>

    <form action="{{ route('lamaran.status', $lamaran->id) }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        <input type="hidden" name="status" value="ditolak">
        <button class="btn-action" type="submit">Tolak</button>
    </form>
</div>

                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
