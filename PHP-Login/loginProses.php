<?php
    include "koneksi.php";

    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $cek = mysqli_num_rows($result);

    if($cek) {
        echo "Anda berhasil login. SIlahkan menuju: "; ?>
        <a href="homeAdmin.php">Halaman Home</a>
    <?php
    } else {
        echo "Anda gagal login. Silahkan "; ?>
        <a href="loginForm.php">Login kembali</a>
    <?php
        echo mysqli_error($conn);
    }
?>