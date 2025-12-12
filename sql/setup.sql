-- Suppression de la base si elle existe déjà (pour réinitialiser)
DROP DATABASE IF EXISTS phase02_autocompletion;

-- Création de la base de données
CREATE DATABASE phase02_autocompletion CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Utiliser la base de données
USE phase02_autocompletion;

-- Création de la table photographs
CREATE TABLE photographs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    year INT NULL,
    location VARCHAR(255) NULL,
    description TEXT NULL,
    technique VARCHAR(100) NULL,
    image_url VARCHAR(500) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertion des données : 20 photographies iconiques d'Ansel Adams
INSERT INTO photographs (title, year, location, description, technique, image_url) VALUES
('Monolith, the Face of Half Dome', 1927, 'Yosemite National Park, California', 'L''une des premières œuvres majeures d''Adams, capturant la face verticale du Half Dome avec un filtre rouge profond.', 'Glass plate negative', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/02/Ansel_Adams_-_National_Archives_79-AA-Q01.jpg/800px-Ansel_Adams_-_National_Archives_79-AA-Q01.jpg'),
('Rose and Driftwood', 1932, 'San Francisco, California', 'Nature morte emblématique combinant une rose délicate et du bois flotté texturé.', 'Silver gelatin print', NULL),
('Clearing Winter Storm', 1935, 'Yosemite Valley, California', 'Vue spectaculaire de la vallée de Yosemite émergeant des nuages d''hiver.', 'Large format camera', 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/47/Clearing_Winter_Storm%2C_Yosemite_National_Park%2C_California_1938_or_1940.jpg/800px-Clearing_Winter_Storm%2C_Yosemite_National_Park%2C_California_1938_or_1940.jpg'),
('Moonrise, Hernandez', 1941, 'Hernandez, New Mexico', 'Peut-être la photographie la plus célèbre d''Adams, capturée au crépuscule avec la lune se levant.', 'Zone System', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/Moonrise%2C_Hernandez%2C_New_Mexico.jpg/1024px-Moonrise%2C_Hernandez%2C_New_Mexico.jpg'),
('Winter Sunrise, Sierra Nevada', 1944, 'Lone Pine, California', 'Vue dramatique de l''aube sur les montagnes enneigées de la Sierra Nevada.', 'Large format', NULL),
('The Tetons and the Snake River', 1942, 'Grand Teton National Park, Wyoming', 'Paysage épique montrant la rivière Snake serpentant devant les Tetons.', '8x10 view camera', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c8/The_Tetons_and_the_Snake_River.jpg/1280px-The_Tetons_and_the_Snake_River.jpg'),
('Oak Tree, Snowstorm', 1948, 'Yosemite National Park, California', 'Chêne solitaire capturé pendant une tempête de neige hivernale.', 'Zone System', NULL),
('Mount Williamson, Sierra Nevada', 1945, 'Sierra Nevada, California', 'Rochers massifs au premier plan avec le Mont Williamson en arrière-plan.', 'Large format', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Mount_Williamson_-_Sierra_Nevada_1944.jpg/1024px-Mount_Williamson_-_Sierra_Nevada_1944.jpg'),
('Aspens, Northern New Mexico', 1958, 'Northern New Mexico', 'Bosquet de trembles aux feuilles automnales lumineuses.', 'Zone System', NULL),
('Half Dome, Apple Orchard', 1933, 'Yosemite Valley, California', 'Vue du Half Dome encadré par des arbres de verger au printemps.', 'Glass plate', NULL),
('Sentinel Rock and Cloud', 1937, 'Yosemite Valley, California', 'Formation rocheuse imposante avec un nuage dramatique.', 'Large format', NULL),
('El Capitan, Winter', 1950, 'Yosemite National Park, California', 'La face massive d''El Capitan couverte de neige hivernale.', 'Zone System', NULL),
('Sand Dunes, Sunrise', 1948, 'Death Valley, California', 'Dunes de sable ondulantes capturées à l''aube avec un éclairage rasant.', 'Large format', NULL),
('White Branches, Mono Lake', 1950, 'Mono Lake, California', 'Branches d''arbres blanchies par le sel contre le ciel sombre.', 'Zone System', NULL),
('Cathedral Peak and Lake', 1938, 'Yosemite National Park, California', 'Pic majestueux se reflétant dans un lac alpin.', 'Large format', NULL),
('Jeffrey Pine, Sentinel Dome', 1940, 'Yosemite National Park, California', 'Pin Jeffrey iconique perché sur Sentinel Dome.', 'Zone System', NULL),
('Burnt Stump and New Grass', 1935, 'Sierra Nevada, California', 'Contraste entre destruction et renaissance dans la nature.', 'Silver gelatin print', NULL),
('Base of Upper Yosemite Fall', 1950, 'Yosemite Valley, California', 'Vue depuis la base de la cascade spectaculaire.', 'Large format', NULL),
('Mirror Lake, Mount Watkins', 1935, 'Yosemite National Park, California', 'Réflexion parfaite du Mont Watkins dans les eaux calmes.', 'Glass plate', NULL),
('Nevada Fall, Rainbow', 1946, 'Yosemite National Park, California', 'Arc-en-ciel capturé dans la brume de Nevada Fall.', 'Zone System', NULL),
('Bridalveil Fall', 1927, 'Yosemite Valley, California', 'Première photographie de cette cascade iconique par Adams.', 'Glass plate negative', NULL);