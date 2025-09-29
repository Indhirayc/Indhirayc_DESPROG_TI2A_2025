<?php

$a = 10;
$b = 5;

$hasilTambah = $a + $b;
$hasilKurang = $a - $b;
$hasilKali = $a * $b;
$hasilBagi = $a / $b;
$sisaBagi = $a % $b;
$pangkat = $a ** $b;

echo "Hasil tambah: $hasilTambah <br>";
echo "Hasil kurang: $hasilKurang <br>";
echo "Hasil kali: $hasilKali <br>";
echo "Hasil bagi: $hasilBagi <br>";
echo "Sisa bagi: $sisaBagi <br>";
echo "Pangkat: $pangkat <br>";

$hasilSama = $a == $b;
$hasilTidakSama = $a != $b;
$hasilLebihKecil = $a < $b;
$hasilLebihBesar = $a > $b;
$hasilLebihKecilSama = $a <= $b;
$hasilLebihBesarSama = $a >= $b;

echo "<br>";

echo "Hasil sama: $hasilSama <br>";
echo "Hasil tidak sama: $hasilTidakSama <br>";
echo "Hasil lebih kecil: $hasilLebihKecil <br>";
echo "Hasil lebih besar: $hasilLebihBesar <br>";
echo "Hasil lebih kecil sama: $hasilLebihKecilSama <br>";
echo "Hasil lebih besar sama: $hasilLebihBesarSama <br>";

$hasilAnd = $a && $b;
$hasilOr = $a || $b;
$hasilNotA = !$a;
$hasilNotB = !$b;

echo "<br>";

echo "Hasil and: $hasilAnd <br>";
echo "Hasil or: $hasilOr <br>";
echo "Hasil not a: $hasilNotA <br>";
echo "Hasil not b: $hasilNotB <br>";

echo "<br>";

$a += $b;
echo "Hasil a += b : $a <br>";

$a -= $b;
echo "Hasil a -= b : $a <br>";

$a *= $b;
echo "Hasil a *= b : $a <br>";

$a /= $b;
echo "Hasil a /= b : $a <br>";

$a %= $b;
echo "Hasil a %= b : $a <br>";

echo "<br>";

$hasilIdentik = $a === $b;
$hasilTidakIdentik = $a !== $b;

echo "Hasil identik: $hasilIdentik <br>";
echo "Hasil tidak identik: $hasilTidakIdentik <br>";

echo "<br>";

// Soal cerita 3.6
$kursiAwal = 45;
$kursiReserved = 28;
$kursiTersedia = $kursiAwal - $kursiReserved;
$presentaseKursiTersedia = ($kursiTersedia / $kursiAwal) * 100;

echo "Kursi awal: $kursiAwal <br>";
echo "Kursi reserved: $kursiReserved <br>";
echo "Kursi tersedia: $kursiTersedia <br>";
echo "Presentase kursi tersedia: $presentaseKursiTersedia% <br>";

?>