<?php
$token = urldecode($_GET['token']);

require_once('modele/joueur/checkToken.class.php');
$tokenInfos = new checkToken($token, $bddConnection);
$ligneReponse = $tokenInfos->getReponseConnection();

$donneesJoueur = $ligneReponse->fetch();
if(empty($donneesJoueur))
{
	//Quand le token est un faux les donneesJoueur sont vides car il n'y a aucune entrée correspondante dans la BDD
	header('Location: ?&page=erreur&erreur=9');
}
else
{	
	require_once('modele/joueur/maj.class.php');
	$ChToken = new Maj($donneesJoueur['pseudo'], $bddConnection);  
	$ChToken->setNouvellesDonneesResetToken(null);
	
	function genMdp(){
		$caracAllows = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        return substr(str_shuffle($caracAllows), 0, 7);
    }   
            
    $mdp = uniqid();
    
    $mdp = genMdp();
	
    $chMdp = new Maj($donneesJoueur['pseudo'], $bddConnection);  
	$chMdp->setNouvellesDonneesMdp(md5(sha1($mdp)));
	
	$retourligne = "\r\n";
	
	$to = $donneesJoueur['email'];
	$subject = "[".$_Serveur_['General']['name']."]Confirmation : Recuperation de mot de passe";
	$txt = 'Bonjour, '.$donneesJoueur['pseudo'].$retourligne
			.$retourligne
			.'Vous avez bien confirmé votre demande de changement de mot de passe.'.$retourligne
			.'Voici votre nouveau mot de passe : '.$mdp.$retourligne
			.$retourligne
			.'Merci de changer votre mot de passe pour cela rendez-vous sur votre profil.'.$retourligne
			.'Il est inutile de répondre à ce mail automatique.'.$retourligne
			.$retourligne
			.'Cordialement, '.$_Serveur_['General']['name'].'.';
	mail($to,$subject,$txt);

	setTempMess("<script> $( document ).ready(function() { Snarl.addNotification({ title: '', text: 'Votre nouveau mot de passe vous a été envoyé par mail !', icon: '<span class=\'glyphicon glyphicon-ok\'></span>});});</script>");
	header('Location : index.php');	
}

?>