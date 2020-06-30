<?php

if(Permission::getInstance()->verifPerm('PermsPanel', 'postit', 'actions', 'addPostIt')) {
	
	$req = $bddConnection->prepare('INSERT INTO cmw_postit(auteur, message) VALUES (?, ?)');
	$req->execute(array(
        $_Joueur_['pseudo'],
        $_POST['message'] ));
}

?>