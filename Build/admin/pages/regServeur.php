<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Gestion de la liaison de vos/votre serveur(s)
    </h2>
</div>
<?php if(!$_Permission_->verifPerm('PermsPanel', 'server', 'actions', 'addServer') AND !$_Permission_->verifPerm('PermsPanel', 'server', 'actions', 'editServer')) { 

    echo '
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="alert alert-danger">
                <strong>Vous avez aucune permission pour accéder aux réglages du serveur</strong>
            </div>
        </div>
    </div>';
}
else
    { echo '<div class="row">'; if($_Permission_->verifPerm('PermsPanel', 'server', 'actions', 'addServer')) { ?>
    <div class="alert alert-success">
        <strong>Vous pouvez ajouter autant de serveurs minecraft que vous souhaitez. La connexion au(x) serveur(s) est essentielle ! Si vous n'avez pas JSONAPI, une connexion RCON/Query est possible (mais privilégiez JSONAPI qui permettra plus de possibilités !(Par exemple la console ainsi que le système de grade temporaire seront impossible avec une connexion RCON/Query)). Pour vous</strong>
    </div>

    <div class="col-md-12 col-xl-6 col-12">
        <div class="card  ">
            <div class="card-header ">
                <h3 class="card-title"><strong>Création d'un serveur <span id="co-title">JSONAPI</span></strong></h3>
            </div>
            <div class="card-body" id="newServer">
                    <label class="control-label">Nom du serveur</label>
                    <input type="text" name="JsonNom" class="form-control" placeholder="Exemple: CraftMyCube" required/>

                    <label class="control-label">Type de connexion</label>
                    <select name="type" class="form-control" onChange="
                    if(parseInt(this.value) == 1) {
                        show('ServeurJSONAPI');
                        hide('ServeurRcon');
                        get('co-title').innerText='JSONAPI';
                    } else if(parseInt(this.value) == 2) {
                        hide('ServeurJSONAPI');
                        show('ServeurRcon');
                        get('co-title').innerText='RCON/Query';
                    }
                    ">
                        <option value="1" selected>JSONAPI</option>
                        <option value="2">RCON/Query</option>
                    </select>
                    
                    <label class="control-label" >IP du serveur</label>
                    <input type="text" name="JsonAddr" placeholder="Exemple: 188.165.190.180 (pas d'ip en lettre)" class="form-control" required/>
                    
                    <div id="ServeurJSONAPI" >
                        <label class="control-label" >Port JSONAPI</label>
                        <input type="text" name="JsonPort" class="form-control" placeholder="Exemple: 12548" />
                        
                        <label class="control-label" >User JSONAPI</label>
                        <input type="text" name="JsonUser" class="form-control" placeholder="Exemple: admin"/>
                    </div>

                    <div id="ServeurRcon" style="display: none;">
                        <label class="control-label" >Port RCON</label>
                        <input type="text" name="RconPort" class="form-control" placeholder="Exemple: 12548"/>

                        <label class="control-label" >Port Query</label>
                        <input type="text" name="QueryPort" class="form-control" placeholder="Exemple: 12548"/>
                    </div>

                    <label class="control-label" >Mot de passe</label>
                    <input type="password" name="JsonMdp" class="form-control" placeholder="Exemple: Trampoline" required/>
            </div>
            <script>initPost('newServer', 'admin.php?&action=serveurJsonNew', function(data) { if(data) { serverUpdate(); clearAllInput('newServer'); }});</script>
            <div class="card-footer">
                <div class="row text-center">
                    <input type="submit" onclick="sendPost('newServer', null);" class="btn btn-success w-100" value="Envoyer !" />
                </div>
            </div>
        </div>
    </div>
    <?php 
    }if($_Permission_->verifPerm('PermsPanel', 'server', 'actions', 'editServer')) { ?> 
    <div class="col-md-12 col-xl-6 col-12">
        <div class="card  ">
            <div class="card-header ">
                <h3 class="card-title"><strong>Edition du/des serveurs</strong></h3>
            </div>
            <div class="card-body" id="modifServer">
                <?php if(count($lectureJSON) != 0)  { ?>
                <div class="col-md-12">
                    <ul class="nav nav-tabs">
                        <?php foreach($lectureJSON as $i => $serveur)
                        { ?>
                         <li class="nav-item"  id="tab-jsonReg<?php echo $i; ?>"><a
                            class="<?php if($i == 0) echo 'active'; ?> nav-link"
                            href="#jsonReg<?php echo $i; ?>" id="servTabName<?php echo $i; ?>" data-toggle="tab"
                            style="color: black !important"><?php echo $serveur['nom']; ?></a></li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content">
                        <?php foreach($lectureJSON as $i => $serveur)
                        { ?>
                        <div class="tab-pane well <?php if($i == 0) echo 'active'; ?>" id="jsonReg<?php echo $i; ?>">
                            <div style="position:inline-block">
                            <div class="float-left">
                                <h3 class="card-title"><strong id="servName<?php echo $i; ?>"><?php echo $serveur['nom']; ?></strong><small><?php echo $serveur['protocole'] == 1 ? '(JSONAPI)' : '(RCON/Query)'; ?></small></h3>
                            </div>
                            <div class="float-right">
                                <button onclick="sendDirectPost('?action=supprJson&nom=<?php echo $serveur['id']; ?>&key=<?php echo $i; ?>', function(data) { if(data) { hide('jsonReg<?php echo $i; ?>'); hide('tab-jsonReg<?php echo $i; ?>')}})" class="btn btn-outline-secondary">Supprimer</button>
                            </div>
                           </div>
                            
                            <input type="hidden" name="id<?=$i;?>" value="<?=$serveur['id'];?>" />
                             <input type="hidden" name="protocole<?=$i;?>" value="<?=$serveur['protocole'];?>" />
                            
                            <input type="text"  onkeyup="get('servName<?php echo $i; ?>').innerText = this.value; get('servTabName<?php echo $i; ?>').innerText = this.value;" name="JsonNom<?php echo $i; ?>" class="form-control" placeholder="Exemple: CraftMyCube" value="<?php echo $serveur['nom']; ?>" required>
                            
                            <label class="control-label" >Ip du serveur</label>
                            <input type="text" name="JsonAddr<?php echo $i; ?>" class="form-control" placeholder="188.165.190.180 (pas d'ip en lettre)" value="<?php echo $serveur['adresse']; ?>" required>

                            <?php 
                            if($serveur['protocole'] == 2)
                            {
                                ?><label class="control-label" >Port Query</label>
                                <input type="text" name="QueryPort<?php echo $i; ?>" class="form-control" placeholder="Exemple: 12548" value="<?php echo $serveur['port']; ?>">

                                <label class="control-label" >Port Rcon</label>
                                <input type="text" name="RconPort<?php echo $i; ?>" class="form-control" placeholder="Exemple: 12548" value="<?php echo $serveur['port2']; ?>"> <?php
                            }
                            else
                            {
                                ?><label class="control-label">Port JsonAPI</label>
                                <input type="text" name="JsonPort<?php echo $i; ?>" class="form-control" placeholder="Exemple: 12548" value="<?php echo $serveur['port']; ?>">
                                
                                <label class="control-label" >User JsonAPI</label>
                                <input type="text" name="JsonUser<?php echo $i; ?>" class="form-control" placeholder="Exemple: admin" value="<?php echo $serveur['utilisateur']; ?>"><?php 
                            } ?>          
                                              
                            <label class="control-label" >Mot de passe</label>
                            <input type="text" name="JsonMdp<?php echo $i; ?>" class="form-control" placeholder="Exemple: Truelle" value="<?php echo $serveur['mdp']; ?>" required>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                 <?php } ?>
            </div>
            <script>initPost('modifServer', 'admin.php?&action=serveurConfig', function(data) { if(data) {  }});</script>
            <div class="card-footer">
                <div class="row text-center">
                    <input type="submit" onclick="sendPost('modifServer', null);" class="btn btn-success w-100" value="Valider les changements !" />
                </div>
            </div>
        </div>
    </div>


    <?php }
        echo '</div>';
    }
?>
