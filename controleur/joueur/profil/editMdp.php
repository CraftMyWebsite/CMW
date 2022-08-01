<?php
require_once('modele/joueur/maj.class.php');
$maj = new Maj($_Joueur_['pseudo'], $bddConnection);
$maj2 = $maj->getReponseConnection();
$maj2 = $maj2->fetch(PDO::FETCH_ASSOC);

if (password_verify($_POST['mdpAncien'], $maj2['mdp']) && $_POST['mdpNouveau'] == $_POST['mdpConfirme']) {
    $maj->setNouvellesDonneesMdp(password_hash($_POST['mdpNouveau'], PASSWORD_DEFAULT));
    header('Location: index.php?page=profil&profil=' . $_Joueur_['pseudo'] . '&status=1');
} else {
    header('Location: index.php?page=profil&profil=' . $_Joueur_['pseudo'] . '&status=0');
}
?>