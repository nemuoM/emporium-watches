-- Base de données pour mon site
-- SBGD MariaDB
-- Script créer création ou restaurer la bdd

-- Création de la bdd si elle n`exite pas 
DROP DATABASE IF EXISTS `db_emporium`;
CREATE DATABASE IF NOT EXISTS `db_emporium` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;
USE `db_emporium`;

CREATE USER IF NOT EXISTS 'emporium' IDENTIFIED BY 'DumB0__2500!';
GRANT ALL PRIVILEGES ON db_emporium.* TO 'emporium';

-- Suppression des tables si elles existent
DROP TABLE IF EXISTS `details_montre`;
DROP TABLE IF EXISTS `changement_statut`;
DROP TABLE IF EXISTS `commande`;
DROP TABLE IF EXISTS `statut`;
DROP TABLE IF EXISTS `client`;
DROP TABLE IF EXISTS `roles`;
DROP TABLE IF EXISTS `montre`;
DROP TABLE IF EXISTS `matiere`;
DROP TABLE IF EXISTS `mouvement`;
DROP TABLE IF EXISTS `style`;
DROP TABLE IF EXISTS `couleur`;
DROP TABLE IF EXISTS `genre`;
DROP TABLE IF EXISTS `marque`;

--
-- CRÉATION DES TABLES
--
CREATE TABLE IF NOT EXISTS `marque`(
  `idMarque` integer NOT NULL AUTO_INCREMENT,
  `libelle` varchar(30),
  CONSTRAINT `pk_marque` PRIMARY KEY(`idMarque`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `genre`(
  `idGenre` integer NOT NULL AUTO_INCREMENT,
  `libelle` varchar(30),
  CONSTRAINT `pk_genre` PRIMARY KEY(`idGenre`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `couleur`(
  `idCouleur` integer NOT NULL AUTO_INCREMENT,
  `libelle` varchar(30),
  CONSTRAINT `pk_couleur` PRIMARY KEY(`idCouleur`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `style`(
  `idStyle` integer NOT NULL AUTO_INCREMENT,
  `libelle` varchar(30),
  CONSTRAINT `pk_style` PRIMARY KEY(`idStyle`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `mouvement`(
  `idMouvement` integer NOT NULL AUTO_INCREMENT,
  `libelle` varchar(30),
  CONSTRAINT `pk_mouvement` PRIMARY KEY(`idMouvement`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `matiere`(
  `idMatiere` integer NOT NULL AUTO_INCREMENT,
  `libelle` varchar(30),
  CONSTRAINT `pk_matiere` PRIMARY KEY(`idMatiere`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `montre`(
  `idMontre` integer NOT NULL AUTO_INCREMENT,
  `image` varchar(250),
  `nom` varchar(50),
  `description` varchar(800),
  `prix` float(7,2),
  `dateAjout` date,
  `stock` integer,
  `idMarque` integer NOT NULL,
  `idGenre` integer NOT NULL,
  `idCouleur` integer NOT NULL,
  `idStyle` integer NOT NULL,
  `idMouvement` integer NOT NULL,
  `idMatiereCadran` integer NOT NULL,
  `idMatiereBracelet` integer NOT NULL,
  CONSTRAINT `pk_montre` PRIMARY KEY(`idMontre`),
  FOREIGN KEY (`idMarque`) REFERENCES `marque`(`idMarque`),
  FOREIGN KEY (`idGenre`) REFERENCES `genre`(`idGenre`),  
  FOREIGN KEY (`idCouleur`) REFERENCES `couleur`(`idCouleur`),
  FOREIGN KEY (`idStyle`) REFERENCES `style`(`idStyle`),
  FOREIGN KEY (`idMouvement`) REFERENCES `mouvement`(`idMouvement`),
  FOREIGN KEY (`idMatiereCadran`) REFERENCES `matiere`(`idMatiere`),
  FOREIGN KEY (`idMatiereBracelet`) REFERENCES `matiere`(`idMatiere`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `roles`(
  `idRole` integer NOT NULL AUTO_INCREMENT,
  `libelle` varchar(20),
  CONSTRAINT `pk_roles` PRIMARY KEY (`idRole`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `client`(
  `idClient` integer  NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `mail` varchar(80) NOT NULL,
  `mdp` varchar(60),
  `telephone` integer,
  `adresse` varchar(80),
  `cp` char(5),
  `ville` varchar(20),
  `idGenre` integer NOT NULL,
  `idRole` integer NOT NULL,
  CONSTRAINT `pk_client`PRIMARY KEY (`idClient`),
  FOREIGN KEY (`idGenre`) REFERENCES  `genre`(`idGenre`),
  FOREIGN KEY (`idRole`) REFERENCES  `roles`(`idRole`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `statut` (
  `idStatut` integer NOT NULL AUTO_INCREMENT,
  `libelle` varchar(25),
  CONSTRAINT `pk_statut` PRIMARY KEY (`idStatut`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `commande` (
  `idCommande` integer NOT NULL AUTO_INCREMENT,
  `dateCmd` date NOT NULL,
  `idStatut` integer NOT NULL,
  `idClient` integer NOT NULL,
  CONSTRAINT `pk_commande` PRIMARY KEY (`idCommande`),
  FOREIGN KEY (`idStatut`) REFERENCES `statut`(`idStatut`),
  FOREIGN KEY (`idClient`) REFERENCES `client`(`idClient`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `changement_statut`(
  `idCommande` integer NOT NULL, 
  `idStatut` integer NOT NULL,
  `dateChangement` date NOT NULL,
  CONSTRAINT `pk_changemenStatut` PRIMARY KEY (`idCommande`,`idStatut`),
  FOREIGN KEY (`idCommande`) REFERENCES `commande`(`idCommande`),
  FOREIGN KEY (`idStatut`) REFERENCES `statut`(`idStatut`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

CREATE TABLE IF NOT EXISTS `details_montre`(
  `idCommande` integer NOT NULL, 
  `idMontre` integer NOT NULL,
  `qte` integer,
  CONSTRAINT `pk_detailsM` PRIMARY KEY (`idCommande`,`idMontre`),
  FOREIGN KEY (`idCommande`) REFERENCES `commande`(`idCommande`),
  FOREIGN KEY (`idMontre`) REFERENCES `montre`(`idMontre`) 
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Création d'une procédure
--
DELIMITER &&
DROP PROCEDURE IF EXISTS AjtOuCreerCart &&
CREATE PROCEDURE AjtOuCreerCart(idC INT, idM INT, laqte INT)
BEGIN 
  
  IF (SELECT qte FROM details_montre WHERE idCommande = idC AND idMontre = idM) IS NOT NULL THEN 
    UPDATE details_montre SET qte = qte + laqte WHERE idCommande = idC AND idMontre = idM;
  ELSE 
    INSERT INTO details_montre (idCommande, idMontre, qte) VALUES (idC, idM, laqte);
  END IF;
END&&

DROP PROCEDURE IF EXISTS decrDelete &&
CREATE PROCEDURE decrDelete(idC INT, idM INT)
BEGIN 
  IF (SELECT qte FROM details_montre WHERE idCommande = idC AND idMontre = idM) = 1 THEN 
    DELETE FROM details_montre WHERE idCommande = idC AND idMontre = idM;
  ELSE 
    UPDATE details_montre SET qte = qte - 1 WHERE idCommande = idC AND idMontre = idM;
  END IF;
END &&
DELIMITER ;

DELIMITER $$
DROP TRIGGER IF EXISTS update_statut_trigger$$
CREATE TRIGGER update_statut_trigger
AFTER UPDATE ON commande
FOR EACH ROW
BEGIN
  IF NEW.idStatut <> OLD.idStatut THEN
    INSERT INTO changement_statut (idCommande, idStatut, dateChangement)
    VALUES (NEW.idCommande, NEW.idStatut, CURDATE());
  END IF;
  
  IF NEW.idStatut = 2 THEN
    UPDATE montre m
    INNER JOIN details_montre dm ON m.idMontre = dm.idMontre
    SET m.stock = m.stock - dm.qte
    WHERE dm.idCommande = NEW.idCommande;
  END IF;

  IF NEW.idStatut = 6 THEN
    UPDATE montre m
    INNER JOIN details_montre dm ON m.idMontre = dm.idMontre
    SET m.stock = m.stock + dm.qte
    WHERE dm.idCommande = NEW.idCommande;
  END IF;
END$$
DELIMITER ;

-- Trigger pour supprimer un client et ses références dans les tables liées
DROP TRIGGER IF EXISTS delete_client_trigger;
DELIMITER $$
CREATE TRIGGER delete_client_trigger
BEFORE DELETE ON client
FOR EACH ROW
BEGIN
  -- Supprimer les enregistrements liés dans la table details_montre et changement_statut avant de supprimer les commandes
  DELETE FROM details_montre WHERE idCommande IN (SELECT idCommande FROM commande WHERE idClient = OLD.idClient);
  DELETE FROM changement_statut WHERE idCommande IN (SELECT idCommande FROM commande WHERE idClient = OLD.idClient);
  
  -- Supprimer les enregistrements liés dans la table commande
  DELETE FROM commande WHERE idClient = OLD.idClient;

END$$
DELIMITER ;




--
-- Insertion des enregistrements
--
INSERT INTO `roles`(`libelle`) VALUES ('SuperAdmin'),('Admin'),('user');

INSERT INTO `marque` (`libelle`)
              VALUES ('KUOE KYOTO'), 
                     ('Orient'),
                     ('MDT'),
                     ('Seiko'),
                     ('Lip'),
                     ('Zentier'),
                     ('Alba'),
                     ('Casio');

INSERT INTO `genre` (`libelle`) VALUES  ('Homme'), ('Femme'), ('Mixte');
INSERT INTO `couleur` (`libelle`) VALUES ('Noir'), ('Blanc'), ('Bleu'), ('Argent'), ('Crème/Ivoire'), ('Vert'), ('Rouge'), ('Turquoise'), ('Blanc crème'), ('Squelette'), ('Rose'), ('Or');
INSERT INTO `style` (`libelle`) VALUES ('Vintage'), ('Classique'), ('Moderne'), ('Sportif'), ('Dresswatch'), ('Militaire'), ('Plongée'), ('Élégant');
INSERT INTO `mouvement` (`libelle`) VALUES ('Quartz'), ('Automatique'), ('Mécanique'), ('Kinetic'), ('Solaire'), ('Pile');
INSERT INTO `matiere` (`libelle`) VALUES ('Acier inoxydable'), ('Cuir'), ('Résine'), ('Silicone'), ('Nylon'), ('Acier'), ('Caoutchouc'), ('Verre en résine'), ('Verre minéral'), ('Verre saphir'), ('Fibre de carbone');

INSERT INTO `statut`(`libelle`) VALUES ('Non Validée'), ('Préparation'), ('Pris en Charge'), ('En cours d''acheminement'), ('Livré'), ('Annulé');

INSERT INTO `montre`(`image`,`nom`, `description`, `prix`, `dateAjout`, `stock`, `idMarque`, `idGenre`, `idCouleur`, `idStyle`, `idMouvement`, `idMatiereCadran`, `idMatiereBracelet`) 
VALUES 
  ('oldsmit.jpg','KUOE KYOTO Old Smit', 'Le premier modèle de la marque, Old Smith, s''inspire des montres anciennes des années 1960. Un diamètre de 35 mm, avec son cadran ivoire, le modèle Old Smith donne une sensation unique et vintage associée aux montres classiques tannées.', 299.00, NOW(), RAND() * 20, 1, 3, 5, 1, 1, 1, 2),
  ('moonphaseclassic.jpg','Orient Moonphase Classic', 'La fonction Soleil & Lune illustre le passage du jour à la nuit sur un disque tournant de 24 heures, et le semi-squelette crée le style classique.Dotée d''un boîtier aminci, d''un verre bombé évoquant le style vintage et la chaleur, et d''un cadran combinant un beau motif soleillé avec des index à barres, elle renaît avec un nouveau style simple.', 329.00, NOW(), RAND() * 20, 2, 1, 2, 1, 2, 1, 3),
  ('cadranblanc.jpg', 'MTGamma cadran blanc', 'La MTGamma est une source de détails horlogers.Votre affichage horaire ne cessera de vous surprendre. Vous trouverez, sur vos aiguilles, une trotteuse rouge, qui amplifiera votre satisfaction à chaque coup d’œil que vous jetterez sur votre garde temps.', 299.00, NOW(), RAND()*20, 3,1,2,3,1,1,1),
  ('datekanji.jpg','Seiko Automatic date Kanji', '', 229.00, NOW(), RAND()*20, 4,1,4,1,2,1,6),
  ('petiteseconde.jpg', 'Seiko petite seconde', 'Un design intemporel et sobre pour l''homme à la classe discrète. Ce garde-temps dégage un luxe distingué. Les aiguilles et les chiffres romains noirs sont montés sur un cadran blanc. Les secondes sont indiquées par une petite aiguille dans un cercle séparé au-dessus de la position 6 heures. Le bracelet en veau brun avec impression crocodile complète la montre et assure un ajustement parfait.', 230.00, NOW(), RAND()*20, 4,1,2,2,1,1,2),
  ('oldsmith.jpg', 'KUOE KYOTO Old Smith', 'Inspirée par les montres militaires britanniques des années 1940 - La collection Old Smith 90-002 de KUOE KYOTO recrée le design de l’époque avec un diamètre plus petit.', 399.00, NOW(), RAND()*20, 1,3,6,6,2,1,5),
  ('z2arabic.jpg', 'Zentier Z2 Arabic dial', 'Limiter à 100 modèle dans le monde', 780.00, NOW(), RAND()*20, 6, 1,7,3,2,6,7),
  ('lip-churchill.jpg', 'LiP T18 Churchill', 'Cette montre LIP T18 Churchill possède un charme vintage toujours d''actualité. Cette nouvelle version dotée d''un bracelet aux couleurs tendances, en fait un modèle souvent copié mais rarement égalé. La fabrication du calibre Type 18 débutera en 1935 juste avant la guerre 39-45. Durant ce conflit, l''entreprise déménage dans le centre de la France, puis au sud, à Valence. A la fin du conflit, LIP revient à Besançon et reconstruit son usine. La "T18" sort alors des ateliers. Calibre d''une grande modernité avec son petit compteur des secondes, un modèle tout en or est offert à Sir Winston Churchill en 1948.', 189.00, NOW(), RAND()*20, 5,2,4,1,1,6,2),
  ('skeletton.jpg', 'MTZeta skeletton', 'Plongez dans le monde la MTZeta de MaisonDuTemps. Arborant un boîtier en acier inoxydable de 42 mm et une lunette décagonale distinctive, cette montre allie précision japonaise Myiota 8N24 et esthétique sophistiquée. Avec verres en saphir, étanchéité à 100 mètres et choix de bracelets, la Zeta est un chef-d''œuvre intemporel.', 385.00, NOW(), RAND()*20, 3,1,10,3,2,1,7),
  ('KINETIC.jpg', 'Seiko KINETIC', '', 299.00, NOW(), RAND()*20, 4,1,3,8,4,1,2),
  ('gshock-noir.png', 'Casio G-Shock GA-2100', 'Les Casio G-SHOCK sont les montres parfaites pour partir à l''aventure ! Réputées indestructibles, ces montres ont de nombreuses fonctionnalités qui vous accompagnerons au quotidien.', 89.90, NOW(),RAND()*20, 8,3,1,4,1,11,3),
  ('gshock-saumon.jpg', 'Casio G-Shock GMA-S2100', 'Cette série réduit la taille de la GA-2100 pour aboutir à un design simple et fin. Les caractéristiques spécifiques de la GA-2100 - lunette octogonale, cadran plat, index simples à trait large et structure Carbon Core Guard - sont désormais disponibles dans une configuration compacte.', 99.90, NOW(), RAND()*20, 8,3,11,4,1,11,3),
  ('gshock-blanc.jpg', 'Casio G-Shock GMA-S2100', 'Cette série réduit la taille de la GA-2100 pour aboutir à un design simple et fin. Les caractéristiques spécifiques de la GA-2100 - lunette octogonale, cadran plat, index simples à trait large et structure Carbon Core Guard - sont désormais disponibles dans une configuration compacte.', 99.90, NOW(),RAND()*20,8,3,2,4,1,11,3),
  ('vintage.jpg', 'Casio Vintage', 'Un classique que l''on ne présente plus.', 59.90, NOW(), RAND()*20, 8,3,12,1,6,3,6),
  ('tiffany.jpg', 'ALBA bleu turquoise "Tiffany"', '', 170.00, NOW(), RAND()*20, 7,3,8,8,1,1,1),
  ('moophase-bleu.jpg', 'Orient Moonphase bleu','La fonction Soleil & Lune illustre le passage du jour à la nuit sur un disque tournant de 24 heures, et le semi-squelette crée le style classique.Dotée d''un boîtier aminci, d''un verre bombé évoquant le style vintage et la chaleur, et d''un cadran combinant un beau motif soleillé avec des index à barres, elle renaît avec un nouveau style simple.', 329.00, NOW(), RAND() * 20, 2,1,3,1,2,1,2),
  ('golden-silver.jpg', 'Orient Golden Eye', 'Orient Watch Company, plus communément appelée Orient est la plus grande entreprise japonaise de production de montres mécaniques, créée en 1950 par Shogoro Yoshida. Orient a la particularité de produire tous ses mouvements in-house. En 2009, Orient devient une filiale exclusive de Seiko.', 289.00, NOW(), RAND()*20, 2,1,4,2,2,1,1),
  ('presage.jpg', 'Seiko présage', 'La nouvelle collection Presage Style 60''s reprend les caractéristiques du chronographe Crown avec un verre box-shaped, des index facettés et des aiguilles aux lignes acérées. Un design imprégné d’une sensation de douceur qui révèle un look vintage des années 60.', 590.00, NOW(), RAND()*20, 4,1,9,8,2,1,6),
  ('casion-avion.jpg', 'Casio AE-1000W-1AVEF', 'Batterie avec 10 ans d''autonomie • Cadran similaire à un indicateur de planche de bord d''avion • Carte du monde pour l''heure mondiale • Écran analogique LC (heure de la ville de résidence) • Étanchéité jusqu''à 100 mètres', 39.90, NOW(), RAND()*20, 8,3,1,4,6,3,3),
  ('casio-calculette.jpg', 'Casio Vintage DB', 'DATA BANK multilingue Cette montre numérique combinée à une calculatrice à 10 touches vous fait bénéficier de toute la commodité d''une calculatrice à 8 chiffres intégrée à une montre-bracelet. Son écran LCD à fort contraste facilite la lecture des chiffres. Parmi les autres fonctionnalités, citons le mode Banque de données, l''affichage du jour de la semaine en 13 langues et une autonomie de 10 ans garantissant un fonctionnement sans interruption.', 59.90, NOW(), RAND()*20, 8,3,4,1,6,3,1),
  ('seiko-plonge.jpg', 'Seiko Prospex', 'La montre automatique Prospex SPB147J1 est une ré-interprétation de la première montre Diver de 1965. Réalisée dans un acier inoxydable et étanche à 200 mètres, elle est la représentation parfaite du savoir-faire de la manufacture Seiko en matière de montres de plongée. Son joli cadran accueille des aiguilles et index revêtus de Lumibrite, son cadran est également recouvert d''un verre en saphir anti-reflet et entouré d''une lunette unidirectionnelle.', 990.0, NOW(), RAND()*20, 4,3,12,7,2,1,4);

INSERT INTO `client` (`nom`,`prenom`,`mail`,`mdp`,`telephone`,`adresse`,`cp`, `ville`, `idGenre`, `idRole`) 
VALUES ('MORABET', 'Abdelmoumen', 'abdelmoumen.morabet@gmail.com', '$2y$10$yvRdbt6lGNe9XVXv7IXsEuWlSKUc5UlI7ADrE5DETW/NBfWVA037O', null, null, null, null, 1, 1),
       ('HAKIMI', 'Achraf', 'achraf.hakimi@gmail.com', '$2y$10$yvRdbt6lGNe9XVXv7IXsEuWlSKUc5UlI7ADrE5DETW/NBfWVA037O', null, null, null, null, 1, 3),
       ('CURIE', 'Marie', 'marie.currie@gmail.com', '$2y$10$yvRdbt6lGNe9XVXv7IXsEuWlSKUc5UlI7ADrE5DETW/NBfWVA037O', null, null, null, null, 1, 3),
       ('RONALDO', 'Cristiano', 'cristiano.ronaldo@gmail.com', '$2y$10$yvRdbt6lGNe9XVXv7IXsEuWlSKUc5UlI7ADrE5DETW/NBfWVA037O', null, null, null, null, 1, 3);

INSERT INTO `commande` (`dateCmd`, `idStatut`, `idClient`)
VALUES (NOW(), 1, 1),
       (NOW(), 1, 2),
       (NOW(), 1, 3),
       (NOW(), 1, 4);