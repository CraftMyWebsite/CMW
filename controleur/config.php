<?php
// On vérifie si le systeme est compatible.


// On récupère la classe permettant la lecture en YML. Les fichiers de config sont sous ce format.
require_once('./modele/config/yml.class.php');
require_once('./modele/ban.class.php');
require_once('./include/MinecraftPing/MinecraftPing.class.php');

//Récupération de la classe Permission
require_once('modele/grades/perms.class.php');

// On lit le fichier de config et on récupère les information dans un tableau. Celui-ci contiens la config générale.
$configLecture = new Lire('modele/config/config.yml');
$_Serveur_ = $configLecture->GetTableau();



$configLecture = new Lire('modele/config/configWidgets.yml');
$_Widgets_ = $configLecture->GetTableau();

require_once('controleur/tempMess.class.php');

if(isset($_COOKIE['playeronline'], $_COOKIE['maxPlayers'], $_COOKIE['servOnline']) && $_COOKIE['servOnline'])
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
    setcookie('playeronline', $playeronline, time() + 120, '', '', true, true);
    setcookie('maxPlayers', $maxPlayers, time() + 120, '', '', true, true);
    setcookie('servOnline', $servEnLigne, time() + 120, '', '', true, true);
}

