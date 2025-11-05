<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST["nama"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($nama) || empty($email) || empty($password)) {
        echo "Semua field harus diisi!";
    } elseif (strlen($password) < 8) {
        echo "Password terlalu pendek! Minimal 8 karakter.";
    } else {
        echo "Form berhasil dikirim.<br>";
        echo "Nama: $nama<br>";
        echo "Email: $email<br>";
        echo "Password: $password<br>";
    }
}
?>
