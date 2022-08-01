<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Gestion de vos nouveautés
    </h2>
</div>
<?php if (!$_Permission_->verifPerm('PermsPanel', 'news', 'showPage')) { ?>

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
            communauté, pensez à rédiger des news souvent, cela prouve votre activité, ça fait toujours plaisir à un
            joueur
            de voir un nouveau message!</strong>
    </div>
    <div class="row">
        <?php if ($_Permission_->verifPerm('PermsPanel', 'news', 'actions', 'editNews')) { ?>
            <div class="col-md-12 col-xl-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Édition des nouveautés</strong></h3>
                    </div>
                    <div class="card-body" id="edit-news">
                        <?php if (!isset($tableauNews) && empty($tableauNews)) { ?>
                            <div class="alert alert-warning">
                                <strong>Aucune nouveauté.</strong>
                            </div>
                        <?php } else { ?>
                            <div class="alert alert-success">
                                <strong>Editer une nouveauté si cela est nécessaire pour corriger des fautes ou tout
                                    simplement la
                                    supprimer de la liste des nouveautés.</strong>
                            </div>
                        <?php }
                        if (!empty($tableauNews)) { ?>
                            <ul class="nav nav-tabs">
                                <?php for ($i = 0; $i < count($tableauNews); $i++) { ?>
                                    <li class="nav-item" id="tabnews-<?= $tableauNews[$i]['id']; ?>"><a
                                                class="<?php if ($i == 0) echo 'active'; ?> nav-link"
                                                href="#news-<?= $tableauNews[$i]['id']; ?>" data-toggle="tab"
                                                style="color: black !important"><?= $tableauNews[$i]['titre']; ?></a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content">
                                <?php for ($i = 0; $i < count($tableauNews); $i++) { ?>
                                    <div class="tab-pane well <?php if ($i == 0) echo 'active'; ?>"
                                         id="news-<?= $tableauNews[$i]['id']; ?>">
                                        <label class="control-label">Titre de la news</label>
                                        <input type="text" class="form-control" name="titre"
                                               value="<?= $tableauNews[$i]['titre']; ?>">


                                        <label class="control-label">Text de la news</label>
                                        <?= '<textarea data-UUID="0002" id="ckeditor" name="message" style="height: 275px; margin: 0; width: 50%;">' . $tableauNews[$i]['message'] . '</textarea>'; ?>

                                        <div class="row" style="margin-top:20px;">
                                            <div class="col-md-4">
                                                <input type="submit" class="btn btn-success w-100"
                                                       onclick="sendPost('news-<?= $tableauNews[$i]['id']; ?>');"
                                                       value="Modifer le message"/>

                                            </div>
                                            <div class="col-md-4">
                                                <button type="button"
                                                        onclick="sendDirectPost('admin.php?action=epingle&newsId=<?= $tableauNews[$i]['id']; ?>&epingle=<?= $tableauNews[$i]['epingle']; ?>', function(data) {  if(data){ Switch(this,'Désépingler la news','Épingler la news');}});"
                                                        class="btn btn-warning w-100"><?= ($tableauNews[$i]['epingle'] == 1) ? 'Désépingler' : 'Épingler'; ?>
                                                    la news
                                                </button>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button"
                                                        onclick="sendDirectPost('admin.php?action=supprNews&newsId=<?= $tableauNews[$i]['id']; ?>', function(data) { if(data) { hide('news-<?= $tableauNews[$i]['id']; ?>'); hide('tabnews-<?= $tableauNews[$i]['id']; ?>');}});"
                                                        class="btn btn-danger w-100">Supprimer la News
                                                </button>
                                            </div>
                                        </div>
                                        <div data-callback="news-<?= $tableauNews[$i]['id']; ?>"
                                             data-url="admin.php?action=editNews&id=<?= $tableauNews[$i]['id']; ?>"></div>
                                        <script>

                                            initPost("news-<?= $tableauNews[$i]['id']; ?>",
                                                "admin.php?action=editNews&id=<?= $tableauNews[$i]['id']; ?>", null);
                                        </script>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php }
        if ($_Permission_->verifPerm('PermsPanel', 'news', 'actions', 'addNews')) { ?>
            <div class="col-md-12 col-xl-12 col-12">
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title"><strong>Création d'une nouveauté</strong></h3>
                    </div>
                    <div class="card-body" id="postNews">
                        <label class="control-label">Titre de la news</label>
                        <input type="text" name="titre" class="form-control" placeholder="ex: Sortie du launcher !"
                               required>

                        <label class="control-label">Contenu de la news</label>
                        <textarea id="ckeditor" data-UUID="0003" name="message"></textarea>
                    </div>
                    <script>initPost("postNews", "admin.php?action=postNews", function (data) {
                            if (data) {
                                clearAllInput('postNews');
                                newsUpdate();
                            }
                        });</script>
                    <div class="card-footer">
                        <div class="row text-center">
                            <input type="submit" onclick="sendPost('postNews', null);" class="btn btn-success w-100"
                                   value="Envoyer !"/>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <br>

<?php } ?>
