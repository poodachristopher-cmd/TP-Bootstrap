<?php

$prix = 120;

if ($prix < 50) {
    echo "0%";
} elseif ($prix <= 100) {
    echo "5%";
} else {
    echo "10%";
}

?>