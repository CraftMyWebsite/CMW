<div class="cmw-page-content-header"><strong>Votes</strong> - Gérez vos votes</div>
<!-- Page Heading -->
<div class="row" style="margin-top:10px;">
	<div class="col-lg-12">
        <?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'vote', 'actions', 'editSettings') AND Permission::getInstance()->verifPerm('PermsPanel', 'vote', 'actions', 'addVote')) { ?>
            <div class="col-lg-12 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux votes.</strong>
                </div>
            </div>
        <?php }
        if(Permission::getInstance()->verifPerm('PermsPanel', 'vote', 'actions', 'editSettings')) { ?>
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
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Message affiché lors du vote</label>
                            <input type="text" name="message" class="form-control"/>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Afficher le message ?</label>
                            <input type="radio" name="display" value="1" id="1" checked />
                            <label for="1"> Oui </label>
                            <input type="radio" name="display" value="2" id="2"/>
                            <label for="2"> Non </label>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Executer une Commande/Give d'item</label>
                            <select name="action" class="form-control">
                                <option value="1"> Executer une commande </option>
                                <option value="2"> Give d'item </option>
                                <option value="3"> Give de jetons site</option>
                            </select>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Obtention de la récompense</label>
                            <select name="methode" class="form-control">     
                                <option value="1"> Le serveur où il est en ligne </option>
                                <option value="2"> Le serveur de la catégorie </option>
                            </select>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Commande à éxecuter (SANS /)</label>
                            <input type="text" name="cmd" class="form-control" />
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">ID de l'item</label>
                            <input type="text" name="id" class="form-control" value="264" />
                        </div>
                    </div>
                    <div class="col-md-offset-1 col-md-6">
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Quantité de l'item à donner <strong>OU</strong> quantité de jetons à donner</label>
                            <input type="text" name="quantite" class="form-control" value="4" />
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Lien de vote du serveur</label>
                            <select name="serveur" class="form-control">        
                                <?php for($i = 0; $i < count($lectureServs); $i++) {        ?>
                                    <option value="<?php echo $i ?>"> <?php echo $lectureServs[$i]['nom']; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Lien de vote</label>
                            <input type="url" name="lien" placeholder="ex: http://serveurs-minecraft.com/...../" class="form-control" required>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Titre du lien</label>
                            <input type="text" name="titre" placeholder="ex: Voter sur McServ !" class="form-control" required>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Temps de vote</label>
                            <input type="number" name="temps" placeholder="ex: 86400 pour 24h" class="form-control" required>
                        </div>
						 <div class="row" style="margin-top:10px;">
                            <label class="control-label">Id unique donné par le site web. *</label>
                            <input type="text" name="idCustom" placeholder="ex: 54748" value="" class="form-control" />
                        </div>
						<div class="row" style="margin-top:10px;">
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
		<form method="POST" action="?&action=changeVoteCron">
        <div class="col-lg-12">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Configuration tâche cron</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-7">
                        <h3>Message</h3>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Entête du message</label>
                            <input type="text" name="entete" value="<?php if(isset($_Serveur_['VoteCron']['entete'])) { echo $_Serveur_['VoteCron']['entete']; } else { echo '&3&m___________&r &b&l[> &b&l/Vote &b&l<] &3&m___________'; }  ?>" class="form-control"/>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Contenue du message SI le joueur peut voter (laisser vide pour désactiver)</label>
							<ul>
								<li> <strong>{LIEN}</strong> contient l'url du site</li>
							</ul>
                            <input type="text" name="msgallow" value="<?php if(isset($_Serveur_['VoteCron']['msgallow'])) { echo $_Serveur_['VoteCron']['msgallow']; } else { echo '&3>> &b {LIEN} &3>> &b Voter ! &8/vote'; }  ?>" class="form-control"/>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Contenue du message SI le joueur ne peut pas voter</label>
							<ul>
								<li> <strong>{LIEN}</strong> contient l'url du site</li>
								<li> <strong>{TEMPS}</strong> contient le temps restant avant que le joueur puisse voter</li>
							</ul>
                             <input type="text" name="msgdeny" value="<?php if(isset($_Serveur_['VoteCron']['msgdeny'])) { echo $_Serveur_['VoteCron']['msgdeny']; } else { echo '&3>> &b {LIEN}&3>> &b {TEMPS} '; }  ?>" class="form-control"/>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Footer du message (laisser vide pour désactiver)</label>
                          <input type="text" name="footer" value="<?php if(isset($_Serveur_['VoteCron']['footer'])) { echo $_Serveur_['VoteCron']['footer']; } else { echo '&3&m_________________________________'; }  ?>" class="form-control"/>
                      
                        </div>
						 <div class="row" style="margin-top:10px;">
                            <label class="control-label">Mot de passe dela tâche cron, laisser vide pour désactivé l'accès à la tâche cron.</label>
                          <input type="text" name="mdp" id="mdpurlCron" onchange="document.getElementById('urlCron').innerText = '<?php echo $_Serveur_['General']['url'].'/?action=voteCron&mdp='; ?>' + document.getElementById('mdpurlCron').value" value="<?php if(isset($_Serveur_['VoteCron']['mdp'])) { echo $_Serveur_['VoteCron']['mdp']; }  ?>" placeholder="ex: CMW123" class="form-control"/>
                      
                        </div>
						
						
                       
                    </div>
                    <div class="col-md-offset-1 col-md-4">
						<div class="row">
                            <label class="control-label">Envoyé la notification même aux personnes qui n'ont jamais voté.
                          <input type="checkbox" name="sendtoall"  value="1"  <?php if(isset($_Serveur_['VoteCron']['sendtoall']) && $_Serveur_['VoteCron']['sendtoall'] == 1) { echo 'checked'; }  ?>></label>
                      
                        </div>
                        <div class="row" style="margin-top:10px;">
		Pour faire fonctionnez ce système vous devez avoir accès au tâche cron sur votre hébergeur, créez en une nouvelle et configurez la sur "récupérer une url", sélectionnez le temps que vous désirez et rentrez comme url: </br><strong id="urlCron"><?php echo $_Serveur_['General']['url'].'/?action=voteCron&mdp='; if(isset($_Serveur_['VoteCron']['mdp'])) { echo $_Serveur_['VoteCron']['mdp']; } ?></strong>
                        </div>
 
                        <div class="row text-center" style="margin-top:10px;">
                            <input type="submit" class="btn btn-success" value="Valider les changements"/>
							<input type="button" onClick="tryCron()" id="trycron" class="btn btn-success" value="Try it !"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
		
		<script>
			function tryCron() {
				document.getElementById('trycron').disabled = true;
				$.post("index.php?action=voteCron&mdp=" + document.getElementById('mdpurlCron').value,{
				},function(data, status){
					console.log(data);
					alert("Envoyé ! Si vous n'avez rien reçu sur votre serveur, vérifiez la connexion jsonapi et confirmez les changements !");
					document.getElementById('trycron').disabled = false;
				});
			}
		</script>
    <?php }
    if(Permission::getInstance()->verifPerm('PermsPanel', 'vote', 'actions', 'resetVote') OR Permission::getInstance()->verifPerm('PermsPanel', 'vote', 'actions', 'deleteVote')) { ?>
        <div class="col-lg-12">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Edition des votes</strong></h3>
                </div>
                <div class="panel-body">
                    <?php if(Permission::getInstance()->verifPerm('PermsPanel', 'vote', 'actions', 'resetVote')) { ?>
                        <div class="row text-center">
                            <h3>Réinitialisation</h3>
                            <a href="?action=resetVotes" class="btn btn-danger">Réinitialiser les votes</a>
                        </div>
                    <?php }
                    if(Permission::getInstance()->verifPerm('PermsPanel', 'vote', 'actions', 'deleteVote')) { ?>
                        <div class="row" style="margin-top:10px;">
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
