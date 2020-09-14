<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h2 gray">
                      Gestion des Menus
                    </h2>
                </div>
 <?php if(!$_Permission_->verifPerm('PermsPanel', 'menus', 'showPage'))
{ ?>
  <div class="col-md-12 text-center">
            <div class="alert alert-danger">
                <strong>Vous avez aucune permission pour accéder aux menus.</strong>
            </div>
        </div>
<?php }
else
  {
    ?><div class="alert alert-success">
      <strong>Vous pouvez créer et modifier des liens qui seront visibles sur la barre du menu principal. Vous pouvez aussi éditer des listes déroulantes. Ces dernières sont plus compliquées à créer. Ce lien basique contient juste un nom et une adresse, vous pouvez choisir parmis 2 catégories pour l'adresse: une page du site (par exemple une page "nous rejoindre !") ou un lien direct(comme un lien "faire un don"). Vous devez créer la page avant de la mettre sur le menu ! Pour gérer une liste déroulante, vous y attribuez au départ un nom et un premier élément de la liste, vous pourrez rajouter une infinité de liens sur votre liste par la suite!</strong>
    </div>
<div class="row"><?php if($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'addLinkMenu')) { ?>
  <div class="col-md-12 col-xl-6 col-12">
    <div class="card">
      <div class="card-header ">
        <h3 class="card-title"><strong>Création d'un lien menu</strong></h3>
      </div>
      <div class="card-body" id="newLien">

          <label class="control-label">Nom</label>
          <input type="text" class="form-control" name="menuTexte" placeholder="Nom du lien" required>

          <label class="control-label">type de redirection</label>
          <select name="methode" class="form-control" onclick="
          if(parseInt(this.value) == 1) {
            hide('typePage');
            show('typeLien');
          } else {
            show('typePage');
            hide('typeLien');
          }
          " required>
            <option value="1">Lien</option>
            <option value="2">Page</option>
          </select>

          <div id="typeLien">
            <label class="control-label">Lien</label>
            <input type="text" class="form-control" name="menuLien" placeholder="ex: http://minecraft.net/">
          </div>
          <div id="typePage" style="display:none;">
            <label class="control-label">Page</label>
            <select class="form-control" name="page">
              <?php $i = 0;  while($i < count($pages)) { ?><option value="<?php echo $pages[$i]; ?>"><?php echo $pages[$i]; ?></option><?php $i++; } ?>
            </select>
          </div>
      </div>

      <script>initPost('newLien', 'admin.php?action=newLienMenu',function(data) { if(data) { menuLienUpdate(); }});</script>
      <div class="card-footer">
        <div class="text-center">
            <input type="submit" onclick="sendPost('newLien', null);" class="btn btn-success btn-block w-100" value="Valider" />
        </div>
      </div>
    </div>
  </div>
<?php } if($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'addDropLinkMenu')) { ?>
  <div class="col-md-12 col-xl-6 col-12">
    <div class="card">
      <div class="card-header ">
        <h3 class="card-title"><strong>Création d'une liste déroulante</strong></h3>
      </div>
      <div class="card-body" id="newListe">

          <label class="control-label">Nom</label>
          <input type="text" class="form-control" name="menuTexte" placeholder="Nom de la liste" required>

          <label class="control-label">Lien #1</label>
          <input type="text" class="form-control" name="lienTexte" placeholder="Nom du lien" required>

          <label class="control-label">type de redirection</label>
          <select name="methode" class="form-control" onclick="
          if(parseInt(this.value) == 1) {
            hide('typePage2');
            show('typeLien2');
          } else {
            show('typePage2');
            hide('typeLien2');
          }
          " required>
            <option value="1">Lien</option>
            <option value="2">Page</option>
          </select>

          <div id="typeLien2">
            <label class="control-label">Lien</label>
            <input type="text" class="form-control" name="menuLien" placeholder="ex: http://minecraft.net/">
          </div>
          <div id="typePage2" style="display:none;">
            <label class="control-label">Page</label>
            <select class="form-control" name="page">
              <?php $i = 0;  while($i < count($pages)) { ?><option value="<?php echo $pages[$i]; ?>"><?php echo $pages[$i]; ?></option><?php $i++; } ?>
            </select>
          </div>
          <small>Vous pourrez rajouter des liens plus tard..</small>
      </div>

      <script>initPost('newListe', 'admin.php?action=newListeMenu',function(data) { if(data) { menuListeUpdate(); }});</script>
      <div class="card-footer">
        <div class="text-center">
            <input type="submit" onclick="sendPost('newListe', null);" class="btn btn-success btn-block w-100" value="Valider" />
        </div>
      </div>
    </div>
  </div>
<?php } if($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'editLinkMenu')) { ?>
  <div class="col-md-12 col-xl-6 col-12">
    <div class="card">
      <div class="card-header ">
        <h3 class="card-title"><strong>Modifier les liens basiques</strong></h3>
      </div>
      <div class="card-body" id="allLien">

           <?php if(!empty($lectureMenu['MenuTexte'])) { ?>
                <ul class="nav nav-tabs">
                    <?php for($i = 0; $i < count($lectureMenu['MenuTexte']); $i++) { if(!array_key_exists($lectureMenu['MenuTexte'][$i], $lectureMenu['MenuListeDeroulante'])) { ?>
                    <li class="nav-item" id="tablien-<?php echo $i; ?>"><a
                            id="tab2lien-<?php echo $i; ?>" class="<?php if($i == 0) echo 'active'; ?> nav-link"
                            href="#lien-<?php echo $i; ?>" data-toggle="tab"
                            style="color: black !important"><?php echo $lectureMenuA['MenuTexte'][$i]; ?></a></li>
                    <?php } } ?>
                </ul>
                <div class="tab-content">
                  <?php for($i = 0; $i < count($lectureMenu['MenuTexte']); $i++) { if(!array_key_exists($lectureMenu['MenuTexte'][$i], $lectureMenu['MenuListeDeroulante'])) {  ?>
                    <div class="tab-pane well <?php if($i == 0) echo 'active'; ?>"id="lien-<?php echo $i; ?>">
                      <div style="width: 100%;display: inline-block">
                        <div class="float-left">
                          <h3 id="lien-name-<?php echo $i; ?>">Lien du menu #<?php echo $lectureMenu['MenuTexte'][$i]; ?></h3>
                        </div>
                        <div class="float-right">
                          <button  onclick="sendDirectPost('admin.php?&action=supprLienMenu&id=<?php echo $i; ?>', function(data) { if(data) { hide('lien-<?php echo $i; ?>'); hide('tablien-<?php echo $i; ?>'); } });" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                        </div>
                      </div>

                      <label class="control-label">Titre du lien</label>
                      <input class="form-control" type="text" onkeyup="get('tab2lien-<?php echo $i; ?>').innerText = this.value; get('lien-name-<?php echo $i; ?>').innerText = 'Lien du menu #'+this.value" value="<?php echo $lectureMenu['MenuTexte'][$i]; ?>" name="texteLien" />

                      <?php $isPage = isPage($lectureMenu['MenuLien'][$i], $pages); ?>

                      <label class="control-label">type de redirection</label>
                      <select name="methode" class="form-control" onclick="
                      if(parseInt(this.value) == 1) {
                        hide('typePage-2-<?php echo $i; ?>');
                        show('typeLien-2-<?php echo $i; ?>');
                      } else {
                        show('typePage-2-<?php echo $i; ?>');
                        hide('typeLien-2-<?php echo $i; ?>');
                      }
                      " required>
                        <option value="1" <?php echo $isPage ? '':'selected'; ?>>Lien</option>
                        <option value="2" <?php echo $isPage ? 'selected':''; ?>>Page</option>
                      </select>

                      <div id="typeLien-2-<?php echo $i; ?>" <?php echo $isPage ? 'style="display:none;"':'';?>>
                        <label class="control-label">Lien</label>
                        <input type="text" class="form-control" value="<?php echo $lectureMenu['MenuLien'][$i]; ?>" name="menuLien" placeholder="ex: http://minecraft.net/">
                      </div>
                      <div id="typePage-2-<?php echo $i; ?>" <?php echo $isPage ? '':'style="display:none;"';?>>
                        <label class="control-label">Page</label>
                        <select class="form-control" name="page">
                          <?php $o = 0;  while($o < count($pages)) { ?><option value="<?php echo $pages[$o]; ?>"<?php if($isPage && strpos($lectureMenu['MenuLien'][$i],$pages[$o])) { echo 'selected';} ?>><?php echo $pages[$o]; ?></option><?php $o++; } ?>
                        </select>
                      </div>

                      <script>initPost('lien-<?php echo $i; ?>', 'admin.php?&action=modifierLien&id=<?php echo $i; ?>', null);</script>
                      <div class="card-footer" style="background-color:rgba(0,0,0,0);">
                        <div class="text-center">
                            <input type="submit" onclick="sendPost('lien-<?php echo $i; ?>', null);" class="btn btn-success btn-block w-100" value="Valider" />
                        </div>
                      </div>

                    </div>
                  <?php } } ?>
                </div>
           <?php } ?>
      </div>
    </div>
  </div>
  <?php } if($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'editDropAndLinkMenu')) { ?>
  <div class="col-md-12 col-xl-6 col-12">
    <div class="card">
      <div class="card-header ">
        <h3 class="card-title"><strong>Modifier les menus déroulant</strong></h3>
      </div>
      <div class="card-body" id="allListe">

           <?php if(!empty($lectureMenu['MenuTexte'])) { ?>
                <ul class="nav nav-tabs">
                    <?php  $first = true; for($i = 0; $i < count($lectureMenu['MenuTexte']); $i++) { if(array_key_exists($lectureMenu['MenuTexte'][$i], $lectureMenu['MenuListeDeroulante'])) {  ?>
                    <li class="nav-item" id="tab3lien-<?php echo $i; ?>"><a
                            id="tab4lien-<?php echo $i; ?>" class="<?php if($first) { $first = false; echo 'active'; } ?> nav-link"
                            href="#liste-<?php echo $i; ?>" data-toggle="tab"
                            style="color: black !important"><?php echo $lectureMenuA['MenuTexte'][$i]; ?></a></li>
                    <?php } } ?>
                </ul>
                <div class="tab-content">
                  <?php $first = true; for($i = 0; $i < count($lectureMenu['MenuTexte']); $i++) { if(array_key_exists($lectureMenu['MenuTexte'][$i], $lectureMenu['MenuListeDeroulante'])) {  ?>
                    <div class="tab-pane well <?php if($first)  { $first = false; echo 'active'; } ?>"id="liste-<?php echo $i; ?>">
                      <div style="width: 100%;display: inline-block">
                        <div class="float-left">
                          <h3 id="lien-name2-<?php echo $i; ?>">Menu déroulant #<?php echo $lectureMenu['MenuTexte'][$i]; ?></h3>
                        </div>
                        <div class="float-right">
                          <button  onclick="sendDirectPost('admin.php?&action=supprLienMenu&id=<?php echo $i; ?>', function(data) { if(data) { hide('liste-<?php echo $i; ?>'); hide('tab3lien-<?php echo $i; ?>'); } });" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                        </div>
                      </div>

                      <label class="control-label">Titre du menu déroulant</label>
                      <input class="form-control" type="text" onkeyup="get('tab4lien-<?php echo $i; ?>').innerText = this.value; get('lien-name2-<?php echo $i; ?>').innerText = 'Menu déroulant #'+this.value" value="<?php echo $lectureMenu['MenuTexte'][$i]; ?>" name="titreListe" disabled required/>

                     <hr/>

                      <?php if($lectureMenu['MenuListeDeroulante'][$lectureMenu['MenuTexte'][$i]]['0'] != "LastLinkDontDelete") {
                        for($j = 0; $j < count($lectureMenu['MenuListeDeroulante'][$lectureMenu['MenuTexte'][$i]]); $j++) { 
                          if(isPage($lectureMenu['MenuListeDeroulanteLien'][$lectureMenu['MenuTexte'][$i]][$j], $pages))
                          {
                            $method = 1;
                          } else if($lectureMenu['MenuListeDeroulanteLien'][$lectureMenu['MenuTexte'][$i]][$j] == '-divider-') {
                            $method = 2;
                          } else {
                            $method = 0;
                          } ?>
                          <div id="ml-<?php echo $i; ?>-<?php echo $j; ?>" style="margin-bottom:15px;width:94%;margin-right:3%;margin-left:3%;">
                            <label class="control-label"><h5>Titre du menu <span id="lienTexte<?php echo $i; ?><?php echo $j; ?>"><?php echo $lectureMenu['MenuListeDeroulante'][$lectureMenu['MenuTexte'][$i]][$j]; ?></h5></span></label>
                            <input type="text" class="form-control" onkeyup="get('lienTexte<?php echo $i; ?><?php echo $j; ?>').innerText = this.value;" name="lienTexte<?php echo $j; ?>" placeholder="Texte du lien" value="<?php echo $lectureMenu['MenuListeDeroulante'][$lectureMenu['MenuTexte'][$i]][$j]; ?>" required >

                            <label class="control-label">type de redirection</label>
                             <select name="methode<?php echo $j; ?>" class="form-control" onclick="
                              if(parseInt(this.value) == 1) {
                                hide('typePage-2-<?php echo $i; ?><?php echo $j; ?>');
                                show('typeLien-2-<?php echo $i; ?><?php echo $j; ?>');
                              } else if(parseInt(this.value) == 2) {
                                show('typePage-2-<?php echo $i; ?><?php echo $j; ?>');
                                hide('typeLien-2-<?php echo $i; ?><?php echo $j; ?>');
                              } else {
                                hide('typePage-2-<?php echo $i; ?><?php echo $j; ?>');
                                hide('typeLien-2-<?php echo $i; ?><?php echo $j; ?>');
                              }
                              " required>
                                <option value="1" <?php echo $method == 0 ? 'selected':''; ?>>Lien</option>
                                <option value="2" <?php echo $method == 1 ? 'selected':''; ?>>Page</option>
                                <option value="3" <?php echo $method == 2 ? 'selected':''; ?>>Diviseur</option>
                              </select>
                               <div id="typeLien-2-<?php echo $i; ?><?php echo $j; ?>" <?php echo $method != 0 ? 'style="display:none;"':'';?>>
                                <label class="control-label">Lien</label>
                                <input type="text" class="form-control" name="menuLien<?php echo $j; ?>" value="<?php echo $lectureMenu['MenuListeDeroulanteLien'][$lectureMenu['MenuTexte'][$i]][$j]; ?> " placeholder="ex: http://minecraft.net/">
                              </div>
                              <div id="typePage-2-<?php echo $i; ?><?php echo $j; ?>" <?php echo $method != 1 ? 'style="display:none;"':'';?>>
                                <label class="control-label">Page</label>
                                <select class="form-control" name="page<?php echo $j; ?>">
                                  <?php $o = 0;  while($o < count($pages)) { ?><option value="<?php echo $pages[$o]; ?>"<?php if($method == 1 && strpos($lectureMenu['MenuListeDeroulanteLien'][$lectureMenu['MenuTexte'][$i]][$j],$pages[$o])) { echo 'selected';} ?>><?php echo $pages[$o]; ?></option><?php $o++; } ?>
                                </select>
                              </div>
                              <input type="button" style="margin-top:15px;" onclick="sendDirectPost('admin.php?&action=supprLienMenuDeroulant&id=<?php echo $i; ?>&id2=<?php echo $j; ?>');" class="btn btn-danger btn-block w-100" value="Supprimer" />
                            </div>
                            <?php } 
                          } else { ?>
                            <div class="row">
                              <div class="col-md-12 text-center" style="margin-top: 5px;">
                                <div class='alert alert-danger' style='text-align: center;'>Veuillez créer un lien pour cette liste ou la supprimer</div>
                              </div>
                            </div>
                           <?php } ?>
                      <script>initPost('liste-<?php echo $i; ?>', 'admin.php?&action=editMenuListe', null);</script>
                      <div class="card-footer" style="background-color:rgba(0,0,0,0);">
                        <div class="text-center">
                            <input type="submit" onclick="sendPost('liste-<?php echo $i; ?>', null);" class="btn btn-success btn-block w-100" value="Valider les changements" />
                        </div>
                      </div>
                     <hr/>
                     <div id="new-ml-<?php echo $i; ?>">
                      <div style="width: 100%;display: inline-block">
                        <div class="float-left">
                          <h5>Ajouter un lien dans la liste: #<?php echo $lectureMenu['MenuTexte'][$i]; ?></h5>
                        </div>
                      </div>

                        <input type="hidden" name="listeNum" value="<?php echo $lectureMenu['MenuTexte'][$i]; ?>" />

                        <label class="control-label">Titre du lien</label>
                        <input type="text" class="form-control" name="nomLien" placeholder="Le nom du lien" required/>

                        <label class="control-label">type de redirection</label>
                              <select name="methode" class="form-control" onclick="
                              if(parseInt(this.value) == 1) {
                                hide('typePage-3-<?php echo $i; ?>');
                                show('typeLien-3-<?php echo $i; ?>');
                              } else if(parseInt(this.value) == 2) {
                                show('typePage-3-<?php echo $i; ?>');
                                hide('typeLien-3-<?php echo $i; ?>');
                              } else {
                                hide('typePage-3-<?php echo $i; ?>');
                                hide('typeLien-3-<?php echo $i; ?>');
                              }
                              " required>
                                <option value="1">Lien</option>
                                <option value="2">Page</option>
                                <option value="3">Diviseur</option>
                              </select>

                              <div id="typeLien-3-<?php echo $i; ?>" >
                                <label class="control-label">Lien</label>
                                <input type="text" class="form-control" value="<?php echo $lectureMenu['MenuLien'][$i]; ?>"  name="menuLien" placeholder="ex: http://minecraft.net/">
                              </div>
                              <div id="typePage-3-<?php echo $i; ?>" style="display:none;">
                                <label class="control-label">Page</label>
                                <select class="form-control" name="page">
                                  <?php $o = 0;  while($o < count($pages)) { ?><option value="<?php echo $pages[$o]; ?>"><?php echo $pages[$o]; ?></option><?php $o++; } ?>
                                </select>
                              </div>

                              <script>initPost('new-ml-<?php echo $i; ?>', 'admin.php?&action=nouveauMenuListeLien', function(data) { if(data) { menuListeUpdate() }});</script>
                              <div class="card-footer" style="background-color:rgba(0,0,0,0);">
                                <div class="text-center">
                                    <input type="submit" onclick="sendPost('new-ml-<?php echo $i; ?>', null);" class="btn btn-success btn-block w-100" value="Valider" />
                                </div>
                              </div>
                      </div>
                    </div>
                  <?php } } ?>
                </div>
           <?php } ?>
      </div>
    </div>
  </div>
<?php } ?>
</div>
<?php } ?>
