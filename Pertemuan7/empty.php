<?php

$myArray = array();

if(empty($myArray)) {
    echo "Array tidak terdefinisi atau kosong";
} else {
    echo "Array tidak kosong";
}

echo "<br>";

if (empty($nonExistentVariable)) {
    echo "Variabel tidak terdefinisi atau kosong"; 
} else {
    echo "Variabel tidak kosong dan terdefinisi";
}

?>