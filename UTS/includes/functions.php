<?php
// includes/functions.php

function hitungBMI($beratKg, $tinggiCm) {
    if ($tinggiCm <= 0) return 0;
    $tinggiM = $tinggiCm / 100.0;
    return $beratKg / ($tinggiM * $tinggiM);
}

function kategoriBMI($bmi) {
    // kategori mengikuti konvensi umum
    if ($bmi < 18.5) return 'Underweight';
    if ($bmi < 25) return 'Normal';
    if ($bmi < 30) return 'Overweight';
    return 'Obese';
}
