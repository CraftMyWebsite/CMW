<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Miniatures & Slider
    </h2>
</div>
<?php if (!$_Permission_->verifPerm('PermsPanel', 'home', 'showPage')) { ?>
    <div class="alert alert-danger">
        <strong>Vous n'avez pas la permission pour accéder aux réglages du slider et des miniatures.</strong>
    </div>

<?php } else { ?>
    <div class="row">
        <?php if ($_Permission_->verifPerm('PermsPanel', 'home', 'actions', 'addMiniature')) { ?>
            <div class="col-md-12 col-xl-6 col-12">
                <div class="card">
                    <div class="card-header ">
                        <h3 class="card-title"><strong>Création d'une miniature</strong></h3>
                    </div>
                    <div class="card-body" id="newMinia">

                        <label class="control-label">Image</label>

                        <select class="form-control" name="image">
                            <?php for ($j = 2; $j < count($images); $j++) { ?>
                                <option value="<?= $images[$j]; ?>"><?= $images[$j]; ?></option>
                            <?php } ?>
                        </select>

                        <label class="control-label">Message sous l'image</label>
                        <textarea id="ckeditor" data-UUID="0300" class="form-control" name="message"
                                  maxlength="200"></textarea>

                        <div class="custom-control custom-radio" style="margin-top:20px;">
                            <input type="radio" name="type" value="0" id="radiominia0" class="custom-control-input"
                                   onclick="show('lienpage');hide('lienurl');" checked>
                            <label class="custom-control-label" for="radiominia0">Je souhaite rediriger vers une page
                                existante</label>
                        </div>

                        <div class="custom-control custom-radio">
                            <input type="radio" name="type" value="1" id="radiominia1"
                                   onclick="hide('lienpage');show('lienurl');" class="custom-control-input">
                            <label class="custom-control-label" for="radiominia1">Je souhaite rediriger vers un lien
                                personnalisé</label>
                        </div>

                        <div id="lienurl" style="display:none;">
                            <label class="control-label">Lien</label>
                            <input type="text" class="form-control" name="lien" maxlength="100"
                                   placeholder="ex: http://minecraft.net/">
                        </div>
                        <div id="lienpage">
                            <label class="control-label">Page</label>
                            <select class="form-control" name="page">
                                <?php $i = 0;
                                while ($i < count($pages)) { ?>
                                    <option id=""
                                            value="<?= $pages[$i]; ?>"><?= $pages[$i]; ?></option><?php $i++;
                                } ?>
                            </select>
                        </div>


                    </div>
                    <script>initPost("newMinia", "admin.php?action=addMiniature", function (data) {
                            if (data) {
                                clearAllInput('newMinia');
                                miniaUpdate();
                            }
                        });</script>

                    <div class="card-footer">
                        <div class="text-center">
                            <input type="submit" onclick="sendPost('newMinia', null);"
                                   class="btn btn-success btn-block w-100" value="Valider"/>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        if ($_Permission_->verifPerm('PermsPanel', 'home', 'actions', 'editMiniature')) { ?>
            <div class="col-md-12 col-xl-6 col-12" id="card-minia" <?php if (empty($Miniature)) {
                echo 'style="display:none;"';
            } ?>>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><strong>Modifier une miniature</strong></h3>
                    </div>
                    <div class="card-body" id="allMinia">

                        <?php if (!empty($Miniature)) { ?>
                            <input type="hidden" name="count" value="<?= count($Miniature); ?>">
                            <ul class="nav nav-tabs">
                                <?php for ($i = 0; $i < count($Miniature); $i++) { ?>
                                    <li class="nav-item <?= ($i == 0) ? 'active' : ''; ?>">
                                        <a class="nav-link"
                                                href="#minia-<?= $Miniature[$i]['id']; ?>" data-toggle="tab"
                                        >
                                            Miniature #<?= $i + 1; ?>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content">
                                <?php for ($i = 0; $i < count($Miniature); $i++) { ?>
                                    <div class="tab-pane well <?= ($i == 0) ? 'active' : ''; ?>"
                                         id="minia-<?=  $Miniature[$i]['id']; ?>">
                                        <div style="width: 100%;display: inline-block">
                                            <div class="float-left">
                                                <h3>Miniature #<?= $i + 1; ?></h3>
                                            </div>
                                            <div class="float-right">
                                                <button <?php if ($i == 0) {
                                                    echo 'style="display:none;"';
                                                } ?> type="button" id="li-minia-<?= $Miniature[$i]['id']; ?>-up"
                                                     onclick="sendDirectPost('admin.php?&action=mooveMinia&type=0&id=<?= $Miniature[$i]['id']; ?>', function(data) { if(data) { menuMooveUp(get('li-minia-<?= $Miniature[$i]['id']; ?>')); }});"
                                                     class="btn btn-sm btn-outline-secondary"><i
                                                            class="fas fa-angle-up"></i></button>
                                                <button <?php if ($i == count($Miniature) - 1) {
                                                    echo 'style="display:none;"';
                                                } ?> type="button"
                                                     id="li-minia-<?= $Miniature[$i]['id']; ?>-down"
                                                     onclick="sendDirectPost('admin.php?&action=mooveMinia&type=1&id=<?= $Miniature[$i]['id']; ?>', function(data) { if(data) { menuMooveDown(get('li-minia-<?= $Miniature[$i]['id']; ?>')); }});"
                                                     class="btn btn-sm btn-outline-secondary"><i
                                                            class="fas fa-angle-down"></i></button>

                                                <button onclick="sendDirectPost('admin.php?action=supprMiniature&id=<?= $Miniature[$i]['id']; ?>', function(data) { if(data) { hide('minia-<?= $Miniature[$i]['id']; ?>'); hide('li-minia-<?= $Miniature[$i]['id']; ?>',true, function() { checkMenuForMoove(); }); } });"
                                                        class="btn btn-sm btn-outline-secondary">Supprimer
                                                </button>
                                            </div>
                                        </div>

                                        <input type="hidden" name="id<?= $i; ?>"
                                               value="<?= $Miniature[$i]['id']; ?>">

                                        <img class="col-md-12 thumbnail" id="minia-img-<?= $i; ?>"
                                             src="theme/upload/navRap/<?= $Miniature[$i]['image']; ?>"/>

                                        <label class="control-label">Image</label>
                                        <select class="form-control" name="image<?= $i; ?>"
                                                onchange="get('minia-img-<?= $i; ?>').src = 'theme/upload/navRap/'+this.value;">
                                            <?php for ($j = 2; $j < count($images); $j++) { ?>
                                                <option value="<?= $images[$j]; ?>" <?php if ($images[$j] == $Miniature[$i]['image']) {
                                                    echo 'selected';
                                                } ?>><?= $images[$j]; ?></option>
                                            <?php } ?>
                                        </select>

                                        <label class="control-label">Message sous l'image</label>
                                        <textarea id="ckeditor" data-UUID="03<?= $Miniature[$i]['id']; ?>"
                                                  class="form-control" name="message<?= $i; ?>"
                                                  maxlength="200"><?= $Miniature[$i]['message']; ?></textarea>

                                        <div class="custom-control custom-radio" style="margin-top:20px;">
                                            <input type="radio" name="type<?= $i; ?>" value="0"
                                                   id="radiominia0<?= $i; ?>" class="custom-control-input"
                                                   onclick="show('lienpage<?= $i; ?>');hide('lienurl<?= $i; ?>');" <?php if ($Miniature[$i]['type'] == 0) {
                                                echo 'checked';
                                            } ?>>
                                            <label class="custom-control-label" for="radiominia0<?= $i; ?>">Je
                                                souhaite rediriger vers une page existante</label>
                                        </div>

                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="type<?= $i; ?>" value="1"
                                                   id="radiominia1<?= $i; ?>"
                                                   onclick="hide('lienpage<?= $i; ?>');show('lienurl<?= $i; ?>');"
                                                   class="custom-control-input" <?php if ($Miniature[$i]['type'] == 1) {
                                                echo 'checked';
                                            } ?>>
                                            <label class="custom-control-label" for="radiominia1<?= $i; ?>">Je
                                                souhaite rediriger vers un lien personnalisé</label>
                                        </div>

                                        <div id="lienurl<?= $i; ?>" <?php if ($Miniature[$i]['type'] == 0) {
                                            echo 'style="display:none;"';
                                        } ?>>
                                            <label class="control-label">Lien</label>
                                            <input type="text" class="form-control"
                                                   name="lien<?= $i; ?>" <?php if ($Miniature[$i]['type'] == 1) {
                                                echo 'value="' . $Miniature[$i]['lien'] . '"';
                                            } ?> maxlength="100" placeholder="ex: http://minecraft.net/">
                                        </div>
                                        <div id="lienpage<?= $i; ?>" <?php if ($Miniature[$i]['type'] == 1) {
                                            echo 'style="display:none;"';
                                        } ?>>
                                            <label class="control-label">Page</label>
                                            <select class="form-control" name="page<?= $i; ?>">
                                                <?php $o = 0;
                                                while ($o < count($pages)) { ?>
                                                    <option id=""
                                                            value="<?= $pages[$o]; ?>" <?php if (str_replace('?&page=', '', $Miniature[$i]['lien']) == urlencode($pages[$o])) {
                                                        echo 'selected';
                                                    } ?>><?= $pages[$o]; ?></option><?php $o++;
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                    <script>initPost("allMinia", "admin.php?action=editMiniature", null);</script>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success w-100" onClick="sendPost('allMinia')">Envoyer
                        </button>
                    </div>
                </div>
            </div>
        <?php }
        if ($_Permission_->verifPerm('PermsPanel', 'home', 'actions', 'uploadMiniature')) { ?>
            <div class="col-md-12 col-xl-6 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            Uploader une miniature (Dans: <code>theme/upload/navRap/</code>)
                        </h4>
                    </div>
                    <form method="POST" action="?&action=postMiniature" enctype="multipart/form-data">
                        <div class="card-body" id="">
                            <div class="input-group file-input-group" style="margin-top:10px;">
                                <input class="form-control" id="file-text" type="text"
                                       placeholder="Aucun fichier séléctioner" readonly>
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
                            <button type="submit" class="btn btn-success w-100">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php } ?>
    </div>

<?php } // Else tout en haut ?>
    
