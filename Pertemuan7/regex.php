<?php

$pattern = '/[a-z]/';
$text = 'This is a example text.';

if(preg_match($pattern, $text)) {
    echo "Huruf kecil ditemukan.";
} else {
    echo "Tidak ada huruf kecil!";
}

echo "<br>";

$pattern = '/[0-9]/';
$text = 'There are 123 apples.';


if(preg_match($pattern, $text, $matches)) {
    echo "Cocokkan: " . $matches[0];
} else {
    echo "Tidak ada yang cocok!";
}

echo "<br>";

$pattern = '/apple/';
$replacement = 'banana';
$text = 'I like apple pie.';

$newText = preg_replace($pattern, $replacement, $text);
echo $newText;

echo "<br>";

$pattern = '/go{2,4}d/';
$text = 'god is good.';

if (preg_match($pattern, $text, $matches)) {
    echo "Cocokkan: " . $matches[0];
} else {
    echo "Tidak ada yang cocok!";
}





?>