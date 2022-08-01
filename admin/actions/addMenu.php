<?php
if ($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'addLinkMenu')) {

    require('modele/menu.class.php');
    $Menu = new menu($bddConnection);

    $data = array();

    $data['dest'] = intval($_POST['dest']);
    $data['name'] = $_POST['name'];
    if (isset($_POST['methode'])) {
        if ($_POST['methode'] == 1) {
            $data['url'] = !empty($_POST['lien']) ? $_POST['lien'] : 'index.php';
        } else {
            $data['url'] = '?page=' . urlencode($_POST['page']);
        }
    } else {
        $data['url'] = null;
    }
    $id = $Menu->createMenu($data);
    echo '[DIV]' . $id;

}
?>