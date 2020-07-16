<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
		Gestion des bannissements utilisateurs du site web et configuration de la page de ban
	</h2>
</div>
<?php if($_Joueur_['rang'] != 1 AND $_PGrades_['PermsPanel']['ban']['showPage'] == false)
{
	echo '
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="alert alert-danger">
				<strong>Vous avez aucune permission pour accéder aux bannissements.</strong>
			</div>
		</div>
	</div>';
}
else
	{
		?>
	<div class="alert alert-success">
		<strong>Sur cette section, vous pouvez gérer les bannissements de votre site. (Cette page n'est visible que par les Créateurs)</strong>
	</div>

<div class="row">
	<div class="col-md-6">
		<div class="card  ">
			<div class="card-header ">
				<h3 class="panel-title"><strong>Liste des bans actuels</strong></h3>
			</div>
			<div class="card-body">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th style="width: 40%;">Membre</th>
							<th style="width: 40%;">IP</th>
							<th>Supprimer</th>
						</tr>
					</thead>
					<tbody id="list-ban">
					<?php foreach($donneesBan as $value)
					{
						?><tr id="Ban<?=$value['id'];?>">
							<td><?=ucfirst($value['pseudo']);?></td>
							<td><?=$value['ip'];?></td>
							<td><button type="button" onclick="sendPost('removeBan&id=<?=$value['id'];?>')" class="btn btn-danger">Débannir</button></td>
							 <script>initPost("removeBan&id=<?=$value['id'];?>", "admin.php?action=removeBan&id=<?=$value['id'];?>",function(data) { if(data) {document.getElementById('Ban<?=$value['id'];?>').style.display='none'; }});</script>
						</tr><?php 
					}
					?>
					</tbody>
				</table>
            </div>
        </div>
   	</div>
   	<div class="col-md-6">
		<div class="card  ">
			<div class="card-header ">
				<h3 class="panel-title"><strong>Ajouter un Bannissement</strong></h3>
			</div>
			<div class="card-body" id="addBan">
					<div class="col-md-12">
						<div class="row">
							<label class="control-label">Pseudo (Si existant)</label>
							<input type="text" name="pseudo" class="form-control" maxlength="30" >
						</div>
						<div class="row">
							<label class="control-label">IP (Si connue)</label>
							<input type="text" name="ip" class="form-control" maxlength="30">
						</div>
	                </div>
            </div>
             <script>initPost("addBan", "admin.php?action=addBan", function(data) { if(data) {
             		document.getElementById('list-ban').innerHTML += 
             		"<tr ><td>"+getValueByName('addBan','pseudo')
             		+"</td><td>"+getValueByName('addBan','ip')
             		+"</td><td><button type='button' class='btn btn-danger' disabled>Débannir</button></td></tr>";clearAllInput('addBan'); 
             	}
             }
         );</script>
			<div class="card-footer">
				<div class="row text-center">
					<input type="submit" onclick="sendPost('addBan')" class="btn btn-success w-100" value="Bannir !" />
				</div>
			</div>
        </div>
   	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card  ">
			<div class="card-header ">
				<h3 class="panel-title">Gérer la page des bannis</h3>
			</div>
			<div class="card-body" id="pageBan">
					<div class="col-md-12">
						<div class="row">
							<label class="control-label">Titre</label>
							<input type="text" name="titre" class="form-control" value="<?=$donneesPageBan['titre'];?>">
						</div>
						<div class="row">
							<label class="control-label">Texte</label>
							<input type="text" name="texte" class="form-control" value="<?=$donneesPageBan['texte'];?>">
						</div>
	                </div>
            </div>
            <script>initPost("pageBan", "admin.php?action=pageBan",null); </script>
			<div class="card-footer">
				<div class="row text-center">
					<input type="submit" onclick="sendPost('pageBan');"class="btn btn-success w-100" value="Modifier !" />
				</div>
			</div>
        </div>
    </div>
</div>
<br/>
	<?php 
	}
?>