<div class="row">
	<center><a href="?action=resetVotes" class="btn btn-danger btn-block" style="width: 25%">Réinitialiser les votes ..</a></center>
	</br>
	<h1><center>Réglages des votes</center></h1>
</div>
<h3><center>Configuration générale des votes</center></h3>

<center><form method="post" action="?&action=modifierVotesGen">
	<div class="form-group">
		<label>Message affiché lors du vote pour que les autres joueurs pensent à voter</label>
		<input type="text" style="width: 25%;text-align: center;" name="message" class="form-control" value="<?php echo $lectureVotes['message']; ?>" />
	</div>
	<div class="row">
	
		<div class="col-md-5">
			<label> Afficher le message ? </label>
			<input type="radio" name="display" value="1" id="1" <?php if($lectureVotes['display'] == 1){ echo 'checked'; } ?> /><label for="1"> Oui </label>
			<input type="radio" name="display" value="2" id="2" <?php if($lectureVotes['display'] == 2){ echo 'checked'; } ?>/><label for="2"> Non </label>
		</div>
	<br/>
		<div style="margin-top: 1%;">
			<label>Executer une commande/Give d'item :</label>
			<select  style="width: 25%;"name="action" class="form-control">
				<option value="<?php echo $lectureVotes['action']; ?>">Actuellement : <?php if($lectureVotes['action'] == 1) { echo 'Commande'; }elseif($lectureVotes['action'] == 2) { echo 'Give item'; } else { echo 'Give Jetons'; } ?>
				<option value="1"> Executer une commande </option>
				<option value="2"> Give d'item </option>
				<option value="3"> Ajout de Jetons </option>
			</select>
		</div>

		<div style="margin-top: 1%;">
			<label>Le joueur obtiendra sa récompense sur:</label>
			<select name="methode" style="width: 25%;" class="form-control">
				<option value="<?php echo $lectureVotes['methode']; ?>" />			
				<option value="1"> Le serveur où il est en ligne </option>
				<option value="2"> Le serveur de la catégorie </option>
			</select>
		</div>		

		<div class="form-group" style="margin-top: 1%;">
			<label> Commande à éxectuer ( SANS / ) si option sélectionné ! Vous pouvez utiliser {JOUEUR} si vous faîtes référence au joueurs ayant voté </label>
			<input type="text" style="width: 25%;" name="cmd" class="form-control" value="<?php echo $lectureVotes['cmd']; ?>" />
		</div>
		
		<div class="form-group" style="margin-top: 1%;">
			<label> Nombre de Jetons à donner si option sélectionné </label>
			<input type="number"style="width: 25%;" name="tokens" class="form-control" value="<?php echo $lectureVotes['tokens']; ?>" />
		</div>

		<div class="form-group" style="margin-top: 1%;">
			<label>ID de l'item donné si option sélectionné </label>
			<input type="text" style="width: 25%;" name="id" value="<?php echo $lectureVotes['id']; ?>" class="form-control" value="264" />
    	</div>

		<div class="form-group" style="margin-top: 1%;">
			<label>Quantité donnée si option sélectionné </label>
			<input type="text" style="width: 25%;" name="quantite" value="<?php echo $lectureVotes['quantite']; ?>" class="form-control" value="4" />
    	</div>
		
	</div>
	<input type="submit" class="btn btn-warning"/>
</form></center>
</br>
<h3><center>Création d'un lien de vote</center></h3>
<form method="POST" action="?&action=creerLienVote">
	<center><div style="width: 25%" class="form-group">
		<label>Lien de vote du serveur</label>
		<select name="serveur" class="form-control">	  	
			<?php for($i = 0; $i < count($lectureServs); $i++) {		?>
         	   <option value="<?php echo $i ?>"> <?php echo $lectureServs[$i]['nom']; ?> </option>
			<?php 	}	?>
		</select>
	</div></center>
	<center><div class="form-group">
		<label>Lien de vote</label>
		<input style="width: 25%" type="text" name="lien" placeholder="ex: http://serveurs-minecraft.com/...../" class="form-control" />
	</div></center>
	<center><div class="form-group">
		<label>Titre du lien</label>
		<input style="width: 25%" type="text" name="titre" placeholder="ex: Voter sur McServ !" class="form-control" />
	</div></center>
	<center><div class="form-group">
		<label>Temps de vote</label>
		<input style="width: 25%" type="number" name="temps" placeholder="ex: 86400 pour 24h" class="form-control" />
	</div></center>
	<center><input type="submit" class="btn btn-success" /></center>
</form>

<center><h3>Supprimer un lien...<h3></center>
<?php
for($i = 0; $i < count($lectureVotes['liens']); $i++)
{	?>
	<center><a style="width: 25%" href="?&action=supprLienVote&id=<?php echo $i; ?>" class="btn btn-danger">Supprimer <?php echo $lectureVotes['liens'][$i]['titre']; ?></a></center>
<?php
} 	?>