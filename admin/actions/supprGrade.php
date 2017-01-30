<?php
if($_Joueur_['rang'] == 1) {
	$grade = urldecode($_GET['grade']);
	$gradeDir = fopen('./modele/grades/'.$grade.'.yml', 'a');
	if($gradeDir) {
		fclose($gradeDir);
		if(unlink('./modele/grades/'.$grade.'.yml')) {
			$req_derank = $bddConnection->prepare('UPDATE cmw_users SET rang = 0 WHERE rang = :deleted_rang');
			$req_derank->bindParam(':deleted_rang', $grade);
			$req_derank->execute();
		} else {
			//Impossible de supprimer le grade//
		}
	} else {
		//Impossible d'ouvrir la config du grade//
	}
}
?>