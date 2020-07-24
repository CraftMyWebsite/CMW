<?php if($_Permission_->verifPerm('PermsPanel', 'menus', 'actions', 'editDropAndLinkMenu')) { 
require_once('./admin/donnees/menu.php');  ?>
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


                      <div data-callback="lien-<?php echo $i; ?>" data-url="admin.php?&action=modifierLien&id=<?php echo $i; ?>"></div>
                      <div class="card-footer" style="background-color:rgba(0,0,0,0);">
                        <div class="text-center">
                            <input type="submit" onclick="sendPost('lien-<?php echo $i; ?>', null);" class="btn btn-success btn-block w-100" value="Valider" />
                        </div>
                      </div>

                    </div>
                  <?php } } ?>
                </div>
           <?php } ?>
<?php } ?>