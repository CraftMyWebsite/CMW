<?php
require_once('modele/joueur/maj.class.php');
$maj = new Maj($_Joueur_['pseudo'], $bddConnection);
if(isset($_POST['visibility'])) {
    $maj->setMailVisibility(1);
    header('Location: profil/' . $_Joueur_['pseudo'] . '/10');
} else {
    $maj->setMailVisibility(0);
    header('Location: profil/' . $_Joueur_['pseudo'] . '/11');
}
?>