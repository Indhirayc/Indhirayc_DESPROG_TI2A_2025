<?php

    include "koneksi.php";

    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    if($row['LEVEL'] == 1) {
        echo "Anda berhasil login sebagai admin. Silahkan menuju: "; ?>
        <a href="homeAdmin.php">Halaman Home</a>
    <?php
    } else if($row['LEVEL'] == 2) {
        echo "Anda berhasil login sebagai guest. Silahkan menuju: "; ?>
        <a href="homeGuest.html">Halaman Home</a>
    <?php
    } else {
        echo "Anda gagal login. Silahkan "; ?>
        <a href="loginForm.php">Login kembali</a>
    <?php
        echo mysqli_error($conn);    
    }
?>