<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['members']['showPage'] == true) { 
	$membresReq = $bddConnection->query('SELECT * FROM cmw_users ORDER BY email');

	$i = 0;
	while($membresDonnees = $membresReq->fetch())
	{
		$membres[$i]['id'] = $membresDonnees['id'];
		$membres[$i]['pseudo'] = $membresDonnees['pseudo'];
		$membres[$i]['email'] = $membresDonnees['email'];
		$membres[$i]['rang'] = $membresDonnees['rang'];
		$membres[$i]['jetons'] = $membresDonnees['tokens'];
		$i++;
	}

	include('./admin/donnees/grades.php');
}
?>