<?php

/**
 * Connexion à la base de données avec PDO
 * Utilise les variables d'environnement (.env) pour la sécurité
 */

/**
 * Charge les variables d'environnement depuis le fichier .env
 * 
 * Logique :
 * 1. Vérifie que le fichier .env existe
 * 2. Lit le fichier ligne par ligne
 * 3. Pour chaque ligne, extrait la clé et la valeur (format: CLE=valeur)
 * 4. Stocke dans le tableau global $_ENV
 */
function loadEnv($path = __DIR__ . '/../.env')
{
    // Vérifier que le fichier .env existe
    if (!file_exists($path)) {
        die("Erreur : Le fichier .env n'existe pas. Copiez .env.example vers .env");
    }

    // Lire le fichier ligne par ligne
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // Parcourir chaque ligne
    foreach ($lines as $line) {
        // Ignorer les commentaires (lignes qui commencent par #)
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Séparer la clé et la valeur (format: CLE=valeur)
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            // Stocker dans $_ENV (accessible partout)
            $_ENV[$key] = $value;
        }
    }
}

/**
 * Crée et retourne une connexion PDO à la base de données
 * 
 * @return PDO Instance de connexion à la base de données
 */
function getDatabase()
{
    // Charger les variables d'environnement
    loadEnv();

    // Récupérer les paramètres de connexion depuis .env
    $host = $_ENV['DB_HOST'] ?? 'localhost';
    $dbname = $_ENV['DB_NAME'] ?? 'phase02_autocompletion';
    $user = $_ENV['DB_USER'] ?? 'root';
    $pass = $_ENV['DB_PASS'] ?? '';
    $charset = $_ENV['DB_CHARSET'] ?? 'utf8mb4';

    // Construction du DSN (Data Source Name)
    // Format : mysql:host=localhost;dbname=nom_base;charset=utf8mb4
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

    // Options PDO pour un comportement sécurisé
    $options = [
        // Mode erreur : lance des exceptions en cas de problème
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

        // Mode fetch par défaut : retourne des tableaux associatifs
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

        // Désactive l'émulation des requêtes préparées (plus sécurisé)
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        // Tentative de connexion
        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
    } catch (PDOException $e) {
        // En cas d'erreur, afficher un message clair et arrêter
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
