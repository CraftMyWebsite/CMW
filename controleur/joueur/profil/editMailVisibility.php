<?php
require_once('modele/joueur/maj.class.php');
$maj = new Maj($_Joueur_['pseudo'], $bddConnection);
if(isset($_POST['visibility'])) {
    $maj->setMailVisibility(1);
    header('Location: index.php?page=profil&profil=' . $_Joueur_['pseudo'] . '&status=10');
} else {
    $maj->setMailVisibility(0);
    header('Location: index.php?page=profil&profil=' . $_Joueur_['pseudo'] . '&status=11');
}
?>