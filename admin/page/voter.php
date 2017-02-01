<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"> Vote
            <small>Gestionnaire des Votes</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a data-toggle="collapse" data-parent="#adminPanel" href="#informations">Informations</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Vote
            </li>
        </ol>
        <hr>
        <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['vote']['actions']['editSettings'] == false AND $_PGrades_['PermsPanel']['vote']['actions']['addVote'] == false)) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux votes.</strong>
                </div>
            </div>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['editSettings'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <h3>Configuration des votes</h3>
            </div>
            <form method="POST" action="?&action=modifierVotesGen">
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-6 col-lg-offset-3">
                                <h3>Réglages des votes</h3>
                                <div class="row">
                                    <label class="control-label">Message affiché lors du vote</label>
                                    <input type="text" name="message" class="form-control" value="<?php echo $lectureVotes['message']; ?>"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">Afficher le message ?</label>
                                    <input type="radio" name="display" value="1" id="1" <?php if($lectureVotes['display'] == 1){ echo 'checked'; } ?> />
                                    <label for="1"> Oui </label>
                                    <input type="radio" name="display" value="2" id="2" <?php if($lectureVotes['display'] == 2){ echo 'checked'; } ?>/>
                                    <label for="2"> Non </label>
                                </div>
                                <div class="row">
                                    <label class="control-label">Executer une Commande/Give d'item</label>
                                    <select name="action" class="form-control">
                                        <option value="<?php echo $lectureVotes['action']; ?>"></option>
                                        <option value="1"> Executer une commande </option>
                                        <option value="2"> Give d'item </option>
                                    </select>
                                </div>
                                <div class="row">
                                    <label class="control-label">Obtention de la récompense</label>
                                    <select name="methode" class="form-control">     
                                        <option value="<?php echo $lectureVotes['methode']; ?>"></option>
                                        <option value="1"> Le serveur où il est en ligne </option>
                                        <option value="2"> Le serveur de la catégorie </option>
                                    </select>
                                </div>
                                <div class="row">
                                    <label class="control-label">Commande à éxecuter (SANS /)</label>
                                    <input type="text" name="cmd" class="form-control" value="<?php echo $lectureVotes['cmd']; ?>"/>
                                </div>
                                <div class="row">
                                    <label class="control-label">ID de l'item</label>
                                    <input type="text" name="id" value="<?php echo $lectureVotes['id']; ?>" class="form-control" value="264" />
                                </div>
                                <div class="row">
                                    <label class="control-label">Quantité</label>
                                    <input type="text" name="quantite" value="<?php echo $lectureVotes['quantite']; ?>" class="form-control" value="4" />
                                </div>
                                <hr>
                                <div class="row">
                                    <input type="submit" class="btn btn-success" value="Valider les changements !"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php } 
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['addVote'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <h3>Création d'un lien de vote</h3>
            </div>
            <form method="POST" action="?&action=creerLienVote">
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-6 col-lg-offset-3">
                                <h3>Ajout d'un vote</h3>
                                <div class="row">
                                    <label class="control-label">Lien de vote du serveur</label>
                                    <select name="serveur" class="form-control">        
                                        <?php for($i = 0; $i < count($lectureServs); $i++) {        ?>
                                            <option value="<?php echo $i ?>"> <?php echo $lectureServs[$i]['nom']; ?> </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <label class="control-label">Lien de vote</label>
                                    <input type="text" name="lien" placeholder="ex: http://serveurs-minecraft.com/...../" class="form-control" />
                                </div>
                                <div class="row">
                                    <label class="control-label">Titre du lien</label>
                                    <input type="text" name="titre" placeholder="ex: Voter sur McServ !" class="form-control" />
                                </div>
                                <div class="row">
                                    <label class="control-label">Temps de vote</label>
                                    <input type="number" name="temps" placeholder="ex: 86400 pour 24h" class="form-control" />
                                </div>
                                <hr>
                                <div class="row">
                                    <input type="submit" class="btn btn-success" value="Valider"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php }
        if($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['vote']['actions']['resetVote'] == true OR $_PGrades_['PermsPanel']['vote']['actions']['deleteVote'] == true)) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <h3>Edition des votes</h3>
            </div>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['resetVote'] == true) { ?>
                            <h3>Réinitialisation</h3>
                            <div class="row">
                                <a href="?action=resetVotes" class="btn btn-danger">Réinitialiser les votes</a>
                            </div>
                        <?php }
                        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['deleteVote'] == true) { ?>
                            <h3>Suppression</h3>
                            <div class="row">
                                <?php for($i = 0; $i < count($lectureVotes['liens']); $i++) { ?>
                                    <a href="?&action=supprLienVote&id=<?php echo $i; ?>" class="btn btn-danger"><?php echo $lectureVotes['liens'][$i]['titre']; ?></a>
                                <?php } ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- /.row -->