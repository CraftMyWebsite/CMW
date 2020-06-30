<?php
if(Permission::getInstance()->verifPerm("PermsPanel", "general", "showPage")) 
{
	$lectureStats = new Lire('modele/config/config.yml');
	$lectureStats = $lectureStats->GetTableau();
}
?>