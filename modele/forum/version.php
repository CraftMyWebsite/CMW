<?php 

$note = file_get_contents('http://5.196.162.31/script/version.php?url=' . $_Serveur_['General']['url'] . '&version=' . $_Serveur_['General']['license_forum']);
echo $note;
?>