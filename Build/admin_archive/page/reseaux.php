<div class="cmw-page-content-header"><strong>Membres</strong> - Gérez vos réseaux sociaux</div>

<?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'social', 'showPage'))
{
	echo '<div class="col-lg-6 col-lg-offset-3 text-center">
		<div class="alert alert-danger">
			<strong>Vous avez aucune permission pour accéder aux réseaux sociaux</strong>
		</div>
	</div>';
}
else
{
?>><div class="alert alert-success">
	<strong>Sur cette section, vous pouvez gérer les réseaux sociaux que peuvent rentrer vos membres, et voir leurs réseaux sociaux.</strong>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
				<h3 class="panel-title"><strong>Liste des réseaux sociaux actuels</strong></h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-hover">
					<tr>
						<th style="width: 80%;">Réseau social</th>
						<th>Supprimer</th>
					</tr>
					<?php foreach($donneesSocial as $value)
					{
						?><tr>
							<td><?=ucfirst($value['nom']);?></td>
							<td><a href="?action=removeSocial&nom=<?=$value['nom'];?>" class="btn btn-danger">Supprimer</a></td>
						</tr><?php 
					}
					?>
				</table>
            </div>
        </div>
   	</div>
   	<div class="col-md-6">
		<div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
				<h3 class="panel-title"><strong>Ajouter un réseau Social</strong></h3>
			</div>
			<div class="panel-body">
				<form action="?action=addSocial" method="POST">
					<div class="col-md-12">
						<div class="row">
							<label class="control-label">Nom du réseau social</label>
							<input type="text" name="nom" class="form-control" maxlength="30">
						</div>
	                   	<div class="row text-center">
	                   		<input type="submit" class="btn btn-success" value="Ajouter le réseau social !" />
	                   	</div>
	                </div>
	            </form>
            </div>
        </div>
   	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
				<h3 class="panel-title"><strong>Réseaux sociaux des joueurs</strong></h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-hover">
					<tr>
						<th>Pseudo</th>
						<?php 
						$arraySocial = array();
						foreach($donneesSocial as $value)
						{
							array_push($arraySocial, $value['nom']);
							?><th><?=$value['nom'];?></th><?php 
						}
						?>
					</tr>
					<?php 
					while($donnees = $req->fetch(PDO::FETCH_ASSOC))
					{
						?><tr>
							<td><?=$donnees['pseudo'];?></td>
							<?php 
							foreach($arraySocial as $value)
							{
								?><td><?=$donnees[$value];?></td><?php 
							}
							?></tr>
							<?php 
					}
					?>
				</table>
			</div>
		</div>
	</div>
</div>
<?php } ?>
