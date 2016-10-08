<?php

echo 'test';
$reqSuppr = $bddConnection->prepare('DELETE from cmw_users WHERE id = :id');
$reqSuppr->execute(Array ( 'id' => $_GET['id'] ));

?>