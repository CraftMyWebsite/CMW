<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'forum', 'actions', 'addPrefix'))
{
	if(isset($_POST['nom'], $_POST['prefix']))
	{
		$nom = htmlspecialchars($_POST['nom']);
		$prefix = htmlspecialchars($_POST['prefix']);
		$req = $bddConnection->prepare('INSERT INTO cmw_forum_prefix (span, nom) VALUES (:span, :nom)');
		$req->execute(array('span' => 'prefix '.$prefix, 'nom' => $nom));
	}
}