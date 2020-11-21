<?php if($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'editDropAndLinkMenu')) { 
require_once('./admin/donnees/menu.php');  ?>
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
                           <div data-callback="liste-<?php echo $i; ?>" data-url="admin.php?&action=editMenuListe"></div>
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
                              <div data-callback="new-ml-<?php echo $i; ?>" data-url="admin.php?&action=nouveauMenuListeLien"></div>
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
<?php } ?>