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
