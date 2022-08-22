<?php
if(Permission::getInstance()->verifPerm('createur')) {

	$nameGrade = htmlspecialchars($_POST['gradeName']);

	$reqExist = $bddConnection->prepare('SELECT COUNT(id) AS test FROM cmw_grades WHERE nom = :nom');
	$reqExist->execute(array('nom' => $nameGrade));
	$data = $reqExist->fetch(PDO::FETCH_ASSOC);
	if(isset($data['test']) AND $data['test'] > 0)
	{
		echo('gradeNameAlreadyUsed');
		exit();
	}
	if(strlen($nameGrade) > 200) {
		echo('nomGradeLong');
		exit();
	} if(strlen($nameGrade) < 3) {
		echo('nomGradeCourt');
		exit();
	}
	$tabInsertion = array();
	$tabInsertion['nom'] = $nameGrade;
	$tabInsertion['prefix'] = '';
	$tabInsertion['couleur'] = '';
	$tabInsertion['effets'] = '';
	$tabPerm = createTab($tabPerm);
	$tabPerm['PermsDefault']['forum']['perms'] = '0';
	$tabInsertion['permDefault'] = serialize($tabPerm['PermsDefault']);
	$tabInsertion['permPanel'] = serialize($tabPerm['PermsPanel']);
	$tabInsertion['permForum'] = serialize($tabPerm['PermsForum']);
	$insert = $bddConnection->prepare('INSERT INTO cmw_grades (nom, priorite, prefix, couleur, effets, permDefault, permPanel, permForum) SELECT :nom, COALESCE(MAX(priorite)+1, 1), :prefix, :couleur, :effets, :permDefault, :permPanel, :permForum FROM cmw_grades');
	$insert->execute($tabInsertion);
	if($insert !== FALSE)
		echo 'grade&gradeCreated';
	else
		echo 'echec';
	exit();
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