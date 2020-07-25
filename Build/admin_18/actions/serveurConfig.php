<?php
if($_Permission_->verifPerm('PermsPanel', 'server', 'actions', 'editServer')) {
	$lecture = new Lire('modele/config/configServeur.yml');
	$lecture = $lecture->GetTableau();

	for($i = 0; $i < count($lecture['Json']); $i++)
	{
		$lecture['Json'][$i]['adresse'] = $_POST['JsonAddr' . $i];

		if(isset($_POST['localhost' . $i]) AND $_POST['localhost' . $i] == 'on')
		{
			$lecture['Json'][$i]['localhost'] = true;
		}
		else
		{
			$lecture['Json'][$i]['localhost'] = false;
		}

		if($_POST['protocole'.$i] == 1)
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
		$lecture['Json'][$i]['protocole'] = $_POST['protocole'.$i];
	}



	$ecriture = new Ecrire('modele/config/configServeur.yml', $lecture);
}
?>