<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'members', 'showPage')) { 
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