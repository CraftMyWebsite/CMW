<?php
$sql->exec(file_get_contents('install.sql'));

#----Fin de l'intégration----#


$sql->exec("INSERT INTO `cmw_news` (`titre`, `message`, `auteur`, `date`) VALUES ('Merci d\'avoir choisi CraftMyWebsite', 'Vous pourrez supprimer cette news depuis votre panel admin !<br /> CraftMyWebsite est en constant développement, pensez à suivre les mises à jours sur notre site !', 'CraftMyWebsite', '".time()."')"); 
$sql->exec("INSERT INTO `cmw_forum` (`nom`) VALUES ('Forum CraftMyWebsite')");
$sql->exec("INSERT INTO `cmw_forum_categorie` (`nom`, `sous-forum`, `forum`, `close`) VALUES ('Votre Premier Forum', 0, 1, 0)");


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