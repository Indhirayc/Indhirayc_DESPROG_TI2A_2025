<?php

$umur;

if (isset($umur) && $umur >= 18) {
    echo "Anda sudah dewasa";
} else {
    echo "Anda belum dewasa atau variabel 'umur' belum ditentukan.";
}

$data = array("nama" => "Jane", "usia" => 25);

echo "<br>";

if(isset($data["nama"])) {
    echo "Nama: " . $data["nama"];
} else {
    echo "Variabel 'nama' tidak ada dalam array.";
}


?>