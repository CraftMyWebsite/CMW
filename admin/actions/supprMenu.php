<?php if ($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'editLinkMenu')) {

    require('modele/menu.class.php');
    $menu = new menu($bddConnection);
    $menu->supprMenu(intval($_GET['id']));
}