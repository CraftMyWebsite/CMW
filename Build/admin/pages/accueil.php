<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Miniatures & Slider
    </h2>
</div>
<?php if(!$_Permission_->verifPerm('PermsPanel', 'home', 'showPage')) { ?>
    <div class="alert alert-danger">
        <strong>Vous n'avez pas la permission pour accéder aux réglages du slider et des miniatures.</strong>
    </div>

<?php } else {?>
<div class="row">
    <?php if($_Permission_->verifPerm('PermsPanel', 'home', 'actions','addMiniature')) { ?>
    <div class="col-md-12 col-xl-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Ajouter une miniature
                </h4>
            </div>
            <div class="card-body" id="changeInfo">
                    <h3 id="miniature-id"> Miniature #<?= count($lectureAccueil['Infos']) + 1 ?> </h3>
                    <div class="form-group">
                        <label class="control-label">Message</label>
                        <textarea class="form-control" placeholder="Petit message qui se situera en dessous de l'image ^^" rows="3" name="message"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-9">
                            <label class="control-label">Image</label>
                            <select class="form-control" name="image">
                            <?php for($j = 2;$j < count($images);$j++) { ?>
                                <option value="<?php echo $images[$j]; ?>"><?php echo $images[$j]; ?></option>
                            <?php } ?>        
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label">Ordre</label>
                            <input type="number" onchange="get('miniature-id').innerText='Miniature #'+this.value" name="ordre" class="form-control" value="<?= count($lectureAccueil['Infos']) + 1 ?>" max="<?= count($lectureAccueil['Infos']) + 1 ?>" min="1" required>
                        </div>
                    </div>
                    <br></br>   

                    <div class="custom-control custom-radio">
                        <input type="radio"  name="typeLien" value="page" id="radiopage" class="custom-control-input" onclick="show('lienpage');hide('lienurl');" checked>
                        <label class="custom-control-label" for="radiopage">Je souhaite rediriger vers une page existante</label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input type="radio"  name="typeLien" value="lien" id="radiolien" onclick="hide('lienpage');show('lienurl');" class="custom-control-input" >
                        <label class="custom-control-label" for="radiolien">Je souhaite rediriger vers un lien personnalisé</label>
                    </div>

                    <hr></hr>

                    <select name="page" class="form-control" id="lienpage" >
                        <?php $j = 0;
                        while($j < count($pages)) { ?>
                        <option value="<?php echo $pages[$j]; ?>" <?php if($j == 0) { echo 'required'; } ?>><?php echo $pages[$j]; ?></option>
                        <?php $j++; } ?>
                    </select>

                    <input type="text" class="form-control" id="lienurl" name="lien" placeholder="URL ex: https://google.com" style="display:none;" >

                    <script>initPost("changeInfo", "admin.php?action=addRapNav",function (data) { if(data) { 
                    show('card-minia');updateCont('admin.php?action=getMiniaList', get('editRapNav'));clearAllInput('changeInfo');initPost("editRapNav", "admin.php?action=editRapNav",null);
                    }});</script>

            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success w-100" onClick="sendPost('changeInfo');">Envoyer!</button>
            </div>
        </div>
    </div>
<?php  } if($_Permission_->verifPerm('PermsPanel', 'home', 'actions','editMiniature')) { ?>
    <div class="col-md-12 col-xl-6 col-12" id="card-minia" <?php if(empty($lectureAccueil['Infos'])) { echo 'style="display:none;"'; } ?>>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                   Modifier une miniature
                </h4>
            </div>
            <div class="card-body" id="editRapNav">
                <div class="col-md-12">
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
                                    <div class="float-right">
                                        <button  onclick="sendPost('suppnavRap<?=$i?>');" class="btn btn-sm btn-outline-secondary">Supprimer</button>
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
                                    <input type="radio"  name="typeLien<?=$i?>" value="page" id="radiopage<?=$i?>" class="custom-control-input" onclick="show('lienpage<?=$i?>');hide('lienurl<?=$i?>');" <?php if($lectureAccueil['Infos'][$i]['type'] == "page") { echo 'checked'; } ?>>
                                    <label class="custom-control-label" for="radiopage<?=$i?>">Je souhaite rediriger vers une page existante</label>
                                </div>

                                <div class="custom-control custom-radio">
                                    <input type="radio"  name="typeLien<?=$i?>" value="lien" id="radiolien<?=$i?>" onclick="hide('lienpage<?=$i?>');show('lienurl<?=$i?>');" class="custom-control-input" <?php if($lectureAccueil['Infos'][$i]['type'] == "lien") { echo 'checked'; } ?>>
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

                            <script>initPost("suppnavRap<?=$i?>", "admin.php?action=supprMini&id=<?=$i;?>",function (data) { if(data) { hide('navRap<?=$i?>');
                                hide('tabnavRap<?=$i?>');  } });</script>
                        <?php } ?>
                        </div>
                     </div>
            </div>
            <div class="card-footer">
                <script>initPost("editRapNav", "admin.php?action=editRapNav",null);</script>
                <button type="submit" class="btn btn-success w-100" onClick="sendPost('editRapNav')">Envoyer!</button>
            </div>
        </div>
        
    </div>
    <?php } if($_Permission_->verifPerm('PermsPanel', 'home','actions', 'uploadMiniature')) { ?>
    <div class="col-md-12 col-xl-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Uploader une miniature (Dans: <code>theme/upload/navRap/</code>)
                </h4>
            </div>
            <form method="POST" action="?&action=postNavRap" enctype="multipart/form-data">
                <div class="card-body" id="">
                    <div class="input-group file-input-group" style="margin-top:10px;">
                      <input class="form-control" id="file-text" type="text" placeholder="Aucun fichier séléctioner" readonly>
                      <input type="file" name="img" id="File" style="display:none;" required>
                      <div class="input-group-append">
                        <label class="btn btn-secondary mb-0" for="File">Choisir un fichier</label>
                      </div>
                    </div>
                    <script>
                      const fileInput = get('File');
                      const label = get('file-text');
                      
                      fileInput.onchange =
                      fileInput.onmouseout = function () {
                        if (!fileInput.value) return
                        
                        var value = fileInput.value.replace(/^.*[\\\/]/, '')
                        label.value = value
                      }
                    </script>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success w-100">Envoyer!</button>
                </div>
            </form>
        </div>
        <br/><br/>
    <?php } ?>
    </div>

<?php } // Else tout en haut ?>
    