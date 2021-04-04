<?php 
require_once('modele/joueur/maj.class.php');
$maj = new Maj($_Joueur_['pseudo'], $bddConnection);
$maj2 = $maj->getReponseConnection();
$maj2 = $maj2->fetch(PDO::FETCH_ASSOC);

if(password_verify($_POST['mdp'], $maj2['mdp'])) {
    $maj->setNouvellesDonneesEmail(htmlspecialchars($_POST['email']));
    header('Location: profil/' . $_Joueur_['pseudo'] . '/7');
} else {
    header('Location: profil/' . $_Joueur_['pseudo'] . '/2');
}

?>