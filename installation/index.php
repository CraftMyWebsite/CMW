<?php
	// On récupère la classe permettant la lecture en YML. Les fichiers de config sont sous ce format.
error_reporting(0);
require_once('../modele/config/yml.class.php');

	// On lit le fichier de config et on récupère les information dans un tableau. Celui-ci contiens la config générale.
$configLecture = new Lire('../modele/config/config.yml');
$_Serveur_ = $configLecture->GetTableau();

$installEtape = new Lire('install.yml');
$installEtape = $installEtape->GetTableau();
$installEtape = $installEtape['etape'];


if(isset($_GET['action']) AND $_GET['action'] == 'sql' AND isset($_POST['hote']) AND isset($_POST['nomBase']) AND isset($_POST['utilisateur']) AND isset($_POST['mdp']) AND isset($_POST['port']))
	if(verifyPDO($_POST['hote'], $_POST['nomBase'], $_POST['utilisateur'], $_POST['mdp'], $_POST['port']))
	{
		$sql = getPDO($_POST['hote'], $_POST['nomBase'], $_POST['utilisateur'], $_POST['mdp'], $_POST['port']);
		require_once('installSQL.php');
	}	

	if(isset($_GET['action']) AND $_GET['action'] == 'infos' AND isset($_POST['nom']) AND isset($_POST['adresse']) AND isset($_POST['description']))
		require_once('installInfos.php');

	if(isset($_GET['action']) AND $_GET['action'] == 'compte' AND isset($_POST['pseudo']) AND isset($_POST['mdp']) AND isset($_POST['email']))
	{
		$sql = getPDO($_Serveur_['DataBase']['dbAdress'], $_Serveur_['DataBase']['dbName'], $_Serveur_['DataBase']['dbUser'], $_Serveur_['DataBase']['dbPassword'], $_Serveur_['DataBase']['dbPort']);
		require_once('compteAdmin.php');
		$compte = new CompteAdmin($sql, $_POST['pseudo'], $_POST['mdp'], $_POST['email']);

		$config = new Lire('../modele/config/config.yml');
		$config = $config->GetTableau();
		$config['installation'] = true;
		$ecriture = new Ecrire('../modele/config/config.yml', $config);
		
		$installLecture = new Lire('install.yml');
		$installLecture = $installLecture->GetTableau();
		$installLecture['etape'] = 4;

		$ecriture = new Ecrire('install.yml', $installLecture);
		
		header('Location: index.php');		
	}
	include '../include/version.php';
	?>
	<html>
	<head>
		<title>CraftMyWebsite Setup #<?php echo $installEtape;?></title>	
		<meta charset="utf-8" />
		<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
		<link href="css/style.css" rel="stylesheet" type="text/css">
		<link href="css/animate.css" rel="stylesheet" type="text/css">
		<script type="text/javascript">
			(function titleScroller(text) {
				document.title = text;
				console.log(text);
				setTimeout(function () {
					titleScroller(text.substr(1) + text.substr(0, 1));
				}, 500);
			}("CraftMyWebsite Setup | Etape #<?php echo $installEtape; ?> | "));
		</script>
	</head>
	<body class="container">
		<?php
		require_once('droits.php');
		$return = VerifieChmod();
		if($return != null) {
			DrawChmod($return); 
			$chmodok = "false";
		} else { 
			SetHtpasswd();
			$chmodok = "true";
		}
		?>
		<?php if($chmodok == "true") { ?>
		<div class="well well-install">
			<h1 class="animated slideInLeft" style="font-family: material;text-align: center;margin-bottom: 25px;">CraftMyWebsite <?php echo $versioncms; ?></h1>
			<div class="p-install">
				<center>
					<h1>Merci d'avoir choisi CraftMyWebsite !</h1>
					<p>Des mises à jour seront disponibles très fréquemment sur le site officiel.<br/>
						Il peut néanmoins y avoir des bugs ! Merci de les report sur le forum pour les corriger au plus vite.<br/>
						Suivez les instructions pour installer CraftMyWebsite.<br/>
					</p>
					<p><a href="http://craftmywebsite.fr" class="btn btn-primary btn-installation" role="button">Aller sur CraftMyWebsite.fr</a></p>
				</center>
			</div>
		</br>
		<center style="padding: 15px;"><h4>Un probléme avec l'installation ? Accédez au tutoriel en cliquant ici : <a target="_blank" href="https://www.youtube.com/watch?v=nV4kRY-kYFo">Tutoriel Vidéo</a></h4></center>
		<br/>
		<div class="p-install-form">
			<div class="container" style="width: 90%; margin: 10px auto;">
				<div class="row multistep">
					<div class="col-xs-3 multistep-step <?php if($installEtape == 1) { echo 'current'; } elseif($installEtape >= 1) { echo 'complete'; } ?>">
						<div class="text-center multistep-stepname" style="color: white;">Étape #1<br/><small>Mise en place BDD SQL</small></div>
						<div class="progress"><div class="progress-bar"></div></div>
						<a href="#" class="multistep-dot"></a>
					</div>

					<div class="col-xs-3 multistep-step <?php if($installEtape == 2) { echo 'current'; } elseif($installEtape >= 2) { echo 'complete'; } ?>">
						<div class="text-center multistep-stepname" style="color: white;">Étape #2<br/><small>Configuration site</small></div>
						<div class="progress"><div class="progress-bar"></div></div>
						<a href="#" class="multistep-dot"></a>
					</div>

					<div class="col-xs-3 multistep-step <?php if($installEtape == 3) { echo 'current'; } elseif($installEtape >= 3) { echo 'complete'; } ?>">
						<div class="text-center multistep-stepname" style="color: white;">Étape #3<br/><small>Création compte admin</small></div>
						<div class="progress"><div class="progress-bar"></div></div>
						<a href="#" class="multistep-dot"></a>
					</div>

					<div class="col-xs-3 multistep-step <?php if($installEtape == 4) { echo 'current'; } elseif($installEtape >= 4) { echo 'complete'; } ?>">
						<div class="text-center multistep-stepname" style="color: white;">Étape #4<br/><small>Fini c:</small></div>
						<div class="progress"><div class="progress-bar"></div></div>
						<a href="#" class="multistep-dot"></a>
					</div>
				</div>

			</div>
			<form method="post" action="<?php if($installEtape == 1) echo '?&action=sql'; elseif($installEtape == 2) echo '?&action=infos'; elseif($installEtape == 3) echo '?&action=compte'; ?>">

				<div class="row">
					<?php if($installEtape == 1) { ?>
					<h3 style="font-family: material;text-align: center;margin-top: 40px;">Base de données <img style="width: 115px;margin-top: -33px;"src="img/logo-mysql.png"></h3>
					<div class="form-group col-md-6">
						<label>Adresse de la base de donnée</label>
						<input type="text" name="hote" class="form-control form-install" placeholder="Exemple: sql.hebergeur.fr"/>
					</div>
					<div class="form-group col-md-6">
						<label>Utilisateur</label>
						<input type="text" name="utilisateur" class="form-control form-install" placeholder="Exemple: monutilisateur864"/>
					</div>
					<div class="form-group col-md-6">
						<label>Mot de passe</label>
						<input type="password" name="mdp" class="form-control form-install" placeholder="Exemple: ttcpgm18"/>
					</div>
					<div class="form-group col-md-6">
						<label>Nom de la base</label>
						<input type="text" name="nomBase" class="form-control form-install" placeholder="Exemple: cmw_bdd"/>
					</div>
					<div class="form-group col-md-6">
						<label>Port de connection <small>Si inconnu laissez 3306</small></label>
						<input type="text" name="port" class="form-control form-install" value="3306"/>
					</div>		
					<div class="form-group col-md-6">
						<input type="submit" class="btn btn-success btn-installation btn-valider"/>
					</div>	
					<?php } 
					elseif($installEtape == 2) { ?>

					<h3>Configuration du site</h3>
					<div class="form-group col-md-6">
						<label>Adresse d'accès au site</label>
						<input type="text" name="adresse" class="form-control form-install" placeholder="Exemple: http://monsite.fr"/>
					</div>
					<div class="form-group col-md-6">
						<label>Nom du Site/Serveur</label>
						<input type="text" name="nom" class="form-control form-install" placeholder="Exemple: CraftMyStory"/>
					</div>
					<div class="form-group col-md-6">
						<label>Une petite description</label>
						<input type="text" name="description" class="form-control form-install" placeholder="Exemple: CraftMyStory est un serveur full vanilla survival."/>
					</div>		
					<div class="form-group col-md-6">
						<input type="submit" class="btn btn-success btn-installation btn-valider"/>
					</div>	

					<?php } 

					elseif($installEtape == 3) { ?>

					<h3>Création d'un compte admin</h3>
					<div class="form-group col-md-6">
						<label>Nom d'utilisateur <small>(Votre pseudo in-game)</small></label>
						<input type="text" name="pseudo" class="form-control form-install" placeholder="Exemple: CraftMyWebsite"/>
					</div>
					<div class="form-group col-md-6">
						<label>Adresse Email</label>
						<input type="email" name="email" class="form-control form-install" placeholder="Exemple: contact@craftmywebsite.fr">
					</div>
					<div class="form-group col-md-6">
						<label>Mot de passe</label>
						<input type="password" name="mdp" class="form-control form-install" placeholder="Exemple: ttcpgm18000"/>
					</div>		
					<div class="form-group col-md-6">
						<input type="submit" class="btn btn-success btn-installation btn-valider"/>
					</div>	

					<?php } 
					elseif($_Serveur_['installation'])
						{ ?>
					<? 
					// Bout de code qui envoi le lien du site a l'installation pour les statistiques CraftMyWebsite
					$URLINSTALL = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; 
					$SENDINSTALL = file_get_contents('http://craftmywebsite.fr/information/checksiteinstall.php?site='. $URLINSTALL .'');
					?>
					<h4 style="font-family: material;text-align: center;margin-top: 30px;">
						L'installation de CraftMyWebsite est maintenant terminée.<br/>
						Vous pouvez aller sur votre site en cliquant ici: <a href="../">Aller voir mon site</a>
					</h4>
					<?php } ?>
				</div>

			</form>
		</div>
		<div class="footer">
			Copyright © <a href="http://craftmywebsite.fr">CraftMyWebsite</a> 2014-2016
		</div>
	</div>
	<script src="../theme/<?php echo $_Serveur_['General']['theme']; ?>/js/jquery.js"></script>
	<script src="../theme/<?php echo $_Serveur_['General']['theme']; ?>/js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>
<?php
function verifyPDO($hote, $nomBase, $utilisateur, $mdp, $port)
{
	try
	{
		$sql = new PDO('mysql:host='.$hote.';dbname='.$nomBase.';port='.$port, $utilisateur, $mdp);
		$sql->exec("SET CHARACTER SET utf8");
		return true;
	}
	catch(Exception $e)
	{
		return false;
	}
}


function getPDO($hote, $nomBase, $utilisateur, $mdp, $port)
{
	try
	{
		$sql = new PDO('mysql:host='.$hote.';dbname='.$nomBase.';port='.$port, $utilisateur, $mdp);
		$sql->exec("SET CHARACTER SET utf8");
		return $sql;
	}
	catch(Exception $e)
	{
	}
}
?>