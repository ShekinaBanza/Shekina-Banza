<?php
header("Content-Type: application/json");

// Lire les données JSON envoyées
$input = file_get_contents("php://input");

// Convertir en tableau PHP
$produits = json_decode($input, true);

if ($produits) {
    file_put_contents("produits.json", json_encode($produits, JSON_PRETTY_PRINT));
    echo json_encode(["status" => "success", "message" => "Produits reçus"]);
} else {
    echo json_encode(["status" => "error", "message" => "Données invalides"]);
}
?>
