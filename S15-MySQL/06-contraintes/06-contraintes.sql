------------------------ Les relations et contraintes d'intégrité ----------------------------

-- Lorsque l'on a une relation entre nos tables, pour faire des jointures ou autre (on définit ça lors de la modélisation)
-- On va créer des clés étrangères
-- Pour "valider" la relation, en plus de catégoriser le champ prévu pour être une FK (Foreign Key) dans notre table, on va devoir rajouter une contraire de clé trangère
-- Une contrainte de clé nous permet de maintenir l'intégrité des données en empêchant déjà l'ajout de données fictives(ne correspondant pas à un vrai enregistrement) et par la suite bloquer de mauvaises manipulations ou au contraire d'engendrer des réactions en chaine (restrict de suppression ou cascade de suppression par ex)
-- En rajoutant les relations sur notre base bibliothèque, je ne peux plus insérer un id_abonne ne correspondant pas à un abonné réel, idem pour les livre, je ne peux pas insérer un id_livre d'un livre qui n'existe pas ! 

-- Pour ça, je peux me rendre dans PHP My Admin, sur la table contenant une FK, dans le menu "structure", en bout de ligne du champ de la FK, bouton "Plus", bouton "Index"
-- Je me rends ensuite dans la vue relationnelle (bouton en haut dans le menu structure), pour ajouter les types de contraintes 

-- Les modes des contraintes 

    -- RESTRICT (ou NO ACTION, identique en MySQL) : Tant qu'un emprunt est rattaché à un abonné, on ne peut pas supprimer l'abonné ! Ni modifier son id.  On pourra le faire uniquement si aucun emprunt n'est rattaché à cet abonné
    -- SET NULL : Inscrira NULL dans le champ de la FK, mais conserve l'enregistrement si on supprime l'abonné (ATTENTION cela induit qu'il faut au préalable autoriser la valeur NULL sur le champ en question)
    -- CASCADE : (=repercussion), Si on supprime l'abonné, tous ses emprunts seront également supprimés ! ATTENTION à manipuler avec précaution ! (Attention à ne pas faire de la relation en cascade si jamais je décide de travailler avec REPLACE... Mieux vaut éviter !)

CREATE DATABASE taxi;

USE TAXI;

CREATE TABLE IF NOT EXISTS `association_vehicule_conducteur` (
  `id_association` int(3) NOT NULL AUTO_INCREMENT,
  `id_vehicule` int(3) DEFAULT NULL,
  `id_conducteur` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_association`)
  
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


INSERT INTO `association_vehicule_conducteur` (`id_association`, `id_vehicule`, `id_conducteur`) VALUES
(1, 501, 1),
(2, 502, 2),
(3, 503, 3),
(4, 504, 4),
(5, 501, 3);


CREATE TABLE IF NOT EXISTS `conducteur` (
  `id_conducteur` int(3) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(30) NOT NULL,
  `nom` varchar(30) NOT NULL,
  PRIMARY KEY (`id_conducteur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;


INSERT INTO `conducteur` (`id_conducteur`, `prenom`, `nom`) VALUES
(1, 'Julien', 'Avigny'),
(2, 'Morgane', 'Alamia'),
(3, 'Philippe', 'Pandre'),
(4, 'Amelie', 'Blondelle'),
(5, 'Alex', 'Richy');


DROP TABLE IF EXISTS `vehicule`;
CREATE TABLE IF NOT EXISTS `vehicule` (
  `id_vehicule` int(3) NOT NULL AUTO_INCREMENT,
  `marque` varchar(30) NOT NULL,
  `modele` varchar(30) NOT NULL,
  `couleur` varchar(30) NOT NULL,
  `immatriculation` varchar(9) NOT NULL,
  PRIMARY KEY (`id_vehicule`)
) ENGINE=InnoDB AUTO_INCREMENT=507 DEFAULT CHARSET=latin1;

INSERT INTO `vehicule` (`id_vehicule`, `marque`, `modele`, `couleur`, `immatriculation`) VALUES
(501, 'Peugeot', '807', 'noir', 'AB-355-CA'),
(502, 'Citroen', 'C8', 'bleu', 'CE-122-AE'),
(503, 'Mercedes', 'Cls', 'vert', 'FG-953-HI'),
(504, 'Volkswagen', 'Touran', 'noir', 'SO-322-NV'),
(505, 'Skoda', 'Octavia', 'gris', 'PB-631-TK'),
(506, 'Volkswagen', 'Passat', 'gris', 'XN-973-MM');

-- EXERCICES Relations et Contraintes 

-- Créer la base taxi et ses tables et insérer les données 

-- 1 - Créer les clés étrangères et les relations, cela empêchera l'insertion de fausses valeurs 

-- 2 - Définir les modes de contraintes en fonction des souhaits de notre client ci-dessous :
        -- 1 - La société de taxis peut modifier leurs conducteurs via leur logiciel, lorsqu'un conducteur est modifié, la société aimerait que la modification soit répercutée dans la table d'association   
        -- 2 - La société de taxis peut supprimer des conducteurs via leur logiciel, ils aimeraient bloquer la possibilité de supprimer un conducteur tant que celui-ci conduit un véhicule.
        -- 3 - La société de taxis peut modifier un véhicule via leur logiciel. Lorsqu'un véhicule est modifié, on veut que la modification soit répercutée dans la table d'association
        -- 4 - Si un véhicule est supprimé alors qu'un ou plusieurs conducteurs le conduisaient, la société aimerait garder la trace de l'association dans la table d'association malgré tout.

-- EXERCICES Requetes

-- 01 - Qui conduit la voiture 503 ? 
-- 02 - Quelle(s) voiture(s) est conduite par le conducteur 3 ? 
-- 03 - Qui conduit quoi ? 
-- 04 - Ajoutez vous dans la liste des conducteurs.
        -- Afficher tous les conducteurs (meme ceux qui n'ont pas de correspondance avec les vehicules) puis les vehicules qu'ils conduisent si c'est le cas
-- 05 - Ajoutez un nouvel enregistrement dans la table des véhicules.
        -- Afficher tous les véhicules (meme ceux qui n'ont pas de correspondance avec les conducteurs) puis les conducteurs si c'est le cas
-- 06 - Afficher tous les conducteurs et tous les vehicules, peu importe les correspondances.