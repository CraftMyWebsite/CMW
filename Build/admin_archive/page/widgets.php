<div class="cmw-page-content-header"><strong>Gestion</strong> - Gérez vos Widgets</div>
        <?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'widgets', 'actions', 'addWidgets') AND !Permission::getInstance()->verifPerm('PermsPanel', 'widgets', 'actions', 'editWidgets')) { ?>
            <div class="row">
            <div class="col-md-12 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux widgets.</strong>
                </div>
            </div>
        </div>
        <?php } else { ?>
            <div class="col-md-12 text-center">
                <div class="alert alert-success">
                    <strong>Les widgets sont disponibles uniquement sur certains thèmes</strong>
                </div>
            </div>
        <?php }
        if(Permission::getInstance()->verifPerm('PermsPanel', 'widgets', 'actions', 'addWidgets')) { ?>
        <div class="col-md-6">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Création d'un widget</strong></h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="?action=newWidget">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Ajout d'un Widget</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label class="control-label">Titre du Widget</label>
                                <input type="text" name="titre" class="form-control" placeholder="Partenaires...">
                            </div>
                            <div class="col-md-6">>
                                <label class="control-label">Type de Widget</label>
                                <select class="form-control" name="type">
                                    <option value="0">Gestion du compte</option>
                                    <option value="1">Status Serveurs</option>
                                    <option value="2">Joueurs en ligne</option>
                                    <option value="3">Champ Texte</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Message du widget<small> uniquement pour les "champs texte"</small></label>
                                <textarea class="form-control" name="message"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-center" style="margin-top: 5px;">
                                <input type="submit" class="btn btn-success" value="Valider" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php }
        if(Permission::getInstance()->verifPerm('PermsPanel', 'widgets', 'actions', 'editWidgets')) { ?>
        <div class="col-md-6">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Édition des Widgets</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h3>Modifier mes Widgets</h3>
                        </div>
                    </div>
                    <div class="row">
                        <ul class="nav nav-tabs">
                            <?php for($i = 0; $i < count($widgets); $i++) { ?>    
                                <li <?php if($i == 0) echo 'class="active"'; ?>><a href="#widgets<?php echo $i; ?>" data-toggle="tab"><?php echo $widgets[$i]['titre']; ?></a></li>
                            <?php } ?>
                        </ul>
                        <div class="tab-content well">
                            <?php for($i = 0; $i < count($widgets); $i++) { ?> 
                                <div class="tab-pane <?php if($i == 0) echo 'active'; ?>" id="widgets<?php echo $i; ?>">
                                    <div class="row">
                                        <?php if($i != 0) { ?>
                                            <div class="col-md-4">
                                                <a class="btn btn-primary" href="?action=upWidget&id=<?php echo $i; ?>"><span class="glyphicon glyphicon-arrow-up"></span> Monter le widget</a>
                                            </div>
                                        <?php }
                                        if($i != count($widgets) - 1) { ?>
                                            <div class="col-md-4">
                                                <a class="btn btn-primary" href="?action=downWidget&id=<?php echo $i; ?>"><span class="glyphicon glyphicon-arrow-down"></span> Descendre le widget</a>
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-4">
                                            <a class="btn btn-danger" href="?action=supprWidget&id=<?php echo $i; ?>">Supprimer ce widget</a>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>