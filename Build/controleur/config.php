<?php
	// On vérifie si le systeme est compatible.
	$URLWEBSITE = "http://".$_SERVER['HTTP_HOST']; 
	$SYSTEMINFO = file_get_contents('http://craftmywebsite.fr/information/website.php?href='. $URLWEBSITE .'');
	if($SYSTEMINFO == ""){
	} else {
	echo $SYSTEMINFO;
	}
	// On récupère la classe permettant la lecture en YML. Les fichiers de config sont sous ce format.
	require_once('./modele/config/yml.class.php');
	require_once('./modele/ban.class.php');
	require_once('./include/MinecraftPing/MinecraftPing.class.php');

	//Récupération de la classe Permission
	require_once("modele/grades/perms.class.php");
	
	// On lit le fichier de config et on récupère les information dans un tableau. Celui-ci contiens la config générale.
	$configLecture = new Lire('modele/config/config.yml');
	$_Serveur_ = $configLecture->GetTableau();
		
	// On effectue la même opération mais pour le fichier YML du menu.
	$configLecture = new Lire('./modele/config/configMenu.yml');
	$_Menu_ = $configLecture->GetTableau();

	for($i = 0; $i < count($_Menu_['MenuTexte']); $i++)
	{
		$_Menu_['MenuTexteBB'][$i] = $_Menu_['MenuTexte'][$i];
	}

	
	$configLecture = new Lire('modele/config/configWidgets.yml');
	$_Widgets_ = $configLecture->GetTableau();
	
	$configLecture = new Lire('modele/config/accueil.yml');
	$_Accueil_ = $configLecture->GetTableau();

    if($_Serveur_['General']['bgType'] == 0)
        $bgType = 'background: url(\'theme/upload/bg.png\') no-repeat fixed 0% 0% / 100% 100% transparent;';
    else
        $bgType = 'background: url(\'theme/upload/bg.png\') repeat scroll center top rgb(0, 0, 0);';

	
	require_once('controleur/tempMess.class.php');
	
	if(isset($_COOKIE['playeronline'], $_COOKIE['maxPlayers'], $_COOKIE['servOnline']) && $_COOKIE['servOnline'] == true)
	{
		$playeronline = htmlspecialchars($_COOKIE['playeronline']);
		$maxPlayers = htmlspecialchars($_COOKIE['maxPlayers']);
		$servEnLigne = true;
	}
	else
	{
		$pingClass = new MinecraftPing($_Serveur_['General']['ip'], $_Serveur_['General']['port']);
		$playeronline = $pingClass->Players;
		$maxPlayers = $pingClass->MaxPlayer;
		$servEnLigne = $pingClass->Online;
		setcookie('playeronline', $playeronline, time() + 120, null, null, false, true);
		setcookie('maxPlayers', $maxPlayers, time() + 120, null, null, false, true);
		setcookie('servOnline', $servEnLigne, time() + 120, null, null, false, true);
	}

	function gradeJoueur($pseudo, $bdd)
	{
		global $_Serveur_;
		$req = $bdd->prepare('SELECT rang FROM cmw_users WHERE pseudo = :pseudo');
		$req->execute(array('pseudo' => $pseudo ));
		$joueurDonnees = $req->fetch(PDO::FETCH_ASSOC);
		if($joueurDonnees['rang'] == 0) {
			$gradeSite = $_Serveur_['General']['joueur'];
		} elseif($joueurDonnees['rang'] == 1) {
			$gradeSite = "<span class='prefix ".$_Serveur_['General']['createur']['effets']."' style='background-color: ".$_Serveur_['General']['createur']['bg']."; color: ".$_Serveur_['General']['createur']['couleur']."' id='grade'>".$_Serveur_['General']['createur']['nom']."</span>";
		} elseif(fopen('./modele/grades/'.$joueurDonnees['rang'].'.yml', 'r')) {
			$openGradeSite = new Lire('./modele/grades/'.$joueurDonnees['rang'].'.yml');
			$readGradeSite = $openGradeSite->GetTableau();
			$gradeSite = "<span class='prefix ".$readGradeSite['effets']."' style='background-color: ".$readGradeSite['prefix']."; color: ".$readGradeSite['couleur']."' id='grade'>".$readGradeSite['Grade']."</span>";
			if(empty($readGradeSite['Grade']))
				$gradeSite = $_Serveur_['General']['joueur'];
		} else {
			$gradeSite = $_Serveur_['General']['joueur'];
		}
		return $gradeSite;
	}
?>
