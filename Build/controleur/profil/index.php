<?php

include('controleur/profil/serveur.php');

include('modele/joueur/donneesJoueur.class.php');

$joueurDonnees = new JoueurDonnees($bddConnection, $_GET['profil']);
$joueurDonnees = $joueurDonnees->getTableauDonnees($listeReseaux);

if(empty($joueurDonnees['email']))
{
	header('Location: ?page=erreur&erreur=19&type=Profil&titre='.htmlspecialchars("Utilisateur inexistant !").'&contenue='.htmlspecialchars("L'utilisateur recherché est inexistant ou n'est pas connue de nos bases de données ! :("));
}
if(empty($joueurDonnees['age']))
	$joueurDonnees['age'] = '??';
if(empty($joueurDonnees['tokens']))
	$joueurDonnees['tokens'] = '0';



if($joueurDonnees['rang'] == 0) {
	$gradeSite = $_Serveur_['General']['joueur'];
} elseif($joueurDonnees['rang'] == 1) {
	$gradeSite = "<span class='prefix ".$_Serveur_['General']['createur']['effets']." ".$_Serveur_['General']['createur']['prefix']."'>".$_Serveur_['General']['createur']['nom']."</span>";
} elseif(fopen('./modele/grades/'.$joueurDonnees['rang'].'.yml', 'r')) {
	$openGradeSite = new Lire('./modele/grades/'.$joueurDonnees['rang'].'.yml');
	$readGradeSite = $openGradeSite->GetTableau();
	$gradeSite = "<span class='prefix ".$readGradeSite['prefix']." ". $readGradeSite['effets']. "'>".$readGradeSite['Grade']."</span>";
	if(empty($readGradeSite['Grade']))
		$gradeSite = $_Serveur_['General']['joueur'];
} else {
	$gradeSite = $_Serveur_['General']['joueur'];
}

include('theme/' .$_Serveur_['General']['theme']. '/pages/profil.php');
?>