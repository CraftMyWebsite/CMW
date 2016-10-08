<?php
if(isset($_POST['email']) AND !empty($_POST['email']))
{
	
	$bddConnection = $base->getConnection();
	require_once('modele/joueur/mail.class.php');
	$userConnection = new Mail($_POST['email'], $bddConnection);
	$ligneReponse = $userConnection->getReponseConnection();
	
	$donneesJoueur = $ligneReponse->fetch();
	if(empty($donneesJoueur))
	{
		header('Location: ?&page=erreur&erreur=4');
	}
	else
	{
		if($donneesJoueur['email'] == $_POST['email'])
		{ 

			$resetToken = md5(microtime(TRUE)*100000);
			
			require_once('modele/joueur/maj.class.php');
			$maj = new Maj($donneesJoueur['pseudo'], $bddConnection);
			$maj->setNouvellesDonneesResetToken($resetToken);
			
			$lien = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"].'?&action=passRecoverConfirm&token='.urlencode($resetToken);

			$retourligne = "\r\n";
			
            $to = $donneesJoueur['email'];
            $subject = "[".$_Serveur_['General']['name']."]Recuperation de mot de passe";
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
            mail($to,$subject,$txt);

			setTempMess("<script> $( document ).ready(function() { Snarl.addNotification({ title: '', text: 'Un mail de récupération a bien été envoyé !', icon: '<span class=\'glyphicon glyphicon-ok\'></span>});});</script>");
			header('Location: index.php');
		}
		else header('Location: ?&page=erreur&erreur=4');
	}
}
else
{
	header('Location: ?&page=erreur&erreur=4');
}       
?>
