<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'server', 'actions', 'editServer')) {
	$lecture = new Lire('modele/config/configServeur.yml');
	$lecture = $lecture->GetTableau();

	for($i = 0; $i < count($lecture['Json']); $i++)
	{
		if($lecture['Json'][$i]['nom'] == $_GET['nom'])
			unset($lecture['Json'][$i]);
	}


	$ecriture = new Ecrire('modele/config/configServeur.yml', $lecture);
	$bugMoche = fopen('modele/config/configServeur.yml', 'r+');
	if($bugMoche)
	{
		$i = 0;
		while (($buffer = fgets($bugMoche, 4096)) !== false) {
			$lectureFichier[$i] = $buffer;
			$i++;
		}
		$ecriture = implode('', $lectureFichier);
		$ecriture = preg_replace('#[0-9]+\:#U', '-', $ecriture);
		fclose($bugMoche);
		$bugMoche2 = fopen('modele/config/configServeur.yml', 'w');
		fwrite($bugMoche2, $ecriture);
		fclose($bugMoche2);
	}
	else
		fclose($bugMoche);
}
?>