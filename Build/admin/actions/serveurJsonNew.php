<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['server']['actions']['addServer'] == true) {
	$lecture = new Lire('modele/config/configServeur.yml');
	$lecture = $lecture->GetTableau();

	$i = count($lecture['Json']);

	$lecture['Json'][$i]['adresse'] = $_POST['JsonAddr'];

	if($_POST['localhost'] == 'on')
		$lecture['Json'][$i]['localhost'] = true;
	else
		$lecture['Json'][$i]['localhost'] = false;
	if(!empty($_POST['JsonPort']))
	{
		$lecture['Json'][$i]['port'] = $_POST['JsonPort'];
		$lecture['Json'][$i]['utilisateur'] = $_POST['JsonUser'];
	}
	else
	{
		$lecture['Json'][$i]['port']['query'] = $_POST['QueryPort'];
		$lecture['Json'][$i]['port']['rcon'] = $_POST['RconPort'];
	}	
	$lecture['Json'][$i]['mdp'] = $_POST['JsonMdp'];
	$lecture['Json'][$i]['salt'] = $_POST['JsonSalt'];
	$lecture['Json'][$i]['nom'] = $_POST['JsonNom'];


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