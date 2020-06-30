<?php


$token = urldecode($_GET['token']);

require_once('modele/joueur/checkToken.class.php');
$tokenInfos = new checkToken($token, $bddConnection);
$ligneReponse = $tokenInfos->getReponseConnection();

$donneesJoueur = $ligneReponse->fetch(PDO::FETCH_ASSOC);
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
            
    $mdp = uniqid();
    
    $mdp = genMdp();

	
    $chMdp = new Maj($donneesJoueur['pseudo'], $bddConnection);  
	$chMdp->setNouvellesDonneesMdp(password_hash($mdp, PASSWORD_DEFAULT));
	
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

	require('include/phpmailer/MailSender.php');
	if(MailSender::send($_Serveur_, $to, $subject, $txt))
	{
		header('Location : index.php?setTemp=1');
	} else {
		header('Location: ?&page=erreur&erreur=21');
	}
}

function genMdp(){
	$caracAllows = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return substr(str_shuffle($caracAllows), 0, 7);
}  
?>