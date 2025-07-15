@extends('layouts.dashboard')

@section('content')

<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Inter', sans-serif;
    }

    .profile-container {
        max-width: 880px;
        margin: 50px auto;
        padding: 2rem;
        background-color: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
    }

    .profile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .profile-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #333;
        margin: 0;
    }

    .profile-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .profile-table td {
        padding: 1rem;
        vertical-align: top;
        background-color: #f9fafb;
        border-radius: 12px;
        color: #444;
    }

    .profile-table td:first-child {
        font-weight: 600;
        width: 30%;
        background-color: #eef2f7;
        color: #555;
    }

    .btn-modern {
        background-color: #4f46e5;
        color: #fff;
        border: none;
        padding: 0.6rem 1.3rem;
        font-weight: 600;
        font-size: 0.95rem;
        border-radius: 10px;
        transition: background 0.3s ease;
    }

    .btn-modern i {
        margin-right: 8px;
    }

    .btn-modern:hover {
        background-color: #4338ca;
    }

    .alert-modern {
        padding: 1.2rem;
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
        border-radius: 10px;
        margin-bottom: 20px;
    }

    /* Modal */
    .modal-content {
        border-radius: 14px;
        border: none;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .modal-header {
        border-bottom: 1px solid #f0f0f0;
        background: #f9f9f9;
        border-top-left-radius: 14px;
        border-top-right-radius: 14px;
    }

    .modal-title {
        font-weight: 700;
        color: #333;
    }

    .form-label {
        font-weight: 600;
        color: #444;
    }

    .form-control {
        border-radius: 10px;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        font-size: 1rem;
    }

    .form-control:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 0.15rem rgba(99, 102, 241, 0.25);
    }

    .modal-footer .btn-success {
        background-color: #4f46e5;
        border: none;
    }

    .modal-footer .btn-success:hover {
        background-color: #4338ca;
    }

    .btn-secondary {
        border-radius: 10px;
    }
</style>

<div class="profile-container">
    <div class="profile-header">
        <h1>Profil Perusahaan</h1>
        <button class="btn-modern" data-bs-toggle="modal" data-bs-target="#editModal">
            <i class="bi bi-pencil-square"></i> 
            {{ $perusahaan && $perusahaan->exists ? 'Edit Profil' : 'Isi Profil' }}
        </button>
    </div>

    @if ($perusahaan && $perusahaan->exists && $perusahaan->nama_perusahaan)
        <table class="profile-table">
            <tr>
                <td>Nama Perusahaan</td>
                <td>{{ $perusahaan->nama_perusahaan }}</td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>{{ $perusahaan->alamat }}</td>
            </tr>
            <tr>
                <td>Profil Perusahaan</td>
                <td>{{ $perusahaan->profil_perusahaan }}</td>
            </tr>
        </table>
    @else
        <div class="alert-modern">
            Data perusahaan belum lengkap. Silakan lengkapi terlebih dahulu.
        </div>
    @endif
</div>

<!-- Modal Bootstrap -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('perusahaan.update') }}">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Profil Perusahaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_perusahaan" class="form-label">Nama Perusahaan</label>
                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan"
                            value="{{ old('nama_perusahaan', $perusahaan->nama_perusahaan ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $perusahaan->alamat ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="profil_perusahaan" class="form-label">Profil Perusahaan</label>
                        <textarea class="form-control" id="profil_perusahaan" name="profil_perusahaan" rows="4" required>{{ old('profil_perusahaan', $perusahaan->profil_perusahaan ?? '') }}</textarea>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i> Simpan
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
