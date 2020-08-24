<?php echo '[DIV]'; 
if($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'editSettings')) {  
	$lectureServs = new Lire('modele/config/configServeur.yml');
	$lectureServs = $lectureServs->GetTableau();

	$lectureServs = $lectureServs['Json'];

	$req_donnees = $bddConnection->query('SELECT * FROM cmw_votes_config'); 
                            $donnees = $req_donnees->fetchAll();
                            $idsc = 500;
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
                                                    <?php if(isset($lectureServs) && !empty($lectureServs)) { for($i = 0; $i < count($lectureServs); $i++) {        ?>
                                                    <option value="<?php echo $i ?>"
                                                        <?=($lectureServs[$i]['nom'] == $lectureServs[intval($donnees[$o]['serveur'])]['nom']) ? 'selected' : ''; ?>>
                                                        <?php echo $lectureServs[$i]['nom']; ?> </option>
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
                                                    <div class="col-md-6 col-12" id="rec-vote-<?php echo $idcs; ?>" data-type="<?php echo $value['type']; ?>" style="margin-top:15px;"><div style="border: 1px solid #B0B0B0;border-radius: 24px;padding:20px;margin:7px;">
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
                                                            </select> <hr/>
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

                            <?php  }  
} ?>       