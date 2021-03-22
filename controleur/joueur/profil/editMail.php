<?php 
require_once('modele/joueur/maj.class.php');
$maj = new Maj($_Joueur_['id'], $bddConnection);
$maj = $maj->getReponseConnection();
$maj = $maj->fetch(PDO::FETCH_ASSOC);

if(password_verify($_POST['mdp'], $maj['mdp'])) {
    $maj->setNouvellesDonneesEmail(htmlspecialchars($_POST['email']));
    header('Location: profil/' . $_Joueur_['pseudo'] . '/7');
} else {
    header('Location: profil/' . $_Joueur_['pseudo'] . '/0');
}

?>