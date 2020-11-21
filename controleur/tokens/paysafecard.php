<?php
if(isset($_POST) && Permission::getInstance()->verifPerm('connect'))
{
	$req = $bddConnection->prepare('INSERT INTO cmw_paysafecard_historique (pseudo, code, offre) VALUES (:pseudo, :code, :offre)');
	$req->execute(array(
		'pseudo' => $_Joueur_['pseudo'],
		'code' => htmlspecialchars($_POST['code']),
		'offre' => htmlspecialchars($_POST['offre'])
	));
	header('Location: ?page=token&notif=2');
}

?>