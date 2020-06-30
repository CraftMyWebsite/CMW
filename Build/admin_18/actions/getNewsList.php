<?php echo '[DIV]';
 if(Permission::getInstance()->verifPerm('PermsPanel', 'news', 'actions', 'editNews')) { 
	require_once('./admin/donnees/news.php'); 
               	    if(!isset($tableauNews) && empty($tableauNews)) { ?>
                        <div class="alert alert-warning">
                            <strong>Aucune nouveauté.</strong>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-success">
                            <strong>Editer une nouveauté si cela est nécessaire pour corriger des fautes ou tout simplement la supprimer de la liste des nouveautés.</strong>
                        </div>
                    <?php } if(!empty($tableauNews)) { ?>
                                <ul class="nav nav-tabs">
                                    <?php for($i = 0; $i < count($tableauNews); $i++) { ?>
                                        <li class="nav-item" id="tabnews-<?php echo $tableauNews[$i]['id']; ?>"><a class="<?php if($i == 0) echo 'active'; ?> nav-link" href="#news<?php echo $tableauNews[$i]['id']; ?>" data-toggle="tab" style="color: black !important"><?php echo $tableauNews[$i]['titre']; ?></a></li>
                                    <?php } ?>
                                </ul>
                                <div class="tab-content" >
                                    <?php for($i = 0; $i < count($tableauNews); $i++) { ?>
                                        <div class="tab-pane <?php if($i == 0) echo 'active'; ?>" id="news-<?php echo $tableauNews[$i]['id']; ?>">

                                            <div id="callback" post="<?php echo $tableauNews[$i]['id']; ?>"></div>
                                                        <label class="control-label">Titre de la news</label>
                                                        <input type="text" class="form-control" name="titre" value="<?php echo $tableauNews[$i]['titre']; ?>">


                                                    <label class="control-label">Text de la news</label>
                                                    <?php echo '<textarea id="ckeditor" name="message" style="height: 275px; margin: 0px; width: 50%;">' . $tableauNews[$i]['message'] . '</textarea>';?>

                                                    <div class="row" style="margin-top:20px;">
                                                        <div class="col-md-4">
                                                            <input type="submit" class="btn btn-success w-100"  onclick="sendPost('news-<?php echo $tableauNews[$i]['id']; ?>');" value="Modifer le message"/>

                                                        </div>
                                                        <div class="col-md-4">
                                                            <button type="button" onclick="sendDirectPost('admin.php?action=epingle&newsId=<?php echo $tableauNews[$i]['id']; ?>&epingle=<?=$tableauNews[$i]['epingle'];?>', function(data) { if(data){ Switch(this,'Désépingler la news','Épingler la news')}});" class="btn btn-warning w-100"><?=($tableauNews[$i]['epingle'] == 1) ? 'Désépingler' : 'Épingler';?> la news</button>
                                                        </div>
                                                        <div class="col-md-4">
                                                              <button type="button" onclick="sendDirectPost('admin.php?action=supprNews&newsId=<?php echo $tableauNews[$i]['id']; ?>', function(data) { if(data) { get('news-<?php echo $tableauNews[$i]['id']; ?>').style.display = 'none';get('tabnews-<?php echo $tableauNews[$i]['id']; ?>').style.display = 'none';}});" class="btn btn-danger w-100">Supprimer la News</button>
                                                        </div>
                                                    </div>

                                        </div>
                                    <?php } ?>
                                </div>
    <?php } 
} ?>