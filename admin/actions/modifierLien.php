<?php
if ($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'editDropAndLinkMenu')) {
    $id = $_GET['id'];

    if ($_POST['methode'] == 1) {
        $lien = $_POST['menuLien'];
    } else if ($_POST['methode'] == 2) {
        $lien = '?page=' . $_POST['page'];
    } else {
        $lien = '-divider-';
    }


    $menuLecture = new Lire('modele/config/configMenu.yml');
    $menuLecture = $menuLecture->GetTableau();
    $menuLecture['MenuTexte'][$id] = $_POST['texteLien'];
    $menuLecture['MenuLien'][$id] = $lien;


    $ecriture = new Ecrire('modele/config/configMenu.yml', $menuLecture);

}
?>