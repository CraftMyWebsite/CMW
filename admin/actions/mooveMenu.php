<?php if($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'editLinkMenu')) { 
    
    require("modele/menu.class.php");
    $Menu = new menu($bddConnection);
    
    if($_GET['type'] == "0") {
        $Menu->downMenu(intval($_GET['id']));
    } else if($_GET['type'] == "1") {
        $Menu->upMenu(intval($_GET['id']));
    }
    
}