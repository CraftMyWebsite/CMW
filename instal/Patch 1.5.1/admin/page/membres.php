<h1><center>Editer les membres</center></h1>

<form class="form-inline row" role="form" method="post" action="?&action=modifierMembres">
<center><table style="width: 50%" class="table table-striped">

    <tr>

        <th>Pseudo</th>
        <th>Email</th>
        <th>Jetons</th>
        <th>Rang</th>
        <th>Mot de passe</th>
        <th>Suppression</th>

    </tr>

<?php for($i = 0; $i < count($membres); $i++) { ?>
	<tr class="ligneMembres" style="max-width: 100%;">

	    <td>
				<input type="text" class="form-control membres-form"  name="pseudo<?php echo $i; ?>" value="<?php echo $membres[$i]['pseudo']; ?>" placeholder="Pseudo">
	    </td>
	    <td>
				<input type="text" class="form-control membres-form"  name="email<?php echo $i; ?>" value="<?php echo $membres[$i]['email']; ?>" placeholder="Email">
	    </td>
	    <td>
				<input type="number" class="form-control membres-form"  name="jetons<?php echo $i; ?>" value="<?php echo $membres[$i]['jetons']; ?>" placeholder="Jetons">
	    </td>
	    <td>
				<!--<input type="text" class="form-control membres-form"  name="rang<?php echo $i; ?>" value="<?php echo $membres[$i]['rang']; ?>" placeholder="Rang">-->
				<select name="rang<?php echo $i; ?>" size="1" class="form-control">
				<option <?php if($membres[$i]['rang'] == 0) { echo 'selected'; }?> value="0">Joueur</option>
				<option <?php if($membres[$i]['rang'] == 1) { echo 'selected'; }?> value="1">Créateur</option>
				<option <?php if($membres[$i]['rang'] == 2) { echo 'selected'; }?> value="2">Administrateur</option>
				<option <?php if($membres[$i]['rang'] == 3) { echo 'selected'; }?> value="3">Modérateur</option>
				<option <?php if($membres[$i]['rang'] == 4) { echo 'selected'; }?> value="4">Développeur</option>
				<option <?php if($membres[$i]['rang'] == 5) { echo 'selected'; }?> value="5">Buildeur</option>
				</select>
		</td>
	    <td>
				<input type="password" class="form-control membres-form"  name="mdp<?php echo $i; ?>" value="" placeholder="Changer MDP">
	    </td>
	    <td>
				<a href="?&action=supprMembre&id=<?php echo $membres[$i]['id']; ?>" class="btn btn-danger">Supprimer</a>
	    </td>
		
	</tr>
<?php } ?>
</table></center>
<input type="hidden" name="nombreUsers" value="<?php echo $i; ?>" />

<div class="row validerModifMembres">
	<input class="btn btn-primary col-md-offset-1 col-md-10 col-md-offset-1" type="submit" value="Modifier le / les comptes"/>
</div>
</form>

