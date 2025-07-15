@extends('layouts.dashboard')

@section('content')

<style>
    body {
        background-color: #e7f0ff !important;
    }

    .container {
        padding-top: 30px;
        padding-bottom: 30px;
    }

    .profil-mahasiswa {
        display: flex;
        justify-content: center;
        background-color: #dbeafe;
        padding: 30px 10px;
        border-radius: 16px;
        margin-bottom: 30px;
    }

    .profil-card {
        background-color: white;
        padding: 30px;
        border-radius: 16px;
        max-width: 500px;
        width: 100%;
        text-align: center;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    .profil-image {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        background-color: #cbd5e1;
        margin-bottom: 20px;
    }

    .profil-table {
        width: 100%;
        text-align: left;
        margin-top: 10px;
    }

    .profil-table td {
        padding: 6px 10px;
        vertical-align: top;
    }

    .btn-cv {
        padding: 6px 14px;
        font-size: 14px;
        border: 1px solid #3b82f6;
        border-radius: 6px;
        background-color: white;
        color: #3b82f6;
        font-weight: bold;
        text-decoration: none;
    }

    .btn-cv:hover {
        background-color: #3b82f6;
        color: white;
    }

    .btn-edit {
        margin-top: 20px;
        background-color: #1e3a8a;
        color: white;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        padding: 8px 20px;
    }

    .btn-edit:hover {
        background-color: #1e40af;
    }

    .modal-content {
        border-radius: 12px;
    }

    .modal-header {
        background-color: #f1f5f9;
        border-bottom: 1px solid #e2e8f0;
    }

    .modal-title {
        font-weight: 600;
    }

    .form-control {
        border-radius: 8px;
        padding: 0.6rem 1rem;
    }

    .alert-warning {
        margin-top: 30px;
    }

    .btn-simpan {
    background-color: #1e3a8a;
    color: white;
    font-weight: 600;
    border-radius: 8px;
    padding: 8px 20px;
    font-size: 0.95rem;
    border: none;
}

.btn-simpan:hover {
    background-color: #1e40af;
}

.btn-batal {
    background-color: #6b7280;
    color: white;
    font-weight: 500;
    border-radius: 8px;
    padding: 8px 20px;
    font-size: 0.95rem;
    border: none;
}

.btn-batal:hover {
    background-color: #4b5563;
}

</style>

<div class="container">
    @if ($mahasiswa && $mahasiswa->exists && $mahasiswa->nama_mhs)
        <div class="profil-mahasiswa">
            <div class="profil-card">
                <h5 class="mb-3">Profil Mahasiswa</h5>

                @if ($mahasiswa->foto)
                    <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="Foto Mahasiswa" class="profil-image">
                @else
                    <div class="profil-image"></div>
                @endif

                <table class="profil-table">
                    <tr><td><strong>Nama</strong></td><td>{{ $mahasiswa->nama_mhs }}</td></tr>
                    <tr><td><strong>NIM</strong></td><td>{{ $mahasiswa->nim }}</td></tr>
                    <tr><td><strong>Jurusan</strong></td><td>{{ $mahasiswa->jurusan }}</td></tr>
                    <tr><td><strong>Universitas</strong></td><td>{{ $mahasiswa->univ }}</td></tr>
                    <tr><td><strong>No HP</strong></td><td>{{ $mahasiswa->no_hp }}</td></tr>
                    <tr><td><strong>Alamat</strong></td><td>{{ $mahasiswa->alamat }}</td></tr>
                    <tr>
                        <td><strong>CV</strong></td>
                        <td>
                            @if ($mahasiswa->cv)
                                <a href="{{ asset('storage/' . $mahasiswa->cv) }}" target="_blank" class="btn-cv">Lihat CV</a>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editProfilModal">
                    Edit Profil
                </button>
            </div>
        </div>
    @else
        <div class="alert alert-warning">
            <strong>Data belum lengkap.</strong> Silakan lengkapi profil Anda terlebih dahulu.
        </div>

        <button class="btn-edit" data-bs-toggle="modal" data-bs-target="#editProfilModal">
            Isi Profil Sekarang
        </button>
    @endif
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="editProfilModal" tabindex="-1" aria-labelledby="editProfilModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="{{ route('mahasiswa.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-header">
                    <h5 class="modal-title" id="editProfilModalLabel">Edit Profil Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_mhs" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama_mhs" name="nama_mhs" value="{{ old('nama_mhs', $mahasiswa->nama_mhs ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" value="{{ old('nim', $mahasiswa->nim ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="jurusan" class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" name="jurusan" value="{{ old('jurusan', $mahasiswa->jurusan ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="univ" class="form-label">Universitas</label>
                        <input type="text" class="form-control" id="univ" name="univ" value="{{ old('univ', $mahasiswa->univ ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="no_hp" class="form-label">Nomor HP</label>
                        <input type="text" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $mahasiswa->no_hp ?? '') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" required>{{ old('alamat', $mahasiswa->alamat ?? '') }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto (opsional)</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label for="cv" class="form-label">CV (opsional)</label>
                        <input type="file" class="form-control" id="cv" name="cv" accept=".pdf,.doc,.docx">
                    </div>
                </div>

                <div class="modal-footer d-flex justify-content-end gap-2">
                    <button type="submit" class="btn-simpan">Simpan</button>
                    <button type="button" class="btn-batal" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
