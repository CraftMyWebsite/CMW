<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['stats']['members']['editLimitIp'] == true) {
	$req = $bddConnection->prepare('UPDATE cmw_sysip SET nbrPerIP = :nbrPerIP WHERE id = :id');
	$req->execute(array(
		'nbrPerIP' => $_POST['nbrPerIP'],
		'id' => $_GET['idPerIP'],
		));
}
?>