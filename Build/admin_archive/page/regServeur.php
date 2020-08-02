<div class="cmw-page-content-header"><strong>Réglages JSONAPI</strong> - Gérez vos serveurs JSONAPI</div>


<div class="row">


    <?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'server', 'actions', 'addServer') AND !Permission::getInstance()->verifPerm('PermsPanel', 'server', 'actions', 'editServer')) { ?>

        <div class="alert alert-danger">
            <strong>Vous avez aucune permission pour accéder aux réglages du/des serveur(s).</strong>
        </div>

    <?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'server', 'actions', 'addServer')) { ?>

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
                    <input type="text" name="JsonAddr" placeholder="Exemple: 188.165.190.180 (pas d'ip en lettre)" class="form-control"/>
                    
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
                    <br/>
                    <input type="submit" class="btn btn-success" value="Ajouter le serveur !"/>
                </form>
            </div>
        </div>
    </div>
    <?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'server', 'actions', 'editServer')) { ?>

    <div class="col-xs-12 col-md-6 text-center">
        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Edition du/des serveurs</strong></h3>
            </div>
            <div class="panel-body">
        <?php if(count($lectureJSON) == 0) { ?>

            <div class="alert alert-warning">
                <strong>Merci de bien vouloir ajouter un serveur pour pouvoir le modifier !</strong>
            </div>

        <?php } else { ?>

            <div class="alert alert-success">
                <strong>Vous pouvez modifier les données du/des serveur(s) ajouté(s). Pour cela rien de plus simple, il vous suffit de remplir le formulaire ci-contre.</strong>
            </div>
        <form method="POST" action="?&action=serveurConfig">
                <div class="row">
                    <ul class="nav nav-tabs">
                        <?php foreach($lectureJSON as $i => $serveur) { ?>
                        <li <?php if($i == 0) echo 'class="active"'; ?>><a href="#jsonReg<?php echo $i; ?>" data-toggle="tab">Serveur <?php echo $i + 1; ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <?php foreach($lectureJSON as $i => $serveur) { ?>
                        <div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="jsonReg<?php echo $i; ?>">
                            <h4><?php echo $serveur['nom']; ?>  <a class="btn btn-danger" href="?&action=supprJson&nom=<?php echo $serveur['id']; ?>">Supprimer ce serveur</a></h4>
                            
                             <input type="hidden" name="id<?=$i;?>" value="<?=$serveur['id'];?>" />
                            <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Nom du serveur</label>
                            <input type="text" name="JsonNom<?php echo $i; ?>" class="form-control" placeholder="Exemple: CraftMyCube" value="<?php echo $serveur['nom']; ?>">
                            
                            <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Ip du serveur</label>
                            <input type="text" name="JsonAddr<?php echo $i; ?>" class="form-control" placeholder="188.165.190.180 (pas d'ip en lettre)" value="<?php echo $serveur['adresse']; ?>">

                            <?php 
                            if($serveur['protocole'] == 1)
                            {
                                ?><label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Port Query</label>
                                <input type="text" name="QueryPort<?php echo $i; ?>" class="form-control" placeholder="Exemple: 12548" value="<?php echo $serveur['port']; ?>">

                                <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Port Rcon</label>
                                <input type="text" name="RconPort<?php echo $i; ?>" class="form-control" placeholder="Exemple: 12548" value="<?php echo $serveur['port2']; ?>"> <?php
                            }
                            else
                            {
                                ?><label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Port JsonAPI</label>
                                <input type="text" name="JsonPort<?php echo $i; ?>" class="form-control" placeholder="Exemple: 12548" value="<?php echo $serveur['port']; ?>">
                                
                                <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">User JsonAPI</label>
                                <input type="text" name="JsonUser<?php echo $i; ?>" class="form-control" placeholder="Exemple: admin" value="<?php echo $serveur['utilisateur']; ?>"><?php 
                            } ?>          
                                              
                            <label class="control-label" style="float: left;font-size: 15px;font-weight: bold;margin-top: 5px;">Mot de passe</label>
                            <input type="text" name="JsonMdp<?php echo $i; ?>" class="form-control" placeholder="Exemple: Truelle" value="<?php echo $serveur['mdp']; ?>">
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
