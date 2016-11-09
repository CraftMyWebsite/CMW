<?php
$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_users` 
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`pseudo` varchar(20) NOT NULL,
	`mdp` varchar(200) NOT NULL,
	`email` varchar(32) NOT NULL,
	`anciennete` int(11) NOT NULL,
	`newsletter` int(1) NOT NULL,
	`rang` int(2) NOT NULL,
	`tokens` int(11) NOT NULL,
	`age` int(11) NOT NULL,
	`skype` varchar(16) NOT NULL,
	`resettoken` varchar(32) NOT NULL,
	`ip` varchar(40) NOT NULL,
	`CleUnique` varchar(32) NOT NULL,
	`ValidationMail` int(1) NOT NULL,
	PRIMARY KEY (`id`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;"	);

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_news` 
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`titre` varchar(100) NOT NULL,
	`message` text NOT NULL,
	`auteur` varchar(20) NOT NULL,
	`date` int(11) NOT NULL,
	`image` varchar(40) NOT NULL,
	PRIMARY KEY (`id`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;"	);

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_pages`
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`titre` varchar(100)NOT NULL,
	`contenu` text NOT NULL,
	PRIMARY KEY (`id`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;"	);

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_support`
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`auteur` varchar(20) NOT NULL,
	`titre` varchar(100)NOT NULL,
	`message` text NOT NULL,
	`date_post` datetime NOT NULL,
	`etat` int(1) NOT NULL,
	PRIMARY KEY (`id`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;"	);

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_support_commentaires` 
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`id_ticket` int(11) NOT NULL,
	`auteur` varchar(20) NOT NULL,
	`message` text NOT NULL,
	`date_post` datetime NOT NULL,
	PRIMARY KEY (`id`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;"	);

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_votes` 
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`pseudo` varchar(20) NOT NULL,
	`nbre_votes` int(5) NOT NULL,
	`site` int(4) NOT NULL,
	`date_dernier` int(11) NOT NULL,
	PRIMARY KEY (`id`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;"	);

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_boutique_categories` 
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`titre` varchar(100) NOT NULL,
	`message` text NOT NULL,
	`ordre` int(11) NOT NULL,
	`serveur` int(11) NOT NULL,
	`connection` int(1) NOT NULL,
	PRIMARY KEY (`id`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;"	);

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_boutique_stats` 
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`offre_id` int(11) NOT NULL,
	`date_achat` date NOT NULL,
	`prix` int(11) NOT NULL,
	`pseudo` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;"	);

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_boutique_offres` 
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`nom` varchar(100) NOT NULL,
	`description` text NOT NULL,
	`prix` int(11) NOT NULL,
	`categorie_id` int(11) NOT NULL,
	`ordre` int(11) NOT NULL,
	PRIMARY KEY (`id`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;"	);

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_boutique_action` 
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`methode` int(2) NOT NULL,
	`commande_valeur` text NOT NULL,
	`prix` int(11) NOT NULL,
	`duree` int(11) NOT NULL,
	`id_offre` int(11) NOT NULL,
	PRIMARY KEY (`id`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;"	);

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_tempgrades` 
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`pseudo` varchar(20) NOT NULL,
	`grade_temporaire` varchar(100) NOT NULL,
	`grade_temps` int(11) NOT NULL,
	`grade_vie` varchar(100) NOT NULL,
	`is_active` int(2) NOT NULL,
	PRIMARY KEY (`id`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;"	);

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_jetons_paypal_offres` 
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`nom` varchar(100) NOT NULL,
	`description` text NOT NULL,
	`prix` int(11) NOT NULL,
	`jetons_donnes` int(11) NOT NULL,
	PRIMARY KEY (`id`)
) 
ENGINE=InnoDB  DEFAULT CHARSET=latin1 ;"	);

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_maintenance`
(
	`maintenanceId` int(1) NOT NULL AUTO_INCREMENT,
	`maintenanceMsg` text NOT NULL,
	`maintenanceMsgAdmin` text NOT NULL,
	`maintenanceTime` int(11) NOT NULL,
	`maintenancePref` int(1) NOT NULL,
	`maintenanceEtat` int(1) NOT NULL,
	PRIMARY KEY (`maintenanceId`)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;	");


#----Début de l'intégration----#

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_news_commentaires`
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`id_news` int(11) NOT NULL,
	`pseudo` varchar(32) NOT NULL,
	`commentaire` text NOT NULL,
	`date_post` int(11) NOT NULL,
	`nbrEdit` int(11) NOT NULL,
	`report` int(11) NOT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;	");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_news_reports`
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`id_news` int(11) NOT NULL,
	`id_commentaires` int(11) NOT NULL,
	`pseudo` text NOT NULL,
	`message` text NOT NULL,
	`victime` text NOT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;	");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_news_stats`
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`id_news` int(11) NOT NULL,
	`pseudo` text NOT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;	");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_sysip`
(
	`id` int(1) NOT NULL AUTO_INCREMENT,
	`idPerIP` int(11) NOT NULL,
	`nbrPerIP` int(11) NOT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;	");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_sysmail`
(
	`idMail` int(1) NOT NULL AUTO_INCREMENT,
	`fromMail` text NOT NULL,
	`sujetMail` text NOT NULL,
	`msgMail` text NOT NULL,
	`strictMail` int(1) NOT NULL,
	`etatMail` int(1) NOT NULL,
	PRIMARY KEY (`idMail`)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;	");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_visits`
(
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`ip` text NOT NULL,
	`dates` date NOT NULL,
	PRIMARY KEY (`id`)
)
ENGINE=InnoDB DEFAULT CHARSET=latin1;	");

$sql->exec("INSERT INTO `cmw_sysmail` (`idMail`, `fromMail`, `sujetMail`, `msgMail`, `strictMail`, `etatMail`) VALUES (1, 'exemple@exemple.fr', 'Activation du compte !', 'Bienvenue sur notre site {JOUEUR} !\r\n\r\nVous vous êtes inscrit sur le site officiel du serveur NOM_DU_SERVEUR.\r\nPour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur internet.\r\n\r\n{LIEN}\r\n\r\nInscription depuis cette adresse IP : {IP}\r\n---------------\r\nCeci est un mail automatique, merci de ne pas y répondre.', 1, 0);");

$sql->exec("INSERT INTO `cmw_sysip` (`id`, `idPerIP`, `nbrPerIP`) VALUES (1, 0, 1);");

$sql->exec("INSERT INTO `cmw_maintenance` (`maintenanceId`, `maintenanceMsg`, `maintenanceMsgAdmin`, `maintenanceTime`, `maintenancePref`, `maintenanceEtat`) VALUES (1, 'Malheureusement le site est actuellement en maintenance..</br>Revenez plus tard.', 'Vous êtes administrateur ? Alors connectez-vous :', 0, 0, 0);");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_forum` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;");

$sql->exec("INSERT INTO `cmw_forum` (`id`, `nom`) VALUES
(1, 'Ton Forum');");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_forum_answer` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_topic` smallint(6) NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  `contenue` varchar(10000) NOT NULL,
  `date_post` date NOT NULL,
  `d_edition` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;");

$sql->exec("INSERT INTO `cmw_forum_answer` (`id`, `id_topic`, `pseudo`, `contenue`, `date_post`, `d_edition`) VALUES
(1, 1, 'florentlife', 'Bienvenue sur ton forum :D ', '2016-05-01', '2016-07-02');");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_forum_answer_removed` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_answer` smallint(5) unsigned NOT NULL,
  `id_topic` smallint(5) unsigned NOT NULL,
  `auteur_answer` varchar(60) NOT NULL,
  `date_creation` date DEFAULT NULL,
  `Raison` varchar(200) DEFAULT NULL,
  `date_suppression` date NOT NULL,
  `auteur_suppression` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_forum_categorie` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `img` varchar(300) DEFAULT NULL,
  `description` varchar(300) NOT NULL,
  `sous-forum` tinyint(4) NOT NULL DEFAULT '0',
  `forum` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;");

$sql->exec("INSERT INTO `cmw_forum_categorie` (`id`, `nom`, `img`, `description`, `sous-forum`, `forum`) VALUES
(1, 'Forum créer par Florentlife', NULL, 'Oh blabla :O', 0, 1);");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_forum_like` (
  `id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(40) NOT NULL,
  `id_answer` int(11) NOT NULL,
  `Appreciation` smallint(6) NOT NULL,
  `vu` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `new` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_forum_lu` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(82) NOT NULL,
  `id_topic` int(10) unsigned NOT NULL,
  `vu` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_forum_post` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_categorie` smallint(6) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  `description` varchar(100) NOT NULL,
  `contenue` varchar(10000) NOT NULL,
  `date_creation` date NOT NULL,
  `last_answer` varchar(40) DEFAULT NULL,
  `sous_forum` smallint(6) DEFAULT NULL,
  `etat` int(11) NOT NULL,
  `d_edition` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

$sql->exec("INSERT INTO `cmw_forum_post` (`id`, `id_categorie`, `nom`, `pseudo`, `description`, `contenue`, `date_creation`, `last_answer`, `sous_forum`, `etat`, `d_edition`) VALUES
(1, 1, 'Test', 'genesis3044', 'Test du forum', 'Test du forum', '2016-05-01', 'florentlife', NULL, 0, '2016-07-02');");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_forum_report` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `type` smallint(6) NOT NULL,
  `id_topic_answer` int(11) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `reporteur` varchar(40) NOT NULL,
  `vu` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `new` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_forum_sous_forum` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_categorie` smallint(6) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `img` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;");

$sql->exec("INSERT INTO `cmw_forum_sous_forum` (`id`, `id_categorie`, `nom`, `description`, `img`) VALUES
(1, 1, 'blabla', 'bla', NULL);");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_forum_topic_followed` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(40) NOT NULL,
  `id_topic` int(11) NOT NULL,
  `last_answer` int(11) NOT NULL,
  `vu` int(10) unsigned NOT NULL DEFAULT '1',
  `new`int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_forum_topic_removed` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  `nb_reponse` int(10) unsigned NOT NULL,
  `auteur_topic` varchar(50) NOT NULL,
  `date_creation` date NOT NULL,
  `raison` varchar(300) NOT NULL,
  `date_suppression` date NOT NULL,
  `auteur_suppression` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");

$sql->exec("CREATE TABLE IF NOT EXISTS `cmw_dedipass` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(40) NOT NULL,
  `code` varchar(8) NOT NULL,
  `rate` varchar(60) NOT NULL,
  `payout` float NOT NULL,
  `tokens` int(11) NOT NULL,
  `date_achat` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;");


#----Fin de l'intégration----#


$sql->exec("INSERT INTO `cmw_news` (`titre`, `message`, `auteur`, `date`) VALUES ('Merci d\'avoir choisi CraftMyWebsite', 'Vous pourrez supprimer cette news depuis votre panel admin !<br /> CraftMyWebsite est en constant développement, pensez à suivre les mises à jours sur notre site !', 'CraftMyWebsite', '".time()."')"); 


$configLecture = new Lire('../modele/config/config.yml');
$config = $configLecture->GetTableau();

$config['DataBase']['dbAdress'] = $_POST['hote'];
$config['DataBase']['dbName'] = $_POST['nomBase'];
$config['DataBase']['dbUser'] = $_POST['utilisateur'];
$config['DataBase']['dbPassword'] = $_POST['mdp'];
$config['DataBase']['dbPort'] = $_POST['port'];

$ecriture = new Ecrire('../modele/config/config.yml', $config);


$installLecture = new Lire('install.yml');
$installLecture = $installLecture->GetTableau();
$installLecture['etape'] = 2;

$ecriture = new Ecrire('install.yml', $installLecture);

header('Location: index.php');
