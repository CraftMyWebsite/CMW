<?php // On appelle les classes du controleur qui instancies les objets principaux (BDD, config, JSONAPI...).
ob_start();
session_set_cookie_params(0, "/", null, true, true);
session_start();

error_reporting(0);
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, "fr_FR");
ini_set('display_errors', 1);


require("modele/app/urlRewrite.class.php");
urlRewrite::call();

if(!isset($_SESSION["mode"])) $_SESSION["mode"] = false; // pour les admins du forum

if(isset($_GET['removeUpdater'])) { unlink('updater.php'); }
//ini_set('display_errors', 1);
require('controleur/config.php');
// On vérifie si le CMS n'a pas été installé, si il ne l'est pas, on redirige vers les fichiers d'installation...
if (!$_Serveur_['installation']) header('Location: installation/');
else $return = true;
// On charge la connection à la base MySQL via l'extention PDO.
require ('controleur/connection_base.php');

require('modele/app/visit.class.php');
$visit = new visit($bddConnection);


require("modele/google/googleService.class.php");
googleService::initialise($_Serveur_, $bddConnection);

//la class Panier pour la boutique
require('modele/joueur/imgProfil.class.php');
$_ImgProfil_ = new ImgProfil($bddConnection);
require('modele/boutique/panier.class.php');
$_Panier_ = new Panier($bddConnection);
// On démarre les sessions sur la page pour récupérer les variables globales(les données du joueur...).*
/* Si l'utilisateur est connecté, on met ses informations dans un tableau global, qui sera utilisable que
 le laps de temps du chargement de la page contrairement aux sessions. */

require('controleur/joueur/joueur.class.php');
$globalJoueur = new Joueur($bddConnection);
$_Joueur_ = $globalJoueur->getUser();

require('modele/json/json.php');
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
$banned = false;
if(Ban::isBanned($bddConnection) | isset($_GET['banPreview']))
{
    require('theme/'. $_Serveur_['General']['theme'] .'/ban.php');
}
else
{
    if (isset($_GET['action'])) {
        require ('controleur/action.php');
    } elseif (isset($_GET['page']) AND $_GET['page'] == 'maintenance') {
        include ('theme/' . $_Serveur_['General']['theme'] . '/maintenance.php');
    }else
    // On charge l'index uniquement si il n'y a pas d'action, cela permet de choisir la page sur laquelle l'utilisateur sera redirigé après l'action. Sinon, on redirige vers
    {
        // La base de la page, s'occupe du <head> ainsi que de l'organisation des élements et chargement du javascript --> La theme.
        include ('theme/' . $_Serveur_['General']['theme'] . '/index.php');
        require('controleur/joueur/changerGrade.php');
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
