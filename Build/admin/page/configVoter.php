<div class="cmw-page-content-header"><strong>Votes</strong> - Gérez vos récompenses auto</div>
<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
        <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['vote']['actions']['editSettings'] == false AND $_PGrades_['PermsPanel']['vote']['actions']['addVote'] == false)) { ?>
            <div class="col-lg-12 text-center">
                <div class="alert alert-danger">
                    <strong>Vous avez aucune permission pour accéder aux votes.</strong>
                </div>
            </div>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['editSettings'] == true) { ?>
        <div class="col-lg-12 text-justify">
            <div class="alert alert-success">
                <strong>Dans cette section vous pourrez configurer vos récompenses auto.</strong><br/>
                Il existe plusieurs types de récompenses auto que vous allez pouvoir configurer<ul>
                    <li> Les récompenses lorsque le joueur vote X fois</li>
                    <li> Les récompenses pour les 1er, 2eme, 3eme meilleurs voteurs en fin de mois ou autre</li>
                </ul>
               Pour le second type, vous devrez définir une date à PARTIR de laquelle les récompenses seront distribuées. <br/>
               Pour éviter le fait de devoir faire plusieurs manipulations pas forcément très simple, nous avons choisit de lier ces récompenses aux chargements des pages du site, c'est à dire que si vous voulez envoyer une récompense le 04/08/2019, la récompense sera envoyé dès qu'une personne chargera la page ce jour là, si personne ne charge la page ce jour là, la récompense est reporté au 05/08 sur le même principe et ainsi de suite. <br/>
                Bonne configuration ! 
                NB: Pour les commandes, les mêmes raccourcis que pour les récompenses de vote sont utilisable !
            </div>
        </div>
    </div>
    <form method="POST" action="?&action=creerRecompenseAuto">
        <div class="col-lg-12">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Configuration des Récompenses Auto</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="col-md-5">
                        <h3>Créer une Récompense auto</h3>
                        <div class="row">
                            <label class="control-label">Type de récompense</label>
                            <select name="type" class="form-control" onChange="updateFormRecompense(this);">
                                <option value="1"> Récompense au bout de X vote</option>
                                <option value="2"> Récompense pour les meilleurs voteurs</option>
                            </select>
                        </div>
                        <div class="row" id="updateRecompense">
                            <label class='control-label'>Au bout de combien de vote ?</label>
                            <input type='number' name='nbreVote' class='form-control' />
                        </div>
                        <div class="row">
                            <label class="control-label">Message affiché (laissez vide si pas de message)</label>
                            <input type="text" name="message" class="form-control"/>
                        </div>
                        <div class="row">
                            <label class="control-label">Executer une Commande/Give d'item</label>
                            <select name="action" class="form-control">
                                <option value="1"> Executer une commande </option>
                                <option value="2"> Give d'item </option>
                                <option value="3"> Give de jetons site</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-offset-1 col-md-6">
                            <div class="row">
                                <label class="control-label">Quantité de l'item à donner <strong>OU</strong> quantité de jetons à donner</label>
                                <input type="text" name="quantite" class="form-control" value="4" />
                            </div>
                            <div class="row">
                                <label class="control-label">Commande à éxecuter (SANS /)</label>
                                <input type="text" name="cmd" class="form-control" />
                            </div>
                            <div class="row">
                                <label class="control-label">ID de l'item (si give d'item)</label>
                                <input type="text" name="id" class="form-control" value="264" />
                            </div>
                            <div class="row">
                                <label class="control-label">Récompense sur quel serveur ?</label>
                                <select name="serveur" class="form-control">        
                                    <?php for($i = 0; $i < count($lectureServs); $i++) {        ?>
                                        <option value="<?php echo $i ?>"> <?php echo $lectureServs[$i]['nom']; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        <hr>
                        <div class="row text-center">
                            <input type="submit" class="btn btn-success" value="Valider les changements !"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    <?php }
    if($_Joueur_['rang'] == 1 OR ($_PGrades_['PermsPanel']['vote']['actions']['resetVote'] == true OR $_PGrades_['PermsPanel']['vote']['actions']['deleteVote'] == true)) { ?>
        <div class="col-lg-12">
            <div class="panel panel-default cmw-panel">
                <div class="panel-heading cmw-panel-header">
                    <h3 class="panel-title"><strong>Edition des récompenses auto</strong></h3>
                </div>
                <div class="panel-body"><?php
                    if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['vote']['actions']['deleteVote'] == true) { ?>
                        <div class="row">
                            <h3 class="text-center">Gestion des récompenses auto</h3>
                        </div>
                        <table class="table table-striped table-hover">
                            <tr>
                                <th>Type</th>
                                <th>Valeur</th>
                                <th>Message</th>
                                <th>Commande</th>
                                <th>Serveur</th>
                                <th>Action</th>
                            </tr>
                        <?php $donnees = $reqConfig->fetchAll();
                        for($o=0; $o < count($donnees); $o++)
                        {
                            ?><tr>
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
                                <td><a href="?action=supprRecAuto&id=<?=$donnees[$o]['id'];?>" class="btn btn-danger">Supprimer</a></td>
                            </tr>
                                <?php 
                        }
                        ?>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<!-- /.row -->