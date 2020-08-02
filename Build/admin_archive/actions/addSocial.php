<?php 
if(Permission::getInstance()->verifPerm('PermsPanel', 'reseaux', 'showPage'))
{
	$nom = htmlspecialchars($_POST['nom']);
	$req = $bddConnection->exec('ALTER TABLE cmw_reseaux ADD '.$nom.' VARCHAR(30)');
}
?>