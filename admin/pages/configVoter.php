
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h2 gray">
                    Gestion des récompenses automatiques
                    </h2>
                </div>
<?php if(!$_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', 'showPage')) { ?>
  <div class="col-lg-6 col-lg-offset-3 text-center">
    <div class="alert alert-danger">
      <strong>Vous avez aucune permission pour accéder à cette page.</strong>
    </div>
  </div>
<?php }
else
  {
    ?><div class="alert alert-success" id="resetVote">
      <strong> 

        Dans cette section vous pourrez configurer vos récompenses automatiques.
        Il existe plusieurs types de récompenses automatique que vous allez pouvoir configurer
        <ul>
          <li>Les récompenses lorsque le joueur vote X fois</li>
          <li>Les récompenses pour les 1er, 2eme, 3eme ... meilleurs voteurs à la fin du cycle</li>
        </ul>
        Le cycle peut être définis ci dessous, il représente quand les votes vont être rénitialisé et par conséquent les récompenses enregistrés pour les meilleurs voteurs vont être distribué. Le joueur pourra les récupérer comme n'importe quelles récompense après un vote. 

        <?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', "actions", 'editReset')) { ?>
         <select name="type" name="type" style="margin-top:10px;margin-bottom:10px;width:200px;" class="form-control form-control-sm" onChange="if(this.value==0) { hide('recsem');hide('recmoi');hide('recheur'); } else if(this.value==1) { show('recsem');hide('recmoi'); show('recheur');} else if(this.value==2) { hide('recsem');show('recmoi');show('recheur'); }" >
                <option value="0" <?php if($dateRec['valueType'] == 0) { echo 'selected';} ?>> Désactivé</option>
                <option value="1" <?php if($dateRec['valueType'] == 1) { echo 'selected';} ?>> Toutes les semaines</option>
                <option value="2" <?php if($dateRec['valueType'] == 2) { echo 'selected';} ?>> Tous mois</option>
              </select>
          <div id="recsem" <?php if($dateRec['valueType'] == 0 || $dateRec['valueType'] == 2) { echo 'style="display:none;"';} ?>>
            <label class="control-label">Le jour de la semaine:</label>
            <select style="width:175px;margin-bottom:10px;" name="jour" class="form-control form-control-sm">
                <option value="1" <?php if($dateRec['valueType'] == 1 && $dateRec['jour'] == 1) { echo 'selected';}?> >lundi</option>
                <option value="2" <?php if($dateRec['valueType'] == 1 && $dateRec['jour'] == 2) { echo 'selected';}?>>mardi</option>
                <option value="3" <?php if($dateRec['valueType'] == 1 && $dateRec['jour'] == 3) { echo 'selected';}?>>mercredi</option>
                <option value="4" <?php if($dateRec['valueType'] == 1 && $dateRec['jour'] == 4) { echo 'selected';}?>>jeudi</option>
                <option value="5" <?php if($dateRec['valueType'] == 1 && $dateRec['jour'] == 5) { echo 'selected';}?>>vendredi</option>
                <option value="6" <?php if($dateRec['valueType'] == 1 && $dateRec['jour'] == 6) { echo 'selected';}?>>samedi</option>
                <option value="0" <?php if($dateRec['valueType'] == 1 && $dateRec['jour'] == 0) { echo 'selected';}?>>dimanche</option>
              </select>
          </div>
          <div id="recmoi" <?php if($dateRec['valueType'] == 0 || $dateRec['valueType'] == 1) { echo 'style="display:none;"';} ?>>
            <label class="control-label">le <input name="mois" style="width:auto;display:inline" type="number" min="1" max="31" class="form-control form-control-sm" value="<?php if($dateRec['valueType'] == 0 || $dateRec['valueType'] == 1) { echo '1';} else { echo $dateRec['mois']; } ?>"><span id="recmoi2"><?php if($dateRec['valueType'] == 0 || $dateRec['valueType'] == 1) { echo 'ier';} else { echo $dateRec['mois'] != 1 ? "ième" : "ier"; } ?></span> du mois</label>
            
          </div>
           <div id="recheur" <?php if($dateRec['valueType'] == 0) { echo 'style="display:none;"';} ?>>
            <label class="control-label">À <input name="heur" style="width:auto;display:inline;" type="number" min="0" max="23" class="form-control form-control-sm" value="<?php if($dateRec['valueType'] == 0) { echo '0';} else { echo $dateRec['heur'];} ?>">H<input name="min" style="width:auto;display:inline;" type="number" min="0" max="59" class="form-control form-control-sm" value="<?php if($dateRec['valueType'] == 0) { echo '0';} else { echo $dateRec['min'];} ?>"></label>
            
          </div>
           <script>
            initPost("resetVote", "admin.php?action=editResetVote");
            registerEvent(getElementByName("resetVote", "mois"), ["keyup", "change"], function(evt) { if(isset(evt.target.value) && evt.target.value != '') {if(parseInt(evt.target.value) < 1) { evt.target.value = 1} else if(parseInt(evt.target.value) > 31){ evt.target.value = 31;} get('recmoi2').innerText = (parseInt(evt.target.value) != 1 ? "ième" : "ier"); sendPost('resetVote');} });
            registerEvent(getElementByName("resetVote", "heur"), ["keyup", "change"], function(evt) { if(isset(evt.target.value) && evt.target.value != '') {if(parseInt(evt.target.value) < 0) { evt.target.value = 0} else if(parseInt(evt.target.value) == 24){ evt.target.value = 0;} else if(parseInt(evt.target.value) > 24){ evt.target.value = 23;}  sendPost('resetVote');}});
            registerEvent(getElementByName("resetVote", "min"), ["keyup", "change"], function(evt) { if(isset(evt.target.value) && evt.target.value != '') {if(parseInt(evt.target.value) < 0) { evt.target.value = 0} else if(parseInt(evt.target.value) == 60){ evt.target.value = 0;} else if(parseInt(evt.target.value) > 60){ evt.target.value = 59;}  sendPost('resetVote');}});
            registerEvent(getElementByName("resetVote", "type"), ["change"], function(evt) { sendPost('resetVote');});
             registerEvent(getElementByName("resetVote", "jour"), ["change"], function(evt) { sendPost('resetVote');});
          </script>
        <?php } ?>
      </strong>
    </div>
  <?php } if($_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', 'actions', 'addRecompense')) { ?>
  <div class="row">
    <div class="col-md-12 col-xl-12 col-12">
      <div class="card">
        <div class="card-header ">
          <h3 class="card-title"><strong>Créer une Récompense automatique</strong></h3>
        </div>
        <div class="card-body" id="new-rec">

              <label class="control-label">Type de récompense</label>
              <select name="type" class="form-control" onChange="
              if(parseInt(this.value) == 1) {
                hide('type-2');
                show('type-1');
              } else {
                show('type-2');
                hide('type-1');
              }" required>
                <option value="1"> Récompense au bout de X vote</option>
                <option value="2"> Récompense pour les meilleurs voteurs lors de la rénitialisation des votes</option>
              </select>

              <div id="type-1">
                <label class='control-label'>Au bout de combien de vote ?</label>
                <input type='number' min="1" max="9999999" name='nbreVote' class='form-control' />
              </div>

              <div id="type-2" style="display:none;">

                <label class='control-label'>Rang de la personne</label>
                <input type="number" min="1" max="999"  name='rang' class='form-control' value="1">
                </div>
               <script>var idvote = 0;</script>
               <input type="hidden" name="action"  class="form-control" value="" id="vote-action-json"/>
                <div class="dropdown " style="margin-top:20px;">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                              Ajouter une récompense
                            </button>
                            <div class="dropdown-menu">
                              <button class="dropdown-item" onclick="addVoteConfigRec('commande', 'all-new-rec-vote','list-new-rec-vote');">Commande</button>
                              <button  class="dropdown-item" onclick="addVoteConfigRec('message', 'all-new-rec-vote','list-new-rec-vote');">Message</button >
                              <button  class="dropdown-item" onclick="addVoteConfigRec('jeton', 'all-new-rec-vote','list-new-rec-vote');"><?=$_Serveur_['General']['moneyName'];?>(s)</button >
                              <button  class="dropdown-item" onclick="addVoteRec('jetonAlea', 'all-new-rec-vote','list-new-rec-vote');"><?=$_Serveur_['General']['moneyName'];?>(s) aléatoire</button >
                              <button  class="dropdown-item" onclick="addVoteConfigRec('item', 'all-new-rec-vote','list-new-rec-vote');">Item(s)</button >
                            </div>
                          </div>


                        <div class="row" style="margin:30px;display:none;" id="all-new-rec-vote">
                            <div class="col-md-12 row " id="list-new-rec-vote">

                            </div>
                        </div>

        </div>

        <script>
          var topRec = new Map();
          <?php 
            foreach($topRecompense as $key => $value) {
              echo "topRec.set(".$key.",'".$value."');";
            }

          ?>
        initPost("new-rec", "admin.php?action=creerRecompenseAuto",function(data) { if(data) {  getElementByName("new-rec", "rang").value = configVoteGetMaxVal(); updateCont('admin.php?action=getRecompenseList', get('all-rec'), null); }});

        getElementByName("new-rec", "rang").value = configVoteGetMaxVal();
        registerEvent(getElementByName("new-rec", "rang"), ["keyup", "click", "change"], function(evt) { if(isset(evt.target.value) && evt.target.value != '') {if(parseInt(evt.target.value) < 1) { evt.target.value = 1} else if(parseInt(evt.target.value) > 999){ evt.target.value = 999;} else if(isset(topRec.get(parseInt(evt.target.value)))) { notif('warning', 'Erreur', 'Rang '+evt.target.value+' déjà enregistré'); evt.target.value = configVoteGetMaxVal(); } }});
      </script>

        <div class="card-footer">
          <div class="text-center">
              <input type="submit" onclick="genVoteJson('list-new-rec-vote','vote-action-json');sendPost('new-rec');" class="btn btn-success btn-block w-100" value="Valider" />
          </div>
        </div>
    </div>
   </div>
 <?php } if($_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', 'actions', 'editRecompense')) { ?>
   <div class="col-md-12 col-xl-12 col-12">
      <div class="card">
        <div class="card-header ">
          <h3 class="card-title"><strong>Edition des récompenses automatique</strong></h3>
        </div>
        <div class="card-body" id="all-rec" >
           <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>Type</th>
                <th>Valeur</th>
                <th>Action</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                    <?php $donnees = $reqConfig->fetchAll(PDO::FETCH_ASSOC);
                    for($o=0; $o < count($donnees); $o++)
                    {
                        ?><tr id="rec-<?php echo $o; ?>">
                            <td><?=($donnees[$o]['type'] == 1) ? 'Récompense tout les X votes' : 'Récompense pour les meilleurs voteurs lors de la rénitialisation des votes'; ?></td>
                            <td><?php if($donnees[$o]['type'] == 1)
                                    echo $donnees[$o]['valueType'].' votes';
                                else
                                {
                                   echo $donnees[$o]['valueType'];
                                    if(((int)$donnees[$o]['valueType'])==1) {
                                      echo 'ier';
                                    } else {
                                      echo 'ième';
                                    }
                                    echo ' du classement';
                                }
                                ?>
                            </td>
                            <td><?php  $json = json_decode($donnees[$o]['action'], true); 
                                $f = "";
                                foreach($json as $value) { 
                                  if($value['type'] == "item") {
                                    $f= $f.'Give '.$value['value2'].' item ID '.$value['value'].' sur '.($value['methode'] == "1" ? 'le serveur où il est en ligne' : 'tous les serveurs').' ('.$value['pourcentage'].'%)<br/>';
                                  } else if($value['type'] == "commande") {
                                    $f= $f.'Éxécute la commande /'.$value['value'].' sur '.($value['methode'] == "1" ? 'le serveur où il est en ligne' : 'tous les serveurs').' ('.$value['pourcentage'].'%)<br/>';
                                  } else if($value['type'] == "jeton") {
                                     $f= $f.'Give '.$value['value'].' '.$_Serveur_['General']['moneyName'].'(s) ('.$value['pourcentage'].'%)<br/>';
                                  } else if($value['type'] == "jetonAlea") {
                                     $f= $f.'Give entre '.$value['value'].' et '.$value['value2'].' '.$_Serveur_['General']['moneyName'].'(s) ('.$value['pourcentage'].'%)<br/>';
                                  } else if($value['type'] == "message") {
                                    $f= $f.'Envoie le message "'.$value['value'].'" sur '.($value['methode'] == "1" ? 'le serveur où il est en ligne' : 'tous les serveurs').' ('.$value['pourcentage'].'%)<br/>';
                                  } 
                                }  
                                if($f != "" && !empty($f)) {
                                   echo substr($f, 0, -5);
                                } ?>
                            </td>
                            <td><button onclick="sendDirectPost('admin.php?action=supprRecAuto&id=<?=$donnees[$o]['id'];?>', function(data) { if(data) { hide('rec-<?php echo $o; ?>'); }});" class="btn btn-outline-secondary">Supprimer</button></td>
                        </tr>
                            <?php 
                    }
                    ?>
            </tbody>
          </table>
        </div>
    </div>
   </div>
  </div>
  <?php } ?>