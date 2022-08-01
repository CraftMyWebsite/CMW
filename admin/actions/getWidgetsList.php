<?php if ($_Permission_->verifPerm('PermsPanel', 'widgets', 'actions', 'editWidgets')) {
    require_once('./admin/donnees/widgets.php'); ?>
    <?php if (!empty($widgets)) { ?>
        <input type="hidden" name="count" value="<?php echo count($widgets); ?>">
        <ul class="nav nav-tabs">
            <?php for ($i = 0; $i < count($widgets); $i++) { ?>
                <li class="nav-item" id="li-widgets-<?php echo $widgets[$i]['id']; ?>"><a
                            class="<?php if ($i == 0) echo 'active'; ?> nav-link"
                            href="#widgets-<?php echo $widgets[$i]['id']; ?>" data-toggle="tab"
                            style="color: black !important">Widget #<?php echo $i + 1; ?></a></li>
            <?php } ?>
        </ul>
        <div class="tab-content">
            <?php for ($i = 0; $i < count($widgets); $i++) { ?>
                <div class="tab-pane well <?php if ($i == 0) echo 'active'; ?>"
                     id="widgets-<?php echo $widgets[$i]['id']; ?>">
                    <div style="width: 100%;display: inline-block">
                        <div class="float-left">
                            <h3>Widget #<?php echo $i + 1; ?></h3>
                        </div>
                        <div class="float-right">
                            <button <?php if ($i == 0) {
                                echo 'style="display:none;"';
                            } ?> type="button" id="li-widgets-<?php echo $widgets[$i]['id']; ?>-up"
                                 onclick="sendDirectPost('admin.php?&action=mooveWidgets&type=0&id=<?php echo $widgets[$i]['id']; ?>', function(data) { if(data) { menuMooveUp(get('li-widgets-<?php echo $widgets[$i]['id']; ?>')); }});"
                                 class="btn btn-sm btn-outline-secondary"><i class="fas fa-angle-up"></i></button>
                            <button <?php if ($i == count($widgets) - 1) {
                                echo 'style="display:none;"';
                            } ?> type="button" id="li-widgets-<?php echo $widgets[$i]['id']; ?>-down"
                                 onclick="sendDirectPost('admin.php?&action=mooveWidgets&type=1&id=<?php echo $widgets[$i]['id']; ?>', function(data) { if(data) { menuMooveDown(get('li-widgets-<?php echo $widgets[$i]['id']; ?>')); }});"
                                 class="btn btn-sm btn-outline-secondary"><i class="fas fa-angle-down"></i></button>

                            <button onclick="sendDirectPost('admin.php?action=supprWidgets&id=<?php echo $widgets[$i]['id']; ?>', function(data) { if(data) { hide('widgets-<?php echo $widgets[$i]['id']; ?>'); hide('li-widgets-<?php echo $widgets[$i]['id']; ?>',true, function() { checkMenuForMoove(); }); } });"
                                    class="btn btn-sm btn-outline-secondary">Supprimer
                            </button>
                        </div>
                    </div>

                    <input type="hidden" name="id<?php echo $i; ?>" value="<?php echo $widgets[$i]['id']; ?>">

                    <label class="control-label">Titre du Widget</label>
                    <input type="text" name="titre<?php echo $i; ?>" value="<?= $widgets[$i]['titre'] ?> "
                           class="form-control" placeholder="Partenaires...">

                    <label class="control-label">Type de Widget</label>
                    <select class="form-control"
                            onchange="if(this.value == '3' | this.value == 3) { show('ck-ct<?php echo $i; ?>'); } else { hide('ck-ct<?php echo $i; ?>'); }"
                            name="type<?php echo $i; ?>">
                        <option value="0" <?= $widgets[$i]['type'] == 0 ? 'selected' : '' ?>>Gestion du compte</option>
                        <option value="1" <?= $widgets[$i]['type'] == 1 ? 'selected' : '' ?>>Status Serveurs</option>
                        <option value="2" <?= $widgets[$i]['type'] == 2 ? 'selected' : '' ?>>Joueurs en ligne</option>
                        <option value="3" <?= $widgets[$i]['type'] == 3 ? 'selected' : '' ?>>Champ Texte</option>
                    </select>

                    <div id="ck-ct<?php echo $i; ?>" <?= $widgets[$i]['type'] == 3 ? '' : 'style="display:none;"' ?> >
                        <label class="control-label">Message du widget</label>
                        <textarea class="form-control" id="ckeditor" data-UUID="0009" name="message<?php echo $i; ?>">
			                	<?= $widgets[$i]['type'] == 3 ? $widgets[$i]['message'] : '' ?>
			                </textarea>
                    </div>

                </div>
            <?php } ?>
        </div>
    <?php } ?>
<?php } ?>