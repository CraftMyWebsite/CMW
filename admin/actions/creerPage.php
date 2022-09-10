<?php
if($_Permission_->verifPerm('PermsPanel', 'pages', 'actions', 'addPage')) {
	require('modele/app/page.class.php');
	require('modele/app/ckeditor.class.php');
	
	$_POST['titre'] = htmlspecialchars($_POST['titre']);
	$_POST['content'] = ckeditor::verif($_POST['content'], true);
	$page = new page();
	
	if(!$page->exist($_POST['titre'])) {
	    $page->print($_POST['titre'], $_POST['content']);
	    print(json_encode(array('retour' => 'OK', 'message' => '')));
	} else {
	    print(json_encode(array('retour' => 'erreur', 'message' => 'Page déjà éxistante')));
	}
} else {
    print(json_encode(array('retour' => 'erreur', 'message' => 'Permission insuffisante')));
}
?>