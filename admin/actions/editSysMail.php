<?php
$req = $bddConnection->prepare('UPDATE cmw_sysmail SET fromMail = :fromMail, sujetMail = :sujetMail, msgMail = :msgMail, strictMail = :strictMail  WHERE idMail = :idMail');
$req->execute(array (
    'fromMail' => $_POST['fromMail'],
    'sujetMail' => $_POST['sujetMail'],
    'msgMail' => $_POST['msgMail'],
    'strictMail' => $_POST['strictMail'],
    'idMail' => $_GET['idMail'],
))
?>