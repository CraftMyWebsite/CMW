<?php
if($_Permission_->verifPerm("createur")) {
	$grade = urldecode($_GET['id']);
	$gradeDir = fopen('./modele/grades/'.$grade.'.yml', 'a');
	if($gradeDir) {
		fclose($gradeDir);
		if(unlink('modele/grades/'.$grade.'.yml')) {
			$req_derank = $bddConnection->prepare('UPDATE cmw_users SET rang = 0 WHERE rang = :deleted_rang');
			$req_derank->bindParam(':deleted_rang', $grade);
			$req_derank->execute();
			echo 'suppr OK';
		} else {
			echo('Impossible de supprimer');
		}
	} else {
		echo('Impossible d\'ouvrir le grade');
	}
}
?>