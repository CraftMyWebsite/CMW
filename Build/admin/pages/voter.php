<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Votes
    </h2>
</div>
<!-- Page Heading -->
<div class="row" style="margin-top:10px;">
	<div class="col-md-12 col-xl-12 col-12">
        <?php if(!$_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'editSettings') AND $_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'addVote')) { ?>
            <div class="col-lg-12 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux votes.</strong>
                </div>
            </div>
        <?php }
        if($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'editSettings')) { ?>
        <div class="col-lg-12 text-justify">
            <div class="alert alert-success">
                <strong>Dans cette section vous pourrez configurer vos votes.</strong><br/>
                Pour le message vous pouvez utiliser les tags:<ul>
                    <li> {JOUEUR} qui sera remplacé par le nom du joueur qui a voté</li>
                    <li> {QUANTITE} qui sera remplacé par la quantité de jetons site, ou d'item IG give</li>
                    <li> {ID} qui sera remplacé par l'id de l'item give IG </li>
                </ul>
                Pour la commande vous pourrez utiliser : 
                <ul>
                    <li> {JOUEUR} qui correspond au nom du joueur qui vote. </li>
                </ul>
            </div>
        </div>
    </div>
        <div class="col-md-12 col-xl-12 col-12">
            <div class="card  ">
                <div class="card-header ">
                    <h3 class="card-title">Configuration des votes</h3>
                </div>
                <div class="card-body" id="new-vote">
                    <div class="col-md-12">
                        <h3>Réglages des votes</h3>
                        <div class="row" id="message-newvote" style="display:none;">
                            <label class="control-label">Message affiché lors du vote</label>
                            <input type="text" name="message"  class="form-control"/>
                        </div>
                        <div class="row">
                            <label class="control-label" for="affichermessageid">Afficher le message ? &nbsp;</label>
                            <div class="custom-control custom-switch" style="padding-top: 20px">
                                <input type="checkbox" class="custom-control-input" id="affichermessageid" onClick="
                                if(this.checked) {
                                    show('message-newvote');
                                } else {
                                    hide('message-newvote');
                                }"
                                 name="display">
                                
                                <label class="custom-control-label" for="affichermessageid">Oui</label>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Executer une Commande/Give d'item</label>
                            <select name="action" class="form-control" onchange="
                            if(parseInt(this.value) == 1) {
                                show('cmd-newvote');
                                hide('id-newvote');
                                hide('quantite-newvote');
                            }else if(parseInt(this.value) ==2 ) {
                                hide('cmd-newvote');
                                show('id-newvote');
                                show('quantite-newvote');
                            } else if( parseInt(this.value) == 3) {
                                hide('cmd-newvote');
                                hide('id-newvote');
                                show('quantite-newvote');
                            }">
                                <option value="1" selected> Executer une commande </option>
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
                        <div class="row" id="cmd-newvote" style="margin-top:10px;">
                            <label class="control-label">Commande à éxecuter (SANS /)</label>
                            <input type="text" name="cmd" class="form-control" />
                        </div>
                        <div class="row" id="id-newvote" style="margin-top:10px;display:none;">
                            <label class="control-label">ID de l'item</label>
                            <input type="text" name="id"  class="form-control" value="264" />
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row" id="quantite-newvote" style="margin-top:10px;display:none;">
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
                            <label class="control-label" for="doisetreenligne">Le joueur doit être connecté sur le serveur pour voter sur ce lien excepté si le pseudo rentré sur la page est le même que celui du compte du joueur sur votre site web ( cela aura pour conséquence de stocker ces récompenses ) &nbsp;</label>
                            <div class="custom-control custom-switch" style="padding-top: 20px">
                                <input type="checkbox" class="custom-control-input" id="doisetreenligne" name="en ligne">
                                <label class="custom-control-label" for="doisetreenligne">Oui</label>
                            </div>
    					</div>
                        <hr>
                        <div class="row">
                            <div class="alert alert-success">
                                <p>
                                <strong>* Un système de vérification de votes est intégré</strong>
                                    <br/>
                                    Les sites suivant <strong>sont compatible</strong> avec cette vérification:
                                    <ul>
                                        <li> serveur-prive.net</li>
                                        <li> serveurs-minecraft.org</li>
                                        <li> serveurs-minecraft.com</li>
                                        <li> serveursminecraft.fr</li>
                                        <li> liste-minecraft-serveurs.com</li>
                                        <li> liste-serveurs.fr</li>
                                        <li> liste-serveur.fr</li>
                                        <li> minecraft-top.com</li>

                                    </ul>
                                <span>
                                    À noter que certains service de recherche du serveur n'ont pas une API utilisable ! Pour que celle-ci fonctionne sur le cms vous devez remplir le champ "Id unique" par l'id donner par le site web ( généralement dans les onglets API). Laisser vide pour le désactiver. Si l'id venait â être incorrecte, ne vous étonnez pas que les votes ne se valident pas
                                </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                 <script>initPost("new-vote", "admin.php?&action=creerLienVote",  
                                            function (data) { if(data) {}})</script>
                <div class="card-footer">
                        <div class="row text-center">
                            <input type="submit" onclick="sendPost('new-vote', function(data) { if(data) { voteUpdate(); }});" class="btn btn-success w-100" value="Valider les changements !"/>
                        </div>
                    </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-12 col-12">
            <div class="card  ">
                <div class="card-header ">
                    <h3 class="card-title">Configuration tâche cron</h3>
                </div>
                <div class="card-body" id="vote-cron">
                    <div class="col-md-12">
                        <h3>Message</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="alert alert-success">
                                    <div id="usablephrase">
                                    Syntaxe:
                                        <ul>
                                            <li> <strong>{LIEN}</strong> : url du site</li>
                                            <li> <strong>{TEMPS}</strong> : temps restant avant que le joueur puisse voter</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Entête du message (Premier de la liste envoyé)</label>
                            <input type="text" name="entete" value="<?php if(isset($_Serveur_['VoteCron']['entete'])) { echo $_Serveur_['VoteCron']['entete']; } else { echo '&3&m___________&r &b&l[> &b&l/Vote &b&l<] &3&m___________'; }  ?>" class="form-control"/>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Contenue du message SI le joueur peut voter (laisser vide pour désactiver)</label>
                            <input type="text" name="msgallow" value="<?php if(isset($_Serveur_['VoteCron']['msgallow'])) { echo $_Serveur_['VoteCron']['msgallow']; } else { echo '&3>> &b {LIEN} &3>> &b Voter ! &8/vote'; }  ?>" class="form-control"/>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Contenue du message SI le joueur ne peut pas voter</label>
                             <input type="text" name="msgdeny" value="<?php if(isset($_Serveur_['VoteCron']['msgdeny'])) { echo $_Serveur_['VoteCron']['msgdeny']; } else { echo '&3>> &b {LIEN}&3>> &b {TEMPS} '; }  ?>" class="form-control"/>
                        </div>
                        <div class="row" style="margin-top:10px;">
                            <label class="control-label">Footer du message (laisser vide pour désactiver / dernier message de la liste envoyé)</label>
                          <input type="text" name="footer" value="<?php if(isset($_Serveur_['VoteCron']['footer'])) { echo $_Serveur_['VoteCron']['footer']; } else { echo '&3&m_________________________________'; }  ?>" class="form-control"/>
                      
                        </div>
						 <div class="row" style="margin-top:10px;">
                            <label class="control-label">Mot de passe de la tâche cron, laisser vide pour désactivé l'accès à la tâche cron.</label>
                          <input type="text" name="mdp" id="mdpurlCron" onkeyup="get('urlCron').innerText = '<?php echo $_Serveur_['General']['url'].'/?action=voteCron&mdp='; ?>' + get('mdpurlCron').value" value="<?php if(isset($_Serveur_['VoteCron']['mdp'])) { echo $_Serveur_['VoteCron']['mdp']; }  ?>" placeholder="ex: CMW123" class="form-control"/>
                      
                        </div>
						
						
                       
                    </div>
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <label class="control-label">Envoyé la notification même aux personnes qui n'ont jamais voté.
                                <input type="checkbox" name="sendtoall"  value="1"  <?php if(isset($_Serveur_['VoteCron']['sendtoall']) && $_Serveur_['VoteCron']['sendtoall'] == 1) { echo 'checked'; }  ?>></label>
                            </div>
                            <div class="col-md-6 col-6">
                                <input type="button" onClick="tryCron()" id="trycron" style="margin-top:15px;" class="btn btn-danger w-100" value="Try it !"/>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card" style="background-color: #E7E7E7; border-color: #E7E7E7;border-radius: 9%;">
                                <div class="card-block">
                                    <div class="card-body">
                                        <p>
                                            Pour faire fonctionnez ce système vous devez avoir accès au tâche cron sur votre hébergeur, créez en une nouvelle et configurez la sur "récupérer une url", sélectionnez le temps que vous désirez et rentrez comme url: <br/><br/> 
                                            <em id="urlCron"><?php echo $_Serveur_['General']['url'].'/?action=voteCron&mdp='; if(isset($_Serveur_['VoteCron']['mdp'])) { echo $_Serveur_['VoteCron']['mdp']; } ?> </em>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <script>initPost("vote-cron", "admin.php?&action=changeVoteCron",  
                                            function (data) { if(data) {}})</script>
                <div class="card-footer">
                    <input type="submit" onclick="sendPost('vote-cron', function(data) { if(data) { }});" class="btn btn-success w-100" value="Valider les changements"/>
                </div>
            </div>
		
		<script>
			function tryCron() {
				get('trycron').disabled = true;
				$.post("index.php?action=voteCron&mdp=" + get('mdpurlCron').value,{
				},function(data, status){
					console.log(data);
					alert("Envoyé ! Si vous n'avez rien reçu sur votre serveur, vérifiez la connexion jsonapi et confirmez les changements !");
					get('trycron').disabled = false;
				});
			}
		</script>
    <?php }
    if($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'resetVote') OR $_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'deleteVote')) { ?>
        <div class="col-md-12 col-xl-12 col-12">
            <div class="card  ">
                <div class="card-header ">
                    <div class="float-left">
                        <h3 class="card-title"><strong>Edition des votes</strong></h3>
                    </div>
                    <div class="float-right">
                        <button onclick="sendDirectPost('?action=resetVotes', function(data) { if(data) { get('all-vote').innerText = '';}})" class="btn btn-outline-secondary">Réinitialiser</button>
                    </div>
                </div>
                <div class="card-body" id="all-vote">
                  
                    <?php 
                    if($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'deleteVote')) { ?>
                        <!-- <div class="row"> -->
                            <?php $donnees = $req_donnees->fetchAll();
                            for($o=0; $o < count($donnees); $o++)
                            {
                            ?>
                            <br/>
                            <button class="btn btn-secondary btn-block w-100" type="button" data-toggle="collapse" data-target="#serveur<?=$o ?>" aria-expanded="false" aria-controls="serveur<?=$o ?>">
                                Lien de vote (#<?=$o+1 ?>)
                            </button>
                            <div class="collapse" id="serveur<?=$o ?>" >
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="card card-body">

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nom<?=$o;?>">Nom :</label>
                                                <input type="text" class="form-control" id="titre<?=$o;?>" name="titre<?=$o;?>" value="<?=$donnees[$o]['titre'];?>" />
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="lien<?=$o;?>">Lien :</label>
                                                <input type="url" class="form-control" id="lien<?=$o;?>" name="lien<?=$o;?>" value="<?=$donnees[$o]['lien'];?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="serveur<?=$o;?>">Dans la catégorie :</label>
                                            <select name="serveur<?=$o;?>" id="serveur<?=$o;?>" class="form-control">
                                                    <?php for($i = 0; $i < count($lectureServs); $i++) {        ?>
                                                    <option value="<?php echo $i ?>"
                                                        <?=($lectureServs[$i]['nom'] == $lectureServs[intval($donnees[$o]['serveur'])]['nom']) ? 'selected' : ''; ?>>
                                                        <?php echo $lectureServs[$i]['nom']; ?> </option>
                                                    <?php } ?>
                                                </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="methode<?=$o;?>">Sur :</label>
                                            <select name="methode<?=$o;?>" id="methode<?=$o;?>" class="form-control">
                                                    <option value="1"
                                                        <?=($donnees[$o]['methode'] == 1) ? 'selected' : '';?>> Le
                                                        serveur où le joueur est en ligne </option>
                                                    <option value="2"
                                                        <?=($donnees[$o]['methode'] == 2) ? 'selected' : '';?>> Le
                                                        serveur de la catégorie </option>
                                            </select>
                                        </div>
                                        <div class="form-row"> 
                                            <div class="form-group col-xs-12">
                                                <label for="action<?=$o;?>">Action</label>
                                                <?php $action = explode(':', $donnees[$o]['action'], 2); ?>
                                                <select name="action<?=$o;?>" id="action<?=$o;?>" class="form-control"onchange="
                                                if(parseInt(this.value) == 1) {
                                                    show('cmd<?=$o;?>2');
                                                    hide('iditem<?=$o;?>2');
                                                    hide('quantite<?=$o;?>2');
                                                }else if(parseInt(this.value) ==2 ) {
                                                    hide('cmd<?=$o;?>2');
                                                    show('iditem<?=$o;?>2');
                                                    show('quantite<?=$o;?>2');
                                                } else if(parseInt(this.value) ==2 || parseInt(this.value) == 3) {
                                                    hide('cmd<?=$o;?>2');
                                                    hide('iditem<?=$o;?>2');
                                                    show('quantite<?=$o;?>2');
                                                }">
                                                        <option value="1" <?=($action[0] == 'cmd') ? 'selected' : '';?>>
                                                            Executer une commande </option>
                                                        <option value="2" <?=($action[0] == 'give') ? 'selected' : '';?>>
                                                            Give d'item </option>
                                                        <option value="3" <?=($action[0] == 'jeton') ? 'selected' : '';?>>
                                                            Give de jetons site</option>
                                                    </select>
                                            </div>
                                            <?php 
                                            if($action[0] == "give")
                                                    $item = explode(':', $action[1]);
                                                    if($action[0] == "jeton")
                                                        $quantite = $action[1];
                                                    elseif($action[0] == "give")
                                                        $quantite = $item[3];
                                                    else
                                                        $quantite = '';
                                            ?>
                                            <div class="form-group col-md-4 col-sm-12" id="cmd<?=$o;?>2" <?=($action[0] == 'cmd') ? '' : 'style="display:none;"';?>>
                                                <label for="cmd<?=$o;?>">Commande à executer</label>
                                                <input type="text" name="cmd<?=$o;?>" id="cmd<?=$o;?>" class="form-control"
                                                    value="<?=($action[0] == 'cmd') ? $action[1] : '';?>" />
                                            </div>
                                            <div class="form-group col-md-2 col-sm-6" id="quantite<?=$o;?>2" <?=($action[0] == 'cmd') ? 'style="display:none;"' : '';?>>
                                                <label for="quantite<?=$o;?>">Quantité</label>
                                                <input type="text" name="quantite<?=$o;?>" id="quantite<?=$o;?>" class="form-control"
                                                    value="<?=$quantite;?>" />
                                            </div>
                                            <div class="form-group col-md-2 col-sm-6" id="iditem<?=$o;?>2" <?=($action[0] == 'cmd') ? 'style="display:none;"' : '';?>>
                                                <label for="iditem<?=$o;?>">ID de l'item</label>
                                                <input type="text" name="id<?=$o;?>" name="iditem<?=$o;?>" class="form-control"
                                                    value="<?=($action[0] == "give") ? $item[1] : '';?>" />
                                            </div>
                                           <div class="form-group col-md-12 col-sm-12" <?=(!isset($donnees[$o]['message'])||empty($donnees[$o]['message'])) ? '' : 'style="display:none;"';?>>
                                                <label for="msg<?=$o;?>">Message</label>
                                                <input type="text" name="message<?=$o;?>" id="msg<?=$o;?>" class="form-control"
                                                    value="<?=$donnees[$o]['message'];?>" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="temps<?=$o;?>">Temps entre chaque vote</label>
                                            <input type="number" name="temps<?=$o;?>" id="temps<?=$o;?>" class="form-control"
                                                    value="<?=$donnees[$o]['temps'];?>" />
                                        </div> 
                                        <div class="form-group">
                                            <label for="idunique<?=$o;?>">ID Unique</label>
                                            <input type="text" name="idCustom<?=$o;?>" id="idunique<?=$o;?>" class="form-control"
                                                    value="<?=$donnees[$o]['idCustom'];?>" />
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="enligne<?=$o;?>" id="enlignecb<?=$o;?>">
                                                <label class="form-check-label" for="enlignecb<?=$o;?>" value="1" <? if($donnees[$o]['enligne']==1) { echo 'checked' ; } ?>>
                                                    Doit être connecté sur le serveur ( Être en ligne pour confirmer le vote )
                                                </label>
                                            </div>
                                        </div>
                                        <button onclick="sendDirectPost('admin.php?action=supprVote&id=<?=$donnees[$o]['id'];?>',function(data) { if(data) {
                                            hide('serveur<?=$o ?>'); 
                                            removePost('all-vote', 'titre<?=$o;?>'); removePost('all-vote', 'lien<?=$o;?>');  removePost('all-vote', 'message<?=$o;?>');  removePost('all-vote', 'serveur<?=$o;?>');  removePost('all-vote', 'methode<?=$o;?>'); removePost('all-vote', 'action<?=$o;?>');  removePost('all-vote', 'cmd<?=$o;?>');  removePost('all-vote', 'quantite<?=$o;?>');  removePost('all-vote', 'id<?=$o;?>');  removePost('all-vote', 'temps<?=$o;?>');  removePost('all-vote', 'idCustom<?=$o;?>');  removePost('all-vote', 'enligne<?=$o;?>'); }})"
                                                    class="btn btn-danger btn-block w-100">Supprimer</button>

                                    </div>
                                    </div>
                                </div>
                            </div>

                            <?php 
                            } ?>
                             <script>
                                initPost("all-vote", "admin.php?action=modifierVote");</script>
                            <div class="card-footer">
                                <input type="submit" onclick="sendPost('all-vote');" class="btn btn-success w-100" value="Valider les changements"/>
                            </div>
                    <?php } ?>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    <?php } ?>
</div>
<!-- /.row -->