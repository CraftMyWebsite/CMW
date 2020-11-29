<?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', 'actions', 'editRecompense')) { 
	require_once('./admin/donnees/configVoter.php'); ?>
    <div>
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
<?php } ?>