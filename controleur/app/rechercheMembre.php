<?php

if(isset($_POST['ajax'])){
	
	$Membres = new MembresPage($bddConnection);
	$recherche = htmlentities($_POST['recherche']);
	$liste = $Membres->rechercheMembre($recherche);
	foreach($liste as $value)
	{ ?>
	<tr>
		<td scope="row"> <?= $value['id']; ?> </td>
		<td>
                	<img src='<?= $_ImgProfil_->getUrlHeadByPseudo($value['pseudo'], 32); ?>' style='width: 32px; height: 32px;' alt='image de profile de <?= $value["pseudo"] ?>' /> <?= $value["pseudo"]; ?>
            	</td>
		<td> <?= $Membres->gradeJoueur($value["pseudo"]); ?> </td>
		<td> <?= $value['tokens']; ?> </td>
		<td>
			<a href="?page=profil&profil=<?= $value['pseudo']; ?>" class="btn btn-reverse">Voir le compte</a>
		</td>
	</tr>
<?php }
}
?>
