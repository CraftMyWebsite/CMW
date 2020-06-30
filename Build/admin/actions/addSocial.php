<?php 
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['reseaux']['showPage'] == true)
{
	$nom = htmlspecialchars($_POST['nom']);
	$req = $bddConnection->exec('ALTER TABLE cmw_reseaux ADD '.$nom.' VARCHAR(30)');
}
?>