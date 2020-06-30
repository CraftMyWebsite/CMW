<?php
$titre = htmlspecialchars($_POST['titre']);
$message = htmlspecialchars($_POST['message']);
$ticketDisplay = htmlspecialchars((int)$_POST['ticketDisplay']);
require_once('modele/support/post.class.php');
if($_Serveur_['support']['visibilite'] != 'both')
{
	if(($_Serveur_['support']['visibilite'] == "prive" && $ticketDisplay != 1) OR ($_Serveur_['support']['visibilite'] == "public" && $ticketDisplay != 0))
		header('Location: ?page=erreur&erreur=17');
	else
	{
		$post = new PostTicket($bddConnection);
		$post->AddTicket($titre, $message, $_Joueur_['pseudo'], $ticketDisplay);
	}
}
else
{
	$post = new PostTicket($bddConnection);
	$post->AddTicket($titre, $message, $_Joueur_['pseudo'], $ticketDisplay);
}
?>