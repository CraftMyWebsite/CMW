<?php if($_Permission_->verifPerm('PermsPanel', 'pages', 'actions', 'editPage')) { 
    require_once('./admin/donnees/pages.php'); 
    if(empty($pages)) { ?>
                    <div class="alert alert-warning">
                        <strong>Aucune page est à modifier.</strong>
                    </div>
                    <?php } else  { ?>

                    <ul class="nav nav-tabs">
                        <?php for($i = 0; $i < count($pages); $i++) { ?>
                        <li class="nav-item" id="tabpage-<?php echo $i; ?>"><a
                            class="<?php if($i == 0) echo 'active'; ?> nav-link"
                            href="#page<?php echo $i; ?>" data-toggle="tab"
                            style="color: black !important" id="pagetab-<?php echo $i; ?>"><?php echo $pages[$i]['titre']; ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <?php for($i = 0; $i < count($pages); $i++) { ?>

                        <div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="page<?php echo $i; ?>">
                                <div style="width: 100%;display: inline-block">
                                    <div class="float-left">
                                        <h3 id="pageTitle-<?php echo $i; ?>"><?php echo $pages[$i]['titre']; ?></h3>
                                    </div>
                                    <div class="float-right">
                                        <button  onclick="sendDirectPost('admin.php?action=supprPage&name=<?php echo $pages[$i]['titre']; ?>', function(data, otherdata) { if(data && jsonDataIsOk(otherdata)) { hide('tabpage-<?php echo $i; ?>'); hide('page<?php echo $i; ?>'); } }, true);" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                                    </div>
                                </div>

                                <label class="control-label">Titre de la page</label>
                                <input type="text" class="form-control" id="titre<?php echo $i; ?>" onkeyup="get('pageTitle-<?php echo $i; ?>').innerText = get('pagetab-<?php echo $i; ?>').innerText = this.value; " name="titre" value="<?php echo $pages[$i]['titre']; ?>" required/>

                                 <input type="hidden" name="oldtitre" value="<?php echo $pages[$i]['titre']; ?>"/>

                                <hr/>

                                <div id="ckeditorPHP<?php echo $i; ?>" data-UUID="PHP0006-<?php echo $i; ?>" ><?php echo $pages[$i]['content']; ?></div>
                                <input type="hidden" name="content" id="content-<?php echo $i; ?>" value=""/>

                                <hr/>

                                <div data-callback="page<?php echo $i; ?>" data-url="admin.php?&action=editPage" data-js="pagesUpdate"></div>
                                <div class="text-center" style="margin-top:20px;margin-bottom:20px;">
                                     <input type="submit" onclick="get('content-<?php echo $i; ?>').value= CK.get(get('ckeditorPHP<?php echo $i; ?>')).getData();sendPost('page<?php echo $i; ?>', null, true);" class="btn btn-success w-100" value="Valider les changements"/>
                                    <button type="button" onclick="get('content-<?php echo $i; ?>').value= CK.get(get('ckeditorPHP<?php echo $i; ?>')).getData();setShowPopUpPage(get('titre<?php echo $i; ?>').value);sendPost('page<?php echo $i; ?>', null, true);" class="btn btn-primary w-100">Prévisualiser</button>
                                </div>
                      </div>
                    <?php } ?>
                    </div>
                <?php } } ?>