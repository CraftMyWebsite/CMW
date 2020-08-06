<?php

if($_Permission_->verifPerm("createur")) {

	$_Serveur_['General']['joueur'] = htmlspecialchars($_POST['nom']);
	unset($_POST['nom']);

	$_Serveur_['General']['createur']['nom'] = htmlspecialchars($_POST['nomCreateur']);
	unset($_POST['nomCreateur']);
	$_Serveur_['General']['createur']['effets'] = htmlspecialchars($_POST['effetCreateur']);
	unset($_POST['effetCreateur']);
	if(isset($_POST['prefixCreateur-none']) && $_POST['prefixCreateur-none'] == "on")
		$_Serveur_['General']['createur']['bg'] = "";
	else
		$_Serveur_['General']['createur']['bg'] = htmlspecialchars($_POST['prefixCreateur']);
	unset($_POST['prefixCreateur']);
	$_Serveur_['General']['createur']['couleur'] = htmlspecialchars($_POST['couleurCreateur']);
	unset($_POST['couleurCreateur']);

	$ecriture = new Ecrire('modele/config/config.yml', $_Serveur_);


	for($i = 2; $i <= max($lastGrade); $i++) { if(file_exists($dirGrades.$i.'.yml')) {
		$allPerm = $_Permission_->readPerm($i);
		$grade = $dirGrades.$i.'.yml';
		$editGrade = new Lire($grade);
		$editGrade = $editGrade->GetTableau();
		$editGrade["Grade"] = $_POST["gradeName".$i];
		if(isset($_POST['prefix'.$i."-none"]) && $_POST['prefix'.$i.'-none'] == "on")
			$editGrade['prefix'] = "";
		else
			$editGrade["prefix"] = $_POST["prefix".$i];
		if($_POST['couleur'.$i] == "000000" OR empty($_POST['couleur'.$i]))
			$editGrade["couleur"] = "";
		else
			$editGrade["couleur"] = $_POST['couleur'.$i];
		$editGrade["effets"] = $_POST["effet".$i];
        
        $editGrade = editPerm($i, $editGrade, $allPerm, "", $_POST);


		$updateGrade = new Ecrire($grade, $editGrade);
	} }




}
?>