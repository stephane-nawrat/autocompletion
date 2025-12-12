# Autocomplétion - Ansel Adams Photothèque

Projet d'autocomplétion pour explorer les photographies noir et blanc iconiques d'Ansel Adams.

## Description

Application web avec système d'autocomplétion intelligent permettant de rechercher parmi les œuvres d'Ansel Adams. La recherche propose des suggestions en temps réel, divisées en deux catégories :
- Résultats qui commencent par la recherche
- Résultats qui contiennent la recherche

## Technologies utilisées

- PHP 8.3
- MySQL 9.4
- JavaScript vanilla (Fetch API)
- CSS responsive (Mobile First)
- Git pour le versioning

## Architecture du projet
```
autocompletion/
├── index.php              Page accueil
├── recherche.php          Page résultats
├── element.php            Page détail photo
├── autocomplete.php       API suggestions JSON
├── .env                   Variables environnement (non versionné)
├── .env.example           Template .env
├── .gitignore             Fichiers exclus
├── README.md              Documentation
├── config/
│   └── database.php       Connexion PDO
├── assets/
│   ├── css/
│   │   └── style.css      Styles responsive
│   └── js/
│       └── autocomplete.js JavaScript
├── includes/
│   ├── header.php         Header réutilisable
│   └── footer.php         Footer réutilisable
├── sql/
│   └── setup.sql          Script création BDD
└── tests/
    ├── README.md          Documentation tests
    └── test_db.php        Test connexion PDO
````

## Installation en local

### Prérequis

- PHP 8.3+ installé
- MySQL 9.4+ installé
- Laravel Valet configuré
- Git

### Accès au projet

Avec Valet, le projet est accessible à l'adresse :
```
http://workspace.test/laplateforme/phase02/autocompletion
```

### Configuration base de données

1. Copier `.env.example` vers `.env` :
```bash
cp .env.example .env
```

2. Modifier `.env` avec vos identifiants MySQL

Documentation complète à venir...

## Fonctionnalités

- Barre de recherche avec autocomplétion en temps réel
- Suggestions divisées en deux groupes (commence par / contient)
- Page de résultats de recherche
- Page détail d'une photographie
- Design responsive mobile-first
- Interface inspirée de Hans Lucas (minimaliste, focus image)

## Auteur

Stphn - Étudiant La Plateforme (Phase 2)

## Liens

- Repository GitHub : https://github.com/ton-username/autocompletion
- Site en ligne : [À compléter]