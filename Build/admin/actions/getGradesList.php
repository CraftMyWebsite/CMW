<?php echo '[DIV]';  if($_Permission_->verifPerm("createur"))
{
	require_once('./admin/donnees/grades.php'); ?>

	<ul class="nav nav-tabs">
						<li class="nav-item"><a href="#gradeCreateur" id="default-name-createur-2" class="nav-link active" style="color: black !important" data-toggle="tab"><?php echo $_Serveur_['General']['createur']['nom']; ?></a></li>
						<?php for($i = 2; $i <= max($lastGrade); $i++) { 
                            if(file_exists($dirGrades.$i.'.yml')) { ?>
                                <li class="nav-item" id="tabgrade<?php echo $i; ?>"><a href="#grade<?php echo $i; ?>" class="nav-link"  id="grade-name-<?php echo $i; ?>" style="color: black !important"  data-toggle="tab"><?php echo $idGrade[$i]['Grade']; ?></a></li>
                            <?php }
                        } ?>
						<li class="nav-item"><a href="#gradeJoueur" id="default-name-joueur-2" class="nav-link"  style="color: black !important" data-toggle="tab"><?php echo $_Serveur_['General']['joueur']; ?></a></li>
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
                            <input maxlength="32" minlength="3" class="form-control" onkeyup="get('default-name-createur-1').innerText = get('default-name-createur-2').innerText = get('grade').innerText = this.value;" name="nomCreateur" type="text"  value="<?=$_Serveur_['General']['createur']['nom'];?>" />

                            <label class="control-label">Couleur du Grade</label>
                            <?php for($a = 0; $a < count($prefixs); $a++) {  ?>
                                <label class="checkbox-inline">
									<input class="form-check-input" type="radio" name="prefixCreateur" value="<?=$prefixs[$a];?>" <?=($_Serveur_['General']['createur']['prefix'] == $prefixs[$a]) ? 'checked' : ''; ?>>
									<span class="prefix <?=$prefixs[$a];?>" style="height: 10px; width: 15px;"></span>
								</label>
                            <?php } ?>
                            <br/>
                            <label class="control-label">Effets</label>
                            <?php for($a =0; $a < count($effets); $a++) { ?>
                                <label class="checkbox-inline">
									<input class="form-check-input" type="radio" name="effetCreateur"  value="<?=$effets[$a];?>"  <?=($_Serveur_['General']['createur']['effets'] == $effets[$a]) ? 'checked' : ''; ?>>
									<span class="username <?=$effets[$a];?>">Test</span>
								</label>
							<?php } ?>
						</div>
						<?php for($i = 2; $i <= max($lastGrade); $i++) { if(file_exists($dirGrades.$i.'.yml')) { ?>
							<div class="tab-pane well" id="grade<?php echo $i; ?>">
								<div style="width: 100%;display: inline-block">
                                    <div class="float-left">
                                        <h3 id="grade-name2-<?php echo $i; ?>"><?php echo $idGrade[$i]['Grade']; ?></h3>
                                    </div>
                                    <div class="float-right">
                                        <button  onclick="sendDirectPost('admin.php?action=supprGrade&id=<?php echo $i; ?>', function(data) { if(data) { hide('grade<?php echo $i; ?>'); hide('tabgrade<?php echo $i; ?>'); } });" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                                    </div>
                                </div>
                                <label class="control-label">Nom du grade</label>
                                <input class="form-control"  onkeyup="get('grade-name2-<?php echo $i; ?>').innerText = get('grade-name-<?php echo $i; ?>').innerText = this.value;" name="gradeName<?php echo $i; ?>" type="text"  value="<?php echo $idGrade[$i]['Grade']; ?>" placeholder="Modérateur"/>

                                <label class="control-label">Couleur du Grade</label>
	                            <?php for($a = 0; $a < count($prefixs); $a++) {  ?>
	                                <label class="checkbox-inline">
										<input class="form-check-input" type="radio" name="prefix<?=$i;?>" value="<?=$prefixs[$a];?>" <?=($idGrade[$i]['prefix'] == $prefixs[$a]) ? 'checked' : ''; ?>>
										<span class="prefix <?=$prefixs[$a];?>" style="height: 10px; width: 15px;"></span>
									</label>
	                            <?php } ?>
	                            <br/>
	                            <label class="control-label">Effets</label>
	                            <?php for($a =0; $a < count($effets); $a++) { ?>
	                                <label class="checkbox-inline">
										<input class="form-check-input" type="radio" name="effet<?=$i;?>"  value="<?=$effets[$a];?>"  <?=($idGrade[$i]['effets'] == $effets[$a]) ? 'checked' : ''; ?>>
										<span class="username <?=$effets[$a];?>">Test</span>
									</label>
								<?php } ?>

								<br/>
								<hr/>
								<div style="width: 100%;display: inline-block">
                                    <div class="float-left">
                                        <h5>Permissions:</h3>
                                    </div>
                                </div>


								<?php $allPerm = $_Permission_->readPerm($i);
								//showForFormatage($allPerm, ""); ne pas toucher ...
								writePerm($allPerm, 20, "", $i, $idGrade, $PermissionFormat); ?>
							</div>
						<?php } } ?>
	                </div>
<?php } ?>