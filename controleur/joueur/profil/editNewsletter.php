<?php
require_once('modele/joueur/maj.class.php');
$maj = new Maj($_Joueur_['id'], $bddConnection);
if(isset($_POST['newsletter'])) {
    $maj->setNewsletter(1);
    header('Location: profil/' . $_Joueur_['pseudo'] . '/8');
} else {
    $maj->setNewsletter(0);
    header('Location: profil/' . $_Joueur_['pseudo'] . '/9');
}
?>