<?php
if ($_Permission_->verifPerm('PermsPanel', 'home', 'actions', 'editMiniature')) {

    require('modele/accueil/miniature.class.php');
    $Minia = new miniature($bddConnection);

    if ($_GET['type'] == '0') {
        $Minia->downMinia(intval($_GET['id']));
    } else if ($_GET['type'] == '1') {
        $Minia->upMinia(intval($_GET['id']));
    }
}

?>