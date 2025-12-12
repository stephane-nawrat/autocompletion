<?php

/**
 * API d'autocomplétion
 * Retourne des suggestions de photographies en JSON
 * Format : autocomplete.php?q=terme
 */

// Inclure la connexion BDD
require_once 'config/database.php';

// Définir le header JSON (important !)
header('Content-Type: application/json');

// Récupérer le terme de recherche depuis l'URL
$query = $_GET['q'] ?? '';

// Si le terme est vide ou trop court, retourner un JSON vide
if (strlen(trim($query)) < 2) {
    echo json_encode([
        'starts_with' => [],
        'contains' => []
    ]);
    exit;
}

// Nettoyer le terme
$query = trim($query);

// Connexion à la base de données
$pdo = getDatabase();

// ============================================
// GROUPE 1 : Résultats qui COMMENCENT par le terme
// ============================================

$sqlStartsWith = "SELECT id, title, year, location 
                  FROM photographs 
                  WHERE title LIKE :query
                  ORDER BY year DESC
                  LIMIT 5";

$stmtStartsWith = $pdo->prepare($sqlStartsWith);
$stmtStartsWith->execute(['query' => "$query%"]); // Commence par
$startsWithResults = $stmtStartsWith->fetchAll();

// ============================================
// GROUPE 2 : Résultats qui CONTIENNENT le terme (mais ne commencent pas)
// ============================================

$sqlContains = "SELECT id, title, year, location 
                FROM photographs 
                WHERE title LIKE :query1
                AND title NOT LIKE :query2
                ORDER BY year DESC
                LIMIT 5";

$stmtContains = $pdo->prepare($sqlContains);
$stmtContains->execute([
    'query1' => "%$query%",   // Contient
    'query2' => "$query%"     // Ne commence pas par
]);
$containsResults = $stmtContains->fetchAll();

// ============================================
// Construire la réponse JSON
// ============================================

$response = [
    'starts_with' => $startsWithResults,
    'contains' => $containsResults
];

// Retourner le JSON
echo json_encode($response, JSON_UNESCAPED_UNICODE);
