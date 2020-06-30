<?php
if(Permission::getInstance()->verifPerm('createur')) {

	$nameGrade = htmlspecialchars($_POST['gradeName']);
	$existGrade = false;

	if(strlen($nameGrade) > 32) {
		header('Location: admin.php?page=grade&nomGradeLong=true');
		exit();
	} if(strlen($nameGrade) < 3) {
		header('Location: admin.php?page=grade&nomGradeCourt=true');
		exit();
	}

	if(!is_dir($dirGrades)) {
		if(!mkdir($dirGrades, 0755)) {
			header('Location: admin.php?page=grade&cdgi=true');
			exit();
		} if(!mkdir($dirGrades.'NOT_TOUCH/', 0755)) {
			header('Location: admin.php?page=grade&cdnti=true');
			exit();
		}
	} elseif(!is_dir($dirGrades.'NOT_TOUCH/')) {
		if(!mkdir($dirGrades.'NOT_TOUCH/', 0755)) {
			header('Location: admin.php?page=grade&cdnti=true');
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
		header('Location: admin.php?page=grade&gradeNameAlreadyUsed=true');
		exit();
	} else {
		if(max($lastGrade) == -1) {
		    $numGrade = max($lastGrade) + 3;
	    } else {
		    $numGrade = max($lastGrade) + 1;
	    }
		if(file_exists($dirGrades.$numGrade.'.yml')) {
			header("Location: admin.php?page=grade&conflitGrade=true");
			exit();
		}
		if($fichier = fopen($dirGrades.$numGrade.'.yml', "w+"))
		{
			fclose($fichier);
			$tabPerm['Grade'] = $nameGrade;
			$tabPerm['prefix'] = '';
			$tabPerm['effets'] = '';
			$tabPerm = createTab($tabPerm);
			$grade = $dirGrades.$numGrade.'.yml';
			$createGrade = new Ecrire($grade, $tabPerm);
			header('Location: admin.php?page=grade&gradeCreated=true');
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