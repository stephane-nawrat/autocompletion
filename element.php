<?php

/**
 * Page de détail d'une photographie
 * Affiche toutes les informations sur une photo spécifique
 */

// Inclure la connexion BDD
require_once 'config/database.php';

// Récupérer et valider l'ID depuis l'URL
$id = filter_var($_GET['id'] ?? 0, FILTER_VALIDATE_INT);

// Si l'ID est invalide, rediriger vers l'accueil
if (!$id) {
    header('Location: index.php');
    exit;
}

// Connexion à la base de données
$pdo = getDatabase();

// Préparer la requête pour récupérer UNE photo par son ID
$sql = "SELECT * FROM photographs WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);

// Récupérer la photo (fetch = une seule ligne)
$photo = $stmt->fetch();

// Si la photo n'existe pas, rediriger vers l'accueil
if (!$photo) {
    header('Location: index.php');
    exit;
}

// Titre de la page dynamique
$pageTitle = htmlspecialchars($photo['title']) . ' - Ansel Adams';

// Inclure le header
require_once 'includes/header.php';
?>

<main class="main-content">
    <article class="photo-detail">
        <!-- Image en grand si disponible -->
        <?php if ($photo['image_url']): ?>
            <div class="photo-detail-image">
                <img src="<?= htmlspecialchars($photo['image_url']) ?>"
                    alt="<?= htmlspecialchars($photo['title']) ?>">
            </div>
        <?php endif; ?>

        <!-- Contenu -->
        <div class="photo-detail-content">
            <!-- Titre -->
            <h1 class="photo-detail-title"><?= htmlspecialchars($photo['title']) ?></h1>

            <!-- Métadonnées -->
            <div class="photo-detail-meta">
                <?php if ($photo['year']): ?>
                    <div class="meta-item">
                        <span class="meta-label">Année</span>
                        <span class="meta-value"><?= $photo['year'] ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($photo['location']): ?>
                    <div class="meta-item">
                        <span class="meta-label">Lieu</span>
                        <span class="meta-value"><?= htmlspecialchars($photo['location']) ?></span>
                    </div>
                <?php endif; ?>

                <?php if ($photo['technique']): ?>
                    <div class="meta-item">
                        <span class="meta-label">Technique</span>
                        <span class="meta-value"><?= htmlspecialchars($photo['technique']) ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Description complète -->
            <?php if ($photo['description']): ?>
                <div class="photo-detail-description">
                    <h2 class="description-title">Description</h2>
                    <p><?= nl2br(htmlspecialchars($photo['description'])) ?></p>
                </div>
            <?php endif; ?>

            <!-- Navigation -->
            <div class="photo-detail-navigation">
                <a href="javascript:history.back()" class="btn-back">← Retour</a>
                <a href="index.php" class="btn-home">Accueil</a>
            </div>
        </div>
    </article>
</main>

<?php
// Inclure le footer
require_once 'includes/footer.php';
?>