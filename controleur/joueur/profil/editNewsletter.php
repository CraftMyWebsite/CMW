<?php
require_once('modele/joueur/maj.class.php');
$maj = new Maj($_Joueur_['pseudo'], $bddConnection);
if(isset($_POST['newsletter'])) {
    $maj->setNewsletter(1);
    header('Location: index.php?page=profil&profil=' . $_Joueur_['pseudo'] . '&status=8');
} else {
    $maj->setNewsletter(0);
    header('Location: index.php?page=profil&profil=' . $_Joueur_['pseudo'] . '&status=9');
}
?>