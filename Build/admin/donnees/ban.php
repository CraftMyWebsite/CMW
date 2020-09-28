<?php 

if($_Permission_->verifPerm('PermsPanel', 'ban', 'showPage')) {
	$req = $bddConnection->query('SELECT * FROM cmw_ban');
	$donneesBan = $req->fetchAll(PDO::FETCH_ASSOC);

	$req = $bddConnection->query('SELECT * FROM cmw_ban_config');
	$donneesPageBan = $req->fetch(PDO::FETCH_ASSOC);

	$membresReq = $bddConnection->query('SELECT pseudo FROM cmw_users ORDER BY pseudo ASC');
	$membres = $membresReq->fetchAll(PDO::FETCH_ASSOC);
}