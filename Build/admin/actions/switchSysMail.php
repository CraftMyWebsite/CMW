<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['info']['stats']['members']['editEmail'] == true) {
	$req = $bddConnection->prepare('UPDATE cmw_sysmail SET etatMail = :etatMail WHERE idMail = :idMail');
	$req->execute(array(
		'etatMail' => $_POST['etatMail'],
		'idMail' => $_GET['idMail'],
		));
}
?>