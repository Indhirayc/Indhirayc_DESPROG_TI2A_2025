<?php

$nilaiNumerik = 92;

if ($nilaiNumerik >= 90 && $nilaiNumerik <= 100) {
    echo "Nilai huruf: A";
} elseif ($nilaiNumerik >= 80 && $nilaiNumerik < 90){
    echo "Nilai huruf: B";
} elseif ($nilaiNumerik >= 70 && $nilaiNumerik < 80){
    echo "Nilai huruf: C";
} elseif ($nilaiNumerik < 70) {
    echo "Nilai huruf: D";
}

echo "<br><br>";

$jarakSaatIni = 0;
$jarakTarget = 500;
$peningkatanHarian = 30;
$hari = 0;

while ($jarakSaatIni < $jarakTarget){
    $jarakSaatIni += $peningkatanHarian;
    $hari++;
}

echo "Atlet tersebut memerlukan $hari hari untuk mencapai jarak 500 kilometer.";

echo "<br><br>";

$jumlahLahan = 10;
$tanamanPerLahan = 5;
$buahPerTanaman = 10;
$jumlahBuah = 0;

for ($i = 1; $i <= $jumlahLahan; $i++) { 
    $jumlahBuah += ($tanamanPerLahan * $buahPerTanaman);
}

echo "Jumlah buah yang akan dipanen adalah: $jumlahBuah";


echo "<br><br>";

$skorUjian = [85, 92, 78, 96, 88];
$totalSkor = 0;

foreach ($skorUjian as $skor) {
    $totalSkor += $skor;
}

echo "Total skor ujian adalah: $totalSkor";


echo "<br><br>";

$nilaiSiswa = [85, 92, 58, 64, 90, 55, 88, 79, 70, 96];

foreach ($nilaiSiswa as $nilai) {
    if ($nilai < 60) {
        echo "Nilai: $nilai (Tidak Lulus) <br>";
        continue;
    }

    echo "Nilai: $nilai (Lulus) <br>";
}


// Soal cerita 4.6

echo "<br> <br>";

$nilaiSiswa = [85, 92, 78, 64, 90, 75, 88, 79, 70, 96];
$nilaiTotal = 0;
$totalSiswa = 0;

sort($nilaiSiswa);

for ($i=0; $i < sizeof($nilaiSiswa); $i++) { 
    if ($i == 0 || $i == 1 || $i == (sizeof($nilaiSiswa)-2) || $i == (sizeof($nilaiSiswa)-1)) {
        continue;
    }

    echo "Nilai ke-" . ($i+1) . ": " . $nilaiSiswa[$i] . "<br>";
    
    $nilaiTotal += $nilaiSiswa[$i];
    $totalSiswa++;
}

$nilaiRataRata = $nilaiTotal / $totalSiswa;

echo "Nilai rata-rata: $nilaiRataRata";


// Soal cerita 4.7

echo "<br> <br>";

$hargaProduk = 120000;

if ($hargaProduk > 100000) {
    $diskon = 0.20 * $hargaProduk;
} else {
    $diskon = 0;
}

$hargaAkhir = $hargaProduk - $diskon;

echo "Harga awal: Rp $hargaProduk <br>";
echo "Diskon: Rp $diskon <br>";
echo "Harga akhir yang harus dibayar: Rp $hargaAkhir";


// Soal cerita 4.8

echo "<br> <br>";

$poin = 300;

echo "Total skor pemain adalah: $poin <br>";
echo "Apakah pemain mendapatkan hadiah tambahan? " . ($poin > 500 ? "Ya" : "Tidak");


?>