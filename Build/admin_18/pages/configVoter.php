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

          <div class="row">
            <div class="col-md-12 col-xl-6 col-12">
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
                <input type='number' min="1" max="9999999" name='nbreVote' class='form-control' />
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

              <label class="control-label">Message affiché (laissez vide si pas de message)</label>
              <input type="text" name="message" class="form-control"/>

            </div>
            <div class="col-md-12 col-xl-6 col-12">

               <label class="control-label">Executer une Commande/Give d'item</label>
              <select name="action" class="form-control" onclick="
                hide('new-rec-item');
                hide('new-rec-item-l');
                hide('new-rec-item-l2');
                hide('new-rec-cmd');
                hide('new-rec-cmd-l');
                hide('new-rec-id');
                hide('new-rec-id-l');
                if(parseInt(this.value) == 1) {
                  show('new-rec-cmd');
                  show('new-rec-cmd-l');
                } else if(parseInt(this.value) == 2) { 
                  show('new-rec-item');
                  show('new-rec-item-l');

                  show('new-rec-id');
                  show('new-rec-id-l');
                } else {
                  show('new-rec-item');
                  show('new-rec-item-l2');
                }
              " required>
                <option value="1" selected> Executer une commande </option>
                <option value="2"> Give d'item </option>
                <option value="3"> Give de jetons site</option>
              </select>

              <label id="new-rec-item-l" style="display:none;" class="control-label">Quantité de l'item à donner</label>
              <label id="new-rec-item-l2" style="display:none;" class="control-label">Quantité de jetons à donner</label>

              <input id="new-rec-item" style="display:none;" type="text" name="quantite" class="form-control" value="4" />

              <label id="new-rec-id-l" style="display:none;" class="control-label">ID de l'item</label>
              <input id="new-rec-id" style="display:none;" type="text" name="id" class="form-control" value="264" />

              <label id="new-rec-cmd-l" class="control-label">Commande à éxecuter (SANS /)</label>
              <input id="new-rec-cmd" type="text" name="cmd" class="form-control" />

              <label class="control-label">Récompense sur quel serveur ?</label>
              <select name="serveur" class="form-control" required>        
                <?php for($i = 0; $i < count($lectureServs); $i++) {        ?>
                  <option value="<?php echo $i ?>"> <?php echo $lectureServs[$i]['nom']; ?> </option>
                 <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <script>initPost("new-rec", "admin.php?action=creerRecompenseAuto",function(data) { if(data) { updateCont('admin.php?action=getRecompenseList', get('all-rec'), null); }});</script>
        <div class="card-footer">
          <div class="text-center">
              <input type="submit" onclick="sendPost('new-rec');" class="btn btn-success btn-block w-100" value="Valider" />
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
                <th>Message</th>
                <th>Commande</th>
                <th>Serveur</th>
                <th>Action</th>
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
                            <td><?=(isset($donnees[$o]['message']) && $donnees[$o]['message'] != 'NULL' && !empty($donnees[$o]['message'])) ? $donnees[$o]['message'] : 'Pas de message';?></td>
                            <td><?php $explode = explode(':', $donnees[$o]['commande'], 2);
                            if($explode[0] == 'cmd')
                                echo 'Commande : '.$explode[1];
                            elseif($explode[0] == 'jeton')
                                echo 'Give de '.$explode[1].' jetons';
                            else
                            {
                                $action = explode(':', $explode[1]);
                                echo 'Give de '.$action[3].' fois l\'item '.$action[1];
                            }
                            ?>
                            </td>
                            <td>
                                Sur le serveur <strong><?=$lectureServs[$donnees[$o]['serveur']]['nom'];?></strong>
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