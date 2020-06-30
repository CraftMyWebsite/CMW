<div class="cmw-page-content-header"><strong>Votes</strong> - Gérez vos votes</div>
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
        <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['vote']['actions']['editSettings'] == false AND $_PGrades_['PermsPanel']['vote']['actions']['addVote'] == false)) { ?>
            <div class="col-lg-12 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux votes.</strong>
                </div>
            </div>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['editSettings'] == true) { ?>
        <div class="col-lg-12 text-justify">
            <div class="alert alert-success">
                <strong>Dans cette section vous pourrez configurer vos votes.</strong><br/>
                Pour le message vous pouvez utiliser les tags:<ul>
                    <li> {JOUEUR} qui sera remplacé par le nom du joueur qui a voté</li>
                    <li> {QUANTITE} qui sera remplacé par la quantité de jetons site, ou d'item IG give</li>
                    <li> {ID} qui sera remplacé par l'id de l'item give IG </li>
                </ul>
                Pour la commande vous pourrez utiliser : <ul>
                    <li> {JOUEUR} qui correspond au nom du joueur qui vote. </li>
                </ul>
                Bonne configuration ! 
            </div>
        </div>
    </div>
    <form method="POST" action="?&action=creerLienVote">
        <div class="col-lg-12">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Configuration des votes</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-5">
                        <h3>Réglages des votes</h3>
                        <div class="row">
                            <label class="control-label">Message affiché lors du vote</label>
                            <input type="text" name="message" class="form-control"/>
                        </div>
                        <div class="row">
                            <label class="control-label">Afficher le message ?</label>
                            <input type="radio" name="display" value="1" id="1" checked />
                            <label for="1"> Oui </label>
                            <input type="radio" name="display" value="2" id="2"/>
                            <label for="2"> Non </label>
                        </div>
                        <div class="row">
                            <label class="control-label">Executer une Commande/Give d'item</label>
                            <select name="action" class="form-control">
                                <option value="1"> Executer une commande </option>
                                <option value="2"> Give d'item </option>
                                <option value="3"> Give de jetons site</option>
                            </select>
                        </div>
                        <div class="row">
                            <label class="control-label">Obtention de la récompense</label>
                            <select name="methode" class="form-control">     
                                <option value="1"> Le serveur où il est en ligne </option>
                                <option value="2"> Le serveur de la catégorie </option>
                            </select>
                        </div>
                        <div class="row">
                            <label class="control-label">Commande à éxecuter (SANS /)</label>
                            <input type="text" name="cmd" class="form-control" />
                        </div>
                        <div class="row">
                            <label class="control-label">ID de l'item</label>
                            <input type="text" name="id" class="form-control" value="264" />
                        </div>
                    </div>
                    <div class="col-md-offset-1 col-md-6">
                        <div class="row">
                            <label class="control-label">Quantité de l'item à donner <strong>OU</strong> quantité de jetons à donner</label>
                            <input type="text" name="quantite" class="form-control" value="4" />
                        </div>
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
                            <input type="url" name="lien" placeholder="ex: http://serveurs-minecraft.com/...../" class="form-control" required>
                        </div>
                        <div class="row">
                            <label class="control-label">Titre du lien</label>
                            <input type="text" name="titre" placeholder="ex: Voter sur McServ !" class="form-control" required>
                        </div>
                        <div class="row">
                            <label class="control-label">Temps de vote</label>
                            <input type="number" name="temps" placeholder="ex: 86400 pour 24h" class="form-control" required>
                        </div>
						 <div class="row">
                            <label class="control-label">Id unique donné par le site web. *</label>
                            <input type="text" name="idCustom" placeholder="ex: 54748" value="" class="form-control" />
                        </div>
						<div class="row">
                            <label class="control-label">Le joueur doit être connecté sur le serveur pour voter sur ce lien excepté si le pseudo rentré sur la page est le même que celui du compte du joueur sur votre site web ( cela aura pour conséquence de stocker ces récompenses )</label>
                            <input type="radio" name="enligne" value="1" id="3" checked />
                            <label for="3"> Oui </label>
                            <input type="radio" name="enligne" value="0" id="4"/>
                            <label for="4"> Non </label>
							</div>
                        <hr>
                        <div class="row text-center">
                            <input type="submit" class="btn btn-success" value="Valider les changements !"/>
                        </div>
                    </div>
					 <strong>* Un système de vérification de votes est intégré</strong><br/>
               Les sites suivant sont compatible avec cette vérification:<ul>
                    <li> serveur-prive.net</li>
                    <li> serveurs-minecraft.org</li>
                    <li> serveurs-minecraft.com</li>
                    <li> serveursminecraft.fr</li>
                    <li> liste-minecraft-serveurs.com</li>
					<li> liste-serveurs.fr</li>
                    <li> liste-serveur.fr</li>
                </ul> À noter que certains service de recherche du serveur n'ont pas une API utilisable ! Pour que celle-ci fonctionne sur le cm, vous devez remplir le champ "Id unique" par l'id donner par le site web ( généralement dans les onglets API). Laisser vide pour le désactiver. Si l'id venait â être incorrecte, ne vous étonnez pas que les votes ne se valident pas : p
                </div>
            </div>
        </div>
        </form>
    <?php }
    if($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['vote']['actions']['resetVote'] == true OR $_PGrades_['PermsPanel']['vote']['actions']['deleteVote'] == true)) { ?>
        <div class="col-lg-12">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Edition des votes</strong></h3>
                </div>
                <div class="panel-body">
                    <?php if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['resetVote'] == true) { ?>
                        <div class="row text-center">
                            <h3>Réinitialisation</h3>
                            <a href="?action=resetVotes" class="btn btn-danger">Réinitialiser les votes</a>
                        </div>
                    <?php }
                    if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['deleteVote'] == true) { ?>
                        <div class="row">
                            <h3 class="text-center">Gestion des votes</h3>
                        </div>
                        <form action="?action=modifierVote" method="post">
                        <table class="table table-striped table-hover " >
                            <tr>
                                <th>Titre</th>
                                <th>Lien de vote</th>
                                <th>Catégorie</th>
                                <th>Récompense donnée sur</th>
                                <th>Action</th>
                                <th>Quantité</th>
                                <th>Commande</th>
                                <th>Id de l'item</th>
                                <th>Message</th>
                                <th>Temps entre chaque vote</th>
								<th>Id unique</th>
								<th>Doit être connecté sur le serveur</th>
                                <th>Action</th>
                            </tr>
                        <?php $donnees = $req_donnees->fetchAll();
                        for($o=0; $o < count($donnees); $o++)
                        {
                            ?><tr>
                                <td><input type="text" class="form-control" name="titre<?=$o;?>" value="<?=$donnees[$o]['titre'];?>" /></td>
                                <td><input type="url" value="<?=$donnees[$o]['lien'];?>" class="form-control" name="lien<?=$o;?>" /></td>
                                <td><select name="serveur<?=$o;?>" class="form-control">        
                                <?php for($i = 0; $i < count($lectureServs); $i++) {        ?>
                                    <option value="<?php echo $i ?>" <?=($lectureServs[$i]['nom'] == $lectureServs[intval($donnees[$o]['serveur'])]['nom']) ? 'selected' : ''; ?>> <?php echo $lectureServs[$i]['nom']; ?> </option>
                                <?php } ?>
                                </select></td>
                                <td><select name="methode<?=$o;?>" class="form-control">     
                                    <option value="1" <?=($donnees[$o]['methode'] == 1) ? 'selected' : '';?>> Le serveur où il est en ligne </option>
                                    <option value="2" <?=($donnees[$o]['methode'] == 2) ? 'selected' : '';?>> Le serveur de la catégorie </option>
                                </select></td><?php $action = explode(':', $donnees[$o]['action'], 2); ?>
                                <td><select name="action<?=$o;?>" class="form-control">
                                    <option value="1" <?=($action[0] == 'cmd') ? 'selected' : '';?>> Executer une commande </option>
                                    <option value="2" <?=($action[0] == 'give') ? 'selected' : '';?>> Give d'item </option>
                                    <option value="3" <?=($action[0] == 'jeton') ? 'selected' : '';?>> Give de jetons site</option>
                                </select></td><?php if($action[0] == "give")
                                    $item = explode(':', $action[1]);
                                    if($action[0] == "jeton")
                                        $quantite = $action[1];
                                    elseif($action[0] == "give")
                                        $quantite = $item[3];
                                    else
                                        $quantite = '';
                                ?>
                                <td><input type="text" name="quantite<?=$o;?>" class="form-control" value="<?=$quantite;?>" /></td>
                                <td><input type="text" name="cmd<?=$o;?>" class="form-control" value="<?=($action[0] == 'cmd') ? $action[1] : '';?>" /></td>
                                <td><input type="text" name="id<?=$o;?>" class="form-control" value="<?=($action[0] == "give") ? $item[1] : '';?>" /></td>
                                <td><input type="text" name="message<?=$o;?>" class="form-control" value="<?=$donnees[$o]['message'];?>" /></td>
                                <td><input type="number" name="temps<?=$o;?>" class="form-control" value="<?=$donnees[$o]['temps'];?>" /></td>
								<td><input type="text" name="idCustom<?=$o;?>" class="form-control" value="<?=$donnees[$o]['idCustom'];?>" /></td>
								<td><input type="checkbox" name="enligne<?=$o;?>" class="form-control" value="1" <? if($donnees[$o]['enligne'] == 1) { echo 'checked'; } ?>></td>
                                <td><a href="?action=supprVote&id=<?=$donnees[$o]['id'];?>" class="btn btn-danger">Supprimer</a></td></tr>
                                <?php 
                        }
                        ?>
                        </table>
                        <div class="row text-center">
                            <button type="submit" class="btn btn-success">Valider les changements</button>
                        </div>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<!-- /.row -->
