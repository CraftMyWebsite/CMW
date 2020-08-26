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



                        <input type="hidden" name="action"  class="form-control" value="" id="vote-action-json"/>
                        <hr/>
                        <div class="dropdown ">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                              Ajouter une récompense
                            </button>
                            <div class="dropdown-menu">
                              <button class="dropdown-item" onclick="addVoteRec('commande', 'all-new-rec-vote','list-new-rec-vote');">Commande</button>
                              <button  class="dropdown-item" onclick="addVoteRec('message', 'all-new-rec-vote','list-new-rec-vote');">Message</button >
                              <button  class="dropdown-item" onclick="addVoteRec('jeton', 'all-new-rec-vote','list-new-rec-vote');">jeton(s)</button >
                              <button  class="dropdown-item" onclick="addVoteRec('item', 'all-new-rec-vote','list-new-rec-vote');">Item(s)</button >
                            </div>
                          </div>


                        <div class="row" style="margin:30px;display:none;" id="all-new-rec-vote">
                            <div class="col-md-12 row " id="list-new-rec-vote">

                            </div>
                        </div>

                            <label class="control-label">Lien de vote du serveur</label>
                            <select name="serveur" class="form-control" required>        
                                <?php  if(count($lectureJSON) != 0) { foreach($lectureJSON as $serveur) {        ?>
                                    <option value="<?php $serveur['id']; ?>"> <?php echo $serveur['nom']; ?> </option>
                                <?php } } ?>
                            </select>

                            <label class="control-label">Lien de vote</label>
                            <input type="url" name="lien" placeholder="ex: http://serveurs-minecraft.com/...../" class="form-control" required>

                            <label class="control-label">Titre du lien</label>
                            <input type="text" name="titre" placeholder="ex: Voter sur McServ !" class="form-control" required>

                            <label class="control-label">Temps de vote</label>
                            <input type="number" name="temps" placeholder="ex: 86400 pour 24h" class="form-control" required>

                            <label class="control-label">Id unique donné par le site web. *</label>
                            <input type="text" name="idCustom" placeholder="ex: 54748" value="" class="form-control" />

                            <label class="control-label" for="doisetreenligne">Le joueur doit être connecté sur le serveur pour voter sur ce lien excepté si le pseudo rentré sur la page est le même que celui du compte du joueur sur votre site web ( cela aura pour conséquence de stocker ces récompenses ) &nbsp;</label>
                            <div class="custom-control custom-switch" >
                                <input type="checkbox" class="custom-control-input" value="1" id="doisetreenligne" name="enligne">
                                <label class="custom-control-label" for="doisetreenligne">Oui</label>
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
                 <script>initPost("new-vote", "admin.php?&action=creerLienVote", function(data) { if(data) {  voteUpdate(); }})</script>
                <div class="card-footer">
                        <div class="row text-center">
                            <input type="submit" onclick="genVoteJson('list-new-rec-vote','vote-action-json');sendPost('new-vote'); " class="btn btn-success w-100" value="Valider les changements !"/>
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

                            <label class="control-label">Entête du message (Premier de la liste envoyé)</label>
                            <input type="text" name="entete" value="<?php if(isset($_Serveur_['VoteCron']['entete'])) { echo $_Serveur_['VoteCron']['entete']; } else { echo '&3&m___________&r &b&l[> &b&l/Vote &b&l<] &3&m___________'; }  ?>" class="form-control"/>

                            <label class="control-label">Contenue du message SI le joueur peut voter (laisser vide pour désactiver)</label>
                            <input type="text" name="msgallow" value="<?php if(isset($_Serveur_['VoteCron']['msgallow'])) { echo $_Serveur_['VoteCron']['msgallow']; } else { echo '&3>> &b {LIEN} &3>> &b Voter ! &8/vote'; }  ?>" class="form-control"/>

                            <label class="control-label">Contenue du message SI le joueur ne peut pas voter</label>
                             <input type="text" name="msgdeny" value="<?php if(isset($_Serveur_['VoteCron']['msgdeny'])) { echo $_Serveur_['VoteCron']['msgdeny']; } else { echo '&3>> &b {LIEN}&3>> &b {TEMPS} '; }  ?>" class="form-control"/>

                            <label class="control-label">Footer du message (laisser vide pour désactiver / dernier message de la liste envoyé)</label>
                          <input type="text" name="footer" value="<?php if(isset($_Serveur_['VoteCron']['footer'])) { echo $_Serveur_['VoteCron']['footer']; } else { echo '&3&m_________________________________'; }  ?>" class="form-control"/>
                      

                            <label class="control-label">Mot de passe de la tâche cron, laisser vide pour désactivé l'accès à la tâche cron.</label>
                          <input type="text" name="mdp" id="mdpurlCron" onkeyup="get('urlCron').innerText = '<?php echo $_Serveur_['General']['url'].'/?action=voteCron&mdp='; ?>' + get('mdpurlCron').value" value="<?php if(isset($_Serveur_['VoteCron']['mdp'])) { echo $_Serveur_['VoteCron']['mdp']; }  ?>" placeholder="ex: CMW123" class="form-control"/>
                      
						
						
                       
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
    <?php } // $_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'resetVote')
    if($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'editSettings')) { ?>
        <div class="col-md-12 col-xl-12 col-12">
            <div class="card  ">
                <div class="card-header ">
                    <div class="float-left">
                        <h3 class="card-title"><strong>Edition des votes</strong></h3>
                    </div>
                    <?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'deleteVote')) { ?>
                    <div class="float-right">
                        <button onclick="sendDirectPost('admin.php?action=resetVotesConfig', function(data) { if(data) { get('all-vote').innerText = '';}})" class="btn btn-outline-secondary">Réinitialiser</button>
                    </div>
                    <?php } ?>
                </div>
                <div class="card-body" id="all-vote">


                            <?php $donnees = $req_donnees->fetchAll();
                            $idcs = 0;
                            for($o=0; $o < count($donnees); $o++)
                            {
                            ?>
                            <input type="hidden"  name="action<?=$o;?>" data-other="list-new-rec-<?=$o;?>vote" id="action<?=$o;?>" value="" />
                            <br/>
                            <button class="btn btn-secondary btn-block w-100" id="btn-serveur<?=$o ?>" type="button" data-toggle="collapse" data-target="#serveur<?=$o ?>" aria-expanded="false" aria-controls="serveur<?=$o ?>">
                                Lien de vote (#<?=$o+1 ?>)
                            </button>
                            <div class="collapse" id="serveur<?=$o ?>" >
                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="nom<?=$o;?>" class="control-label">Nom :</label>
                                                <input type="text" class="form-control" id="titre<?=$o;?>" name="titre<?=$o;?>" value="<?=$donnees[$o]['titre'];?>" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lien<?=$o;?>" class="control-label">Lien :</label>
                                                <input type="url" class="form-control" id="lien<?=$o;?>" name="lien<?=$o;?>" value="<?=$donnees[$o]['lien'];?>" required>
                                            </div>
                                        </div>

                                            <label for="serveur<?=$o;?>" class="control-label">Dans la catégorie :</label>
                                            <select name="serveur<?=$o;?>" id="serveur<?=$o;?>" class="form-control" required>        
                                                <?php  if(count($lectureJSON) != 0) { foreach($lectureJSON as $serveur) {        ?>
                                                    <option value="<?php $serveur['id']; ?>"  <?php if($serveur['id'] == $donnees[$o]['serveur']) { echo 'selected'; } ?> > <?php echo $serveur['nom']; ?> </option>
                                                <?php } } ?>
                                            </select>

             
                                             <hr/>
                                            <div class="dropdown ">
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                  Ajouter une récompense
                                                </button>
                                                <div class="dropdown-menu">
                                                  <button class="dropdown-item" onclick="addVoteRec('commande','all-new-rec-<?=$o;?>vote','list-new-rec-<?=$o;?>vote');">Commande</button>
                                                  <button  class="dropdown-item" onclick="addVoteRec('message','all-new-rec-<?=$o;?>vote','list-new-rec-<?=$o;?>vote');">Message</button >
                                                  <button  class="dropdown-item" onclick="addVoteRec('jeton','all-new-rec-<?=$o;?>vote','list-new-rec-<?=$o;?>vote');">jeton(s)</button >
                                                  <button  class="dropdown-item" onclick="addVoteRec('item','all-new-rec-<?=$o;?>vote','list-new-rec-<?=$o;?>vote');">Item(s)</button >
                                                </div>
                                              </div>

                                            <div class="row" style="margin:30px; <?php  if(str_replace(" ", "", $donnees[$o]['action']) == "[]") { echo 'display:none;'; } ?>" id="all-new-rec-<?=$o;?>vote">
                                                <div class="col-md-12 row" id="list-new-rec-<?=$o;?>vote">
                                                    <?php  $json = json_decode($donnees[$o]['action'], true); 
                                                    foreach($json as $value) { $idcs++; ?>
                                                    <div class=" col-md-6 col-12" id="rec-vote-<?php echo $idcs; ?>" data-type="<?php echo $value['type']; ?>" style="margin-top:15px;"><div style="border: 1px solid #B0B0B0;border-radius: 24px;padding:20px;margin:7px;">
                                                        <div style="width: 100%;display: inline-block">
                                                            <div class="float-left">
                                                                <h5><?php echo ucfirst($value['type']); ?></h5>
                                                            </div>
                                                            <div class="float-right">'
                                                                <button onclick="genVoteJson2();sendPost('all-vote');get('list-new-rec-<?=$o;?>vote').removeChild(get('rec-vote-<?php echo $idcs; ?>'));if(get('list-new-rec-<?=$o;?>vote').children.length == 0) { hide('all-new-rec-<?=$o;?>vote');}" class="btn btn-sm btn-outline-secondary">Supprimer</button>'
                                                            </div>
                                                        </div>

                                                         <?php if($value['type'] == "commande") { ?>
                                                                <label class="control-label">Commande à éxecuter (SANS /)</label>
                                                                <input type="text" data-type="value" value="<?php echo $value['value']; ?>"class="form-control"/>
                                                         <?php } else  if($value['type'] == "message") { ?>
                                                                <label class="control-label">Message à afficher lors du vote</label>
                                                                <input type="text" data-type="value" value="<?php echo $value['value']; ?>" class="form-control"/>
                                                         <?php } else  if($value['type'] == "jeton") { ?>
                                                                <label class="control-label">Quantité de jetons à donner (forcera le joueur à être connecter sur le serveur pour voter)</label>
                                                                <input type="number" data-type="value" min="1" value="<?php echo $value['value']; ?>" max="99999999" class="form-control"/>
                                                         <?php } else  if($value['type'] == "item") { ?>
                                                                <label class="control-label">Id de l\'item à donner</label>
                                                                <input type="text" data-type="value" value="<?php echo $value['value']; ?>" class="form-control"/>

                                                                <label class="control-label">Nombre d\'item à donner</label>
                                                                <input type="number" data-type="value2" min="1" value="<?php echo $value['value2']; ?>" max="64"  class="form-control"/>
                                                         <?php }  ?>
                                                            <label class="control-label" style="<?php if($value['type'] == "jeton") { echo 'display:none'; } ?>">Obtention de la récompense</label>
                                                            <select data-type="methode" class="form-control" style="margin-bottom:20px;<?php if($value['type'] == "jeton") { echo 'display:none'; } ?>">
                                                                <option value="1"  <?php if($value['methode'] == "1") { echo 'selected'; }?>> Le serveur où il est en ligne </option>
                                                                <option value="2" <?php if($value['methode'] == "2") { echo 'selected'; }?>> Le serveur de la catégorie </option>
                                                                <option value="3" <?php if($value['methode'] == "3") { echo 'selected'; }?>> Tous les serveurs </option>
                                                            </select>
                                                    </div></div>

                                                    <?php } ?>
                                                </div>
                                            </div>

                                       
                                            <label class="control-label" for="temps<?=$o;?>">Temps entre chaque vote</label>
                                            <input type="number" name="temps<?=$o;?>" id="temps<?=$o;?>" class="form-control"
                                                    value="<?=$donnees[$o]['temps'];?>" required>
                                      
                                            <label class="control-label" for="idunique<?=$o;?>">ID Unique</label>
                                            <input type="text" name="idCustom<?=$o;?>" id="idunique<?=$o;?>" class="form-control"
                                                    value="<?=$donnees[$o]['idCustom'];?>" />
                                       

                                              <label class="control-label" for="doisetreenligne">Le joueur doit être connecté sur le serveur pour voter sur ce lien excepté si le pseudo rentré sur la page est le même que celui du compte du joueur sur votre site web ( cela aura pour conséquence de stocker ces récompenses ) &nbsp;</label>
                                                <div class="custom-control custom-switch" style="margin-bottom:15px;" >
                                                    <input type="checkbox" class="custom-control-input" value="1" id="doisetreenligne<?=$o;?>" name="enligne<?=$o;?>" <? if($donnees[$o]['enligne']==1) { echo 'checked' ; } ?>>
                                                    <label class="custom-control-label" for="doisetreenligne<?=$o;?>">Oui</label>
                                                </div>

                              
                                        <?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'deleteVote')) { ?>
                                        <button onclick="sendDirectPost('admin.php?action=supprVote&id=<?=$donnees[$o]['id'];?>',function(data) { if(data) {
                                            hide('serveur<?=$o ?>'); 
                                             hide('btn-serveur<?=$o ?>'); 
                                            removePost('all-vote', 'titre<?=$o;?>'); removePost('all-vote', 'lien<?=$o;?>'); removePost('all-vote', 'temps<?=$o;?>');  removePost('all-vote', 'idCustom<?=$o;?>');  removePost('all-vote', 'enligne<?=$o;?>'); }})"
                                                    class="btn btn-danger btn-block w-100">Supprimer</button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                            <?php 
                            }  ?>
                    </div>
                                 <script>initPost("all-vote", "admin.php?action=modifierVote"); var idvote = <?php echo $idcs; ?>;</script>
                            <div class="card-footer">
                                <input type="submit" onclick="genVoteJson2();sendPost('all-vote');" class="btn btn-success w-100" value="Valider les changements"/>
                            </div>
                <!-- </div> -->
            </div>
        </div>
    <?php } ?>
</div>
<!-- /.row -->