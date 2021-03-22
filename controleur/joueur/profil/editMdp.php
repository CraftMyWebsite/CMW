<?php
require_once('modele/joueur/maj.class.php');
$maj = new Maj($_Joueur_['id'], $bddConnection);
$maj = $maj->getReponseConnection();
$maj = $maj->fetch(PDO::FETCH_ASSOC);

if(password_verify($_POST['mdpAncien'], $maj['mdp']) && $_POST['mdpNouveau'] == $_POST['mdpConfirme'] ) {
    $maj->setNouvellesDonneesMdp($_POST['mdpNouveau']);
    header('Location: profil/' . $_Joueur_['pseudo'] . '/1');
} else {
    header('Location: profil/' . $_Joueur_['pseudo'] . '/0');
}
?>