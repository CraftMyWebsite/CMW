<?php
require_once('modele/joueur/maj.class.php');
$maj = new Maj($_Joueur_['pseudo'], $bddConnection);
require('modele/app/ckeditor.class.php');
$signature = ckeditor::verif($_POST['signature']);
$maj->setNouvellesDonneesSignature($signature);
header('Location: index.php?page=profil&profil=' . $_Joueur_['pseudo'] . '&status=13');
?>