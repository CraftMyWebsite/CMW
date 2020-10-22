<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h2 class="h2 gray">
		Gestion des grades du site
	</h2>
</div>
<?php if(!$_Permission_->verifPerm("createur"))
{ ?>
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="alert alert-danger">
				<strong>Vous avez aucune permission pour accéder aux réglages des grades.</strong>
			</div>
		</div>
	</div>
<?php }
else
	{
		?>
    <div class="alert alert-success">
   		<strong>Vous pouvez ajouter autant de grades que vous le souhaitez pour votre site. Grâce à une toute nouvelle fonctionnalité vous pouvez dorénavant modifier/ajouter des permissions à tous vos grades créés. Cependant, les grades par défaut (Créateur et Joueur) ne peuvent pas être modifiés par sécurité.<br>L'accès à cette fonctionnalité est réservée aux Créateurs.</strong>
    </div>
    <div class="alert alert-warning">
        <strong>ATTENTION<br>Certains hébergeurs bloquent la création automatique des grades.</strong>
     </div>

	 <div class="row">

		<div class="col-md-12 col-xl-6 col-12">
			<div class="card  ">
				<div class="card-header ">
					<h3 class="card-title"><strong>Création d'un grade</strong></h3>
				</div>
				<div class="card-body" id="addGrade">


                <label class="control-label">Nom du grade</label>
                <input type="text" maxlength="32" minlength="3" name="gradeName" class="form-control" placeholder="Support" required/>
	            </div>

	            <script>initPost("addGrade", "admin.php?&action=addGrade",function(data) { if(data) { gradesUpdate(); }});</script>

	            <div class="card-footer">
	                <div class="row text-center">
	                    <input type="submit" onclick="if(checkGrade()){ sendPost('addGrade', null);}" class="btn btn-success w-100"
	                        value="Envoyer !" />
	                </div>
	            </div>
	        </div>
	   	</div>

	   	<div class="col-md-12 col-xl-6 col-12">
			<div class="card  ">
				<div class="card-header ">
					<h3 class="card-title"><strong>Édition des grades</strong></h3>
				</div>
				<div class="card-body" id="allGrade">
					<ul class="nav nav-tabs">
						<li class="nav-item"><a href="#gradeCreateur" data-grade id="default-name-createur-2" class="nav-link active" style="color: black !important" data-toggle="tab"><?php echo $_Serveur_['General']['createur']['nom']; ?></a></li>
						<?php for($i = 0; $i < count($idGrade); $i++) { 
                            ?>
                                <li class="nav-item" id="tabgrade<?php echo $i; ?>"><a href="#grade<?php echo $i; ?>" class="nav-link"  id="grade-name-<?php echo $i; ?>" style="color: black !important"  data-grade data-toggle="tab"><?php echo $idGrade[$i]['nom']; ?></a></li>
                        <?php  } ?>
						<li class="nav-item"><a href="#gradeJoueur" id="default-name-joueur-2" class="nav-link"  style="color: black !important" data-grade data-toggle="tab"><?php echo $_Serveur_['General']['joueur']; ?></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane well" id="gradeJoueur">
							<div style="width: 100%;display: inline-block">
                                <div class="float-left">
                                    <h3 id="default-name-joueur-1"><?=$_Serveur_['General']['joueur'];?></h3>
                                </div>
                            </div>
	                        <label class="control-label">Nom du grade</label>
	                        <input maxlength="32" minlength="3" onkeyup="get('default-name-joueur-1').innerText = get('default-name-joueur-2').innerText = this.value;" class="form-control" name="nom" type="text" value="<?=$_Serveur_['General']['joueur'];?>" required/>
	                    </div>

	                    <div class="tab-pane active well" id="gradeCreateur">
	                    	<div style="width: 100%;display: inline-block">
                                <div class="float-left">
                                    <h3 id="default-name-createur-1"><?=$_Serveur_['General']['createur']['nom'];?></h3>
                                </div>
                            </div>

                            <label class="control-label">Nom du grade</label>
                            <input maxlength="32" minlength="3" class="form-control" onkeyup="get('default-name-createur-1').innerText = get('default-name-createur-2').innerText = get('grade').innerText = get('previsuCrea').innerText = this.value;" name="nomCreateur" type="text"  value="<?=$_Serveur_['General']['createur']['nom'];?>" />

                            <label class="control-label">Couleur d'arrière plan du grade</label>
                            <input type="color" name="prefixCreateur" id="prefixCrea" onchange="updatePrevisu('Crea');" value="<?=$_Serveur_['General']['createur']['bg'];?>" />
                            <input type="checkbox" <?=(empty($_Serveur_['General']['createur']['bg'])) ? "checked" : "";?> name="prefixCreateur-none" id="prefixCrea-none" onchange="updatePrevisu('Crea');" />Pas d'arrière plan
                            <br/>

                            <label class="control-label">Couleur d'écriture du grade</label>
                            <input type="color" name="couleurCreateur" id="couleurCrea" onchange="updatePrevisu('Crea');" value="<?=(empty($_Serveur_['General']['createur']['couleur'])) ? "#000000" : $_Serveur_['General']['createur']['couleur'];?>" />

                            <br/>
                            <label class="control-label">Prévisulation : <span id="previsuCrea" class="prefix <?=$_Serveur_['General']['createur']['effets'];?>" style="background-color: <?=$_Serveur_['General']['createur']['bg'];?>; color: <?=(empty($_Serveur_['General']['createur']['couleur'])) ? "#000000" : $_Serveur_['General']['createur']['couleur'];?>"><?=$_Serveur_['General']['createur']['nom'];?></span>
                            <div id="effetsCrea">
                            	<label class="control-label">Effets</label>
	                            <?php for($a =0; $a < count($effets); $a++) { ?>
	                                <label class="checkbox-inline">
										<input class="form-check-input" type="radio" name="effetCreateur" onchange="updatePrevisu('Crea');" value="<?=$effets[$a];?>"  <?=($_Serveur_['General']['createur']['effets'] == $effets[$a]) ? 'checked' : ''; ?>>
										<span class="username <?=$effets[$a];?>">Test</span>
									</label>
								<?php } ?>
								<label class="checkbox-inline">
									<input class="form-check-input" type="radio" name="effetCreateur" onchange="updatePrevisu('Crea');" value="" <?=($_Serveur_['General']['createur']['effets'] == "") ? "checked" : "";?>/>Pas d'effet
								</label>
							</div>
						</div>
						<?php
						for($i = 0; $i < count($idGrade); $i++) { ?>
							<div class="tab-pane well" id="grade<?php echo $i; ?>">
								<div style="width: 100%;display: inline-block">
                                    <div class="float-left">
                                        <h3 id="grade-name2-<?php echo $i; ?>"><?php echo $idGrade[$i]['nom']; ?></h3>
                                    </div>
                                    <div class="float-right">
                                        <button  onclick="sendDirectPost('admin.php?action=supprGrade&id=<?php echo $idGrade[$i]['id']; ?>', function(data) { if(data) { hide('grade<?php echo $i; ?>'); hide('tabgrade<?php echo $i; ?>'); } });" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                                    </div>
                                </div>
                                <label class="control-label">Nom du grade</label>
                                <input class="form-control"  onkeyup="get('grade-name2-<?php echo $i; ?>').innerText = get('grade-name-<?php echo $i; ?>').innerText = get('previsu<?=$i;?>').innerText = this.value;" name="gradeName<?php echo $i; ?>" type="text"  value="<?php echo $idGrade[$i]['nom']; ?>" placeholder="Modérateur"/>

                                <label class="control-label">Couleur d'arrière plan du grade</label>
	                            <input type="color" name="prefix<?=$i;?>" id="prefix<?=$i;?>" onchange="updatePrevisu('<?=$i;?>');" value="<?=(empty($idGrade[$i]['prefix'])) ? "#000000" : $idGrade[$i]['prefix'];?>" />
	                            <input type="checkbox" name="prefix<?=$i;?>-none" <?=(empty($idGrade[$i]['prefix'])) ? "checked" : "";?> id="prefix<?=$i;?>-none" onchange="updatePrevisu('<?=$i;?>');" />Pas d'arrière plan
	                            <br/>

	                            <label class="control-label">Couleur d'écriture du grade</label>
	                            <input type="color" name="couleur<?=$i;?>" id="couleur<?=$i;?>" onchange="updatePrevisu('<?=$i;?>');" value="<?=(empty($idGrade[$i]['couleur'])) ? "#000000" : $idGrade[$i]['couleur'];?>" />

	                            <br/>
	                            <label class="control-label">Prévisulation : <span id="previsu<?=$i;?>" class="prefix <?=$idGrade[$i]['effets'];?>" style="background-color: <?=$idGrade[$i]['prefix'];?>; color: <?=(empty($idGrade[$i]['couleur'])) ? "#000000" : $idGrade[$i]['couleur'];?>"><?=$idGrade[$i]['nom'];?></span>
	                            <div id="effets<?=$i;?>">
	                            	<label class="control-label">Effets</label>
		                            <?php for($a =0; $a < count($effets); $a++) { ?>
		                                <label class="checkbox-inline">
											<input class="form-check-input" type="radio" name="effet<?=$i;?>" onchange="updatePrevisu('<?=$i;?>');" value="<?=$effets[$a];?>"  <?=($idGrade[$i]['effets'] == $effets[$a]) ? 'checked' : ''; ?>>
											<span class="username <?=$effets[$a];?>">Test</span>
										</label>
									<?php } ?>
									<label class="checkbox-inline">
										<input type="radio" class="form-check-input" name="effet<?=$i;?>" onchange="updatePrevisu('<?=$i;?>');" value="" <?=($idGrade[$i]['effets'] == "") ? "checked" : "";?>/> Pas d'effets
									</label>
								</div>

								<br/>
								<hr/>
								<div style="width: 100%;display: inline-block">
                                    <div class="float-left">
                                        <h5>Permissions:</h3>
                                    </div>
                                </div>


								<?php 
								$allPerm = $_Permission_->readPerm($idGrade[$i]['id']);
								//showForFormatage($allPerm, ""); ne pas toucher ...
								writePerm($allPerm, 20, "", $i, $idGrade, $PermissionFormat); ?>
							</div>
						<?php } ?>
	                </div>
	            </div>
	            <script>initPost("allGrade", "admin.php?&action=editGrade");</script>

	            <div class="card-footer">
	                <div class="row text-center">
	                    <input type="submit" onclick="sendPost('allGrade'); " class="btn btn-success w-100"
	                        value="Valider les changements !" />
	                </div>
	            </div>
	        </div>
	   	</div>

	</div>
<?php }
?>