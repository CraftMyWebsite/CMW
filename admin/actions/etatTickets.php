<?php
$req = $bddConnection->prepare('UPDATE cmw_support SET etat = :etat WHERE id = :id');
$req->execute(array (
    'etat' => $_POST['etat'],
    'id' => $_GET['id'],
))
?>