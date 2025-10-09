<?php

function perkenalan($nama, $salam = "Shalom") {
    echo $salam . ", ";
    echo "Perkenalkan, nama saya " .$nama. "<br>";
    echo "Senang berkenalan dengan Anda<br>";
}

perkenalan("Indhira");

echo "<hr>";

$saya = "Tovin";
$ucapanSalam = "Selamat pagi";

perkenalan($saya);

?>