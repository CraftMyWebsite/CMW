<?php
if(Permission::getInstance()->verifPerm("connect") && isset($_POST['i']) && isset($_POST['message']) && (!isset($_SESSION['chat']) OR $_SESSION['chat'] < time()))
{
	$_SESSION['chat'] = time()+1;
	if(Permission::getInstance()->verifPerm('PermsDefault', 'chat', 'color'))
		$message = str_replace('&', '§', $_POST['message']);
	else
		$message = str_replace('§', '', $_POST['message']);
	$message = htmlspecialchars($message);
	if(strlen($message) <= 100 && strlen($message) > 1)
	{
		$i = htmlentities($_POST['i']);
		$Chat = new Chat($jsonCon);
		if($Chat->sendMessageChat($message, $i, $_Joueur_['pseudo']) == true)
			header('Location: index.php?page=chat&success');
		else
			header('Location: index.php?page=chat&erreur');
	}
	else
	{
		header('Location: index.php?page=erreur&erreur=19&type='.urlencode("Erreur Chat")."&titre=".urlencode("Erreur Message")."&contenue=".urlencode("Message trop long ou trop court :/"));
	}
}
else
	header('Location: index.php?page=erreur&erreur=16');
?>