<?php

    $req = $bddConnection->prepare('UPDATE cmw_news SET titre = :titre, message = :contenu WHERE id = :id');
    $req->execute(array(
        'titre' => $_POST['titre'],
        'contenu' => $_POST['message'],
        'id' => $_GET['id']        ));

?>