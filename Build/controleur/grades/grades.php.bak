<?php
header('content-type: text/html; charset=utf-8');
require_once('./modele/config/yml.class.php');
$directoryGrades = './modele/grades/';
if($_SERVER['PHP_SELF'] == '/admin.php') {
	if($switch == true) {
		if(isset($_SESSION['Player']['pseudo']))
			$rangMember = $_SESSION['Player']['rang'];
	} elseif($switch == false) {
		$rangMember = $_Joueur_['rang'];
	}
} else {
	$rangMember = $_Joueur_['rang'];
} if(is_dir($directoryGrades)) {
	$grade = $directoryGrades.$rangMember.'.yml';
	if(file_exists($grade)) {
		$gradeLecture = new Lire($grade);
		$_PGrades_ = $gradeLecture->GetTableau();
	}
}
?>