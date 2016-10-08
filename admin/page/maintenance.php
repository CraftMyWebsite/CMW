<h1><center>Gestion de maintenance</center></h1>
</br>		
<?php for($i = 0; $i < count($maintenance); $i++) { ?>
<div class="row">
	<div class="col-md-6">
	</br>
	<center><B>Vous pourrez définir vos messages personnalisé ci-dessous :</B></center>
</br>
<center><table style="width: 50%" class="table table-striped table-bordered">
	<tr>
		<th>Message :</th>
		<th style="width: 20px;">Action :</th>
	</tr>
	<form class="form-horizontal default-form" method="post" action="?&action=editMessage&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>">

		<tr>
			<td><input style="width: 85%" type="text" name="maintenanceMsg" value="<?php echo $maintenance[$i]['maintenanceMsg']; ?>" class="form-control" placeholder="Ex : Maintenance en cours.." required></td>
			<td><input type="submit" class="btn btn-warning" value="Modifier le message !" /></td>
		</form>
	</tr>

	<tr>
		<th>Message Administration :</th>
		<th></th>
	</tr>

	<tr>
		<form class="form-horizontal default-form" method="post" action="?&action=editMessageAdmin&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>">
			<td><input style="width: 85%" type="text" name="maintenanceMsgAdmin" value="<?php echo $maintenance[$i]['maintenanceMsgAdmin']; ?>" class="form-control" placeholder="Ex : Vous êtes administrateur? Alors connectez-vous :" required></td>
			<td><input type="submit" class="btn btn-warning" value="Modifier le message !" /></td>
		</form>

	</tr>
</table></center>
</div>
<div class="col-md-6">
	<div class="row">
		<div class="col-md-6">
			<?php if($maintenance[$i]['maintenanceEtat'] == 1) { ?> 
			<center><button class="btn btn-block" style="background: #18bc9c;color: white;" disabled><strong>INFO :</strong> Maintenance activé</button></center>
			<?php } else { ?>
			<center><button class="btn btn-block" style="background: #e74c3c;color: white;" disabled><strong>INFO :</strong> Maintenance  désactivé</button></center>
			<?php } ?>
		</div>
		<div class="col-md-6">
			<?php if($maintenance[$i]['maintenancePref'] == 1) { ?> 
			<center><button class="btn btn-block" style="background: #3498db;color: white;" disabled><strong>Pref actuelle :</strong> Accès panel uniquement</button></center>
			<?php } else { ?>
			<center><button class="btn btn-block" style="background: #3498db;color: white;" disabled><strong>Pref actuelle :</strong> Accès panel + site </button></center>
			<?php } ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-6">	
			<div class="panel panel-success" style="text-align: center;margin-top: 5px;">
				<div class="panel-heading">
					<h3 class="panel-title">Activer/désactiver la maintenance</h3>
				</div>
				<center style="padding: 5px;">Vous souhaitez rendre le site accésible uniquement aux administrateurs ? Il vous suffie d'appuyer sur le bouton ci-dessous. Les visiteurs seront redirigé vers la page de maintenance.</center>
				<div class="panel-body">
					<form method="post" action="?&action=switchMaintenance&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>">
						<?php if($maintenance[$i]['maintenanceEtat'] == 1) { 
							echo '<button type="submit" name="maintenanceEtat" class="btn btn-danger btn-block" value="0" />Désactiver la maintenance</button>';
						} else {
							echo '<button type="submit" name="maintenanceEtat" class="btn btn-success btn-block" value="1" />Activer la maintenance</button>';
						} ?>
					</form>
				</div>
			</div>
		</div>
		<div class="col-md-6">	
			<div class="panel panel-success" style="text-align: center;margin-top: 5px;">
				<div class="panel-heading">
					<h3 class="panel-title">Changer le type de redirection</h3>
				</div>
				<center style="padding: 15px;">Grâce a cette option , si la maintenance est activé vous pouvez choisir si les administrateurs peuvent accéder au panel + le site ou uniquement le panel.</center>
				<div class="panel-body">
					<form method="post" action="?&action=switchPreference&maintenanceId=<?php echo $maintenance[$i]['maintenanceId']; ?>">
						<?php if($maintenance[$i]['maintenancePref'] == 1) { 
							echo '<button type="submit" name="maintenancePref" class="btn btn-warning" value="0" />Changer sur <strong>Panel + Site</strong></button>';
						} else {
							echo '<button type="submit" name="maintenancePref" class="btn btn-warning" value="1" />Changer sur <strong>Panel uniquement</strong></button>';
						} ?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php }  ?>