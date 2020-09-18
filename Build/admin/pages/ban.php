<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
		Gestion des bannissements utilisateurs du site web et configuration de la page de ban
	</h2>
</div>
<?php if(!$_Permission_->verifPerm('PermsPanel', 'ban', 'showPage')) { ?>
	
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="alert alert-danger">
				<strong>Vous avez aucune permission pour accéder aux bannissements.</strong>
			</div>
		</div>
	</div>
<?php } else {?>
	<div class="alert alert-success">
		<strong>Sur cette section, vous pouvez gérer les bannissements de votre site. (Cette page n'est visible que par les Créateurs)</strong>
	</div>

<div class="row">
	<?php if($_Permission_->verifPerm('PermsPanel', 'ban', 'actions','showBan')) { ?>
	<div class="col-md-12 col-xl-6 col-126">
		<div class="card  ">
			<div class="card-header ">
				<h3 class="card-title"><strong>Liste des bans actuels</strong></h3>
			</div>
			<div class="card-body">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th style="width: 40%;">Membre</th>
							<th style="width: 40%;">IP</th>
							<?php  if($_Permission_->verifPerm('PermsPanel', 'ban', 'actions','removeBan')) { ?><th>Supprimer</th> <?php } ?>
						</tr>
					</thead>
					<tbody id="list-ban">
					<?php foreach($donneesBan as $value)
					{
						?><tr id="Ban<?=$value['id'];?>">
							<td><?=ucfirst($value['pseudo']);?></td>
							<td><?=$value['ip'];?></td>
							<?php  if($_Permission_->verifPerm('PermsPanel', 'ban', 'actions','removeBan')) { ?>
							<td><button type="button" onclick="sendPost('removeBan&id=<?=$value['id'];?>')" class="btn btn-danger">Débannir</button></td>
							 <script>initPost("removeBan&id=<?=$value['id'];?>", "admin.php?action=removeBan&id=<?=$value['id'];?>",function(data) { if(data) {hide('Ban<?=$value['id'];?>'); }});</script> <?php } ?>
						</tr><?php 
					}
					?>
					</tbody>
				</table>
            </div>
        </div>
   	</div>
   <?php }  if($_Permission_->verifPerm('PermsPanel', 'ban', 'actions','addBan')) { ?>
   	<div class="col-md-12 col-xl-6 col-12">
		<div class="card  ">
			<div class="card-header ">
				<h3 class="card-title"><strong>Ajouter un Bannissement</strong></h3>
			</div>
			<div class="card-body" id="addBan">

							<label class="control-label">Pseudo (Si existant)</label>
							<input type="text" name="pseudo" class="form-control" maxlength="30" >

							<label class="control-label">IP (Si connue)</label>
							<input type="text" name="ip" class="form-control" maxlength="30">

            </div>
             <script>initPost("addBan", "admin.php?action=addBan", function(data) { if(data) {
             		get('list-ban').innerHTML += 
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
	<?php } if($_Permission_->verifPerm('PermsPanel', 'ban', 'actions','editBanPage')) { ?>
	<div class="col-md-12 col-xl-12 col-12">
		<div class="card  ">
			<div class="card-header ">
				<h3 class="card-title">Gérer la page des bannis</h3>
			</div>
			<div class="card-body" id="pageBan">

				<label class="control-label">Titre</label>
				<input type="text" name="titre" class="form-control" value="<?=$donneesPageBan['titre'];?>">

				<label class="control-label">Texte</label>
				<textarea data-UUID="0008" id="ckeditor" name="texte" ><?php echo $donneesPageBan['texte'];?></textarea>

				<iframe id="iframeBan" style="width:100%;height:900px;display:none;margin-top:20px;border:1px #d4dadf;cursor:pointer;" title=""  src="./index.php?banPreview"></iframe>
            </div>
            <script>initPost("pageBan", "admin.php?action=pageBan",function(data) { if(data) { get('iframeBan').src = get('iframeBan').src;}});</script>
			<div class="card-footer">
				<div class="row text-center">
					<input type="button" onclick="SwitchDisplay(get('iframeBan'));"class="btn btn-secondary w-100" value="Prévisualisation" />
					<input type="submit" onclick="sendPost('pageBan');"class="btn btn-success w-100" value="Modifier !" />
				</div>
			</div>
        </div>
    </div>
	<?php } ?>
</div>
<br/>
	<?php 
	}
?>