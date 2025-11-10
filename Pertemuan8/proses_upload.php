<?php
$target_dir = "uploads/"; 
$allowed_types = array('jpg', 'jpeg', 'png', 'gif'); // Jenis file gambar yang diperbolehkan

if (isset($_POST['submit'])) {
    $total_files = count($_FILES['files']['name']); // Menghitung jumlah file yang diupload

    for ($i = 0; $i < $total_files; $i++) {
        $file_name = $_FILES['files']['name'][$i];
        $file_tmp  = $_FILES['files']['tmp_name'][$i];
        $file_size = $_FILES['files']['size'][$i];
        $file_ext  = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_types)) {
            if ($file_size <= 5000000) {
                $target_file = $target_dir . basename($file_name);

                if (move_uploaded_file($file_tmp, $target_file)) {
                    echo "File <b>$file_name</b> berhasil diupload.<br>";

                    echo "<img src='$target_file' width='150' style='margin:10px; border:1px solid #ccc; padding:3px;'>";
                } else {
                    echo "Gagal mengupload file <b>$file_name</b>.<br>";
                }
            } else {
                echo "Ukuran file <b>$file_name</b> terlalu besar.<br>";
            }
        } else {
            echo "File <b>$file_name</b> ditolak karena bukan file gambar (jpg, jpeg, png, gif).<br>";
        }
    }
}
?>