<?php
$req = $bddConnection->prepare('UPDATE cmw_sysmail SET etatMail = :etatMail WHERE idMail = :idMail');
$req->execute(array (
    'etatMail' => $_POST['etatMail'],
    'idMail' => $_GET['idMail'],
))
?>