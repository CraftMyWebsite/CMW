<?php
if ($_Permission_->verifPerm('createur')) {
    if (isset($_GET['id'])) {
        $req = $bddConnection->prepare('DELETE FROM cmw_ban WHERE id = :id');
        $req->execute(array(
            'id' => $_GET['id']
        ));
    }
}