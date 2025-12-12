<?php
// Titre de la page (optionnel, pour personnaliser le <title>)
$pageTitle = 'Accueil - Ansel Adams Photothèque';

// Inclure le header
require_once 'includes/header.php';
?>

<main class="main-content">
    <div class="welcome-section">
        <h1 class="welcome-title">Explorez l'œuvre d'Ansel Adams</h1>
        <p class="welcome-text">
            Découvrez 21 photographies iconiques du maître de la photographie de paysage noir et blanc.
            Utilisez la barre de recherche ci-dessus pour explorer la collection.
        </p>
        <p class="welcome-hint">
            Essayez : "Yosemite", "Winter", "Half Dome"...
        </p>
    </div>
</main>

<?php
// Inclure le footer
require_once 'includes/footer.php';
?>