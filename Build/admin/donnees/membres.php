<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['members']['showPage'] == true) { 
	$membresReq = $bddConnection->query('SELECT * FROM cmw_users ORDER BY pseudo');

	$i = 0;
	while($membresDonnees = $membresReq->fetch(PDO::FETCH_ASSOC))
	{
		$membres[$i] = $membresDonnees;
		$i++;
	}

	include('./admin/donnees/grades.php');
}
?>