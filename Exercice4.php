<?php

$produits = 
    "Clavier" => 49.90,
    "Souris" => 29.90,
    "Écran" => 189.90,
    "Webcam" => 79.90
;

foreach ($produits as $nom => $prix) 
    echo $nom . " : " . $prix . " €" . "\n";


foreach ($produits as $nom => $prix) 
    if ($prix > 50) 
        echo $nom . " : " . $prix . " €" . "\n";
    


$compteur = 0;
foreach ($produits as $nom => $prix) 
    $compteur = $compteur + 1;

echo "Nombre de produits : " . $compteur;

?>