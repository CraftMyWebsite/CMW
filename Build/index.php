<?php // On appelle les classes du controleur qui instancies les objets principaux (BDD, config, JSONAPI...).
ob_start();
session_start();
error_reporting(0);
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");
ini_set('display_errors', 1);
if(!isset($_SESSION["mode"])) $_SESSION["mode"] = false; // pour les admins du forum
//ini_set('display_errors', 1);
require_once ('controleur/config.php');
// On vérifie si le CMS n'a pas été installé, si il ne l'est pas, on redirige vers les fichiers d'installation...
if (!$_Serveur_['installation']) header('Location: installation/');
else $return = true;
// On charge la connection à la base MySQL via l'extention PDO.
require_once ('controleur/connection_base.php');
//Les fonctions de mises en pages 
require('modele/forum/miseEnPage.php'); 
//la class Panier pour la boutique
require('modele/joueur/imgProfil.class.php');
$_ImgProfil_ = new ImgProfil($bddConnection);
require('modele/boutique/panier.class.php');
$_Panier_ = new Panier($bddConnection);
// On démarre les sessions sur la page pour récupérer les variables globales(les données du joueur...).*
/* Si l'utilisateur est connecté, on met ses informations dans un tableau global, qui sera utilisable que
 le laps de temps du chargement de la page contrairement aux sessions. */
if ((isset($_SESSION['Player']['pseudo']) AND !empty($_SESSION['Player']['pseudo'])) OR isset($_COOKIE['id'], $_COOKIE['pass'])) {
    /* On instancie un joueur, et on récupère le tableau de données. $_Joueur_ sera donc utilisable
     sur toutes les pages grâce au système de GET sur l'index.*/
	if(!isset($_SESSION['Player']['pseudo']))
		require_once('controleur/joueur/connexion_cookie.php');
    else
        $suite = true;
    if($suite == true)
    {	
        require_once ('controleur/joueur/joueur.class.php');
        $globalJoueur = new Joueur();
        if(isset($_SESSION['Player']['temp']) && $_SESSION['Player']['temp'] < time()+60)
            $globalJoueur->updateArrayDonneesUtilisateur($bddConnection);
        // Cette variable contiens toutes les informations du joueur.
        $_Joueur_ = $globalJoueur->getArrayDonneesUtilisateur();
        $connection = true;
    }
    else
        $connection = false;
}  else $connection = false;
require_once ('modele/json/json.php');
//le fichier controle des récompenses Auto
require('controleur/recompenseAuto.php');
// système de Get(tout le site passe par index.php).
// Les deux types de Get pricipaux utilisés sont les "pages" et les "actions.
// Les actions n'affichent aucun code html alors que les pages sont dans la theme.
// Ici une condition pour vérifier si il faut charger le fichier controleur des actions. Ce fichier effectue l'action qu'il faut en
// faisant appel au bon fichier en fonction de la valeur du get
if(!isset($_Serveur_['General']['createur']))
{
    $tmp = $_Serveur_;
    $tmp['General']['createur'] = 'Créateur';
    $ecriture = new Ecrire('modele/config/config.yml', $tmp);
}
if(Ban::isBanned($bddConnection))
{
    require_once('theme/'. $_Serveur_['General']['theme'] .'/ban.php');
}
else
{
    if (isset($_GET['action'])) {
        require_once ('controleur/action.php');
    } elseif (isset($_GET['redirection']) AND $_GET['redirection'] == 'maintenance') {
        include ('theme/' . $_Serveur_['General']['theme'] . '/maintenance.php');
    }else
    // On charge l'index uniquement si il n'y a pas d'action, cela permet de choisir la page sur laquelle l'utilisateur sera redirigé après l'action. Sinon, on redirige vers
    {
        // La base de la page, s'occupe du <head> ainsi que de l'organisation des élements et chargement du javascript --> La theme.
        include ('theme/' . $_Serveur_['General']['theme'] . '/index.php');
        require_once ('controleur/joueur/changerGrade.php');
    }
}
if(isset($jsonCon))
{
    foreach($jsonCon as $instance)
    {
        $instance->close();
    }
}
ob_end_flush();