<?php
if(isset($_Joueur_) && $_Joueur_['rang'] == 1)
{
	if(isset($_POST['pseudo']) OR isset($_POST['ip']))
	{
		$pseudo = htmlspecialchars($_POST['pseudo']);
		$ip = htmlspecialchars($_POST['ip']);
		$req = $bddConnection->prepare('INSERT INTO cmw_ban (pseudo, ip) VALUES (:pseudo, :ip)');
		$req->execute(array(
			'pseudo' => $pseudo,
			'ip' => $ip
		));
	}
}

?>