<?php
if(isset($_Joueur_) && $_Joueur_['rang'] == 1)
{
	if(isset($_POST['titre'], $_POST['texte']))
	{
		$req = $bddConnection->prepare('UPDATE cmw_ban_config SET titre = :titre, texte = :texte WHERE id = 1');
		$req->execute(array(
			'titre' => htmlspecialchars($_POST['titre']),
			'texte' => htmlspecialchars($_POST['texte'])
		));
	}
}