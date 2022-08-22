<?php 
if($_Permission_->verifPerm('PermsPanel', 'social', 'actions', 'addSocial'))
{
	$nom = htmlspecialchars($_POST['nom']);
	$req = $bddConnection->exec('ALTER TABLE cmw_reseaux ADD COLUMN '.$nom.' VARCHAR(30)');
}
?>