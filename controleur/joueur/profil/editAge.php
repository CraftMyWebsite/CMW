<?php
require_once('modele/joueur/maj.class.php');
$maj = new Maj($_Joueur_['pseudo'], $bddConnection);
$age = intval($_POST['age']);
$maj->setNouvellesDonneesAge($age);
header('Location: index.php?page=profil&profil=' . $_Joueur_['pseudo'] . '&status=14');
?>