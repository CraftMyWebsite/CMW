<?php // On appelle les classes du controleur qui instancies les objets principaux (BDD, config, JSONAPI...).
ob_start();
error_reporting(0);
require_once ('controleur/config.php');
// On vérifie si le CMS n'a pas été installé, si il ne l'est pas, on redirige vers les fichiers d'installation...
if (!$_Serveur_['installation']) header('Location: installation/');
else $return = true;
// On charge la connection à la base MySQL via l'extention PDO.
require_once ('controleur/connection_base.php');
// On démarre les sessions sur la page pour récupérer les variables globales(les données du joueur...).
session_start();
/* Si l'utilisateur est connecté, on met ses informations dans un tableau global, qui sera utilisable que
 le laps de temps du chargement de la page contrairement aux sessions. */
if (isset($_SESSION['Player']['pseudo'])) {
    /* On instancie un joueur, et on récupère le tableau de données. $_Joueur_ sera donc utilisable
     sur toutes les pages grâce au système de GET sur l'index.*/
    require_once ('controleur/joueur/joueur.class.php');
    $globalJoueur = new Joueur();
    // Cette variable contiens toutes les informations du joueur.
    $_Joueur_ = $globalJoueur->getArrayDonneesUtilisateur();
    $connection = true;
} else $connection = false;
require_once ('controleur/json/json.php');
// système de Get(tout le site passe par index.php).
// Les deux types de Get pricipaux utilisés sont les "pages" et les "actions.
// Les actions n'affichent aucun code html alors que les pages sont dans la theme.
// Ici une condition pour vérifier si il faut charger le fichier controleur des actions. Ce fichier effectue l'action qu'il faut en
// faisant appel au bon fichier en fonction de la valeur du get
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
ob_end_flush();