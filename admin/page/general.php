<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"> General
            <small>Gestionnaire General</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a data-toggle="collapse" data-parent="#adminPanel" href="#informations">Informations</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> General
            </li>
        </ol>
        <hr>
        <?php if($_Joueur_['rang'] != 1 AND $_PGrades_['PermsPanel']['general']['actions']['editGeneral'] == false) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux réglages généraux.</strong>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-success">
                    <strong>Modifiez ici les informations principales de votre serveur. La plupart des autres données du site dépendent de la base de données, qui est donc essentielle, changez les identifiants de la base seulement si vous savez ce que vous faites ! </strong>
                </div>
            </div>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['general']['actions']['editGeneral'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <h3>Edition des informations</h3>
            </div>
            <form method="POST" action="?&action=general">
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-6 col-lg-offset-3">
                                <h3>Informations</h3>
                                <div class="row">
                                    <label class="control-label">Adresse du site</label>
                                    <input type="url" name="adresseWeb" class="form-control text-center" placeholder="http://monsiteminecraft.fr/" value="<?php echo $lecture['General']['url']; ?>">
                                </div>
                                <div class="row">
                                    <label class="control-label">Nom du serveur</label>
                                    <input type="text" name="nom" class="form-control text-center" placeholder="MineServeur" value="<?php echo $lecture['General']['name']; ?>">
                                </div>
                                <div class="row">
                                    <label class="control-label">Description</label>
                                    <input type="text" name="description" class="form-control text-center" placeholder="Mon super serveur minecraft !" value="<?php echo $lecture['General']['description']; ?>">
                                </div>
                                <hr>
                                <h3>Base de données</h3>
                                <div class="row">
                                    <label class="control-label">Adresse</label>
                                    <input type="text" name="adresse" class="form-control text-center" placeholder="localhost" value="<?php echo $lecture['DataBase']['dbAdress']; ?>">
                                </div>
                                <div class="row">
                                    <label class="control-label">Nom de la base</label>
                                    <input type="text" name="dbNom" class="form-control text-center" placeholder="BaseSite" value="<?php echo $lecture['DataBase']['dbName']; ?>">
                                </div>
                                <div class="row">
                                    <label class="control-label">Nom d'utilisateur</label>
                                    <input type="text" name="dbUtilisateur" class="form-control text-center" placeholder="root" value="<?php echo $lecture['DataBase']['dbUser']; ?>">
                                </div>
                                <div class="row">
                                    <label class="control-label">Mot de passe</label>
                                    <input type="password" name="dbMdp" class="form-control text-center" placeholder="Balançoire" value="<?php echo $lecture['DataBase']['dbPassword']; ?>">
                                </div>
                                <hr>
                                <div class="row">
                                    <input type="submit" class="btn btn-danger" value="Valider les changements" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php } ?>
	</div>
</div>
<!-- /.row -->