CREATE TABLE IF NOT EXISTS cmw_ban (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `ip` VARCHAR(20) NOT NULL,
  `pseudo` VARCHAR(16) 
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS cmw_ban_config (
  `id` TINYINT(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `titre` VARCHAR(255) NOT NULL,
  `texte` TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS `cmw_boutique_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `methode` int(2) NOT NULL,
  `commande_valeur` text NOT NULL,
  `prix` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `id_offre` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_cache_json` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `requete` varchar(255) NOT NULL,
  `valeur`TEXT NOT NULL,
  `temp`int(11)
) ENGINE= InnoDB;

CREATE TABLE IF NOT EXISTS `cmw_boutique_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `ordre` int(11) NOT NULL,
  `serveur` int(11) NOT NULL,
  `connection` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_boutique_offres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `prix` int(11) NOT NULL,
  `nbre_vente` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `ordre` int(11) NOT NULL,
  `evo` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_boutique_reduction` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_promo` char(8) NOT NULL,
  `pourcent` tinyint(3) UNSIGNED NOT NULL,
  `titre` varchar(60) NOT NULL,
  `categorie` int(11) UNSIGNED,
  `debut` int(11) UNSIGNED,
  `fin` int(11) UNSIGNED,
  `expire` int(11) UNSIGNED,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_boutique_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `offre_id` int(11) NOT NULL,
  `date_achat` date NOT NULL,
  `prix` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS cmw_conversations (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `pseudo1` VARCHAR(20) NOT NULL,
  `pseudo2` VARCHAR(20) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cmw_dedipass` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(40) NOT NULL,
  `code` varchar(8) NOT NULL,
  `rate` varchar(60) NOT NULL,
  `payout` float NOT NULL,
  `tokens` int(11) NOT NULL,
  `date_achat` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  `perms` int(11) UNSIGNED NOT NULL,
  `ordre` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_forum_answer` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_topic` smallint(6) NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  `contenue` varchar(10000) NOT NULL,
  `date_post` date NOT NULL,
  `d_edition` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum_answer_removed` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_answer` smallint(5) UNSIGNED NOT NULL,
  `id_topic` smallint(5) UNSIGNED NOT NULL,
  `auteur_answer` varchar(60) NOT NULL,
  `date_creation` date DEFAULT NULL,
  `Raison` varchar(200) DEFAULT NULL,
  `date_suppression` date NOT NULL,
  `auteur_suppression` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_forum_categorie` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `img` varchar(300) DEFAULT NULL,
  `sous-forum` tinyint(4) NOT NULL DEFAULT '0',
  `forum` int(11) NOT NULL,
  `close` tinyint(3) UNSIGNED NOT NULL,
  `ordre` int(11) UNSIGNED NOT NULL,
  `perms` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum_like` (
  `id` smallint(4) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(40) NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL,
  `id_answer` int(11) NOT NULL,
  `Appreciation` smallint(6) NOT NULL,
  `vu` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `new` tinyint(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum_lu` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(82) NOT NULL,
  `id_topic` int(10) UNSIGNED NOT NULL,
  `vu` tinyint(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_forum_post` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_categorie` smallint(6) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  `contenue` varchar(10000) NOT NULL,
  `date_creation` date NOT NULL,
  `last_answer` varchar(40) DEFAULT NULL,
  `sous_forum` smallint(6) DEFAULT NULL,
  `etat` int(11) NOT NULL,
  `d_edition` date DEFAULT NULL,
  `prefix` tinyint(4) NOT NULL,
  `epingle` tinyint(3) UNSIGNED NOT NULL,
  `affichage` int(10) UNSIGNED NOT NULL,
  `last_answer_temps` int(11) NOT NULL,
  `perms` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum_prefix` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `span` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_forum_report` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` smallint(6) NOT NULL,
  `id_topic_answer` int(11) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `reporteur` varchar(40) NOT NULL,
  `vu` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `new` tinyint(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum_smileys` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `symbole` varchar(10) NOT NULL,
  `image` varchar(200) NOT NULL,
  `priorite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_forum_sous_forum` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_categorie` smallint(6) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL,
  `ordre` int(11) UNSIGNED NOT NULL,
  `close` tinyint(1) UNSIGNED NOT NULL,
  `perms` int(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum_topic_followed` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(40) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `last_answer` int(11) NOT NULL,
  `vu` int(10) UNSIGNED NOT NULL DEFAULT '1',
  `new` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_forum_topic_removed` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  `nb_reponse` int(10) UNSIGNED NOT NULL,
  `auteur_topic` varchar(50) NOT NULL,
  `date_creation` date NOT NULL,
  `raison` varchar(300) NOT NULL,
  `date_suppression` date NOT NULL,
  `auteur_suppression` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_jetons_paypal_offres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `prix` decimal(8,2) NOT NULL,
  `jetons_donnes` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_log_DealJeton` ( 
  `ID` INT NOT NULL AUTO_INCREMENT , 
  `fromUser` VARCHAR(20) NOT NULL , 
  `toUser` VARCHAR(20) NOT NULL , 
  `amount` INT NOT NULL , 
  `date` INT NOT NULL , 
  PRIMARY KEY (`ID`)) 
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `cmw_maintenance` (
  `maintenanceId` int(1) NOT NULL AUTO_INCREMENT,
  `maintenanceMsg` text NOT NULL,
  `maintenanceMsgAdmin` text NOT NULL,
  `maintenanceTime` int(11) NOT NULL,
  `maintenancePref` int(1) NOT NULL,
  `maintenanceEtat` int(1) NOT NULL,
  `dateFin` int(11) NOT NULL,
  PRIMARY KEY (`maintenanceId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_messages` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `idConversation` smallint(5) UNSIGNED NOT NULL,
  `expediteur` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `date_envoie` datetime NOT NULL,
  `lu` tinyint(1) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `auteur` varchar(20) NOT NULL,
  `date` int(11) NOT NULL,
  `image` varchar(40) NOT NULL,
  `epingle` tinyint(1) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_news_commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_news` int(11) NOT NULL,
  `pseudo` varchar(32) NOT NULL,
  `commentaire` text NOT NULL,
  `date_post` int(11) NOT NULL,
  `nbrEdit` int(11) NOT NULL,
  `report` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_news_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_news` int(11) NOT NULL,
  `id_commentaires` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  `message` text NOT NULL,
  `victime` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_news_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_news` int(11) NOT NULL,
  `pseudo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `contenu` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_postit` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `auteur` varchar(40) NOT NULL,
  `message` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS cmw_reseaux (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  `idJoueur` INT UNSIGNED NOT NULL, 
  `Discord` VARCHAR(30)) 
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS cmw_serveur (
  id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nom VARCHAR(32) NOT NULL,
  adresse CHAR(15) NOT NULL,
  protocole BOOLEAN NOT NULL DEFAULT 0,
  port SMALLINT UNSIGNED NOT NULL,
  port2 SMALLINT UNSIGNED NULL,
  utilisateur VARCHAR(32) NULL,
  mdp VARCHAR(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cmw_support` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `auteur` varchar(20) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_post` datetime NOT NULL,
  `etat` int(1) NOT NULL,
  `ticketDisplay` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_support_commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket` int(11) NOT NULL,
  `auteur` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `date_post` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_sysip` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `idPerIP` int(11) NOT NULL,
  `nbrPerIP` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_sysmail` (
  `idMail` int(1) NOT NULL AUTO_INCREMENT,
  `fromMail` text NOT NULL,
  `sujetMail` text NOT NULL,
  `msgMail` text NOT NULL,
  `strictMail` int(1) NOT NULL,
  `etatMail` int(1) NOT NULL,
  PRIMARY KEY (`idMail`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_tempgrades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `grade_temporaire` varchar(100) NOT NULL,
  `grade_temps` int(11) NOT NULL,
  `grade_vie` varchar(100) NOT NULL,
  `is_active` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  `email` varchar(64) NOT NULL,
  `anciennete` int(11) NOT NULL,
  `newsletter` int(1) NOT NULL,
  `rang` int(2) NOT NULL DEFAULT '1',
  `tokens` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `resettoken` varchar(32) NOT NULL,
  `ip` varchar(40) NOT NULL,
  `CleUnique` varchar(32) NOT NULL,
  `ValidationMail` int(1) NOT NULL,
  `img_extension` char(4) NULL,
  `show_email` tinyint(1) UNSIGNED NOT NULL,
  `signature` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` text NOT NULL,
  `dates` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `nbre_votes` int(5) NOT NULL,
  `site` int(4) NOT NULL,
  `date_dernier` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_votes_config` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `methode` tinyint(3) UNSIGNED NOT NULL,
  `action` varchar(100) NOT NULL,
  `serveur` tinyint(3) UNSIGNED NOT NULL,
  `lien` varchar(255) NOT NULL,
  `temps` int(10) UNSIGNED NOT NULL,
  `titre` varchar(60) NOT NULL,
  `idCustom` text NOT NULL,
  `enligne` int(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_votes_temp` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(16) NOT NULL,
  `methode` tinyint(3) UNSIGNED NOT NULL,
  `action` varchar(100) NOT NULL,
  `serveur` tinyint(3) UNSIGNED NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `cmw_votes_recompense_auto_config` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `valueType` varchar(50) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `commande` varchar(255) NOT NULL,
  `serveur` smallint(5) UNSIGNED NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE cmw_paysafecard_offres (
  id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  montant text NOT NULL,
  jetons varchar(32) NOT NULL,
  description text NOT NULL,
  statut tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE cmw_paysafecard_historique (
  id smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  pseudo varchar(32) NOT NULL,
  code char(16) NOT NULL,
  offre smallint(5) UNSIGNED NOT NULL,
  statut tinyint(1) NOT NULL DEFAULT '0',
  CONSTRAINT cle_offre 
  FOREIGN KEY (offre) 
  REFERENCES cmw_paysafecard_offres(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

INSERT INTO `cmw_forum_smileys` (`id`, `symbole`, `image`, `priorite`) VALUES
(1, ':)', 'theme/smileys/1.gif', 500),
(2, ':diable', 'theme/smileys/37.gif', 499),
(3, ':D', 'theme/smileys/2.gif', 498),
(4, 'x)', 'theme/smileys/3.gif', 0),
(5, 'xd', 'theme/smileys/4.gif', 0),
(6, ':excited:', 'theme/smileys/5.gif', 0),
(7, ';)', 'theme/smileys/6.gif', 0),
(8, ':embarrass', 'theme/smileys/11.gif', 0),
(9, '8)', 'theme/smileys/13.gif', 0),
(10, ':o', 'theme/smileys/20.gif', 0),
(11, ':(', 'theme/smileys/23.gif', 0),
(12, ':c', 'theme/smileys/23.gif', 0),
(13, ':\'(', 'theme/smileys/24.gif', 0),
(14, '<3', 'theme/smileys/120.gif', 0),
(15, ':angel:', 'theme/smileys/36.gif', 0),
(16, ':salut:', 'theme/smileys/48.gif', 0),
(17, ':beer:', 'theme/smileys/51.gif', 0),
(18, ':cul:', 'theme/smileys/96.gif', 0),
(19, ':calimero', 'theme/smileys/97.gif', 0),
(20, ':vomir:', 'theme/smileys/98.gif', 0),
(21, ':google', 'theme/smileys/110.gif', 0),
(22, ':je sors:', 'theme/smileys/112.gif', 0),
(23, ':tu sors:', 'theme/smileys/117.gif', 0),
(24, ':vive moi:', 'theme/smileys/113.gif', 0),
(25, ':fouet:', 'theme/smileys/130.gif', 0),
(26, ':caca:', 'theme/smileys/151.gif', 0),
(27, ':bomb', 'theme/smileys/157.gif', 0),
(28, ':p', 'theme/smileys/131.gif', 0);