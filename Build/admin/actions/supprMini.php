<?php 

if(isset($_GET['id']) && $_Permission_->verifPerm('PermsPanel', 'home', 'actions','editMiniature'))
{
	$id = intval(htmlentities($_GET['id']));
	$tmp = array(
		'Infos' => array(),
		'Slider' => $lectureAccueil['Slider'],
		'SliderTitre' => $lectureAccueil['SliderTitre']
	);
	$i = 1;
	foreach($lectureAccueil['Infos'] as $key => $value)
	{
		if($key != $id)
		{
			$tmp['Infos'][strval($i)]['message'] = $value['message'];
			$tmp['Infos'][strval($i)]['image'] = $value['image'];
			$tmp['Infos'][strval($i)]['lien'] = $value['lien'];
			$i++;
		}
	}
	$ecriture = new Ecrire('modele/config/accueil.yml', $tmp);
}