<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['pages']['actions']['editPage'] == true) {
	$req = $bddConnection->prepare('DELETE FROM cmw_pages WHERE id = :id');
	$req->execute(array('id' => $_GET['id']));
}
?>