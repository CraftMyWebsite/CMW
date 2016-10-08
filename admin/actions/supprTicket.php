<?php
    $req = $bddConnection->prepare('DELETE FROM cmw_support WHERE id = :id');
    $req->execute(array( 'id' => $_GET['id'] ));
?>
