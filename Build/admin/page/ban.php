<div class="cmw-page-content-header"><strong>Membres</strong> - Gérez vos bannissement</div>

<?php if($_Joueur_['rang'] != 1 AND $_PGrades_['PermsPanel']['ban']['showPage'] == false)
{
	echo '<div class="col-lg-6 col-lg-offset-3 text-center">
		<div class="alert alert-danger">
			<strong>Vous avez aucune permission pour accéder aux bannissements.</strong>
		</div>
	</div>';
}
else
	{
		?><div class="alert alert-success">
			<strong>Sur cette section, vous pouvez gérer les bannissements de votre site. (Cette page n'est visible que par les Créateurs)</strong>
		</div>

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default cmw-panel">
			<div class="panel-heading cmw-panel-header">
				<h3 class="panel-title"><strong>Liste des bans actuels</strong></h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped table-hover">
					<tr>
						<th style="width: 40%;">Membre</th>
						<th style="width: 40%;">IP</th>
						<th>Supprimer</th>
					</tr>
					<?php foreach($donneesBan as $value)
					{
						?><tr>
							<td><?=ucfirst($value['pseudo']);?></td>
							<td><?=$value['ip'];?></td>
							<td><a href="?action=removeBan&id=<?=$value['id'];?>" class="btn btn-danger">Débannir</a></td>
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
				<h3 class="panel-title"><strong>Ajouter un Bannissement</strong></h3>
			</div>
			<div class="panel-body">
				<form action="?action=addBan" method="POST">
					<div class="col-md-12">
						<div class="row">
							<label class="control-label">Pseudo (Si existant)</label>
							<input type="text" name="pseudo" class="form-control" maxlength="30">
						</div>
						<div class="row">
							<label class="control-label">IP (Si connue)</label>
							<input type="text" name="ip" class="form-control" maxlength="30">
						</div>
	                   	<div class="row text-center">
	                   		<input type="submit" class="btn btn-success" value="Bannir !" />
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
				<h3 class="panel-title"><strong>Gérer la page des bannis</strong></h3>
			</div>
			<div class="panel-body">
				<form action="?action=pageBan" method="POST">
					<div class="col-md-12">
						<div class="row">
							<label class="control-label">Titre</label>
							<input type="text" name="titre" class="form-control" value="<?=$donneesPageBan['titre'];?>">
						</div>
						<div class="row">
							<label class="control-label">Texte</label>
							<input type="text" name="texte" class="form-control" value="<?=$donneesPageBan['texte'];?>">
						</div>
	                   	<div class="row text-center">
	                   		<input type="submit" class="btn btn-success" value="Modifier !" />
	                   	</div>
	                </div>
	            </form>
            </div>
        </div>
    </div>
</div>
	<?php 
	}
?>