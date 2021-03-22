<?php 
require('modele/joueur/donneesJoueur.class.php');
$joueurDonnees = new JoueurDonnees($bddConnection, $_Joueur_['pseudo']);
$joueurDonnees = $joueurDonnees->getTableauDonnees($listeReseaux);

$changementsReseaux = array();
foreach($listeReseaux as $value)
{
	if(!empty($_POST[$value['nom']]))
	{
		$temp = htmlspecialchars($_POST[$value['nom']]);
		$changementsReseaux += [ $value['nom'] => $temp ];
	}
}

require_once('modele/joueur/maj.class.php');
$maj = new Maj($_Joueur_['id'], $bddConnection);
if(!empty($changementsReseaux))
{
    $maj->setNouvellesDonneesReseaux($changementsReseaux, $_Joueur_['id']);
}
header('Location: profil/' . $_Joueur_['pseudo'] . '/12');
?>