<?php
if($_Joueur_['rang'] == 1) {
	$dirGrades = './modele/grades/';
	$initGrades = glob($dirGrades.'*.yml');

	$lastGrade[] = array();
	foreach($initGrades as $numGrade) {
		$lastGrade[] = substr($numGrade, 16, -4);
	}

	$lastGrade = array_filter($lastGrade);
	if(empty($lastGrade))
		array_push($lastGrade, -1);

	$idGrade[] = array();
	for($i = 2;$i <= max($lastGrade); $i++) {
		$openGrade = new Lire($dirGrades.$i.'.yml');
		$readGrade = $openGrade->GetTableau();
		$idGrade[$i] = $readGrade;
	}
}
?>