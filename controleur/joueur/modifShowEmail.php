<?php
if(isset($_Joueur_, $_GET['actuel']))
{
	if($_GET['actuel'] == 0)
		$show = 1;
	else
		$show = 0;
	$req = $bddConnection->prepare('UPDATE cmw_users SET show_email = :show WHERE id = :id');
	$req->execute(array(
		'show' => $show,
		'id' => $_Joueur_['id']
	));
	header('Location: ?page=profil&profil='.$_Joueur_['pseudo'].'&success=true');
}