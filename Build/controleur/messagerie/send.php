<?php
if(isset($_POST['destinataire'], $_POST['message'], $_Joueur_))
{
	$Messagerie = new Messagerie($bddConnection, $_Joueur_['pseudo']);
	$destinataire = htmlspecialchars($_POST['destinataire']);

	require('modele/app/ckeditor.class.php');
	$message = ckeditor::verif($_POST['message']);
	if($Messagerie->sendMessage($destinataire, $message))
		header('Location: ?page=messagerie&send=true');
	else
		header('Location: ?page=erreur&erreur=19&type='.urlencode("Messagerie").'&titre='.urlencode("Joueur inexistant").'&contenue='.urlencode("Le joueur rentré n'existe pas ! :("));
}

?>