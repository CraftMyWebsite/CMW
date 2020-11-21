

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
		Réglages Forum
	</h2>
</div>
<?php if(!$_Permission_->verifPerm('PermsPanel', 'forum', 'showPage'))
{ ?>
	<div class="col-lg-6 col-lg-offset-3 text-center">
		<div class="alert alert-danger">
			<strong>Vous avez aucune permission pour accéder aux réglages de cette page.</strong>
		</div>
	</div>
<?php }  else { ?>
<div class="alert alert-success">
	<strong>Sur cette section, vous pouvez gérer tout votre forum.</strong>
</div>

<div class="row">
<?php if($_Permission_->verifPerm('PermsPanel', 'forum', 'actions', 'addPrefix')) { ?>
	<div class="col-md-12 col-xl-6 col-12">
		<div class="card">
			<div class="card-header ">
				<h3 class="card-title"><strong>Ajout de préfixe</strong></h3>
			</div>
			<div class="card-body" id="addPref">
				<label class="control-label">Nom du préfix (Important, Acceptée, Refusée, ...)</label>
				<input type="text" name="nom" class="form-control" maxlength="40">
								<label class="control-label">Couleur à utiliser :</label>
									<label class="checkbox-inline">
									  <input class="form-check-input" type="radio" name="prefix" id="prefixPrimary" value="prefixPrimary" checked>
									    <span class="prefix prefixPrimary" style="height: 10px; width: 15px;"></span>
									</label>
									<label class="checkbox-inline">
									  <input class="form-check-input" type="radio" name="prefix" id="prefixSecondary" value="prefixSecondary">
									    <span class="prefix prefixSecondary" style="height: 10px; width: 15px;"></span>
									</label>
									<label class="checkbox-inline">
									  <input class="form-check-input" type="radio" name="prefix" id="prefixRed" value="prefixRed">
									    <span class="prefix prefixRed" style="height: 10px; width: 15px;"></span>
									</label>
									<label class="checkbox-inline">
									  <input class="form-check-input" type="radio" name="prefix" id="prefixGreen" value="prefixGreen" >
									    <span class="prefix prefixGreen" style="height: 10px; width: 15px;"></span>
									</label>
									<label class="checkbox-inline">
									  <input class="form-check-input" type="radio" name="prefix" id="prefixOlive" value="prefixOlive" >
									    <span class="prefix prefixOlive" style="height: 10px; width: 15px;"></span>
									</label>
									<label class="checkbox-inline">
									  <input class="form-check-input" type="radio" name="prefix" id="prefixLightGreen" value="prefixLightGreen" >
									    <span class="prefix prefixLightGreen" style="height: 10px; width: 15px;"></span>
									</label>
									<label class="checkbox-inline">
									  <input class="form-check-input" type="radio" name="prefix" id="prefixBlue" value="prefixBlue" >
									    <span class="prefix prefixBlue" style="height: 10px; width: 15px;"></span>
									</label>
									<label class="checkbox-inline">
									  <input class="form-check-input" type="radio" name="prefix" id="prefixRoyalBlue" value="prefixRoyalBlue" >
									    <span class="prefix prefixRoyalBlue" style="height: 10px; width: 15px;"></span>
									</label>
									<label class="checkbox-inline">
									  <input class="form-check-input" type="radio" name="prefix" id="prefixSkyBlue" value="prefixSkyBlue" >
									    <span class="prefix prefixSkyBlue" style="height: 10px; width: 15px;"></span>
									</label>
									<label class="checkbox-inline">
									  <input class="form-check-input" type="radio" name="prefix" id="prefixGray" value="prefixGray" >
									    <span class="prefix prefixGray" style="height: 10px; width: 15px;"></span>
									</label>
									<label class="checkbox-inline">
									  <input class="form-check-input" type="radio" name="prefix" id="prefixSilver" value="prefixSilver" >
									    <span class="prefix prefixSilver" style="height: 10px; width: 15px;"></span>
									</label>
									<label class="checkbox-inline">
									  <input class="form-check-input" type="radio" name="prefix" id="prefixYellow" value="prefixYellow" >
									    <span class="prefix prefixYellow" style="height: 10px; width: 15px;"></span>
									</label>
									<label class="checkbox-inline">
									  <input class="form-check-input" type="radio" name="prefix" id="prefixOrange" value="prefixOrange" >
									    <span class="prefix prefixOrange" style="height: 10px; width: 15px;"></span>
									</label>
            </div>
            <script>initPost("addPref", "admin.php?action=addPrefix",function(data) { if(data) { 
            	let st = "";
            		st+= "<tr>";
            		st+= "<td>"+ getValueByName("addPref", "nom")+"</td>";
            		st+= "<td><span class='prefix "+getValueByName("addPref", "prefix")+"' style='height: 10px; width: 20px;'></span></td>";
            		st+= "<td><span class='prefix "+getValueByName("addPref", "prefix")+"'>"+ getValueByName("addPref", "nom")+"</span></td>";
            		st+= "<td></td>";
            		st+= "</tr>";
            	get('allprefix').innerHTML += st;
            }}); </script>
			<div class="card-footer">
				<div class="row text-center">
					<input type="submit" onclick="sendPost('addPref');"class="btn btn-success w-100" value="Modifier !" />
				</div>
			</div>
        </div>
   	</div>
<?php } if($_Permission_->verifPerm('PermsPanel', 'forum', 'actions', 'seePrefix')) { ?>
	<div class="col-md-12 col-xl-6 col-12">
		<div class="card">
			<div class="card-header ">
				<h3 class="card-title"><strong>Edition des préfixes</strong></h3>
			</div>
			<div class="card-body">
				<table class="table table-striped table-hover">
					<thead>
                        <tr>
                            <th>Nom</th>
                            <th>Attributs</th>
                            <th>Rendu</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="allprefix">
                    <?php 
                    while($data = $reqPrefix->fetch(PDO::FETCH_ASSOC))
                    {
                    	?><tr id="prefix<?=$data['id'];?>">
                    		<td><?=$data['nom'];?></td>
                    		<td><span class="<?php echo $data['span'];?>" style="height: 10px; width: 20px;"></span></td>
                    		<td><span class="<?=$data['span'];?>"><?=$data['nom'];?></span></td>
                    		<td><button onclick="sendDirectPost('admin.php?action=supprPrefix&id=<?=$data['id'];?>', function(data) { if(data) { hide('prefix<?=$data['id'];?>')}});" class="btn btn-danger">Supprimer</button></td>
                    	</tr><?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
   	</div>
<?php }  ?>
</div>
<?php } ?>