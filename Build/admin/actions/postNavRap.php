<?php
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['actions']['uploadMiniature'] == true) {
	if(isset($_FILES['img']) and !empty($_FILES['img']))
	{
		include_once('controleur/upload.class.php');
		
		$types = Array('png', 'jpg', 'gif');
		
		$copie = new Copie('theme/upload/navRap/', $_FILES['img'], 10000000, $types, 2000, 2000);
		$verif = $copie->Verification();

		
		if($verif == 4)
			$copie->Copie();
	}
}
?>