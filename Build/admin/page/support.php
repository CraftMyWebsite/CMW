<div class="cmw-page-content-header"><strong>Gestion</strong> - Gérez vos tickets support</div>
        <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['support']['tickets']['actions']['editEtatTicket'] == false AND $_PGrades_['PermsPanel']['support']['tickets']['actions']['deleteTicket'] == false)) { ?><div class="row">
            <div class="ccol-md-12 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux tickets.</strong>
                </div>
            </div></div>
        <?php } 
        if($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['support']['tickets']['actions']['editEtatTicket'] == true OR $_PGrades_['PermsPanel']['support']['tickets']['actions']['deleteTicket'] == true)) {
            if($aucunTicket) { ?><div class="row">
                <div class="col-md-12 text-center">
                    <div class="alert alert-warning">
                        <strong>Aucun ticket n'a été créé par les membres jusqu'à présent !</strong>
                    </div>
                </div></div>
            <?php } else { ?>
            <div class="row">
				<div class=" col-md-3 text-center">
					<div class="panel panel-default cmw-panel">
						<div class="panel-heading cmw-panel-header">
							<h3 class="panel-title"><strong>visibilité du support</strong></h3>
						</div>
						<div class="panel-body">
							<form method="POST" action="?&action=switchTypeSupport">
								<select name="visibilite" class="form-control" required>
									<option value="both"<?php if(isset($_Serveur_["support"]["visibilite"]) && $_Serveur_["support"]["visibilite"] == "both") echo " selected"?>> Au choix
									<option value="prive"<?php if(isset($_Serveur_["support"]["visibilite"]) && $_Serveur_["support"]["visibilite"] == "prive") echo " selected"?>> Privée
									<option value="public"<?php if(isset($_Serveur_["support"]["visibilite"]) && $_Serveur_["support"]["visibilite"] == "public") echo " selected"?>> Publique
								</select>
								<input type="submit" class="btn btn-success" value="Valider">
							</form>
						</div>
					</div>
				</div>
                <div class="col-md-9 text-center">
                    <div class="panel panel-default cmw-panel">
                        <div class="panel-heading cmw-panel-header">
                            <h3 class="panel-title"><strong>Édition des tickets</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <a class="btn btn-danger" href="?action=supprAllTickets">Tout supprimer</a><br/><br/>
                                <table class="table table-bordered">
                                    <tr>
                                        <th style="text-align: center;">Titre</th>
                                        <th style="text-align: center;">Auteur</th>
                                        <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['tickets']['actions']['deleteTicket'] == true) { ?>
                                            <th style="text-align: center;">Supprimer</th>
                                        <?php }
                                        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['tickets']['actions']['editEtatTicket'] == true) { ?>
                                            <th style="text-align: center;">Action</th>
                                        <?php } ?>
                                    </tr>
                                    <?php for($i = 0; $i < count($donneesSupport); $i++) { ?>
                                        <form method="POST" action="?&action=etatTickets&id=<?php echo $donneesSupport[$i]['id']; ?>">
                                            <tr>
                                                <td><?php echo $donneesSupport[$i]['titre']; ?></td>
                                                <td><?php echo $donneesSupport[$i]['auteur']; ?></td>
                                                <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['tickets']['actions']['deleteTicket'] == true) { ?>
                                                    <td><a href="?action=supprTicket&id=<?php echo $donneesSupport[$i]['id']; ?>" class="btn btn-danger">Supprimer</a></td>
                                                <?php }
                                                if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['support']['tickets']['actions']['editEtatTicket'] == true) { ?>
                                                    <td><?php if($donneesSupport[$i]['etat'] == 0) { echo '<button type="submit" name="etat" class="btn btn-warning" value="1" />Fermer le ticket</button>'; } else { echo '<button type="submit" name="etat" class="btn btn-warning" value="0" />Ouvrir le ticket</button>'; } ?></td>
                                                <?php } ?>
                                            </tr>
                                        </form>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        <?php }
        } ?>