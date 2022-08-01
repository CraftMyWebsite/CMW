<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Gestion des widgets
    </h2>
</div>
<?php if (!$_Permission_->verifPerm('PermsPanel', 'widgets', 'showPage')) {
    echo '
	<div class="row">
		<div class="col-md-12 text-center">
			<div class="alert alert-danger">
				<strong>Vous avez aucune permission pour accéder aux widgets..</strong>
			</div>
		</div>
	</div>';
} else { ?>
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="alert alert-success">
                <strong>Les widgets sont disponibles uniquement sur certains thèmes</strong>
            </div>
        </div>
        <?php if ($_Permission_->verifPerm('PermsPanel', 'widgets', 'actions', 'addWidgets')) { ?>
            <div class="col-md-12 col-xl-6 col-12">
                <div class="card  ">
                    <div class="card-header ">
                        <h3 class="card-title"><strong>Création d'un widget</strong></h3>
                    </div>
                    <div class="card-body" id="addWidgets">
                        <label class="control-label">Titre du Widget</label>
                        <input type="text" name="titre" class="form-control" placeholder="Partenaires...">

                        <label class="control-label">Type de Widget</label>
                        <select class="form-control"
                                onchange="if(this.value == '3' | this.value == 3) { show('ck-ct'); } else { hide('ck-ct'); }"
                                name="type">
                            <option value="0">Gestion du compte</option>
                            <option value="1">Status Serveurs</option>
                            <option value="2">Joueurs en ligne</option>
                            <option value="3">Champ Texte</option>
                        </select>

                        <div id="ck-ct" style="display:none;">
                            <label class="control-label">Message du widget</label>
                            <textarea class="form-control" id="ckeditor" data-UUID="0009" name="message"></textarea>
                        </div>

                    </div>

                    <script>initPost("addWidgets", "admin.php?&action=addWidgets", function (data) {
                            if (data) {
                                widgetsUpdate();
                            }
                        });</script>

                    <div class="card-footer">
                        <div class="row text-center">
                            <input type="submit" onclick="sendPost('addWidgets', null );" class="btn btn-success w-100"
                                   value="Envoyer !"/>
                        </div>
                    </div>
                </div>
            </div>

        <?php }
        if ($_Permission_->verifPerm('PermsPanel', 'widgets', 'actions', 'editWidgets')) { ?>
            <div class="col-md-12 col-xl-6 col-12">
                <div class="card  ">
                    <div class="card-header ">
                        <h3 class="card-title"><strong>Édition des Widgets</strong></h3>
                    </div>
                    <div class="card-body" id="allWidgets">


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
                                                     class="btn btn-sm btn-outline-secondary"><i
                                                            class="fas fa-angle-up"></i></button>
                                                <button <?php if ($i == count($widgets) - 1) {
                                                    echo 'style="display:none;"';
                                                } ?> type="button"
                                                     id="li-widgets-<?php echo $widgets[$i]['id']; ?>-down"
                                                     onclick="sendDirectPost('admin.php?&action=mooveWidgets&type=1&id=<?php echo $widgets[$i]['id']; ?>', function(data) { if(data) { menuMooveDown(get('li-widgets-<?php echo $widgets[$i]['id']; ?>')); }});"
                                                     class="btn btn-sm btn-outline-secondary"><i
                                                            class="fas fa-angle-down"></i></button>

                                                <button onclick="sendDirectPost('admin.php?action=supprWidgets&id=<?php echo $widgets[$i]['id']; ?>', function(data) { if(data) { hide('widgets-<?php echo $widgets[$i]['id']; ?>'); hide('li-widgets-<?php echo $widgets[$i]['id']; ?>',true, function() { checkMenuForMoove(); }); } });"
                                                        class="btn btn-sm btn-outline-secondary">Supprimer
                                                </button>
                                            </div>
                                        </div>

                                        <input type="hidden" name="id<?php echo $i; ?>"
                                               value="<?php echo $widgets[$i]['id']; ?>">

                                        <label class="control-label">Titre du Widget</label>
                                        <input type="text" name="titre<?php echo $i; ?>"
                                               value="<?= $widgets[$i]['titre'] ?> " class="form-control"
                                               placeholder="Partenaires...">

                                        <label class="control-label">Type de Widget</label>
                                        <select class="form-control"
                                                onchange="if(this.value == '3' | this.value == 3) { show('ck-ct<?php echo $i; ?>'); } else { hide('ck-ct<?php echo $i; ?>'); }"
                                                name="type<?php echo $i; ?>">
                                            <option value="0" <?= $widgets[$i]['type'] == 0 ? 'selected' : '' ?>>Gestion
                                                du compte
                                            </option>
                                            <option value="1" <?= $widgets[$i]['type'] == 1 ? 'selected' : '' ?>>Status
                                                Serveurs
                                            </option>
                                            <option value="2" <?= $widgets[$i]['type'] == 2 ? 'selected' : '' ?>>Joueurs
                                                en ligne
                                            </option>
                                            <option value="3" <?= $widgets[$i]['type'] == 3 ? 'selected' : '' ?>>Champ
                                                Texte
                                            </option>
                                        </select>

                                        <div id="ck-ct<?php echo $i; ?>" <?= $widgets[$i]['type'] == 3 ? '' : 'style="display:none;"' ?> >
                                            <label class="control-label">Message du widget</label>
                                            <textarea class="form-control" id="ckeditor" data-UUID="0009"
                                                      name="message<?php echo $i; ?>">
			                	<?= $widgets[$i]['type'] == 3 ? $widgets[$i]['message'] : '' ?>
			                </textarea>
                                        </div>

                                    </div>
                                <?php } ?>
                            </div>
                        <?php } ?>


                    </div>
                    <script>initPost("allWidgets", "admin.php?action=editWidgets");</script>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success w-100" onClick="sendPost('allWidgets')">Envoyer!
                        </button>
                    </div>
                </div>
            </div>

        <?php } ?>
    </div>
<?php } ?>