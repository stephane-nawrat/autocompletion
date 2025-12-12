<?php
// Titre de la page
$pageTitle = 'Accueil - Ansel Adams Photothèque';

// Inclure le header
require_once 'includes/header.php';

// Inclure la connexion BDD
require_once 'config/database.php';

// Récupérer toutes les photographies
$pdo = getDatabase();
$sql = "SELECT * FROM photographs ORDER BY year DESC";
$stmt = $pdo->query($sql);
$photos = $stmt->fetchAll();
$totalCount = count($photos);
?>

<main class="main-content">
    <div class="search-results">
        <div class="results-header">
            <p class="results-count"><?= $totalCount ?> photographies disponibles</p>
        </div>

        <div class="results-grid">
            <?php foreach ($photos as $photo): ?>
                <article class="photo-card">
                    <?php if ($photo['image_url']): ?>
                        <div class="photo-card-image">
                            <img src="<?= htmlspecialchars($photo['image_url']) ?>"
                                alt="<?= htmlspecialchars($photo['title']) ?>"
                                loading="lazy">
                        </div>
                    <?php endif; ?>

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
    </div>
</main>

<?php
// Inclure le footer
require_once 'includes/footer.php';
?>