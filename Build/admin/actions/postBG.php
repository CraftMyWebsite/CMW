<?php
if($_Permission_->verifPerm('PermsPanel', 'theme', 'actions', 'editBackground')) {
	if(isset($_FILES['img']) and !empty($_FILES['img']))
	{
		include_once('controleur/upload.class.php');
		
		$types = Array('png', 'jpg', 'gif');
		
		$copie = new Copie('theme/upload/', $_FILES['img'], 10000000, $types, 2000, 2000);
		$verif = $copie->Verification();
		$copie->SetName('bg.png');
		
		
		if($verif == 4)
			$copie->Copie();
	}
}
header('Location: ?page=theme');
?>