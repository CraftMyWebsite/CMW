<?php 
if($_Permission_->verifPerm('PermsPanel', 'reseaux', 'showPage'))
{
	$nom = htmlspecialchars($_POST['nom']);
	$req = $bddConnection->prepare('ALTER TABLE cmw_reseaux ADD :nom VARCHAR(30)');
	$req->execute(array('nom' => $nom));
}
?>