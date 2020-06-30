<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['server']['actions']['editServer'] == true) {
	$lecture = new Lire('modele/config/configServeur.yml');
	$lecture = $lecture->GetTableau();

	for($i = 0; $i < count($lecture['Json']); $i++)
	{
		$lecture['Json'][$i]['adresse'] = $_POST['JsonAddr' . $i];

		if(isset($_POST['localhost' . $i]) AND $_POST['localhost' . $i] == 'on')
			$lecture['Json'][$i]['localhost'] = true;
		else
			$lecture['Json'][$i]['localhost'] = false;

		if(isset($_POST['JsonPort'.$i]))
		{
			$lecture['Json'][$i]['port'] = $_POST['JsonPort' . $i];
			$lecture['Json'][$i]['utilisateur'] = $_POST['JsonUser' . $i];
		}
		else
		{
			$lecture['Json'][$i]['port']['rcon'] = $_POST['RconPort'. $i];
			$lecture['Json'][$i]['port']['query'] = $_POST['QueryPort'. $i];
		}
		$lecture['Json'][$i]['mdp'] = $_POST['JsonMdp' . $i];
		$lecture['Json'][$i]['salt'] = $_POST['JsonSalt' . $i];
		$lecture['Json'][$i]['nom'] = $_POST['JsonNom' . $i];
	}



	$ecriture = new Ecrire('modele/config/configServeur.yml', $lecture);
}
?>