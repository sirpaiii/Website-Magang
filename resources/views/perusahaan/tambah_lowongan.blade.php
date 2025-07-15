@extends('layouts.dashboard')

@section('content')
<style>
    body {
        background: #f5f7fa;
        font-family: 'Segoe UI', Roboto, sans-serif;
    }

    .form-container {
        max-width: 720px;
        margin: 3rem auto;
        padding: 2.25rem 2rem;
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.04);
        border: 1px solid #e5e7eb;
    }

    .form-container h3 {
        font-weight: 600;
        font-size: 1.6rem;
        margin-bottom: 1.5rem;
        color: #1e293b;
        text-align: center;
    }

    .form-label {
        font-weight: 500;
        font-size: 0.95rem;
        color: #374151;
        margin-bottom: 0.5rem;
        display: block;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.65rem 0.9rem;
        font-size: 0.95rem;
        border: 1px solid #d1d5db;
        background: #f9fafb;
        color: #111827;
        width: 100%;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
        background: #fff;
        outline: none;
    }

    .btn-submit {
        background: linear-gradient(to right, #1b12c4ff, #390dd5ff);
        color: white;
        border: none;
        padding: 0.75rem;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        width: 100%;
        transition: transform 0.2s ease, opacity 0.2s ease;
    }

    .btn-submit:hover {
        transform: scale(1.02);
        opacity: 0.95;
    }

    .alert {
        border-radius: 10px;
        background-color: #fef2f2;
        border-left: 4px solid #f43f5e;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        font-size: 0.95rem;
        color: #991b1b;
    }

    .alert-success {
        background-color: #ecfdf5;
        border-left-color: #10b981;
        color: #065f46;
    }

    .invalid-feedback {
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .mb-3, .mb-4 {
        margin-bottom: 1.25rem;
    }
</style>

<div class="form-container">
    <h3>Tambah Lowongan</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('lowongan.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="judul" class="form-label">Judul Lowongan</label>
            <input type="text" id="judul" name="judul"
                   class="form-control @error('judul') is-invalid @enderror"
                   value="{{ old('judul') }}" required>
            @error('judul')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="deskripsi_lowongan" class="form-label">Deskripsi</label>
            <textarea id="deskripsi_lowongan" name="deskripsi_lowongan"
                      rows="4"
                      class="form-control @error('deskripsi_lowongan') is-invalid @enderror"
                      required>{{ old('deskripsi_lowongan') }}</textarea>
            @error('deskripsi_lowongan')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" id="lokasi" name="lokasi"
                   class="form-control @error('lokasi') is-invalid @enderror"
                   value="{{ old('lokasi') }}" required>
            @error('lokasi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-submit">Simpan Lowongan</button>
    </form>
</div>
@endsection
