<?php
if(Permission::getInstance()->verifPerm('createur')) {

	$nameGrade = htmlspecialchars($_POST['gradeName']);
	$existGrade = false;
	$dirGrades = './modele/grades/';
	$initGrades = glob($dirGrades.'*.yml');

	$lastGrade[] = array();
	foreach($initGrades as $numGrade) {
		$lastGrade[] = substr($numGrade, 16, -4);
	}

	$lastGrade = array_filter($lastGrade);
	if(empty($lastGrade))
		array_push($lastGrade, -1);

	if(strlen($nameGrade) > 32) {
		echo('nomGradeLong');
		exit();
	} if(strlen($nameGrade) < 3) {
		echo('nomGradeCourt');
		exit();
	}

	if(!is_dir($dirGrades)) {
		if(!mkdir($dirGrades, 0755)) {
			echo('cdgi');
			exit();
		} if(!mkdir($dirGrades.'NOT_TOUCH/', 0755)) {
			echo('cdnti');
			exit();
		}
	} elseif(!is_dir($dirGrades.'NOT_TOUCH/')) {
		if(!mkdir($dirGrades.'NOT_TOUCH/', 0755)) {
			echo('cdnti');
			exit();
		}
	}

	for($i = 2; $i <= max($lastGrade); $i++) {
		$checkGrade = new Lire($dirGrades.$i.'.yml');
		$checkGrade = $checkGrade->GetTableau();
		$compareGrade = $checkGrade['Grade'];
		if($nameGrade == $compareGrade)
			$existGrade = true;
	}

	if($existGrade == true) {
		echo('gradeNameAlreadyUsed');
		exit();
	} else {
		if(max($lastGrade) == -1) {
		    $numGrade = max($lastGrade) + 3;
	    } else {
		    $numGrade = max($lastGrade) + 1;
	    }
		if(file_exists($dirGrades.$numGrade.'.yml')) {
			echo("conflitGrade");
			exit();
		}
		if($fichier = fopen($dirGrades.$numGrade.'.yml', "w+"))
		{
			fclose($fichier);
			$tabPerm['Grade'] = $nameGrade;
			$tabPerm['prefix'] = '';
			$tabPerm['effets'] = '';
			$tabPerm = createTab($tabPerm);
			$tabPerm["PermsDefault"]["forum"]["perms"] = "0";
			$grade = $dirGrades.$numGrade.'.yml';
			$createGrade = new Ecrire($grade, $tabPerm);
			echo('grade&gradeCreated');
			exit();
		}	
	}
}

function createTab(&$tableau, $recursif = false, $cle = null)
{
	if($recursif == false)
		$tab = PERMS;
	else
		$tab = $cle;
	foreach($tab as $key => $value)
	{
		if(is_array($value))
			createTab($tableau[$key], true, $tab[$key]);
		else
			$tableau[$key] = false;
	}
	return $tableau;
}
?>