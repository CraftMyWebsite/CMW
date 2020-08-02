<div class="cmw-page-content-header"><strong>Réglages Forum</strong> - Paramétrez votre Forum</div>

<div class="row">
	<?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'forum', 'showPage') AND !Permission::getInstance()->verifPerm('PermsPanel', 'forum', 'actions', 'addSmiley'))
	{
		echo '<div class="col-lg-6 col-lg-offset-3 text-center">
		<div class="alert alert-danger">
			<strong>Vous avez aucune permission pour accéder aux réglages de la boutique.</strong>
		</div>
	</div>';
	}
	else
	{
		?><div class="alert alert-success">
			<strong>Sur cette section, vous pouvez gérer tout votre forum, créer des smileys unique.</strong>
		</div>
	<?php 
	}
	if(Permission::getInstance()->verifPerm('PermsPanel', 'forum', 'actions', 'addSmiley'))
	{
		?><form method="POST" action="?action=addSmiley" enctype="multipart/form-data">
			<div class="col-lg-6">
				<div class="panel panel-default cmw-panel">
					<div class="panel-heading cmw-panel-header">
						<h3 class="panel-title"><strong>Ajout de Smiley</strong></h3>
					</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="row">
								<label class="control-label">Symbole à utiliser sur le forum : (exemple : :D, :), :p, :vladort qui dort: )</label>
								<input type="text" name="symbole" class="form-control" maxlength="20">
							</div>
							<div class="row">
								<label class="control-label">Fichier smiley, la taille ne sera pas réduite sur le forum ! Il est donc vivement conseillé de ne pas dépasser du 32x32. (Les smileys actuels sont en 18x18 pour les basiques).
		                        <input type="file" id="file" name="image" class="custom-file-input">
		                        <span class="custom-file-control"></span>
		                        </label>
		                   	</div>
		                   	<hr/>
		                   	<div class="row text-center">
		                   		<input type="submit" class="btn btn-success" value="Ajouter le smiley !" />
		                   	</div>
		                </div>
		            </div>
		        </div>
		    </div>
		</form><?php
	}
	if(Permission::getInstance()->verifPerm('PermsPanel', 'forum', 'actions', 'addPrefix'))
	{
		?><form method="POST" action="?action=addPrefix">
			<div class="col-lg-6">
				<div class="panel panel-default cmw-panel">
					<div class="panel-heading cmw-panel-header">
						<h3 class="panel-title"><strong>Ajout de préfixe</strong></h3>
					</div>
					<div class="panel-body">
						<div class="col-md-12">
							<div class="row">
								<label class="control-label">Nom du préfix (Important, Acceptée, Refusée, ...)</label>
								<input type="text" name="nom" class="form-control" maxlength="40">
							</div>
							<div class="row">
								<label>Couleur à utiliser :</label>
								<label class="checkbox-inline">
								  <input class="form-check-input" type="radio" name="prefix" id="prefixPrimary" value="prefixPrimary" checked>
								    <span class="prefix prefixPrimary" style="height: 10px; width: 5px;"></span>
								</label>
								<label class="checkbox-inline">
								  <input class="form-check-input" type="radio" name="prefix" id="prefixSecondary" value="prefixSecondary">
								    <span class="prefix prefixSecondary" style="height: 10px; width: 5px;"></span>
								</label>
								<label class="checkbox-inline">
								  <input class="form-check-input" type="radio" name="prefix" id="prefixRed" value="prefixRed">
								    <span class="prefix prefixRed" style="height: 10px; width: 5px;"></span>
								</label>
								<label class="checkbox-inline">
								  <input class="form-check-input" type="radio" name="prefix" id="prefixGreen" value="prefixGreen" >
								    <span class="prefix prefixGreen" style="height: 10px; width: 5px;"></span>
								</label>
								<label class="checkbox-inline">
								  <input class="form-check-input" type="radio" name="prefix" id="prefixOlive" value="prefixOlive" >
								    <span class="prefix prefixOlive" style="height: 10px; width: 5px;"></span>
								</label>
								<label class="checkbox-inline">
								  <input class="form-check-input" type="radio" name="prefix" id="prefixLightGreen" value="prefixLightGreen" >
								    <span class="prefix prefixLightGreen" style="height: 10px; width: 5px;"></span>
								</label>
								<label class="checkbox-inline">
								  <input class="form-check-input" type="radio" name="prefix" id="prefixBlue" value="prefixBlue" >
								    <span class="prefix prefixBlue" style="height: 10px; width: 5px;"></span>
								</label>
								<label class="checkbox-inline">
								  <input class="form-check-input" type="radio" name="prefix" id="prefixRoyalBlue" value="prefixRoyalBlue" >
								    <span class="prefix prefixRoyalBlue" style="height: 10px; width: 5px;"></span>
								</label>
								<label class="checkbox-inline">
								  <input class="form-check-input" type="radio" name="prefix" id="prefixSkyBlue" value="prefixSkyBlue" >
								    <span class="prefix prefixSkyBlue" style="height: 10px; width: 5px;"></span>
								</label>
								<label class="checkbox-inline">
								  <input class="form-check-input" type="radio" name="prefix" id="prefixGray" value="prefixGray" >
								    <span class="prefix prefixGray" style="height: 10px; width: 5px;"></span>
								</label>
								<label class="checkbox-inline">
								  <input class="form-check-input" type="radio" name="prefix" id="prefixSilver" value="prefixSilver" >
								    <span class="prefix prefixSilver" style="height: 10px; width: 5px;"></span>
								</label>
								<label class="checkbox-inline">
								  <input class="form-check-input" type="radio" name="prefix" id="prefixYellow" value="prefixYellow" >
								    <span class="prefix prefixYellow" style="height: 10px; width: 5px;"></span>
								</label>
								<label class="checkbox-inline">
								  <input class="form-check-input" type="radio" name="prefix" id="prefixOrange" value="prefixOrange" >
								    <span class="prefix prefixOrange" style="height: 10px; width: 5px;"></span>
								</label>
		                   	</div>
		                   	<hr/>
		                   	<div class="row text-center">
		                   		<input type="submit" class="btn btn-success" value="Ajouter le préfix !" />
		                   	</div>
		                </div>
		            </div>
		        </div>
		    </div>
		</form><?php
	}
	?></div>
	<div class="row">
	<?php
	if(Permission::getInstance()->verifPerm('PermsPanel', 'forum', 'actions', 'seeSmileys'))
	{
		?><div class="col-md-6">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Edition des Smileys</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <h3 class="text-center">Gestion des Smileys</h3>
                    </div>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Symbole</th>
                            <th>Images</th>
                            <th>Lien</th>
                            <th>Action</th>
                        </tr>
                    <?php 
                    $reqSmileys = $bddConnection->query('SELECT id, symbole, image FROM cmw_forum_smileys ORDER BY priorite DESC');
                    while($data = $reqSmileys->fetch(PDO::FETCH_ASSOC))
                    {
                    	?><tr>
                    		<td><?=$data['symbole'];?></td>
                    		<td><img src="./<?=$data['image'];?>" /></td>
                    		<td><?=$data['image'];?></td>
                    		<td><a href="?action=supprSmiley&id=<?=$data['id'];?>&image=<?=$data['image'];?>" class="btn btn-danger">Supprimer</a></td>
                    	</tr><?php
                    }
                    ?>
               		</table>
               	</div>
            </div>
        </div><?php
	}
	if(Permission::getInstance()->verifPerm('PermsPanel', 'forum', 'actions', 'seePrefix'))
	{
		?><div class="col-md-6">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Edition des préfixes</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <h3 class="text-center">Gestion des préfixes</h3>
                    </div>
                    <table class="table table-striped table-hover">
                        <tr>
                            <th>Nom</th>
                            <th>Attributs</th>
                            <th>Rendu</th>
                            <th>Action</th>
                        </tr>
                    <?php 
                    $reqPrefix = $bddConnection->query('SELECT id, span, nom FROM cmw_forum_prefix ORDER BY id ASC');
                    while($data = $reqPrefix->fetch(PDO::FETCH_ASSOC))
                    {
                    	?><tr>
                    		<td><?=$data['nom'];?></td>
                    		<td><span class="<?php echo $data['span'];?>" style="height: 10px; width: 20px;"></span></td>
                    		<td><span class="<?=$data['span'];?>"><?=$data['nom'];?></span></td>
                    		<td><a href="?action=supprPrefix&id=<?=$data['id'];?>" class="btn btn-danger">Supprimer</a></td>
                    	</tr><?php
                    }
                    ?>
               		</table>
               	</div>
            </div>
        </div><?php
	}
	?>
</div>