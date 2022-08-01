<?php
if ($_Permission_->verifPerm('PermsPanel', 'home', 'actions', 'editMiniature')) {

    require('modele/accueil/miniature.class.php');
    $Minia = new miniature($bddConnection);

    $data = array();

    $data['message'] = $_POST['message'];
    $data['image'] = $_POST['image'];
    $data['type'] = intval($_POST['type']);
    if ($data['type'] == 1) {
        $data['lien'] = !empty($_POST['lien']) ? $_POST['lien'] : 'index.php';
    } else {
        $data['lien'] = '?&page=' . urlencode($_POST['page']);
    }

    $id = $Minia->createMinia($data);
    echo '[DIV]' . $id;
}

?> 