<?php echo '[DIV]'; 
if($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'editSettings'))) {  {
	$lectureServs = new Lire('modele/config/configServeur.yml');
	$lectureServs = $lectureServs->GetTableau();

	$lectureServs = $lectureServs['Json'];

	$req_donnees = $bddConnection->query('SELECT * FROM cmw_votes_config'); 
                             $donnees = $req_donnees->fetchAll();
                            for($o=0; $o < count($donnees); $o++)
                            {
                            ?>
                            <br/>
                            <button class="btn btn-secondary btn-block w-100" id="btn-serveur<?=$o ?>" type="button" data-toggle="collapse" data-target="#serveur<?=$o ?>" aria-expanded="false" aria-controls="serveur<?=$o ?>">
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
                                        <?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'actions', 'deleteVote')) { ?>
                                        <button onclick="sendDirectPost('admin.php?action=supprVote&id=<?=$donnees[$o]['id'];?>',function(data) { if(data) {
                                            hide('serveur<?=$o ?>'); 
                                             hide('btn-serveur<?=$o ?>'); 
                                            removePost('all-vote', 'titre<?=$o;?>'); removePost('all-vote', 'lien<?=$o;?>');  removePost('all-vote', 'message<?=$o;?>');  removePost('all-vote', 'serveur<?=$o;?>');  removePost('all-vote', 'methode<?=$o;?>'); removePost('all-vote', 'action<?=$o;?>');  removePost('all-vote', 'cmd<?=$o;?>');  removePost('all-vote', 'quantite<?=$o;?>');  removePost('all-vote', 'id<?=$o;?>');  removePost('all-vote', 'temps<?=$o;?>');  removePost('all-vote', 'idCustom<?=$o;?>');  removePost('all-vote', 'enligne<?=$o;?>'); }})"
                                                    class="btn btn-danger btn-block w-100">Supprimer</button>
                                        <?php } ?>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
}

 ?>       