@extends('layouts.dashboard')

@section('content')

<style>
/* ======== Layout Utama ======== */
.main-wrapper {
    max-width: 1280px;
    margin: 0 auto;
    padding: 2rem 2.5rem;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
}

/* ======== Heading Utama ======== */
.section-heading {
    margin-bottom: 2.5rem;
}
.section-heading h1 {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0;
    color: #111827;
}
.section-heading p {
    font-size: 1rem;
    color: #4b5563;
    margin-top: 0.4rem;
}

/* ======== Grid Lamaran ======== */
.lamaran-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(420px, 1fr));
    gap: 1.8rem;
}

/* ======== Kartu Lamaran ======== */
.card-lamaran {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-top: 4px solid #5b4bff;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, .05);
    padding: 1.6rem 2rem;
    display: flex;
    flex-direction: column;
}
.card-lamaran h5 {
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0 0 .8rem 0;
    color: #0f172a;
}
.card-lamaran p {
    font-size: .95rem;
    margin: .3rem 0;
    color: #444;
}
.card-lamaran strong {
    color: #0f172a;
}

/* ======== Badge Status ======== */
.badge-status {
    display: inline-block;
    padding: .35rem .8rem;
    font-size: .8rem;
    font-weight: 600;
    border-radius: 9999px;
    background-color: #dbeafe;
    color: #1e3a8a;
    margin-top: .4rem;
}

/* ======== Alert kosong ======== */
.alert-info {
    grid-column: 1 / -1;
    background: #f0f0ff;
    border: 1px dashed #5b4bff;
    border-radius: 10px;
    padding: 1.2rem;
    font-size: .95rem;
    color: #4b5563;
    text-align: center;
}

@media (max-width: 768px) {
    .lamaran-grid {
        grid-template-columns: 1fr;
    }
    .section-heading h1 {
        font-size: 1.6rem;
    }
}
</style>

<div class="main-wrapper">

    <div class="section-heading">
        <h1>Lamaran yang dikirim</h1>
        <p>Lihat Lowongan yang telah anda lamar</p>
    </div>

    <div class="lamaran-grid">
        @forelse ($lamarans as $lamaran)
            <div class="card-lamaran">
                <h5>{{ $lamaran->lowongan->judul }}</h5>

                <p><strong>Perusahaan:</strong> {{ $lamaran->lowongan->perusahaan->nama_perusahaan ?? '-' }}</p>

                <p><strong>Status:</strong>
                    <span class="badge-status">{{ ucfirst($lamaran->status) }}</span>
                </p>

                <p><strong>Tanggal Lamar:</strong>
                    {{ \Carbon\Carbon::parse($lamaran->tgl_lamaran)->format('d M Y') }}
                </p>
            </div>
        @empty
            <div class="alert-info">Anda belum melamar lowongan apa pun.</div>
        @endforelse
    </div>
</div>

@endsection
