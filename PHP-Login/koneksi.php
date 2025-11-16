<?php
// Konfigurasi koneksi ke database
$host = "localhost";   // Server database
$user = "root";        // Username MySQL (default di XAMPP)
$pass = "";            // Password MySQL (kosong secara default di XAMPP)
$db   = "prakwebdb";   // Nama database yang digunakan

// Membuat koneksi ke MySQL
$conn = mysqli_connect($host, $user, $pass, $db);

// Mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    // (Opsional) tampilkan jika ingin tahu koneksi sukses
    // echo "Koneksi berhasil!";
}
?>
