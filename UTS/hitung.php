<?php
// hitung.php
require __DIR__ . '/includes/functions.php'; 
// Mengimpor file functions.php yang berisi fungsi hitungBMI() dan kategoriBMI().
file_put_contents(__DIR__ . '/debug.log', date('H:i:s') . " Dipanggil\n", FILE_APPEND);
// Untuk memastikan apakah hitung.php dipanggil dua kali, tambahkan ini di awal file:

// Set header agar response dikirim dalam format JSON dengan encoding UTF-8
header('Content-Type: application/json; charset=utf-8');

// Ambil metode request HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Cek apakah request bukan POST
if ($method !== 'POST') {
    // Jika bukan POST, redirect ke index.php
    header('Location: index.php');
    exit; // Hentikan eksekusi script
}

// ------------------- AMBIL INPUT DARI FORM -------------------
$nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';     // Ambil nama dan hapus spasi di awal/akhir
$email = isset($_POST['email']) ? trim($_POST['email']) : '';  // Ambil email
$berat = isset($_POST['berat']) ? floatval($_POST['berat']) : 0; // Ambil berat badan dan ubah ke float
$tinggi = isset($_POST['tinggi']) ? floatval($_POST['tinggi']) : 0; // Ambil tinggi badan dan ubah ke float

$errors = []; // Array untuk menampung pesan error validasi

// ------------------- VALIDASI SERVER-SIDE -------------------
if ($nama === '') 
    $errors['nama'] = 'Nama wajib diisi'; // Nama tidak boleh kosong
if ($email === '') 
    $errors['email'] = 'Email wajib diisi'; // Email tidak boleh kosong
elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    $errors['email'] = 'Format email tidak valid'; // Validasi format email (contoh: harus ada '@')
// Validasi berat dan tinggi agar bernilai positif
if ($berat <= 0) 
    $errors['berat'] = 'Masukkan berat badan yang valid';
if ($tinggi <= 0) 
    $errors['tinggi'] = 'Masukkan tinggi badan yang valid';

// ------------------- DETEKSI AJAX -------------------
$isAjax = isset($_POST['ajax']) && $_POST['ajax'] == '1'; 
// Jika dikirim lewat AJAX (form JS), maka ada field ajax=1

// Jika ada error validasi
if (!empty($errors)) {
    if ($isAjax) {
        // Jika request dari AJAX, kirimkan respon JSON berisi error
        echo json_encode(['success' => false, 'errors' => $errors], JSON_UNESCAPED_UNICODE);
        exit;
    } else {
        // Jika bukan AJAX, redirect kembali ke index.php
        header('Location: index.php');
        exit;
    }
}

// ------------------- PERHITUNGAN BMI -------------------
$bmi = hitungBMI($berat, $tinggi);    // Hitung BMI menggunakan fungsi dari functions.php
$bmiRounded = round($bmi, 1);         // Bulatkan hasil ke 1 desimal
$kategori = kategoriBMI($bmi);        // Tentukan kategori BMI (Underweight, Normal, dll.)

// ------------------- BUAT RECORD DATA -------------------
$record = [
    'nama' => htmlspecialchars($nama, ENT_QUOTES, 'UTF-8'),   // Sanitasi input agar aman dari XSS
    'email' => htmlspecialchars($email, ENT_QUOTES, 'UTF-8'),
    'bmi' => $bmiRounded,     // Nilai BMI hasil perhitungan
    'kategori' => $kategori,  // Kategori berdasarkan BMI
    'waktu' => date('Y-m-d H:i:s') // Waktu saat data disimpan
];

// ------------------- SIMPAN KE FILE riwayat.json -------------------
$dataFile = __DIR__ . '/riwayat.json'; // Lokasi file JSON untuk menyimpan data

// Jika file belum ada, buat file kosong (berisi array kosong)
if (!file_exists($dataFile)) 
    file_put_contents($dataFile, json_encode([]));

$success = false; // Status sukses atau gagal menyimpan
$tries = 0;       // Jumlah percobaan menulis file

// Coba menulis file maksimal 5 kali (jika gagal lock)
while ($tries < 5) {
    $tries++;
    $fp = fopen($dataFile, 'c+'); // Buka file untuk read/write (create jika belum ada)
    if (!$fp) break; // Jika gagal membuka file, keluar dari loop

    if (flock($fp, LOCK_EX)) { // Lock file agar tidak ditulis bersamaan oleh proses lain
        // Baca isi file
        $size = filesize($dataFile);
        $contents = '';
        if ($size > 0) {
            rewind($fp); // Posisikan pointer di awal file
            $contents = stream_get_contents($fp); // Ambil isi file
        }

        $arr = [];
        if ($contents) $arr = json_decode($contents, true); // Decode JSON ke array PHP
        if (!is_array($arr)) $arr = []; // Jika gagal decode, buat array kosong

        $arr[] = $record; // Tambahkan record baru ke array data

        // Tulis ulang file JSON
        rewind($fp); // Kembali ke awal file
        ftruncate($fp, 0); // Kosongkan isi file
        $written = fwrite(
            $fp, 
            json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) // Encode ulang dengan format rapi
        );
        fflush($fp);        // Pastikan data benar-benar ditulis ke disk
        flock($fp, LOCK_UN); // Lepas kunci file
        fclose($fp);        // Tutup file

        if ($written !== false) {
            $success = true; // Jika berhasil menulis, set sukses
            break; // Keluar dari loop
        }
    } else {
        fclose($fp); // Jika gagal lock file, tutup dulu
    }

    usleep(50000); // Tunggu 50 milidetik sebelum mencoba lagi
}

// ------------------- RESPONSE KE CLIENT -------------------
if ($isAjax) {
    if ($success) {
        // Jika berhasil, kirim JSON sukses + data record
        echo json_encode(['success' => true, 'data' => $record], JSON_UNESCAPED_UNICODE);
    } else {
        // Jika gagal menyimpan, kirim pesan error JSON
        echo json_encode(['success' => false, 'message' => 'Gagal menyimpan data.'], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

// ------------------- NON-AJAX FALLBACK -------------------
// Jika bukan request AJAX, redirect ke index.php (riwayat akan tampil di halaman utama)
header('Location: index.php');
exit;
