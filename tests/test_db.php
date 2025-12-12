<?php

/**
 * Test de connexion à la base de données
 */

// Inclure le fichier de connexion (remonter d'un niveau avec ../)
require_once __DIR__ . '/../config/database.php';

echo "<h1>Test de connexion MySQL avec PDO</h1>";

try {
    // Tenter de se connecter
    $pdo = getDatabase();
    echo "<p style='color: green;'>✓ Connexion réussie !</p>";

    // Afficher les infos de connexion (sans le mot de passe)
    echo "<h2>Informations</h2>";
    echo "<p>Base de données : " . $_ENV['DB_NAME'] . "</p>";
    echo "<p>Utilisateur : " . $_ENV['DB_USER'] . "</p>";
    echo "<p>Host : " . $_ENV['DB_HOST'] . "</p>";

    // Test requête simple : compter les photos
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM photographs");
    $result = $stmt->fetch();

    echo "<h2>Test requête SQL</h2>";
    echo "<p style='color: green;'>✓ Nombre de photographies : " . $result['total'] . "</p>";

    // Test requête : afficher 3 photos
    $stmt = $pdo->query("SELECT id, title, year FROM photographs LIMIT 3");
    $photos = $stmt->fetchAll();

    echo "<h2>Aperçu des données</h2>";
    echo "<ul>";
    foreach ($photos as $photo) {
        echo "<li>#{$photo['id']} - {$photo['title']} ({$photo['year']})</li>";
    }
    echo "</ul>";

    echo "<hr>";
    echo "<p style='color: green; font-weight: bold;'>✓ Tous les tests sont réussis !</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Erreur : " . $e->getMessage() . "</p>";
}
