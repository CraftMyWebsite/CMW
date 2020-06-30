<?php
if(isset($_POST['id']))
{
	$Messagerie = new Messagerie($bddConnection, $_Joueur_['pseudo']);
	if($Messagerie->setLu($_POST['id']))
		echo 1;
	else
		echo 2;
}

?>