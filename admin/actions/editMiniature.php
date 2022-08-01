<?php
if ($_Permission_->verifPerm('PermsPanel', 'home', 'actions', 'editMiniature')) {
    require('modele/accueil/miniature.class.php');
    $Minia = new miniature($bddConnection);


    for ($i = 0; $i < intval($_POST['count']); $i++) {
        if (isset($_POST['message' . $i])) {
            $data = array();

            $data['message'] = $_POST['message' . $i];
            $data['image'] = $_POST['image' . $i];
            $data['type'] = intval($_POST['type' . $i]);
            if ($data['type'] == 1) {
                $data['lien'] = !empty($_POST['lien' . $i]) ? $_POST['lien' . $i] : 'index.php';
            } else {
                $data['lien'] = '?&page=' . urlencode($_POST['page' . $i]);
            }

            $Minia->editMinia($data, intval($_POST['id' . $i]));
        }
    }
}
?>