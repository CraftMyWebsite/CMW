<?php echo '[DIV]';
if ($_Permission_->verifPerm('PermsPanel', 'home', 'actions', 'editMiniature')) {
    require_once('admin/donnees/accueil.php');
    ?>
    <?php if (!empty($Miniature)) { ?>
        <input type="hidden" name="count" value="<?php echo count($Miniature); ?>">
        <ul class="nav nav-tabs">
            <?php for ($i = 0; $i < count($Miniature); $i++) { ?>
                <li class="nav-item" id="li-minia-<?php echo $Miniature[$i]['id']; ?>"><a
                            class="<?php if ($i == 0) echo 'active'; ?> nav-link"
                            href="#minia-<?php echo $Miniature[$i]['id']; ?>" data-toggle="tab"
                            style="color: black !important">Miniature #<?php echo $i + 1; ?></a></li>
            <?php } ?>
        </ul>
        <div class="tab-content">
            <?php for ($i = 0; $i < count($Miniature); $i++) { ?>
                <div class="tab-pane well <?php if ($i == 0) echo 'active'; ?>"
                     id="minia-<?php echo $Miniature[$i]['id']; ?>">
                    <div style="width: 100%;display: inline-block">
                        <div class="float-left">
                            <h3>Miniature #<?php echo $i + 1; ?></h3>
                        </div>
                        <div class="float-right">
                            <button <?php if ($i == 0) {
                                echo 'style="display:none;"';
                            } ?> type="button" id="li-minia-<?php echo $Miniature[$i]['id']; ?>-up"
                                 onclick="sendDirectPost('admin.php?&action=mooveMinia&type=0&id=<?php echo $Miniature[$i]['id']; ?>', function(data) { if(data) { menuMooveUp(get('li-minia-<?php echo $Miniature[$i]['id']; ?>')); }});"
                                 class="btn btn-sm btn-outline-secondary"><i class="fas fa-angle-up"></i></button>
                            <button <?php if ($i == count($Miniature) - 1) {
                                echo 'style="display:none;"';
                            } ?> type="button" id="li-minia-<?php echo $Miniature[$i]['id']; ?>-down"
                                 onclick="sendDirectPost('admin.php?&action=mooveMinia&type=1&id=<?php echo $Miniature[$i]['id']; ?>', function(data) { if(data) { menuMooveDown(get('li-minia-<?php echo $Miniature[$i]['id']; ?>')); }});"
                                 class="btn btn-sm btn-outline-secondary"><i class="fas fa-angle-down"></i></button>

                            <button onclick="sendDirectPost('admin.php?action=supprMiniature&id=<?php echo $Miniature[$i]['id']; ?>', function(data) { if(data) { hide('minia-<?php echo $Miniature[$i]['id']; ?>'); hide('li-minia-<?php echo $Miniature[$i]['id']; ?>'); } });"
                                    class="btn btn-sm btn-outline-secondary">Supprimer
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="id<?php echo $i; ?>" value="<?php echo $Miniature[$i]['id']; ?>">

                    <img class="col-md-12 thumbnail" id="minia-img-<?php echo $i; ?>"
                         src="theme/upload/navRap/<?php echo $Miniature[$i]['image']; ?>"/>

                    <label class="control-label">Image</label>
                    <select class="form-control" name="image<?php echo $i; ?>"
                            onchange="get('minia-img-<?php echo $i; ?>').src = 'theme/upload/navRap/'+this.value;">
                        <?php for ($j = 2; $j < count($images); $j++) { ?>
                            <option value="<?php echo $images[$j]; ?>" <?php if ($images[$j] == $Miniature[$i]['image']) {
                                echo 'selected';
                            } ?>><?php echo $images[$j]; ?></option>
                        <?php } ?>
                    </select>

                    <label class="control-label">Message sous l'image</label>
                    <textarea id="ckeditor" data-UUID="03<?php echo $Miniature[$i]['id']; ?>" class="form-control"
                              name="message<?php echo $i; ?>"
                              maxlength="200"><?php echo $Miniature[$i]['message']; ?></textarea>

                    <div class="custom-control custom-radio" style="margin-top:20px;">
                        <input type="radio" name="type<?php echo $i; ?>" value="0" id="radiominia0<?php echo $i; ?>"
                               class="custom-control-input"
                               onclick="show('lienpage<?php echo $i; ?>');hide('lienurl<?php echo $i; ?>');" <?php if ($Miniature[$i]['type'] == 0) {
                            echo 'checked';
                        } ?>>
                        <label class="custom-control-label" for="radiominia0<?php echo $i; ?>">Je souhaite rediriger
                            vers une page existante</label>
                    </div>

                    <div class="custom-control custom-radio">
                        <input type="radio" name="type<?php echo $i; ?>" value="1" id="radiominia1<?php echo $i; ?>"
                               onclick="hide('lienpage<?php echo $i; ?>');show('lienurl<?php echo $i; ?>');"
                               class="custom-control-input" <?php if ($Miniature[$i]['type'] == 1) {
                            echo 'checked';
                        } ?>>
                        <label class="custom-control-label" for="radiominia1<?php echo $i; ?>">Je souhaite rediriger
                            vers un lien personnalisé</label>
                    </div>

                    <div id="lienurl<?php echo $i; ?>" <?php if ($Miniature[$i]['type'] == 0) {
                        echo 'style="display:none;"';
                    } ?>>
                        <label class="control-label">Lien</label>
                        <input type="text" class="form-control"
                               name="lien<?php echo $i; ?>" <?php if ($Miniature[$i]['type'] == 1) {
                            echo 'value="' . $Miniature[$i]['lien'] . '"';
                        } ?> maxlength="100" placeholder="ex: http://minecraft.net/">
                    </div>
                    <div id="lienpage<?php echo $i; ?>" <?php if ($Miniature[$i]['type'] == 1) {
                        echo 'style="display:none;"';
                    } ?>>
                        <label class="control-label">Page</label>
                        <select class="form-control" name="page<?php echo $i; ?>">
                            <?php $o = 0;
                            while ($o < count($pages)) { ?>
                                <option id=""
                                        value="<?php echo $pages[$o]; ?>" <?php if (str_replace('?&page=', '', $Miniature[$i]['lien']) == urlencode($pages[$o])) {
                                    echo 'selected';
                                } ?>><?php echo $pages[$o]; ?></option><?php $o++;
                            } ?>
                        </select>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
<?php } ?>              