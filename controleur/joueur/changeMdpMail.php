<?php

if(isset($_POST['email']) AND !empty($_POST['email']))
{
	
	$bddConnection = $base->getConnection();
	require_once('modele/joueur/mail.class.php');
	$userConnection = new Mail($_POST['email'], $bddConnection);
	$ligneReponse = $userConnection->getReponseConnection();
	
	$donneesJoueur = $ligneReponse->fetch(PDO::FETCH_ASSOC);
	if(empty($donneesJoueur))
	{
		//email mining
		//header('Location: index.php?page=erreur&erreur=4');
		header('Location: index.php?page=accueil&envoieMail');
	}
	else
	{
		if($donneesJoueur['email'] == $_POST['email'])
		{ 

			$resetToken = md5(microtime(TRUE)*100000);
			
			require_once('modele/joueur/maj.class.php');
			$maj = new Maj($donneesJoueur['pseudo'], $bddConnection);
			$maj->setNouvellesDonneesResetToken($resetToken);

			$url = $_SERVER['SERVER_NAME'];
	    	$ht = $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://';
			
			$lien = $ht.$url.'/index.php?&action=passRecoverConfirm&token='.urlencode($resetToken);

			$retourligne = "\r\n";

            $to = $donneesJoueur['email'];
            $subject = '[' .$_Serveur_['General']['name']. ']Recuperation de mot de passe';
            $txt = 'Bonjour, '.$donneesJoueur['pseudo'].$retourligne
                    .$retourligne
                    .'Suite à une demande de récupération de mail, vous recevez ce message.'.$retourligne
                    .'Voici votre lien de récupération : '.$lien.$retourligne
                    .$retourligne
					.'Si vous n\'avez pas fait de demande de récupération veuillez ignorer cet e-mail...'.$retourligne
					.'Adresse IP de l\'envoyeur de la demande : '.$_SERVER['REMOTE_ADDR'].$retourligne
                    .'Il est inutile de répondre à ce mail automatique.'.$retourligne
                    .$retourligne
                    .'Cordialement, '.$_Serveur_['General']['name'].'.';

			require('include/phpmailer/MailSender.php');
			if(MailSender::send($_Serveur_, $to, $subject, $txt))
			{
				header('Location: index.php?page=accueil&envoieMail');
			} 
			//else {
			//	header('Location: index.php?page=erreur&erreur=21');
			//}
		}
		//else header('Location: index.php?page=erreur&erreur=4');
	}
}
else
{
	header('Location: index.php?page=erreur&erreur=4');
}       
?>