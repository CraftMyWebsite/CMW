<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Widgets
            <small>Gestionnaire des Widgets</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a data-toggle="collapse" data-parent="#adminPanel" href="#informations">Informations</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Widgets
            </li>
        </ol>
        <hr>
        <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['widgets']['actions']['addWidgets'] == false AND $_PGrades_['PermsPanel']['widgets']['actions']['editWidgets'] == false)) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux widgets.</strong>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-success">
                    <strong>Les Widgets sont disponible sur certains thèmes</strong>
                </div>
            </div>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['widgets']['actions']['addWidgets'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <h3>Création d'un Widget</h3>
            </div>
            <form method="post" action="?action=newWidget">
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-6 col-lg-offset-3">
                                <h3>Ajout d'un Widget</h3>
                                <div class="row">
                                    <label class="control-label">Titre du Widget</label>
                                    <input type="text" name="titre" class="form-control" placeholder="Partenaires...">
                                </div>
                                <div class="row">
                                    <label class="control-label">Type de Widget</label>
                                    <select class="form-control" name="type">
                                        <option value="0">Gestion du compte</option>
                                        <option value="1">Status Serveurs</option>
                                        <option value="2">Joueurs en ligne</option>
                                        <option value="3">Champ Texte</option>
                                    </select>
                                </div>
                                <div class="row">
                                    <label class="control-label">Message du Widget<small> Uniquement pour les "Champ Texte"</small></label>
                                    <textarea class="form-control" name="message"></textarea>
                                </div>
                                <hr>
                                <div class="row">
                                    <input type="submit" class="btn btn-success" value="Valider" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['widgets']['actions']['editWidgets'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <h3>Edition des Widgets</h3>
            </div>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="col-lg-6 col-lg-offset-3">
                            <h3>Modifier mes Widgets</h3>
                            <div class="row">
                                <ul class="nav nav-tabs">
                                    <?php for($i = 0; $i < count($widgets); $i++) { ?>    
                                        <li <?php if($i == 0) echo 'class="active"'; ?>><a href="#widgets<?php echo $i; ?>" data-toggle="tab"><?php echo $widgets[$i]['titre']; ?></a></li>
                                    <?php } ?>
                                </ul>
                                <div class="tab-content well">
                                    <?php for($i = 0; $i < count($widgets); $i++) { ?> 
                                        <div class="tab-pane <?php if($i == 0) echo 'active'; ?>" id="widgets<?php echo $i; ?>">
                                            <?php if($i != 0) { ?>
                                                <div class="row">
                                                    <a class="btn btn-primary btn-lg" href="?action=upWidget&id=<?php echo $i; ?>"><span class="glyphicon glyphicon-arrow-up"></span> Monter le widget</a>
                                                </div>
                                            <?php }
                                            if($i != count($widgets) - 1) { ?>
                                                <div class="row">
                                                    <a class="btn btn-primary btn-lg" href="?action=downWidget&id=<?php echo $i; ?>"><span class="glyphicon glyphicon-arrow-down"></span> Descendre le widget</a>
                                                </div>
                                            <?php } ?>
                                            <div class="row">
                                                <a class="btn btn-danger btn-lg" href="?action=supprWidget&id=<?php echo $i; ?>">Supprimer ce widget</a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- /.row -->