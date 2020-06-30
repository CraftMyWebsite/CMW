<?php echo '[DIV]'; 
if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['home']['showPage'] == true) {
    $lectureAccueil = new Lire('modele/config/accueil.yml');
    $lectureAccueil = $lectureAccueil->GetTableau();


    $pagesReq = $bddConnection->query('SELECT titre FROM cmw_pages');
    $i = 0;
    while($pagesDonnees = $pagesReq->fetch(PDO::FETCH_ASSOC))
    {
       $pages[$i] = $pagesDonnees['titre'];
       $i++;
   }
   $pages[$i] = 'boutique';
    $i++;
    $pages[$i] = 'voter';
    $i++;
    $pages[$i] = 'tokens';
    $i++;
    $pages[$i] = 'forum';
    $i++;
    $pages[$i] = 'support';
    ?>
					<ul class="nav nav-tabs" id="list-minia">
                        <?php for($i = 1;$i < count($lectureAccueil['Infos']) + 1;$i++) {?>
                            <li class="nav-item"  id="tabnavRap<?=$i?>"><a href="#navRap<?=$i?>" class="nav-link <?php if($i == 1) echo 'active'; ?>"  data-toggle="tab" style="color: black !important">Miniature #<?=$i?></a></li>
                        <?php }?>
                        </ul>
                        
                        <div class="tab-content">
                        <?php for($i = 1;$i < count($lectureAccueil['Infos']) + 1;$i++) {?>
                            <div class="tab-pane well<?php if($i == 1) echo ' active'?>" id="navRap<?=$i?>" style="margin-top:10px;">
                                <div style="width: 100%;display: inline-block">
                                    <div class="float-left">
                                        <h3>Miniature #<?=$i?></h3>
                                    </div>
                                  
                                </div>
                                <div class="row">
                                    <img class="col-md-6 thumbnail" src="theme/upload/navRap/<?php echo $lectureAccueil['Infos'][$i]['image']; ?>"/>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Message</label>
                                            <textarea class="form-control" placeholder="Petit message qui se situera en dessous de l'image ^^" rows="3" name="message<?=$i?>"><?php echo $lectureAccueil['Infos'][$i]['message']; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-9">
                                        <label class="control-label">Image</label>
                                        <select class="form-control" name="image<?=$i?>">
                                        <?php for($j = 2;$j < count($images);$j++) { ?>
                                        <option value="<?php echo $images[$j]; ?>"<?php if($images[$j] == $lectureAccueil['Infos'][$i]['image']) echo " selected"?>><?php echo $images[$j]; ?></option>
                                        <?php } ?>       
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <label class="control-label">Ordre</label>
                                        <input type="number" name="ordre<?=$i?>" class="form-control" max="<?= count($lectureAccueil['Infos']) + 1 ?>" min="1" value="<?=$i?>" required>
                                    </div>
                                </div>
                                
                                <br></br>   
    
                                <div class="custom-control custom-radio">
                                    <input type="radio"  name="typeLien<?=$i?>" value="page" id="radiopage<?=$i?>" class="custom-control-input" onclick="document.getElementById('lienpage<?=$i?>').style.display='block';document.getElementById('lienurl<?=$i?>').style.display='none';" <?php if($lectureAccueil['Infos'][$i]['type'] == "page") { echo 'checked'; } ?>>
                                    <label class="custom-control-label" for="radiopage<?=$i?>">Je souhaite rediriger vers une page existante</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input type="radio"  name="typeLien<?=$i?>" value="lien" id="radiolien<?=$i?>" onclick="document.getElementById('lienpage<?=$i?>').style.display='none';document.getElementById('lienurl<?=$i?>').style.display='block';" class="custom-control-input" <?php if($lectureAccueil['Infos'][$i]['type'] == "lien") { echo 'checked'; } ?>>
                                    <label class="custom-control-label" for="radiolien<?=$i?>">Je souhaite rediriger vers un lien personnalisé</label>
                                </div>

                                <hr></hr>

                                <select name="page<?=$i?>" class="form-control" id="lienpage<?=$i?>" <?php if($lectureAccueil['Infos'][$i]['type'] == "lien") { echo 'style="display:none;"'; } ?>>
                                    <?php $j = 0;
                                    while($j < count($pages)) { ?>
                                    <option value="<?php echo $pages[$j]; ?>" <?php  if($lectureAccueil['Infos'][$i]['type'] == "page" && $pages[$j] == $pageActive[$i]) { echo 'selected';}?>><?php echo $pages[$j]; ?></option>
                                    <?php $j++; } ?>
                                </select>

                                <input type="text" class="form-control" id="lienurl<?=$i?>"<?php if($lectureAccueil['Infos'][$i]['type'] == "lien") echo 'value="'.$lectureAccueil['Infos'][$i]['lien'].'"'; ?> name="lien<?=$i?>" placeholder="URL ex: https://google.com" <?php if($lectureAccueil['Infos'][$i]['type'] == "page") { echo 'style="display:none;"'; } ?> />

                               
                            </div>

                        <?php } ?>
                        </div>
<?php } ?>              