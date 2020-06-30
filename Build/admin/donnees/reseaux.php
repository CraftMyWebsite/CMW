<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['reseaux']['showPage'] == true)
{
	$req = $bddConnection->query('SELECT COLUMN_NAME AS nom FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "cmw_reseaux" AND TABLE_SCHEMA = "'.$_Serveur_['DataBase']['dbName'].'"');
	$donneesSocial = $req->fetchAll(PDO::FETCH_ASSOC);
	unset($donneesSocial[array_search('id', array_column($donneesSocial, 'nom'))]);
	array_merge($donneesSocial);
	unset($donneesSocial[array_search('idJoueur', array_column($donneesSocial, 'nom'))+1]);
	array_merge($donneesSocial);

	$req = $bddConnection->query('SELECT * FROM cmw_reseaux 
		INNER JOIN cmw_users
		ON idJoueur = cmw_users.id;');
}
?>