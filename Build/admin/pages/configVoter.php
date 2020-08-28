<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2 class="h2 gray">
                    Gestions des récompenses auto
                    </h2>
                </div>
<?php if(!$_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', "actions", 'addRecompense') AND !$_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', 'actions', 'resetRecompense')) {
  echo '<div class="col-lg-6 col-lg-offset-3 text-center">
    <div class="alert alert-danger">
      <strong>Vous avez aucune permission pour accéder à cette page.</strong>
    </div>
  </div>';
}
else
  {
    ?><div class="alert alert-success">
      <strong>

        Dans cette section vous pourrez configurer vos récompenses auto.
        Il existe plusieurs types de récompenses auto que vous allez pouvoir configurer
        <ul>
          <li>Les récompenses lorsque le joueur vote X fois</li>
          <li>Les récompenses pour les 1er, 2eme, 3eme meilleurs voteurs en fin de mois ou autre</li>
        </ul>
        Pour le second type, vous devrez définir une date à PARTIR de laquelle les récompenses seront distribuées.
        Pour éviter le fait de devoir faire plusieurs manipulations pas forcément très simple, nous avons choisit de lier ces récompenses aux chargements des pages du site, c'est à dire que si vous voulez envoyer une récompense le 04/08/2019, la récompense sera envoyé dès qu'une personne chargera la page ce jour là, si personne ne charge la page ce jour là, la récompense est reporté au 05/08 sur le même principe et ainsi de suite.
        Bonne configuration ! NB: Pour les commandes, les mêmes raccourcis que pour les récompenses de vote sont utilisable !
      </strong>
    </div>
  <?php } if($_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', 'actions', 'addRecompense')) { ?>
  <div class="row">
    <div class="col-md-12 col-xl-12 col-12">
      <div class="card">
        <div class="card-header ">
          <h3 class="card-title"><strong>Créer une Récompense auto</strong></h3>
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
                <option value="2"> Récompense pour les meilleurs voteurs</option>
              </select>

              <div id="type-1">
                <label class='control-label'>Au bout de combien de vote ?</label>
                <input type='number' min="1" max="9999999" name='nbreVote' class='form-control' required />
              </div>

              <div id="type-2" style="display:none;">
                <label class='control-label'>Quelle date ?</label>
                <input type='date' name='date' class='form-control' />

                <label class='control-label'>Réinitialiser les votes après ?</label>
                <select name='reinit' class='form-control'>
                  <option value='1'>Oui</option>
                  <option value='0'>Non</option>
                </select>

                <label class='control-label'>Rang de la personne</label>
                <select name='rang' class='form-control'>
                  <option value='1'>Premier</option>
                  <option value='2'>Second</option>
                  <option value='3'>Troisième</option>
                </select>
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
                              <button  class="dropdown-item" onclick="addVoteConfigRec('jeton', 'all-new-rec-vote','list-new-rec-vote');">jeton(s)</button >
                              <button  class="dropdown-item" onclick="addVoteRec('jetonAlea', 'all-new-rec-vote','list-new-rec-vote');">jeton(s) aléatoire</button >
                              <button  class="dropdown-item" onclick="addVoteConfigRec('item', 'all-new-rec-vote','list-new-rec-vote');">Item(s)</button >
                            </div>
                          </div>


                        <div class="row" style="margin:30px;display:none;" id="all-new-rec-vote">
                            <div class="col-md-12 row " id="list-new-rec-vote">

                            </div>
                        </div>

        </div>
        <script>initPost("new-rec", "admin.php?action=creerRecompenseAuto",function(data) { if(data) { updateCont('admin.php?action=getRecompenseList', get('all-rec'), null); }});</script>
        <div class="card-footer">
          <div class="text-center">
              <input type="submit" onclick="genVoteJson('list-new-rec-vote','vote-action-json');sendPost('new-rec');" class="btn btn-success btn-block w-100" value="Valider" />
          </div>
        </div>
    </div>
   </div>
 <?php } if($_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', 'actions', 'resetRecompense')) { ?>
   <div class="col-md-12 col-xl-12 col-12">
      <div class="card">
        <div class="card-header ">
          <h3 class="card-title"><strong>Edition des récompenses auto</strong></h3>
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
                    <?php $donnees = $reqConfig->fetchAll();
                    for($o=0; $o < count($donnees); $o++)
                    {
                        ?><tr id="rec-<?php echo $o; ?>">
                            <td><?=($donnees[$o]['type'] == 1) ? 'Récompense tout les X votes' : 'Récompense pour les meilleurs voteurs'; ?></td>
                            <td><?php if($donnees[$o]['type'] == 1)
                                    echo $donnees[$o]['valueType'].' votes';
                                else
                                {
                                    $explode = explode(':', $donnees[$o]['valueType']);
                                    if($explode[2] == 1)
                                        $rang = "premier";
                                    elseif($explode[2] == 2)
                                        $rang = "second";
                                    else
                                        $rang = "troisième";
                                    echo 'Pour le <strong>'.$rang.'</strong> ';
                                    echo 'le '.date('d-m-Y', $explode[0]);
                                    echo $string = ($explode[1] == 1) ? ' avec réinitialisation des votes' : '';
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
                                     $f= $f.'Give '.$value['value'].' jeton(s) ('.$value['pourcentage'].'%)<br/>';
                                  } else if($value['type'] == "jetonAlea") {
                                     $f= $f.'Give entre '.$value['value'].' et '.$value['value2'].' jeton(s) ('.$value['pourcentage'].'%)<br/>';
                                  } else if($value['type'] == "message") {
                                    $f= $f.'Envoie le message "'.$value['value'].'" sur '.($value['methode'] == "1" ? 'le serveur où il est en ligne' : 'tous les serveurs').' ('.$value['pourcentage'].'%)<br/>';
                                  } 
                                }  
                                if($f != "" && !empty($f)) {
                                   echo substr($f, 0, -5);
                                } ?>
                            </td>
                            <td><button onclick="sendDirectPost('?action=supprRecAuto&id=<?=$donnees[$o]['id'];?>', function(data) { if(data) { hide('rec-<?php echo $o; ?>'); }});" class="btn btn-outline-secondary">Supprimer</button></td>
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