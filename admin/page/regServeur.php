<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"> Serveur
            <small>Gestionnaire du/des Serveur(s)</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a data-toggle="collapse" data-parent="#adminPanel" href="#informations">Informations</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Serveur
            </li>
        </ol>
        <hr>
        <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['server']['actions']['addServer'] == false AND $_PGrades_['PermsPanel']['server']['actions']['editServer'] == false)) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux réglages du/des serveur(s).</strong>
                </div>
            </div>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['server']['actions']['addServer'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="row">
                    <h3>Création d'un serveur JSONAPI</h3>
                </div>
                <div class="row">
                    <div class="alert alert-success">
                        <strong>Vous pouvez ajouter autant de serveurs minecraft que vous le souhaitez. La connexion au(x) serveur(s) est essentiel !</strong>
                    </div>
                </div>
            </div>
            <form method="POST" action="?&action=serveurJsonNew">
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-6 col-lg-offset-3">
                                <h3>Ajout d'un serveur</h3>
                                <div class="row">
                                    <label class="control-label">Nom du serveur</label>
                                    <input type="text" name="JsonNom" class="form-control" placeholder="MineCraftOnline"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">Ip du serveur</label>
                                    <input type="text" name="JsonAddr" placeholder="ex: play.monserveur.fr ou 77.54.25.124" class="form-control"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">Port JsonAPI</label>
                                    <input type="text" name="JsonPort" class="form-control" placeholder="ex: 12548"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">User JSONAPI</label>
                                    <input type="text" name="JsonUser" class="form-control" placeholder="ex: admin"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">Mot de passe</label>
                                    <input type="password" name="JsonMdp" class="form-control" placeholder="ex: monMdpSecret"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">Salt</label>
                                    <input type="password" name="JsonSalt" class="form-control" placeholder="Depuis la 1.7, merci d'ignorer ce champ !"/>
                                </div>
                                <hr>
                                <div class="row">
                                    <input type="submit" class="btn btn-success" value="Ajouter le serveur !"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['server']['actions']['editServer'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="row">
                    <h3>Edition du/des serveur(s)</h3>
                </div>
                <div class="row">
                    <?php if(count($lecture['Json']) == 0) { ?>
                        <div class="alert alert-warning">
                            <strong>Merci de bien vouloir ajouter un serveur pour pouvoir le modifier !</strong>
                        </div>
                    <?php } else { ?>
                        <div class="alert alert-success">
                            <strong>Vous pouvez modifier les données du/des serveur(s) ajouté(s). Pour cela rien de plus simple, il vous suffit de remplir le formulaire ci-contre.</strong>
                        </div>
                    <?php } 
                    if(!count($lecture['Json']) == 0) { ?>
                        <form method="POST" action="?&action=serveurConfig">
                            <div class="col-lg-6 col-lg-offset-3 text-center">
                                <div class="panel panel-primary">
                                    <div class="panel-body">
                                        <div class="col-lg-10 col-lg-offset-1">
                                            <div class="row">
                                                <ul class="nav nav-tabs">
                                                    <?php for($i = 0; $i < count($lecture['Json']); $i++) { ?>
                                                        <li <?php if($i == 0) echo 'class="active"'; ?>><a href="#jsonReg<?php echo $i; ?>" data-toggle="tab">Serv' <?php echo $i + 1; ?></a></li>
                                                    <?php } ?>
                                                </ul>
                                                <div class="tab-content">
                                                    <?php for($i = 0; $i < count($lecture['Json']); $i++) { ?>
                                                        <div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="jsonReg<?php echo $i; ?>">
                                                            <h4><?php echo $lecture['Json'][$i]['nom']; ?>  <a class="btn btn-danger" href="?&action=supprJson&nom=<?php echo $lecture['Json'][$i]['nom']; ?>">Supprimer ce serveur</a></h4>
                                                            <div class="row">
                                                                <label class="control-label">Nom du serveur</label>
                                                                <input type="text" name="JsonNom<?php echo $i; ?>" class="form-control" placeholder="Ca sert à mieux s'y retrouver" value="<?php echo $lecture['Json'][$i]['nom']; ?>">
                                                            </div>
                                                            <div class="row">
                                                                <label class="control-label">Ip du serveur</label>
                                                                <input type="text" name="JsonAddr<?php echo $i; ?>" class="form-control" placeholder="play.monserveur.fr" value="<?php echo $lecture['Json'][$i]['adresse']; ?>">
                                                            </div>
                                                            <div class="row">
                                                                <label class="control-label">Port JsonAPI</label>
                                                                <input type="text" name="JsonPort<?php echo $i; ?>" class="form-control" placeholder="12548" value="<?php echo $lecture['Json'][$i]['port']; ?>">
                                                            </div>
                                                            <div class="row">
                                                                <label class="control-label">User JsonAPI</label>
                                                                <input type="text" name="JsonUser<?php echo $i; ?>" class="form-control" placeholder="admin" value="<?php echo $lecture['Json'][$i]['utilisateur']; ?>">
                                                            </div>
                                                            <div class="row">
                                                                <label class="control-label">Mot de passe</label>
                                                                <input type="text" name="JsonMdp<?php echo $i; ?>" class="form-control" placeholder="Brouette" value="<?php echo $lecture['Json'][$i]['mdp']; ?>">
                                                            </div>
                                                            <div class="row">
                                                                <label class="control-label">Salt</label>
                                                                <input type="text" name="JsonSalt<?php echo $i; ?>" class="form-control" placeholder="MonSaltSecret" value="<?php echo $lecture['Json'][$i]['salt']; ?>">
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <input type="submit" class="btn btn-success" value="Valider les changements"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- /.row -->