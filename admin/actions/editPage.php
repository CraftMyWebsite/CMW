<?php
if($_Permission_->verifPerm('PermsPanel', 'pages', 'actions', 'editPage')) {
	
    require('modele/app/page.class.php');
    require('modele/app/ckeditor.class.php');
    
    $_POST['titre'] = htmlspecialchars($_POST['titre']);
    $_POST['oldtitre'] = htmlspecialchars($_POST['oldtitre']);
    $_POST['content'] = ckeditor::verif($_POST['content'], true);
    $page = new page();
    
    if($_POST['oldtitre'] != $_POST['titre']) {
        if($page->exist($_POST['oldtitre'])) {
            if(!$page->changeName($_POST['oldtitre'],$_POST['titre'])) {
                print(json_encode(array('retour' => 'erreur', 'message' => 'Erreur interne')));
                exit();
            }else {
                $page = new $page();
            }
        } else {
            print(json_encode(array('retour' => 'erreur', 'message' => 'Page inéxistante')));
            exit();
        }
    }
    if($page->exist($_POST['titre'])) {
        $page->print($_POST['titre'], $_POST['content']);
        print(json_encode(array('retour' => 'OK', 'message' => '')));
    } else {
        print(json_encode(array('retour' => 'erreur', 'message' => 'Page déjà éxistante')));
    }
} else {
    print(json_encode(array('retour' => 'erreur', 'message' => 'Permission insuffisante')));
}
?>