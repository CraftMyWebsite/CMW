<?php
$req = $bddConnection->prepare('SELECT * FROM cmw_pages WHERE id = :id');
$req->execute(array('id' => $_GET['id']));
$donnees = $req->fetch();

$construction = $donnees['contenu'] .'#µ¤#'. $_POST['sousTitre'] .'|;|'. $_POST['message'];

$req = $bddConnection->prepare('UPDATE cmw_pages SET contenu = :contenu WHERE id = :id');
$req->execute(array('contenu' => $construction, 'id' => $_GET['id']));
?>