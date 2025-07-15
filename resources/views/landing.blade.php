<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>MagangIn - Web Magang Mahasiswa</title>

  <!-- Bootstrap CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .hero {
      background: url('https://www.transparenttextures.com/patterns/cubes.png');
      padding: 80px 0;
    }

    .hero h1 {
      font-size: 2.5rem;
      font-weight: 700;
    }

    .hero p {
      font-size: 1.1rem;
      color: #555;
    }

    .btn-primary {
      background-color: #4F46E5;
      border: none;
    }

    .btn-outline-primary {
      border-color: #4F46E5;
      color: #4F46E5;
    }

    .btn-outline-primary:hover {
      background-color: #4F46E5;
      color: #fff;
    }

    .info-box {
      font-size: 0.9rem;
      font-weight: 500;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold text-primary" href="#">Ayo Magang</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="#hero">Beranda</a></li>
        <li class="nav-item"><a class="nav-link" href="#fitur">Fitur</a></li>
        <li class="nav-item"><a class="nav-link" href="#testimoni">Testimoni</a></li>
      </ul>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section id="hero" class="hero">
  <div class="container d-flex flex-column flex-lg-row align-items-center justify-content-between">
    <div class="text-left mb-5 mb-lg-0" style="max-width: 600px;">
      <h1>Magang Lebih Mudah dengan <span class="text-primary">Ayo Magang</span></h1>
      <p>Temukan peluang magang terbaik dari berbagai perusahaan di Indonesia. Tingkatkan skill dan pengalaman kerjamu dengan program magang berkualitas.</p>
      <div class="d-flex gap-3 mt-4">
        <a href="{{ route('login') }}" class="btn btn-primary px-4">Login</a>
        <a href="{{ route('register') }}" class="btn btn-outline-primary px-4">Register</a>
      </div>
      <div class="d-flex gap-4 mt-4 text-secondary info-box">
        <div><strong>1000+</strong><br>Lowongan Magang</div>
        <div><strong>500+</strong><br>Perusahaan Terdaftar</div>
      </div>
    </div>
    <div>
      <img src="images/foto1.png" alt="Tampilan App" class="img-fluid" style="max-width: 320px;">
    </div>
  </div>
</section>

<!-- Fitur Unggulan -->
<section id="fitur" class="py-5 bg-white">
  <div class="container text-center">
    <h2 class="fw-bold mb-2">Fitur Unggulan Kami</h2>
    <p class="text-muted mb-5">MagangIn menyediakan fitur menarik untuk memudahkan proses magangmu</p>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="border rounded p-4 shadow-sm h-100 bg-light">
          <i class="bi bi-search text-primary fs-1 mb-3"></i>
          <h5 class="fw-semibold">Pencarian Lowongan</h5>
          <p class="text-muted">Temukan lowongan magang sesuai jurusan, minat, dan lokasi secara cepat.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="border rounded p-4 shadow-sm h-100 bg-light">
          <i class="bi bi-shield-lock text-primary fs-1 mb-3"></i>
          <h5 class="fw-semibold">Keamanan Data</h5>
          <p class="text-muted">Data pengguna terlindungi dengan sistem keamanan yang terpercaya.</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="border rounded p-4 shadow-sm h-100 bg-light">
          <i class="bi bi-graph-up-arrow text-primary fs-1 mb-3"></i>
          <h5 class="fw-semibold">Tracking Progress</h5>
          <p class="text-muted">Pantau perkembangan magangmu dengan fitur progress tracking.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Testimoni -->
<section id="testimoni" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center mb-5 section-title">Testimoni Mahasiswa</h2>

    <div class="row align-items-center mb-5">
      <div class="col-md-6">
        <h3 class="fw-bold">Pengalaman Magang yang Berkesan</h3>
        <p>"Melalui MagangIn, saya berhasil mendapatkan posisi magang di perusahaan teknologi ternama. Saya belajar banyak hal baru dan pengalaman ini sangat membantu dalam pengembangan karir saya."</p>
        <p><strong>- Rina, Mahasiswa Informatika</strong></p>
      </div>
      <div class="col-md-6 text-center">
        <img src="images/foto2.png" class="img-fluid rounded shadow" style="max-height: 300px" alt="Testimoni 1">
      </div>
    </div>

    <div class="row align-items-center mb-5">
      <div class="col-md-6 text-center">
        <img src="images/foto3.jpeg" class="img-fluid rounded shadow" style="max-height: 300px" alt="Testimoni 2">
      </div>
      <div class="col-md-6">
        <h3 class="fw-bold">Platform yang Sangat Membantu</h3>
        <p>"Fitur pencarian lowongan sangat memudahkan saya menemukan magang sesuai minat. Prosesnya cepat dan saya langsung dihubungi oleh perusahaan!"</p>
        <p><strong>- Budi, Mahasiswa Manajemen</strong></p>
      </div>
    </div>

    <div class="row align-items-center">
      <div class="col-md-6">
        <h3 class="fw-bold">Rekomendasi untuk Mahasiswa</h3>
        <p>"MagangIn memberikan akses ke perusahaan terpercaya dan terverifikasi. Sertifikat digital yang saya dapatkan juga sangat membantu saat melamar kerja."</p>
        <p><strong>- Sari, Mahasiswa Sistem Informasi</strong></p>
      </div>
      <div class="col-md-6 text-center">
        <img src="images/foto4.jpeg" class="img-fluid rounded shadow" style="max-height: 300px" alt="Testimoni 3">
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-primary text-white text-center py-4">
  <p class="mb-0">Ayo Magang Bersama Kami</p>
</footer>

<!-- Script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Smooth scroll
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({ behavior: 'smooth' });
      }
    });
  });
</script>
</body>
</html>
