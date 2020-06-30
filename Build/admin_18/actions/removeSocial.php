<?php 
if(Permission::getInstance()->verifPerm('PermsPanel', 'reseaux', 'showPage'))
{
	$nom = htmlspecialchars($_GET['nom']);
	$bddConnection->exec('ALTER TABLE cmw_reseaux DROP COLUMN '.$nom);
}
?>