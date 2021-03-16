<?php
if($_Permission_->verifPerm('PermsPanel', 'pages', 'actions', 'editPage')) {
	
    require("modele/app/page.class.php");
    
    $page = new page();
    $_GET['name'] = urldecode($_GET['name']);
    
    if($page->exist($_GET['name'])) {
        if($page->removePage($_GET['name'])) {
            print(json_encode(array("retour" => "OK", "message" => "")));
        } else {
            print(json_encode(array("retour" => "erreur", "message" => "Erreur interne")));
        }
    } else {
        print(json_encode(array("retour" => "erreur", "message" => "Page inéxistante")));
        exit();
    }

} else {
    print(json_encode(array("retour" => "erreur", "message" => "Permission insuffisante")));
}
?>