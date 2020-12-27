CREATE TABLE IF NOT EXISTS cmw_ban (
  `id` smallint(5) UNSIGNED  AUTO_INCREMENT PRIMARY KEY,
  `ip` VARCHAR(20) ,
  `pseudo` VARCHAR(16) 
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS cmw_ban_config (
  `id` TINYINT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `titre` VARCHAR(255),
  `texte` TEXT
);

CREATE TABLE IF NOT EXISTS `cmw_boutique_action` (
  `id` int(11) AUTO_INCREMENT,
  `methode` int(2),
  `commande_valeur` text,
  `prix` int(11),
  `duree` int(11),
  `id_offre` int(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_cache_json` (
  `id` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `requete` varchar(255),
  `valeur`TEXT,
  `temp`int(11)
) ENGINE= InnoDB;

CREATE TABLE IF NOT EXISTS `cmw_boutique_categories` (
  `id` int(11) AUTO_INCREMENT,
  `titre` varchar(100),
  `message` text,
  `ordre` int(11),
  `serveur` int(11),
  `connection` int(1),
  `showNumber` int(1),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_boutique_offres` (
  `id` int(11) AUTO_INCREMENT,
  `nom` varchar(100),
  `description` text,
  `prix` int(11),
  `nbre_vente` int(11),
  `categorie_id` int(11),
  `ordre` int(11),
  `evo` text NULL,
  `max_vente` int(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_boutique_reduction` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `code_promo` char(8),
  `pourcent` tinyint(3) UNSIGNED,
  `titre` varchar(60),
  `categorie` int(11) UNSIGNED,
  `debut` int(11) UNSIGNED,
  `fin` int(11) UNSIGNED,
  `expire` int(11) UNSIGNED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_boutique_stats` (
  `id` int(11) AUTO_INCREMENT,
  `offre_id` int(11),
  `date_achat` datetime,
  `prix` int(11),
  `pseudo` varchar(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS cmw_conversations (
  `id` SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `pseudo1` VARCHAR(20),
  `pseudo2` VARCHAR(20)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cmw_dedipass` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `pseudo` varchar(40),
  `code` varchar(8),
  `rate` varchar(60),
  `payout` float,
  `tokens` int(11),
  `date_achat` datetime,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `nom` varchar(80),
  `perms` int(11) UNSIGNED,
  `ordre` int(11) UNSIGNED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_forum_answer` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `id_topic` smallint(6),
  `pseudo` varchar(40),
  `contenue` varchar(10000),
  `date_post` datetime,
  `d_edition` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum_answer_removed` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `id_answer` smallint(5) UNSIGNED,
  `id_topic` smallint(5) UNSIGNED,
  `auteur_answer` varchar(60),
  `date_creation` datetime DEFAULT NULL,
  `Raison` varchar(200) DEFAULT NULL,
  `date_suppression` datetime,
  `auteur_suppression` varchar(60),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_forum_categorie` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `nom` varchar(40),
  `img` varchar(300) DEFAULT NULL,
  `sous-forum` tinyint(4) DEFAULT '0',
  `forum` int(11),
  `close` tinyint(3) UNSIGNED,
  `ordre` int(11) UNSIGNED,
  `perms` int(11) UNSIGNED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum_like` (
  `id` smallint(4) UNSIGNED AUTO_INCREMENT,
  `pseudo` varchar(40),
  `type` tinyint(1) UNSIGNED,
  `id_answer` int(11),
  `Appreciation` smallint(6),
  `vu` tinyint(3) UNSIGNED DEFAULT '0',
  `new` tinyint(3) UNSIGNED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum_lu` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `pseudo` varchar(82),
  `id_topic` int(10) UNSIGNED,
  `vu` tinyint(3) UNSIGNED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_forum_post` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `id_categorie` smallint(6),
  `nom` varchar(40),
  `pseudo` varchar(40),
  `contenue` varchar(10000),
  `date_creation` datetime,
  `last_answer` varchar(40) DEFAULT NULL,
  `sous_forum` smallint(6) DEFAULT NULL,
  `etat` int(11),
  `d_edition` datetime DEFAULT NULL,
  `prefix` tinyint(4),
  `epingle` tinyint(3) UNSIGNED,
  `affichage` int(10) UNSIGNED,
  `last_answer_temps` int(11),
  `perms` int(11) UNSIGNED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum_prefix` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `span` varchar(40),
  `nom` varchar(40),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_forum_report` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `type` smallint(6),
  `id_topic_answer` int(11),
  `reason` varchar(200),
  `reporteur` varchar(40),
  `vu` tinyint(3) UNSIGNED DEFAULT '0',
  `new` tinyint(3) UNSIGNED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum_sous_forum` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `id_categorie` smallint(6),
  `nom` varchar(40),
  `description` varchar(300) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL,
  `ordre` int(11) UNSIGNED,
  `close` tinyint(1) UNSIGNED,
  `perms` int(11) UNSIGNED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum_topic_followed` (
  `id` int(10) UNSIGNED AUTO_INCREMENT,
  `pseudo` varchar(40),
  `id_topic` int(11),
  `last_answer` int(11),
  `vu` int(10) UNSIGNED DEFAULT '1',
  `new` int(10) UNSIGNED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum_topic_removed` (
  `id` int(11) UNSIGNED AUTO_INCREMENT,
  `nom` varchar(80),
  `nb_reponse` int(10) UNSIGNED,
  `auteur_topic` varchar(50),
  `date_creation` datetime,
  `raison` varchar(300),
  `date_suppression` datetime,
  `auteur_suppression` varchar(50),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_jetons_paypal_offres` (
  `id` int(11) AUTO_INCREMENT,
  `nom` varchar(100),
  `description` text,
  `prix` decimal(8,2),
  `jetons_donnes` int(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_log_DealJeton` ( 
  `ID` INT AUTO_INCREMENT, 
  `fromUser` VARCHAR(20), 
  `toUser` VARCHAR(20), 
  `amount` INT, 
  `date` INT, 
  PRIMARY KEY (`ID`)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cmw_maintenance` (
  `maintenanceId` int(1) AUTO_INCREMENT,
  `maintenanceMsg` text,
  `maintenanceMsgAdmin` text,
  `maintenanceMsgInscr` text,
  `maintenanceTime` int(11),
  `maintenancePref` int(1),
  `maintenanceEtat` int(1),
  `dateFin` int(11),
  `inscription` tinyint(1) UNSIGNED DEFAULT '0', 
  PRIMARY KEY (`maintenanceId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_news` (
  `id` int(11) AUTO_INCREMENT,
  `titre` varchar(100),
  `message` text,
  `auteur` varchar(20),
  `date` int(11),
  `image` varchar(40),
  `epingle` tinyint(1) UNSIGNED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_news_commentaires` (
  `id` int(11) AUTO_INCREMENT,
  `id_news` int(11),
  `pseudo` varchar(32),
  `commentaire` text,
  `date_post` int(11),
  `nbrEdit` int(11),
  `report` int(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_news_reports` (
  `id` int(11) AUTO_INCREMENT,
  `id_news` int(11),
  `id_commentaires` int(11),
  `pseudo` text,
  `message` text,
  `victime` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_news_stats` (
  `id` int(11) AUTO_INCREMENT,
  `id_news` int(11),
  `pseudo` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_pages` (
  `id` int(11) AUTO_INCREMENT,
  `titre` varchar(100),
  `contenu` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_postit` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `auteur` varchar(40),
  `message` varchar(50),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS cmw_reseaux (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
  `idJoueur` INT UNSIGNED, 
  `Discord` VARCHAR(30)) 
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS cmw_serveur (
  id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(32),
  adresse CHAR(15),
  protocole BOOLEAN DEFAULT 0,
  port SMALLINT UNSIGNED,
  port2 SMALLINT UNSIGNED NULL,
  utilisateur VARCHAR(32) NULL,
  mdp VARCHAR(64)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_support` (
  `id` int(11) AUTO_INCREMENT,
  `auteur` varchar(20),
  `titre` varchar(100),
  `message` text,
  `date_post` datetime,
  `etat` int(1),
  `ticketDisplay` int(1),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_support_commentaires` (
  `id` int(11) AUTO_INCREMENT,
  `id_ticket` int(11),
  `auteur` varchar(20),
  `message` text,
  `date_post` datetime,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_sysip` (
  `id` int(1) AUTO_INCREMENT,
  `idPerIP` int(11),
  `nbrPerIP` int(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_sysmail` (
  `idMail` int(1) AUTO_INCREMENT,
  `fromMail` text,
  `sujetMail` text,
  `msgMail` text,
  `strictMail` int(1),
  `etatMail` int(1),
  PRIMARY KEY (`idMail`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_tempgrades` (
  `id` int(11) AUTO_INCREMENT,
  `pseudo` varchar(20),
  `grade_temporaire` varchar(100),
  `grade_temps` int(11),
  `grade_vie` varchar(100),
  `is_active` int(2),
  PRIMARY KEY (`id`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_users` (
  `id` int(11) AUTO_INCREMENT,
  `pseudo` varchar(20),
  `mdp` varchar(200),
  `email` varchar(64),
  `anciennete` int(11),
  `newsletter` int(1),
  `rang` int(2) DEFAULT '1',
  `tokens` int(11),
  `age` int(11),
  `resettoken` varchar(32),
  `ip` varchar(40),
  `CleUnique` varchar(32),
  `ValidationMail` int(1),
  `img_extension` char(4) NULL,
  `show_email` tinyint(1) UNSIGNED,
  `achats` text NULL,
  `signature` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_visits` (
  `id` int(11) AUTO_INCREMENT,
  `ip` text,
  `dates` datetime,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_votes` (
  `id` int(11) AUTO_INCREMENT,
  `pseudo` varchar(50),
  `ip` varchar(20),
  `nbre_votes` int(5),
  `site` int(4),
  `date_dernier` int(11),
  `isOld` int(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_votes_config` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `action` text NULL,
  `serveur` tinyint(3) UNSIGNED,
  `lien` varchar(255),
  `temps` int(10) UNSIGNED,
  `titre` varchar(60),
  `idCustom` text,
  `enligne` int(1) DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_votes_temp` (
  `id` int(10) UNSIGNED AUTO_INCREMENT,
  `pseudo` varchar(16),
  `action` text,
  `serveur` tinyint(3) UNSIGNED,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_votes_recompense_auto_config` (
  `id` smallint(5) UNSIGNED AUTO_INCREMENT,
  `type` tinyint(3) UNSIGNED,
  `valueType` varchar(50),
  `action` text NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE cmw_paysafecard_offres (
  id smallint(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  montant text,
  jetons varchar(32),
  description text,
  statut tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE cmw_paysafecard_historique (
  id smallint(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  pseudo varchar(32),
  code char(16),
  offre smallint(5) UNSIGNED,
  statut tinyint(1) DEFAULT '0',
  CONSTRAINT cle_offre 
  FOREIGN KEY (offre) 
  REFERENCES cmw_paysafecard_offres(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_paypal_historique` (
  `id` int(5) UNSIGNED AUTO_INCREMENT,
  `montant` double(5, 2) UNSIGNED,
  `pseudo` varchar(32),
  `date` datetime,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE cmw_grades (
  id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(200),
  priorite INT UNSIGNED DEFAULT 0,
  prefix CHAR(9) DEFAULT '',
  couleur CHAR(9) DEFAULT '',
  effets VARCHAR(64) DEFAULT '',
  permDefault BLOB,
  permPanel LONGBLOB, 
  permForum BLOB
)              
ENGINE= InnoDB;

ALTER TABLE cmw_grades AUTO_INCREMENT=2;

INSERT INTO `cmw_paysafecard_offres` (`id`, `montant`, `jetons`, `description`, `statut`) VALUES
(1, '10', '100', 'Offre 10€ = 10 jetons', 1),
(2, '25', '25', 'Offre 25€ = 25 jetons', 1),
(3, '50', '50', 'Offre 50€ = 50 jetons', 1);

INSERT INTO `cmw_forum_prefix` (`id`, `span`, `nom`) VALUES
(1, 'prefix prefixRed', 'Important'),
(2, 'prefix prefixOrange', 'Refusée'),
(3, 'prefix prefixGreen', 'Acceptée'),
(4, 'prefix prefixRoyalBl', 'En Attente');

INSERT INTO `cmw_maintenance` (`maintenanceId`, `maintenanceMsg`, `maintenanceMsgAdmin`, `maintenanceTime`, `maintenancePref`, `maintenanceEtat`) VALUES
(1, 'Malheureusement le site est actuellement en maintenance..</br>Revenez plus tard.', 'Vous êtes administrateur ? Alors connectez-vous :', 1501248800, 0, 0);

INSERT INTO `cmw_sysip` (`id`, `idPerIP`, `nbrPerIP`) VALUES
(1, 0, 1);

INSERT INTO `cmw_sysmail` (`idMail`, `fromMail`, `sujetMail`, `msgMail`, `strictMail`, `etatMail`) VALUES
(1, 'exemple@exemple.fr', 'Activation du compte !', 'Bienvenue sur notre site {JOUEUR} !\r\n\r\nVous vous êtes inscrit sur le site officiel du serveur NOM_DU_SERVEUR.\r\nPour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur internet.\r\n\r\n{LIEN}\r\n\r\nInscription depuis cette adresse IP : {IP}\r\n---------------\r\nCeci est un mail automatique, merci de ne pas y répondre.', 1, 0);

INSERT INTO `cmw_ban_config` (`id`, `titre`, `texte`) VALUES
(1, 'Vous êtes bannis', 'Vous avez été bannis du site, veuillez prendre contact avec l\'administration pour les raisons de votre bannissement.');
