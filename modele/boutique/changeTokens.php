<?php
$oldValues = $bddConnection->prepare('SELECT tokens FROM cmw_users WHERE pseudo = :pseudo');
$oldValues->execute( array (
	'pseudo' => $_Joueur_['pseudo'] ));
$oldTokens = $oldValues->fetch();
$update = $bddConnection->prepare('UPDATE cmw_users set tokens = :tokens WHERE pseudo = :pseudo');
$update->execute( array (
	'tokens' => $oldTokens['tokens'] - $offresByGet[$_GET['offre']]['prix'],
	'pseudo' => $_Joueur_['pseudo'] ));

$_Joueur_['tokens'] = $_Joueur_['tokens'] - $offresByGet[$_GET['offre']]['prix'];
$_SESSION['Player']['tokens'] = $_Joueur_['tokens'];
?>
