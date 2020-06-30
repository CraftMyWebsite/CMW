<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Gestion de vos nouveautés
    </h2>
</div>
<?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'news', 'actions', 'addNews') AND !Permission::getInstance()->verifPerm('PermsPane', 'news', 'actions', 'editNews')) { ?>

<div class="row">
    <div class="col-md-12 text-center">
        <div class="alert alert-danger">
            <strong>Vous avez aucune permission pour accéder aux nouveautés.</strong>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="alert alert-success">
    <strong>Les news sont visibles sur l'accueil, elles informent vos joueurs des nouveautés relatives à votre
        communauté, pensez à rédiger des news souvent, cela prouve votre activité, ça fait toujours plaisir à un joueur
        de voir un nouveau message!</strong>
</div>
<?php }?>
<div class="row">
    <?php if(Permission::getInstance()->verifPerm('PermsPanel', 'news', 'actions', 'editNews')) { ?>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><strong>Édition des nouveautés</strong></h3>
            </div>
            <div class="card-body" id="edit-news">
                <?php if(!isset($tableauNews) && empty($tableauNews)) { ?>
                <div class="alert alert-warning">
                    <strong>Aucune nouveauté.</strong>
                </div>
                <?php } else { ?>
                <div class="alert alert-success">
                    <strong>Editer une nouveauté si cela est nécessaire pour corriger des fautes ou tout simplement la
                        supprimer de la liste des nouveautés.</strong>
                </div>
                <?php } if(!empty($tableauNews)) { ?>
                <ul class="nav nav-tabs">
                    <?php for($i = 0; $i < count($tableauNews); $i++) { ?>
                    <li class="nav-item" id="tabnews<?php echo $tableauNews[$i]['id']; ?>"><a
                            class="<?php if($i == 0) echo 'active'; ?> nav-link"
                            href="#news<?php echo $tableauNews[$i]['id']; ?>" data-toggle="tab"
                            style="color: black !important"><?php echo $tableauNews[$i]['titre']; ?></a></li>
                    <?php } ?>
                </ul>
                <div class="tab-content">
                    <?php for($i = 0; $i < count($tableauNews); $i++) { ?>
                    <div class="tab-pane <?php if($i == 0) echo 'active'; ?>"
                        id="news<?php echo $tableauNews[$i]['id']; ?>">
                        <label class="control-label">Titre de la news</label>
                        <input type="text" class="form-control" name="titre"
                            value="<?php echo $tableauNews[$i]['titre']; ?>">


                        <label class="control-label">Text de la news</label>
                        <?php echo '<textarea id="ckeditor" name="message" style="height: 275px; margin: 0px; width: 50%;">' . $tableauNews[$i]['message'] . '</textarea>';?>

                        <div class="row" style="margin-top:20px;">
                            <div class="col-md-4">
                                <input type="submit" class="btn btn-success w-100"
                                    onclick="sendPost('news-<?php echo $tableauNews[$i]['id']; ?>');"
                                    value="Modifer le message" />
                            </div>
                            <div class="col-md-4">
                                <button type="button"
                                    onclick="sendDirectPost('admin.php?action=epingle&newsId=<?php echo $tableauNews[$i]['id']; ?>&epingle=<?=$tableauNews[$i]['epingle'];?>', function(data) {  if(data){ Switch(this,'Désépingler la news','Épingler la news');}});"
                                    class="btn btn-warning w-100"><?=($tableauNews[$i]['epingle'] == 1) ? 'Désépingler' : 'Épingler';?>
                                    la news</button>
                            </div>
                            <div class="col-md-4">
                                <button type="button"
                                    onclick="sendDirectPost('admin.php?action=supprNews&newsId=<?php echo $tableauNews[$i]['id']; ?>', function(data) { if(data) { get('news-<?php echo $tableauNews[$i]['id']; ?>').style.display = 'none'; get('tabnews-<?php echo $tableauNews[$i]['id']; ?>').style.display = 'none';}});"
                                    class="btn btn-danger w-100">Supprimer la News</button>
                            </div>
                        </div>
                        <script>
                            initPost("news-<?php echo $tableauNews[$i]['id']; ?>",
                                "admin.php?action=editNews&id=<?php echo $tableauNews[$i]['id']; ?>", null);
                        </script>
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'news', 'actions', 'addNews')) { ?>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header ">
                <h3 class="card-title"><strong>Création d'une nouveauté</strong></h3>
            </div>
            <div class="card-body" id="postNews">
                <label class="control-label">Titre de la news</label>
                <input type="text" name="titre" class="form-control" placeholder="ex: Sortie du launcher !" required>

                <label class="control-label">Contenu de la news</label>
                <textarea id="ckeditor" name="message"></textarea>
            </div>
            <script>initPost("postNews", "admin.php?action=postNews", async function (data) {if (data) {updateCont("admin.php?action=getNewsList", get('edit-news'), function () {clearAllInput("postNews");for (let el of document.querySelectorAll('#ckeditor')) {ClassicEditor.create(el).catch(error => {console.log(error); });}for (let el of document.querySelectorAll('#callback')) {initPost("news-" + el.getAttribute("post"),"admin.php?action=editNews&id=" + el.getAttribute("post"),null);}});}});</script>
            <div class="card-footer">
                <div class="row text-center">
                    <input type="submit" onclick="sendPost('postNews');" class="btn btn-success w-100"
                        value="Envoyer !" />
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>
<br>