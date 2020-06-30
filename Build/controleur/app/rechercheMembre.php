<?php

if(isset($_POST['ajax']))
{
	$Membre = new MembresPage($bddConnection);
	$recherche = htmlentities($_POST['recherche']);
	$liste = $Membre->rechercheMembre($recherche);
	foreach($liste as $value)
	{
		$Img = new ImgProfil($value['id']);
		?><tr>
			<td scope="row"><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><?=$value['id'];?></a></td>
			<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><img src='<?=$Img->getImgToSize(32, $width, $height);?>' style='width: <?=$width;?>px; height: <?=$height;?>px;' alt='Profil' /> <?=$value["pseudo"];?></a></td>
			<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><?=$Membre->gradeJoueur($value["pseudo"]);?></a></td>
			<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><?=$value['tokens'];?></a></td>
		</tr><?php
	}
}

?>