<?php echo '[DIV]';
if($_Permission_->verifPerm('PermsPanel', 'server', 'actions', 'editServer')) {
    if(count($lectureJSON) != 0)  { ?>
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
                                <h3 class="card-title"><strong id="servName<?php echo $i; ?>"><?php echo $serveur['nom']; ?></strong><small><?php echo $serveur['protocole'] == 0 ? '(JSONAPI)' : '(RCON/Query)'; ?></small>
                                <?php if($conEtablie[$i]) { ?> <span class="badge badge-success">En Ligne</span> <?php } else { ?><span class="badge badge-danger">Hors Ligne</span> <?php } ?></h3>
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
                            if($serveur['protocole'] == 1)
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
                             <div class="input-group mb-3">
                             <input type="password" name="JsonMdp<?php echo $i; ?>" class="form-control" placeholder="Exemple: Truelle" value="<?php echo $serveur['mdp']; ?>" required>
                              <div class="input-group-append">
                                <span onclick="switchTypePassword(this);" class="input-group-text" style="cursor:pointer;"><i class="far fa-eye"></i></span>
                              </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                 <?php } } ?>