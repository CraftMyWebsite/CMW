<?php
	// On vérifie si le systeme est compatible.


	// On récupère la classe permettant la lecture en YML. Les fichiers de config sont sous ce format.
	require_once('./modele/config/yml.class.php');
	require_once('./modele/ban.class.php');
	require_once('./include/MinecraftPing/MinecraftPing.class.php');

	//Récupération de la classe Permission
	require_once("modele/grades/perms.class.php");
	
	// On lit le fichier de config et on récupère les information dans un tableau. Celui-ci contiens la config générale.
	$configLecture = new Lire('modele/config/config.yml');
	$_Serveur_ = $configLecture->GetTableau();
		

	if(!isset($_Serveur_['lastCMWCheck']) || (isset($_Serveur_['lastCMWCheck']) && $_Serveur_['lastCMWCheck'] < time())) {
		$_Serveur_['lastCMWCheck'] = time() + 3600;
		$URLWEBSITE = "http://".$_SERVER['HTTP_HOST']; 
		$SYSTEMINFO = "";
		if (function_exists('curl_init') and extension_loaded('curl')) {    
            $ch = curl_init();  

            curl_setopt($ch, CURLOPT_URL,'https://craftmywebsite.fr/information/website.php?href='. $URLWEBSITE);    
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);    
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);   

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);    

            $output = curl_exec($ch);   
            curl_close($ch);    

            $SYSTEMINFO = $output; 
        } else {    
            $SYSTEMINFO = @file_get_contents('https://craftmywebsite.fr/information/website.php?href='. $URLWEBSITE);    
        }   
        if($SYSTEMINFO != "") {
        	$_Serveur_['SYSTEMINFO'] = $SYSTEMINFO;
        } else if(isset($_Serveur_['SYSTEMINFO'])) {
        	unset($_Serveur_['SYSTEMINFO']);
        }
        $ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);
	}
	
	$configLecture = new Lire('modele/config/configWidgets.yml');
	$_Widgets_ = $configLecture->GetTableau();

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


?>
