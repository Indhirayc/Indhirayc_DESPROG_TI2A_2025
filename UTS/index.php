<?php
// index.php
// Halaman utama — menampilkan layout & form
require __DIR__ . '/includes/functions.php';
// Memanggil file 'functions.php' agar fungsi seperti hitungBMI() dan kategoriBMI() bisa digunakan jika dibutuhkan
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <!-- Mengatur encoding karakter UTF-8 agar mendukung semua karakter bahasa -->
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <!-- Agar tampilan responsive (menyesuaikan dengan lebar layar perangkat) -->
  <title>Aplikasi Penghitung BMI</title>
  <!-- Judul halaman yang tampil di tab browser -->

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <!-- Mengimpor font "Inter" dari Google Fonts -->
  <link rel="stylesheet" href="assets/style.css">
</head>
<body>
  <?php include __DIR__ . '/includes/header.php'; ?>
  <!-- Menyertakan file header.php yang berisi bagian header halaman (biasanya logo / judul navigasi) -->

  <main class="site">
    <!-- HERO/PEMBUKA & PENGANTAR -->
    <section class="hero">
      <div class="container">
        <h1 class="hero-title">Hitung BMI Anda</h1>
        <!-- Judul utama halaman -->
        <p class="hero-sub">Dapatkan informasi kesehatan Anda dengan cepat.</p>
        <!-- Subjudul / tagline aplikasi -->
        <button id="scrollToForm" class="btn primary">Hitung BMI</button>
        <!-- Tombol untuk menggulir ke bagian form menggunakan JavaScript -->
      </div>
    </section>

    <!-- FORMULIR -->
    <section id="formSection" class="section form-section">
      <div class="container grid-2">
        <div class="col">
          <h2 class="section-title">Formulir BMI</h2>
        </div>
        <div class="col"></div>
      </div>

      <div class="container form-card">
        <form id="bmiForm" method="post" action="hitung.php" novalidate>
           <!-- Form dengan method POST yang akan mengirim data ke hitung.php -->
           <!-- 'novalidate' = mematikan validasi default browser (karena JS dan PHP akan memvalidasi sendiri) -->
          <div class="row">
            <div class="input-group">
              <label for="nama">Nama Pengguna</label>
              <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
              <!-- Field input nama, wajib diisi -->
              <div class="error" data-for="nama"></div>
              <!-- Tempat menampilkan pesan error untuk input nama (via JavaScript) -->
            </div>

            <div class="input-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" placeholder="Masukkan email Anda" required>
              <!-- Field input email, wajib diisi dan divalidasi formatnya -->
              <div class="error" data-for="email"></div>
              <!-- Tempat menampilkan pesan error email -->
            </div>
          </div>

          <div class="row">
            <div class="input-group">
              <label for="berat">Berat Badan (kg)</label>
              <input type="number" id="berat" name="berat" placeholder="Masukkan berat badan" step="0.1" required>
              <!-- Input angka berat badan, mendukung desimal (step=0.1) -->
              <div class="error" data-for="berat"></div>
            </div>

            <div class="input-group">
              <label for="tinggi">Tinggi Badan (cm)</label>
              <input type="number" id="tinggi" name="tinggi" placeholder="Masukkan tinggi badan" step="0.1" required>
              <!-- Input angka tinggi badan dalam cm -->
              <div class="error" data-for="tinggi"></div>
            </div>
          </div>

          <div class="form-actions">
            <button type="submit" class="btn primary" id="btnHitung">Hitung BMI</button>
            <!-- Tombol untuk mengirimkan form ke hitung.php -->
          </div>
        </form>
      </div>
    </section>

    <!-- ILUSTRASI -->
    <section class="info-section" id="heroSection">
      <div class="container">
        <div class="info-card">
          <div class="info-text">
            <h2 class="info-title">Apa itu BMI?</h2>
            <p class="info-desc">
              BMI adalah ukuran tingkat kekurusan atau kegemukan seseorang berdasarkan tinggi dan berat badannya, 
              dan bertujuan untuk mengukur massa jaringan tubuh. BMI secara luas digunakan sebagai indikator umum 
              untuk menentukan apakah seseorang memiliki berat badan yang sehat sesuai dengan tingginya. Secara 
              spesifik, nilai yang diperoleh dari perhitungan BMI digunakan untuk mengkategorikan apakah seseorang 
              termasuk dalam kategori berat badan kurang, normal, berlebih, atau obesitas, tergantung pada rentang 
              nilai yang diperoleh. Rentang BMI ini bervariasi tergantung pada faktor seperti wilayah dan usia, dan 
              terkadang dibagi lagi menjadi subkategori seperti sangat kurus atau sangat obesitas. Kelebihan berat 
              badan atau kekurangan berat badan dapat memiliki dampak kesehatan yang signifikan, jadi meskipun BMI 
              bukanlah ukuran yang sempurna untuk berat badan sehat, ia tetap menjadi indikator berguna untuk 
              menentukan apakah diperlukan tes tambahan atau tindakan lebih lanjut. Lihat tabel di bawah ini untuk 
              melihat kategori-kategori berdasarkan BMI yang digunakan oleh kalkulator.
            </p>
          </div>

          <div class="info-image">
            <img src="assets/img/bmi.jpg" alt="Ilustrasi pengukuran tinggi badan">
          </div>
        </div>
      </div>
    </section>


    <!-- HASIL -->
    <section id="hasilSection" class="section hasil-section">
      <div class="container">
        <h2 class="section-title">Hasil Perhitungan</h2>

        <div id="hasilCard" class="card hasil-card hidden">
          <!-- Kartu hasil yang akan muncul setelah pengguna menghitung BMI -->
          <div class="field">
            <label>Nama Pengguna</label>
            <div class="readonly" id="outNama"></div>
          </div>

          <div class="field">
            <label>Email</label>
            <div class="readonly" id="outEmail"></div>
          </div>

          <div class="field">
            <label>Nilai BMI</label>
            <div class="readonly" id="outBMI"></div>
          </div>

          <div class="field">
            <label>Kategori BMI</label>
            <div class="readonly" id="outKategori"></div>
          </div>
        </div>

        <div class="result-actions">
          <button id="hitungUlang" class="btn ghost">Hitung Ulang</button>
          <!-- Tombol untuk mengulangi perhitungan -->
        </div>
      </div>
    </section>

    <!-- RIWAYAT -->
    <section class="section riwayat-section" id="riwayatSection">
      <div class="container">
        <h2 class="section-title">Daftar Riwayat</h2>
        <div id="riwayatList" class="riwayat-list card">
          <?php include __DIR__ . '/riwayat.php'; ?>
          <!-- Menyertakan file riwayat.php untuk menampilkan daftar hasil perhitungan sebelumnya -->
        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="footer">
      <div class="container footer-inner">
      <p>© <?= date('Y') ?> Aplikasi BMI — Semua Hak Dilindungi</p>
      <!-- Menampilkan tahun otomatis (misalnya: 2025) -->
      </div>
    </div>
  </footer>
  <!-- Memuat file JavaScript utama -->
  <script src="assets/script.js"></script>
</body>
</html>