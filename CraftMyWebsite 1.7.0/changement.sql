ALTER TABLE cmw_forum_sous_forum ADD ordre INT UNSIGNED NOT NULL, ADD close TINYINT UNSIGNED NOT NULL;

ALTER TABLE cmw_forum ADD perms INT UNSIGNED NOT NULL;
ALTER TABLE cmw_forum_categorie ADD perms INT UNSIGNED NOT NULL;
ALTER TABLE cmw_forum_post ADD perms INT UNSIGNED NOT NULL;
ALTER TABLE cmw_forum_sous_forum ADD perms INT UNSIGNED NOT NULL;

ALTER TABLE cmw_users ADD show_email TINYINT UNSIGNED NOT NULL;

ALTER TABLE cmw_boutique_offres ADD nbre_vente INT NOT NULL AFTER prix;

ALTER TABLE `cmw_maintenance` ADD `dateFin` INT(11) NOT NULL AFTER `maintenanceEtat`;

CREATE TABLE `cmw_log_DealJeton` ( `ID` INT NOT NULL AUTO_INCREMENT , `fromUser` VARCHAR(20) NOT NULL , `toUser` VARCHAR(20) NOT NULL , `amount` INT NOT NULL , `date` INT NOT NULL , PRIMARY KEY (`ID`)) ENGINE = InnoDB;

CREATE TABLE cmw_reseaux (id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, idJoueur INT UNSIGNED NOT NULL, Skype VARCHAR(30)) ENGINE = InnoDB;

ALTER TABLE cmw_users DROP skype;

ALTER TABLE cmw_forum_like ADD type INT UNSIGNED NOT NULL AFTER pseudo;

ALTER TABLE cmw_boutique_reduction ADD categorie INT UNSIGNED, ADD debut INT UNSIGNED, ADD fin INT UNSIGNED, ADD expire INT UNSIGNED;

ALTER TABLE cmw_news ADD epingle TINYINT UNSIGNED NOT NULL;

ALTER TABLE cmw_users ADD signature TEXT;

CREATE TABLE cmw_conversations (
	id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	pseudo1 VARCHAR(20) NOT NULL,
	pseudo2 VARCHAR(20) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE cmw_messages (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `idConversation` smallint(5) UNSIGNED NOT NULL,
  `expediteur` varchar(20) NOT NULL,
  `message` text NOT NULL,
  `date_envoie` datetime NOT NULL,
  `lu` tinyint(1) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE cmw_ban (
	`id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`ip` VARCHAR(20) NOT NULL,
	`pseudo` VARCHAR(16) 
) ENGINE=InnoDB;

CREATE TABLE cmw_ban_config (
	`id` TINYINT(5) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`titre` VARCHAR(255) NOT NULL,
	`texte` TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS `cmw_dedipass` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(40) NOT NULL,
  `code` varchar(8) NOT NULL,
  `rate` varchar(60) NOT NULL,
  `payout` float NOT NULL,
  `tokens` int(11) NOT NULL,
  `date_achat` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE `cmw_votes_temp` (
  `id` int(10) UNSIGNED NOT NULL,
  `pseudo` varchar(16) NOT NULL,
  `methode` tinyint(3) UNSIGNED NOT NULL,
  `action` varchar(100) NOT NULL,
  `serveur` tinyint(3) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `cmw_votes_recompense_auto_config` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `valueType` varchar(50) NOT NULL,
  `message` varchar(255) DEFAULT NULL,
  `commande` varchar(255) NOT NULL,
  `serveur` smallint(5) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `cmw_ban_config` (`id`, `titre`, `texte`) VALUES
(1, 'Vous êtes bannis', 'Vous avez été bannis du site, veuillez prendre contact avec l\'administration pour les raisons de votre bannissement.');

ALTER TABLE cmw_forum_categorie ADD ordre INT UNSIGNED NOT NULL;