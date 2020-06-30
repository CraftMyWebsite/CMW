<?php

if(isset($_POST['ajax']))
{
	$Membre = new MembresPage($bddConnection);
	$recherche = htmlentities($_POST['recherche']);
	$liste = $Membre->rechercheMembre($recherche);
	foreach($liste as $value)
	{
		?><tr>
			<td scope="row"><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><?=$value['id'];?></a></td>
			<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><img src='<?=$_ImgProfil_->getUrlHeadByPseudo($value['player']);?>' style='width: 32px; height: 32px;' alt='Profil' /> <?=$value["pseudo"];?></a></td>
			<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><?=$Membre->gradeJoueur($value["pseudo"]);?></a></td>
			<td><a href="?page=profil&profil=<?=$value['pseudo'];?>" style="color: inherit;"><?=$value['tokens'];?></a></td>
		</tr><?php
	}
}

?>