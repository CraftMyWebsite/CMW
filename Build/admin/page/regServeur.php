<div class="cmw-page-content-header"><strong>Réglages JSONAPI</strong> - Gérez vos serveurs JSONAPI</div>


<div class="row">


    <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['server']['actions']['addServer'] == false AND $_PGrades_['PermsPanel']['server']['actions']['editServer'] == false)) { ?>

        <div class="alert alert-danger">
            <strong>Vous avez aucune permission pour accéder aux réglages du/des serveur(s).</strong>
        </div>

    <?php } if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['server']['actions']['addServer'] == true) { ?>

    <div class="col-xs-12 col-md-6 text-center">
        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Création d'un serveur JSONAPI</strong></h3>
            </div>
            <div class="panel-body">
                <div class="alert alert-success">
                    <strong>Vous pouvez ajouter autant de serveurs minecraft que vous souhaitez. La connexion au(x) serveur(s) est essentielle ! Si vous n'avez pas JSONAPI, une connexion RCON/Query est possible (mais privilégiez JSONAPI qui permettra plus de possibilités !(Par exemple la console ainsi que le système de grade temporaire seront impossible avec une connexion RCON/Query)). Pour vous  </strong>
                </div>
                <form method="POST" action="?&action=serveurJsonNew">
                    <h3>Ajout d'un serveur</h3>

                    <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Nom du serveur</label>
                    <input type="text" name="JsonNom" class="form-control" placeholder="Exemple: CraftMyCube"/>

                    <label class="control-label" style="float: left; font-size: 15px;font-weight: bold;margin-top: 5px;">Type de connexion</label>
                    <select name="type" class="form-control" onChange="updateFormServeur(this);">
                        <option value="1">Jsonapi</option>
                        <option value="2">RCON/Query</option>
                    </select>
                    
                    <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">IP du serveur</label>
                    <input type="text" name="JsonAddr" placeholder="Exemple: play.craftmycube.fr ou 188.165.190.180" class="form-control"/>
                    
                    <div id="updateFormServeurJSONAPI" style="display: block;">
                        <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Port JSONAPI</label>
                        <input type="text" name="JsonPort" class="form-control" placeholder="Exemple: 12548"/>
                        
                        <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">User JSONAPI</label>
                        <input type="text" name="JsonUser" class="form-control" placeholder="Exemple: admin"/>
                    </div>

                    <div id="updateFormServeurRcon" style="display: none;">
                        <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Port RCON</label>
                        <input type="text" name="RconPort" class="form-control" placeholder="Exemple: 12548"/>

                        <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Port Query</label>
                        <input type="text" name="QueryPort" class="form-control" placeholder="Exemple: 12548"/>
                    </div>

                    <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Mot de passe</label>
                    <input type="password" name="JsonMdp" class="form-control" placeholder="Exemple: Trampoline"/>
                    
                    <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Salt</label>
                    <input type="password" name="JsonSalt" class="form-control" placeholder="Depuis la 1.7, merci d'ignorer ce champ !"/>
                    <br/>
                    <input type="submit" class="btn btn-success" value="Ajouter le serveur !"/>
                </form>
            </div>
        </div>
    </div>
    <?php } if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['server']['actions']['editServer'] == true) { ?>

    <div class="col-xs-12 col-md-6 text-center">
        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Edition du/des serveurs</strong></h3>
            </div>
            <div class="panel-body">
        <?php if(count($lecture['Json']) == 0) { ?>

            <div class="alert alert-warning">
                <strong>Merci de bien vouloir ajouter un serveur pour pouvoir le modifier !</strong>
            </div>

        <?php } else { ?>

            <div class="alert alert-success">
                <strong>Vous pouvez modifier les données du/des serveur(s) ajouté(s). Pour cela rien de plus simple, il vous suffit de remplir le formulaire ci-contre.</strong>
            </div>

        <?php } if(!count($lecture['Json']) == 0) { ?>

        <form method="POST" action="?&action=serveurConfig">
                <div class="row">
                    <ul class="nav nav-tabs">
                        <?php for($i = 0; $i < count($lecture['Json']); $i++) { ?>
                        <li <?php if($i == 0) echo 'class="active"'; ?>><a href="#jsonReg<?php echo $i; ?>" data-toggle="tab">Serveur <?php echo $i + 1; ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <?php for($i = 0; $i < count($lecture['Json']); $i++) { ?>
                        <div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="jsonReg<?php echo $i; ?>">
                            <h4><?php echo $lecture['Json'][$i]['nom']; ?>  <a class="btn btn-danger" href="?&action=supprJson&nom=<?php echo $lecture['Json'][$i]['nom']; ?>">Supprimer ce serveur</a></h4>
                            
                            <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Nom du serveur</label>
                            <input type="text" name="JsonNom<?php echo $i; ?>" class="form-control" placeholder="Exemple: CraftMyCube" value="<?php echo $lecture['Json'][$i]['nom']; ?>">
                            
                            <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Ip du serveur</label>
                            <input type="text" name="JsonAddr<?php echo $i; ?>" class="form-control" placeholder="Exemple: play.craftmycube.fr" value="<?php echo $lecture['Json'][$i]['adresse']; ?>">

                            <?php 
                            if(isset($lecture['Json'][$i]['port']['query']))
                            {
                                ?><label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Port Query</label>
                                <input type="text" name="QueryPort<?php echo $i; ?>" class="form-control" placeholder="Exemple: 12548" value="<?php echo $lecture['Json'][$i]['port']['query']; ?>">

                                <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Port Rcon</label>
                                <input type="text" name="RconPort<?php echo $i; ?>" class="form-control" placeholder="Exemple: 12548" value="<?php echo $lecture['Json'][$i]['port']['rcon']; ?>"> <?php
                            }
                            else
                            {
                                ?><label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Port JsonAPI</label>
                                <input type="text" name="JsonPort<?php echo $i; ?>" class="form-control" placeholder="Exemple: 12548" value="<?php echo $lecture['Json'][$i]['port']; ?>">
                                
                                <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">User JsonAPI</label>
                                <input type="text" name="JsonUser<?php echo $i; ?>" class="form-control" placeholder="Exemple: admin" value="<?php echo $lecture['Json'][$i]['utilisateur']; ?>"><?php 
                            } ?>          
                                              
                            <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Mot de passe</label>
                            <input type="text" name="JsonMdp<?php echo $i; ?>" class="form-control" placeholder="Exemple: Truelle" value="<?php echo $lecture['Json'][$i]['mdp']; ?>">
                            
                            <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Salt</label>
                            <input type="text" name="JsonSalt<?php echo $i; ?>" class="form-control" placeholder="Exemple: MonSaltSecret" value="<?php echo $lecture['Json'][$i]['salt']; ?>">

                            <br/>
                            <input type="submit" class="btn btn-success" value="Valider les changements"/>
                        </div>
                        <?php } ?>
                    </div>
                </div>
        </form>
    <?php } ?>
</div>
</div>
</div>
<?php } ?>
</div>