<?php
// riwayat.php
// File ini bertanggung jawab untuk menampilkan daftar riwayat hasil perhitungan BMI
// Data diambil dari file JSON (riwayat.json) yang disimpan oleh hitung.php
$dataFile = __DIR__ . '/riwayat.json';
// Menentukan lokasi file data riwayat (disimpan di folder yang sama dengan file ini)
$records = [];
// Membuat array kosong untuk menampung data riwayat BMI
if (file_exists($dataFile)) {
  // Mengecek apakah file riwayat.json sudah ada
    $json = file_get_contents($dataFile);
    // Membaca seluruh isi file riwayat.json menjadi string JSON
    $arr = json_decode($json, true);
    // Mengubah (decode) JSON menjadi array asosiatif PHP
    if (is_array($arr)) $records = array_reverse($arr); // terbaru dulu
    // Jika hasil decode valid (array), simpan ke $records
    // array_reverse() digunakan agar data terbaru muncul di atas
    // Jadi dia tidak menyimpan data, hanya menampilkna data yang sudah ada di file JSON
}

if (empty($records)) {
  // Jika tidak ada data sama sekali di riwayat.json
    echo '<div class="empty">Belum ada riwayat. Gunakan formulir di atas untuk menghitung BMI.</div>';
    // Menampilkan pesan bahwa belum ada data yang tersimpan
    return; // Menghentikan eksekusi file agar tidak lanjut ke bagian HTML di bawah
}
?>
<ul class="history">
<?php foreach ($records as $r): ?>
  <!-- Melakukan perulangan untuk setiap data BMI yang tersimpan di array $records -->
  <li class="history-item">
    <div class="avatar">👤</div>
    <!-- Ikon sederhana untuk tiap item riwayat -->
    <div class="info">
      <div class="name"><?= htmlspecialchars($r['nama']) ?></div>
      <!-- Menampilkan nama pengguna -->
      <div class="email muted"><?= htmlspecialchars($r['email']) ?></div>
      <!-- Menampilkan email pengguna dalam teks berwarna abu-abu (muted) -->
    </div>
    <div class="meta">
      <div class="bmi"><?= htmlspecialchars($r['bmi']) ?></div>
      <!-- Menampilkan nilai BMI hasil perhitungan -->
      <div class="kategori muted"><?= htmlspecialchars($r['kategori']) ?></div>
      <!-- Menampilkan kategori BMI seperti “Normal”, “Obesitas”, dll -->
    </div>
  </li>
<?php endforeach; ?>
</ul>
