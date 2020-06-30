<?php
if(Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'editMiniature')) {
	    $lectureAccueil = new Lire('modele/config/accueil.yml');
  		$lectureAccueil = $lectureAccueil->GetTableau();
  		if(isset($lectureAccueil['Infos'][$_POST["ordre"]]))
  		{
  			for($i = count($lectureAccueil['Infos']); $i>0;$i--) {
  				if($i == $_POST["ordre"] -1)
  				{
  					break;
  				} else {
  					$lectureAccueil['Infos'][$i+1] = $lectureAccueil['Infos'][$i];
  				}
  			}
  		}
		$lectureAccueil['Infos'][$_POST["ordre"]]['message'] = $_POST['message'];
		$lectureAccueil['Infos'][$_POST["ordre"]]['image'] = $_POST['image'];
		$lectureAccueil['Infos'][$_POST["ordre"]]['type'] = $_POST['typeLien'];
		if($_POST['typeLien'] == 'page')
		{
			$lectureAccueil['Infos'][$_POST["ordre"]]['lien'] = '?page='. urlencode($_POST['page']);
		}
		else 
		{
			$lectureAccueil['Infos'][$_POST["ordre"]]['lien'] = $_POST['lien'];
		}

	$ecriture = new Ecrire('modele/config/accueil.yml', $lectureAccueil);
}

?> 