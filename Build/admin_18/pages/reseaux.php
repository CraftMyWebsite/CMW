<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
		Gestion - Champs personnalisable
	</h2>
</div>
<?php if(!Permission::getInstance()->verifPerm('Permscard', 'social', 'showPage'))
{
	echo '
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-danger">
					<strong>Vous avez aucune permission pour accéder aux réseaux sociaux</strong>
				</div>
			</div>
		</div>
	';
}
else
{
?><div class="alert alert-success">
	<strong>Sur cette section, vous pouvez gérer les réseaux sociaux que peuvent rentrer vos membres, et voir leurs réseaux sociaux.</strong>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="card   ">
			<div class="card-header">
				<h3 class="card-title"><strong>Liste des réseaux sociaux ajoutés</strong></h3>
			</div>
			<div class="card-body">
				<div class="row">
					<table class="table table-striped table-hover">
						<thead>
						<tr>
							<th style="width: 95%;">Nom</th>
							<th></th>
						</tr>
						</thead>
						<tbody id="cont-res">
						<?php foreach($donneesSocial as $value)
						{
							?><tr id="removeSocial&nom=<?=$value['nom'];?>">
								<td><?=ucfirst($value['nom']);?></td>
								<td><button type="button" onclick="sendPost('removeSocial&nom=<?=$value['nom'];?>');" class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
								<script>initPost("removeSocial&nom=<?=$value['nom'];?>", "admin.php?action=removeSocial&nom=<?=$value['nom'];?>",function (data) { if(data) {  document.getElementById('removeSocial&nom=<?=$value['nom'];?>').style.display='none';}});</script>
							</tr><?php 
						}
						?>
						</tbody>
					</table>
				</div>
            </div>
        </div>
   	</div>
   	<div class="col-md-6">
		<div class="card   ">
			<div class="card-header">
				<h3 class="card-title"><strong>Ajouter un réseau</strong></h3>
			</div>
			<div class="card-body" id="addSocial">
					<div class="row">
						<div class="col-md-12">
							<label class="control-label">Nom du réseau</label>
							<input type="text" name="nom" class="form-control" maxlength="30">

						</div>
	                </div>

            </div>
            <div class="card-footer">
            	 <script>initPost("addSocial", "admin.php?action=addSocial",function (data) { if(data) { 
                    document.getElementById('cont-res').innerHTML+='<tr><td>'+getValueByName("addSocial","nom")+'</td><td></td></tr>';clearAllInput('addSocial');
                    }});</script>
                <input type="submit" onclick="sendPost('addSocial')" class="btn btn-success w-100" value="Ajouter le réseau social !" />
            </div>
        </div>
   	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card   ">
			<div class="card-header">
				<h3 class="card-title"><strong>Réseaux sociaux de vos membres</strong></h3>
			</div>
			<div class="card-body">
				<table class="table table-striped table-hover">
					<thead>
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
					</thead>
					<tbody>
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
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<br/>
<?php } ?>
