<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'Ansel Adams - Photothèque' ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <header class="site-header">
        <div class="header-container">
            <!-- Logo/Titre cliquable -->
            <a href="index.php" class="site-logo">Ansel Adams</a>

            <!-- Formulaire de recherche -->
            <form action="recherche.php" method="GET" class="header-search-form">
                <input
                    type="search"
                    name="search"
                    class="header-search-input"
                    placeholder="Rechercher..."
                    autocomplete="off"
                    value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                <button type="submit" class="header-search-button"></button>
            </form>
        </div>
        <script src="assets/js/autocomplete.js" defer></script>
        </head>

    </header>