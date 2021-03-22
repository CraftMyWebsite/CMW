<?php 
require_once('modele/joueur/maj.class.php');
$maj = new Maj($_Joueur_['id'], $bddConnection);
$age = intval($_POST['age']);
$maj->setNouvellesDonneesAge($age);
header('Location: profil/' . $_Joueur_['pseudo'] . '/14');
?>