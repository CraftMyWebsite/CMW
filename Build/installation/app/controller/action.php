<?php
if (isset($_GET['action']) AND $_GET['action'] == 'setchmod'){
	rchmod("../theme/upload");
	chmod("app/data/install.yml", 0777);
	rchmod('../modele/config');
	chmod("../modele/.htpasswd", 0777);
	chmod("../controleur/.htpasswd", 0777);
	chmod("../admin/actions/.htpasswd", 0777);
	rchmod("../theme/smileys");
	rchmod("../utilisateurs/");
}
// On essaie de se connecté et d'écrire les premiéres données histoire de voir si la base de données répond bien
if(isset($_GET['action']) AND $_GET['action'] == 'sql' AND isset($_POST['hote']) AND isset($_POST['nomBase']) AND isset($_POST['utilisateur']) AND isset($_POST['mdp']) AND isset($_POST['port']))
{
	if(($testPDO = verifyPDO($_POST['hote'], $_POST['nomBase'], $_POST['utilisateur'], $_POST['mdp'], $_POST['port'])) === TRUE)
	{
		$sql = getPDO($_POST['hote'], $_POST['nomBase'], $_POST['utilisateur'], $_POST['mdp'], $_POST['port']);
		require_once ('app/plugins/installSQL.php');
	}
	else if($testPDO == 3)
	{
		$erreur['type'] = 'pass';
	}
	else
	{
		$erreur['type'] = 'sql_mode';
		$erreur['data'] = $testPDO;
	}
}
// On ecrit les informations de la page "Configuration & Paramétrage du site" dans les fichier de config du cms
if(isset($_GET['action']) AND $_GET['action'] == 'infos' AND isset($_POST['nom']) AND isset($_POST['adresse']) AND isset($_POST['description']))
{    
	require('app/plugins/installInfos.php'); 
}
if(isset($_GET['action']) AND $_GET['action'] == 'cgu'){
	$installLecture = new Lire('app/data/install.yml');
	$installLecture = $installLecture->GetTableau();
	$installLecture['etape'] = 1;

	$ecriture = new Ecrire('app/data/install.yml', $installLecture);

	header('Location: index.php');
}
if(isset($_GET['action']) AND $_GET['action'] == 'compte' AND isset($_POST['pseudo']) AND isset($_POST['mdp']) AND isset($_POST['email']))
{
	$sql = getPDO($_Serveur_['DataBase']['dbAdress'], $_Serveur_['DataBase']['dbName'], $_Serveur_['DataBase']['dbUser'], $_Serveur_['DataBase']['dbPassword'], $_Serveur_['DataBase']['dbPort']);

	require_once ('app/plugins/compteAdmin.php');
	$compte = new CompteAdmin($sql, $_POST['pseudo'], $_POST['mdp'], $_POST['email']); //Création du compte admin

	$config = new Lire('../modele/config/config.yml');
	$config = $config->GetTableau();
	$config['installation'] = true;
	$ecriture = new Ecrire('../modele/config/config.yml', $config);
		
	$installLecture = new Lire('app/data/install.yml');
	$installLecture = $installLecture->GetTableau();
	$installLecture['etape'] = 4;

	$ecriture = new Ecrire('app/data/install.yml', $installLecture);
		
	header('Location: index.php');
}

function rchmod($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rchmod($dir."/".$object); else chmod($dir."/".$object, 0777);
       }
     }
     reset($objects);
     chmod($dir, 0777);
   }
 }


// if(isset($_GET['action']) AND $_GET['action'] == "sqlforce"){
// 	if(isset($_POST['']))
// }