<?php
if(isset($_Joueur_, $_POST['page']))
{
	$page = intval($_POST['page']);
	$Messagerie = new Messagerie($bddConnection, $_Joueur_['pseudo']);
	$messages = $Messagerie->getConversations($page);
	echo $messages['conv'];
}
else
	echo '<h1>Erreur !</h1>';