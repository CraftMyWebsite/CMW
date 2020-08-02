<?php 

$req = $bddConnection->query('SELECT * FROM cmw_ban');
$donneesBan = $req->fetchAll(PDO::FETCH_ASSOC);

$req = $bddConnection->query('SELECT * FROM cmw_ban_config');
$donneesPageBan = $req->fetch(PDO::FETCH_ASSOC);