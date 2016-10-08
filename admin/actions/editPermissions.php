<?php
$lectureStats = new Lire('modele/config/config.yml');
$lectureStats = $lectureStats->getTableau();


$lectureStats['General']['permsPlugin'] = $_POST['perms'];

$ecriture = new Ecrire('modele/config/config.yml', $lectureStats);
?>
