<?php if($_Permission_->verifPerm('PermsPanel', 'vote', 'recompenseAuto', 'actions', 'resetRecompense')) { 
	require_once('./admin/donnees/configVoter.php'); ?>
    <div>
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
<?php } ?>