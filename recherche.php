<?php

/**
 * Page de résultats de recherche
 * Affiche les photographies correspondant au terme recherché
 */

// Titre de la page
$pageTitle = 'Résultats de recherche - Ansel Adams';

// Inclure le header
require_once 'includes/header.php';

// Inclure la connexion BDD
require_once 'config/database.php';

// Récupérer le terme de recherche depuis l'URL
$search = $_GET['search'] ?? '';

// Si le terme est vide, rediriger vers l'accueil
if (empty(trim($search))) {
    header('Location: index.php');
    exit;
}

// Nettoyer le terme pour l'affichage (sécurité XSS)
$searchDisplay = htmlspecialchars($search);

// Connexion à la base de données
$pdo = getDatabase();

// Préparer la requête SQL avec LIKE sur plusieurs colonnes
// Le % permet de chercher le terme n'importe où dans le texte
$sql = "SELECT * FROM photographs 
        WHERE title LIKE :search1 
        OR location LIKE :search2 
        OR description LIKE :search3
        ORDER BY year DESC";

// Préparer la requête
$stmt = $pdo->prepare($sql);

// Exécuter avec le terme de recherche (un pour chaque placeholder)
$searchParam = "%$search%";
$stmt->execute([
    'search1' => $searchParam,
    'search2' => $searchParam,
    'search3' => $searchParam
]);

// Récupérer tous les résultats
$results = $stmt->fetchAll();

// Compter le nombre de résultats
$count = count($results);
?>

<main class="main-content">
    <div class="search-results">
        <!-- En-tête des résultats -->
        <div class="results-header">
            <h1 class="results-title">Résultats pour "<?= $searchDisplay ?>"</h1>
            <p class="results-count"><?= $count ?> photographie<?= $count > 1 ? 's' : '' ?> trouvée<?= $count > 1 ? 's' : '' ?></p>
        </div>

        <?php if ($count > 0): ?>
            <!-- Grille de résultats -->
            <div class="results-grid">
                <?php foreach ($results as $photo): ?>
                    <article class="photo-card">
                        <!-- Image (si disponible) -->
                        <?php if ($photo['image_url']): ?>
                            <div class="photo-card-image">
                                <img src="<?= htmlspecialchars($photo['image_url']) ?>"
                                    alt="<?= htmlspecialchars($photo['title']) ?>"
                                    loading="lazy">
                            </div>
                        <?php endif; ?>

                        <!-- Infos -->
                        <div class="photo-card-content">
                            <h2 class="photo-card-title">
                                <a href="element.php?id=<?= $photo['id'] ?>">
                                    <?= htmlspecialchars($photo['title']) ?>
                                </a>
                            </h2>

                            <p class="photo-card-meta">
                                <?php if ($photo['year']): ?>
                                    <span class="photo-year"><?= $photo['year'] ?></span>
                                <?php endif; ?>

                                <?php if ($photo['location']): ?>
                                    <span class="photo-location"><?= htmlspecialchars($photo['location']) ?></span>
                                <?php endif; ?>
                            </p>

                            <?php if ($photo['description']): ?>
                                <p class="photo-card-description">
                                    <?= htmlspecialchars(substr($photo['description'], 0, 150)) ?>...
                                </p>
                            <?php endif; ?>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <!-- Aucun résultat -->
            <div class="no-results">
                <p>Aucune photographie ne correspond à votre recherche.</p>
                <p><a href="index.php" class="btn-back">Retour à l'accueil</a></p>
            </div>
        <?php endif; ?>
    </div>
</main>

<?php
// Inclure le footer
require_once 'includes/footer.php';
?>