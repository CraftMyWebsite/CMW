<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2 class="h2 gray">
        Réglages de la boutique
    </h2>
</div>


<?php if(!$_Permission_->verifPerm('PermsPanel', 'shop', 'showPage')) { ?>
<div class="col-lg-12 text-justify">
    <div class="alert alert-danger">
        <strong>Vous n'avez aucune permission pour accéder aux réglages de la boutique</strong>
    </div>
</div>
<?php } else {?>
    <div class="col-lg-12 text-justify">
            <div class="alert alert-success">
                <strong>Dans cette section vous pourrez configurer les offres proposé dans votre boutique</strong><br/>
            </div>
        </div>
<div class="row">
<?php if($_Permission_->verifPerm('PermsPanel', 'shop', 'actions', 'addCategorie')) {?>
    <div class="col-md-12 col-xl-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Créer une catégorie
                </h4>
            </div>
            <div class="card-body" id="createCate">
                    <div class="alert alert-success">
                        <strong>Avant de créez une catégorie sachez d'abord à quoi servent ces catégories, en effet en plus de permettre de ne pas tout mettre en vrac et d'avoir un minimum d'organisation, les catégories vous permettent de gérer le multiserveur! Vous avez trois choix pour le serveur d'action d'une catégorie: tous les serveurs(la commande est envoyée sur tous les serveurs), le serveur où le joueur est en ligne(par exemple pour un give d'item) ou un serveur spécifique que vous choisissez à l'avance. L'ordre de la catégorie est l'ordre d'affichage, il ne sert qu'à titre d'organisation.</strong>
                    </div>

                        <label class="control-label">Titre de la catégorie</label>
                        <input type="text" class="form-control" name="titre" placeholder="ex: Grades pas chers !" required>

                        <label class="control-label">Ordre d'affichage</label>
                        <input type="number" class="form-control" name="ordre" value="<?php echo $categorieNum; ?>" placeholder="L'ordre dans lequel va s'afficher la catégorie !" required> 

                        <label class="control-label">Nombre d'offre par ligne dans la catégorie (min: 1, max: 4)</label>
                        <input class="form-control" required type="number" name="number"  min ="1" max="4" value="3" />
                    
                        <label class="control-label">Connexion In-Game</label>
                        <select name="connection"class="form-control" required>
                            <option value="0">Désactivé</option>
                            <option value="1">Activé</option>
                        </select>
                
                        <label class="control-label">Serveurs d'action</label>
                        <select name="serveur" class="form-control" required>
                            <option value="-1">Tous</option>
                            <option value="-2">Au choix (Le joueur se connecte sur le serveur voulu)</option>
                            <?php foreach($lectureJSON as $serveur) { ?>
                            <option value="<?php echo $serveur['id']; ?>"><?php echo $serveur['nom']; ?></option>
                            <?php } ?>
                        </select>
                    
                        <label class="control-label">Description de la catégorie</label>
                        <textarea class="form-control" id="ckeditor" data-UUID="CATBOUTIQUENEW1" name="message"></textarea>
            </div>
             <script>initPost("createCate", "admin.php?action=creerCategorie",function (data) { if(data) { show('card-minia'); boutiqueUpdate();}});</script>
            <div class="card-footer">
                <button type="submit" class="btn btn-success w-100" onClick="sendPost('createCate');">Envoyer!</button>
            </div>
        </div>
    </div>
    <?php } if($_Permission_->verifPerm('PermsPanel', 'shop', 'actions', 'addOffre')) {  ?>
    <div class="col-md-12 col-xl-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Créer une offre
                </h4>
            </div>
            <div class="card-body" id="createOffre">

                <div class="alert alert-success">
                    <strong>Après avoir créé une catégorie, vous pouvez y insérer une offre. L'offre est dans un premier temps composée d'un titre, d'un message(ou image) et appartient à une catégorie, vous pourrez par la suite attribuer à une offre une "action"(=commande). Pour mettre une image rien de plus simple, il vous suffit d'activer l'option dans Réglages du site et d'utiliser l'éditeur de texte.</strong>
                </div>

                        <label class="control-label">Titre de l'offre</label>
                        <input type="text" class="form-control" name="nom" placeholder="ex: 64 x Diamants" required> 
                
                        <label class="control-label">Description</label>
                         <textarea class="form-control" id="ckeditor" data-UUID="CATBOUTIQUENEW2" name="description"></textarea>
                
                        <label class="control-label">Prix</label>
                        <input type="number" class="form-control" name="prix" required>
                    
                        <label class="control-label">Catégorie</label>
                        <select name="categorie" class="form-control" required id="allcategorieupdate">
                            <?php $k = 0;
                            while($k < count($categories)) { ?>
                            <option value="<?php echo $categories[$k]['id']; ?>"><?php echo $categories[$k]['titre']; ?></option>
                            <?php $k++; } ?>
                        </select>
                
                        <label class="control-label">Nombre de ventes possibles au total <small>(-1 si aucune limite, max 9999)</small></label><br>
                        <input class="form-control" type="number" name="nbre_vente" value="-1" min="-1" max="9999" required />

                        <label class="control-label">Nombre de ventes possibles par joueur <small>(-1 si aucune limite, max 9999)</small></label><br>
                        <input class="form-control" type="number" name="max_vente" value="-1" min="-1" max="9999" required />

                        <label class="control-label">Dépendance de l'offre (devra avoir acheter les offres suivante avant celle-ci)</label>
                        <input type="text"  value="" id="dep-tag" name="dep"  data-role="tagsinput">
                        <select style="margin-top:10px;" id="dep-tag-sel" onfocus="this.selectedIndex = -1;" class="form-control" onchange="$('#dep-tag').tagsinput('add', { 'value': parseInt(this.value.split('|')[0]) , 'text': this.value.split('|')[1]});">
                            <?php for($j = 1;$j <= count($offres);$j++) { ?>
                                <option value="<?php echo $offres[$j]['id']; ?>|<?php echo $offres[$j]['nom']; ?>"><?php echo $offres[$j]['nom']; ?></option>
                            <?php } ?> 
                        </select>
                    
            </div>
             <script>
             initPost("createOffre", "admin.php?action=creerOffre",function (data) { if(data) { boutiqueUpdate();}});</script>
            <div class="card-footer">
                <button type="submit" class="btn btn-success w-100" onClick="sendPost('createOffre');">Envoyer!</button>
            </div>
        </div>
    </div>
<?php } if($_Permission_->verifPerm('PermsPanel', 'shop', 'actions', 'createCoupon')) { ?>
    <div class="col-md-12 col-xl-6 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Création de coupon de réduction
                </h4>
            </div>
            <div class="card-body" id="createCoupon">

                <div class="alert alert-success">
                    <strong>Ici vous pouvez créer des coupons de réduction pour votre boutique. La valeur des coupons est en %age. Il ne peut y avoir qu'un seul coupon utilisé par paiement, les coupons sont valables jusqu'à ce que vous les supprimiez et ils sont réutilisables. Il vous suffit simplement de rentrer un code de maximum 8 lettres, un pourcentage ainsi qu'un titre pour décrire votre remise, il apparaîtra dans la description du produit dans le panier.</strong>
                </div>
                    <label class="control-label">Titre de la remise (description)</label>
                    <input type="text" class="form-control" name="titre" placeholder="Remise spécial CMW V1.8" required maxlength="60">

                    <label class="control-label"> Pourcentage de remise </label>
                    <input type="number" name="pourcent" class="form-control" max="100" min="1" required >

                    <label class="control-label"> Code de remise </label>
                    <input type="text" name="code" class="form-control" maxlength="8" placeholder="CMWV1.8">

                    <div class="text-center"><button class="btn btn-info w-100" onclick="SwitchDisplay(get('advancedoption'))" >Options Avancées</button></div>
                    <div class="row" id="advancedoption" style="display:none;margin-top:15px;padding:15px;">
                        <div class="col-xs-12"> 
                            <label class="control-label" for="OuiCat">Activer l'option : "Code utilisable sur une seule catégorie" &nbsp;</label>
                            <div class="custom-control custom-switch" style="padding-top: 20px">
                                <input type="checkbox" class="custom-control-input" onclick="SwitchDisplay(get('OuiCatTab'))" id="OuiCat" name="OuiCat" >
                                <label class="custom-control-label" for="OuiCat">Oui</label>
                            </div>
                            <div style="margin:10px;display:none;" id="OuiCatTab">
                                <label class="control-label" > Quelle catégorie ?</label>
                                    <select name="cat" id="allcategoriecoupon" class="form-control">
                                                <?php 
                                                $a = 0;
                                                while($a < count($categories))
                                                {
                                                    ?><option id="cate-list-<?=$categories[$a]['id'];?>" value="<?=$categories[$a]['id'];?>"><?=$categories[$a]['titre'];?></option><?php
                                                    $a++;
                                                }
                                                $a = 0;
                                                ?> 
                                    </select>

                            </div>
                        </div>
                        <hr></hr>
                        <div class="col-xs-12"> 
                            <label class="control-label" for="OuiTemps">Activer l'option : "Code utilisable sur une période de temps (début/fin)" </label>
                            <div class="custom-control custom-switch" style="padding-top: 20px">
                                <input type="checkbox" class="custom-control-input" onclick="SwitchDisplay(get('OuiTempsTab'))" id="OuiTemps" name="OuiTemps" >
                                <label class="custom-control-label" for="OuiTemps">Oui</label>
                            </div>
                            <div style="margin:10px;display:none;" id="OuiTempsTab">
                                <label class="control-label" > Date de début (mm/jj/aaaa HH:MM) </label>
                                <input type="text" class="form-control" name="dDebut" placeholder="mm/jj/aaaa HH:MM">
                                <label class="control-label" > Date de fin (mm/jj/aaaa HH:MM) (le coupon sera automatiquement supprimé après)</label>
                                <input type="text" class="form-control" name="dFin" placeholder="mm/jj/aaaa HH:MM">

                            </div>
                        </div>
                        <hr></hr>
                        <div class="col-xs-12"> 
                            <label class="control-label" for="OuiFois">Activer l'option : "Code utilisable un certain nombre de fois"</label>
                            <div class="custom-control custom-switch" style="padding-top: 20px">
                                <input type="checkbox" class="custom-control-input" onclick="SwitchDisplay(get('OuiFoisTab'))" id="OuiFois" name="OuiFois" >
                                <label class="custom-control-label" for="OuiFois">Oui</label>
                            </div>
                            <div style=" margin:10px;display:none;" id="OuiFoisTab">
                                <label class="control-label"> Nombre de fois maximum d'utilisation (le coupon sera automatiquement supprimé après)</label>
                                <input type="number" class="form-control" name="expire">

                            </div>
                        </div>
                    </div>

                    
            </div>
             <script>initPost("createCoupon", "admin.php?action=creerCoupon",function (data) { if(data) {
                let str = "";
                str+="<tr>";
                str+= "<td>"+getValueByName("createCoupon", "titre")+"</td>";
                str+= "<td>"+getValueByName("createCoupon", "code")+"</td>";
                str+= "<td>"+getValueByName("createCoupon", "pourcent")+"</td>";
                str+= "<td>";
                if(get("OuiCat").checked | get("OuiFois").checked |  get("OuiTemps").checked) {
                    str += "Utilisable ";
                    if(get("OuiCat").checked) {
                        str +="uniquement sur "+get("cate-list-"+getValueByName("createCoupon", "cat")).innerText+ " ";
                    }
                    if(get("OuiTemps").checked) {
                        str +="du "+getValueByName("createCoupon", "dDebut")+" au "+getValueByName("createCoupon", "dFin")+" ";
                    }
                    if(get("OuiFois").checked) {
                        str +="maximum "+getValueByName("createCoupon", "expire")+" fois";
                    }
                }
                str+= "<td></td>";
                str+="</tr>";
                get("allCoupon").innerHTML += str;
             }});</script>
            <div class="card-footer">
                <button type="submit" class="btn btn-success w-100" onClick="sendPost('createCoupon');">Envoyer!</button>
            </div>
        </div>
    </div>
<?php }if($_Permission_->verifPerm('PermsPanel', 'shop', 'actions', 'editCoupon')) { ?> 
    <div class="col-md-12 col-xl-12 col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Les coupons de réduction actuellement disponibles
                </h4>
            </div>
            <div class="card-body" >
                <table class="table table-striped table-hover table-responsive">
                        <thead>
                            <tr>
                            <th>Titre / Description</th>
                            <th >Code de réduction</th>
                            <th>Pourcentage de réduction</th>
                            <th>Options avancées</th>
                            <th>Actions ...</th>
                            </tr>
                        </thead>
                        <tbody id="allCoupon">
                            <?php $coupons = getCouponsReduc($bddConnection);
                        for($i = 0; $i < count($coupons); $i++)
                        {
                            ?><tr id="coupon-<?php echo $coupons[$i]['id']; ?>">
                                <td><?php echo $coupons[$i]['titre']; ?></td>
                                <td><?php echo $coupons[$i]['code_promo']; ?></td>
                                <td><?php echo $coupons[$i]['pourcent']; ?>%</td>
                                <td><?php 
                                if(isset($coupons[$i]['categorie']) || isset($coupons[$i]['debut']) || isset($coupons[$i]['expire']))
                                {
                                    echo 'Utilisable ';
                                    if(isset($coupons[$i]['categorie']))
                                        echo 'uniquement sur '.$categories[array_search($coupons[$i]['categorie'], array_column($categories, 'id'))]['titre'].' ';
                                    if(isset($coupons[$i]['debut']))
                                        echo 'du '.date('d/m/Y H:i', $coupons[$i]['debut']).' au '.date('d/m/Y H:i', $coupons[$i]['fin']).' ';
                                    if(isset($coupons[$i]['expire']))
                                        echo 'maximum '.$coupons[$i]['expire'].' fois';
                                }
                                ?></td>
                                <td><button type="button" class="btn btn-danger" onclick="sendDirectPost('admin.php?action=supprCoupon&id=<?php echo $coupons[$i]['id']; ?>', function(data) { if(data) { hide('coupon-<?php echo $coupons[$i]['id']; ?>'); }});" >Supprimer le coupon</button></td>
                            </tr><?php
                        }
                    ?>
                        </tbody>
                    </table>
            </div>
        </div>
    </div>
<?php } if($_Permission_->verifPerm('PermsPanel', 'shop', 'actions', 'editCategorieOffre')) { ?>

    <div class="col-md-12 col-xl-12 col-12" id="card-minia" <?php if(empty($categories)) { echo 'style="display:none;"'; } ?>>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                   Edition des offres/catégories
                </h4>
            </div>
            <div class="card-body" id="editRapNav">
                <div class="col-md-12" id="allcategorie">
                    <ul class="nav nav-tabs" id="list-minia">
                        <?php for($i = 0;$i < count($categories);$i++) {?>
                        <li class="nav-item" id="tabnavRap<?=$i?>"><a class="<?php if($i == 0) echo 'active'; ?> nav-link" href="#navRap<?=$i?>" data-toggle="tab" style="color: black !important" id="titlecat<?=$i?>"><?php echo $categories[$i]['titre']; ?></a></li>
                        <?php }?>
                    </ul>
                    <div class="tab-content" id="speccategorie">
                     
                        <?php for($i = 0;$i < count($categories);$i++) {?>
                          
                            <div class="tab-pane <?php if($i == 0) echo 'active'; ?>" id="navRap<?=$i?>" >
                                <div style="width: 100%;display: inline-block">
                                    <input type="hidden" name="categorie" class="form-control" value="<?php echo $categories[$i]['id']; ?>" />
                                    <div class="float-left col-md-8" >
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label class="control-label">Titre de la catégorie</label>
                                                <input type="text" class="form-control" onkeyup="get('titlecat<?=$i?>').innerText = this.value" name="categorieNom" value="<?php echo $categories[$i]['titre']; ?>" placeholder="Remise spécial CMW V1.8" required maxlength="60">
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label class="control-label">Nombre d'offre par ligne dans la catégorie (min: 1, max: 4)</label>
                                                 <input class="form-control" required type="number" name="number"  min ="1" max="4" value="<?php echo $categories[$i]['showNumber']; ?>" />
                                             </div>
                                        </div>
                                    </div>
                                    <div class="float-right" style="margin-top:15px;">
                                        <button  onclick="sendDirectPost('admin.php?action=supprCategorie&id=<?php echo $categories[$i]['id']; ?>', function(data) { if(data) { hide('navRap<?=$i?>');hide('tabnavRap<?=$i?>');}});" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                                    </div>
                                </div>
                                <div class="col-md-12">


                                    <label class="control-label">Description de la catégorie</label>
                                    <textarea class="form-control" id="ckeditor" data-UUID="CATBOUTIQUENEW0" name="categorieInfo" class="col-sm-12"><?php echo $categories[$i]['message']; ?></textarea>

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Description</th>
                                                <th>Prix</th>
                                                <th>Catégorie</th>
                                                <th>Nombre de ventes restantes</th>
                                                <th>Ordre</th>
                                                <th>Supprimer</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for($j = 1;$j <= count($offres);$j++) {
                                                if($offres[$j]['categorie'] == $categories[$i]['id']) {?>
                                                    <tr id="ligneoffre-<?php echo $offres[$j]['id']; ?>">
                                                <td><input type="text" name="offresNom<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo $offres[$j]['nom']; ?>" /></td>
                                                <td>
                                                    <button class="btn btn-primary" data-toggle="modal" type="button" data-target="#description_offre<?php echo $offres[$j]['id']; ?>">
                                                    <i class="fas fa-pen"></i> / <i class="far fa-eye"></i>
                                                    </button>
                                                    <div class="modal fade" id="description_offre<?=$offres[$j]['id'];?>" tabindex="-1"
                                                        role="dialog" aria-labelledby="description_offre<?=$offres[$j]['id'];?>Label"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-light">
                                                                    <h5 class="modal-title" id="description_offre<?=$offres[$j]['id'];?>Label">Description de l'offre - <?php echo $offres[$j]['nom']; ?></h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body bg-light">
                                                                    <textarea name="offresDescription<?php echo $offres[$j]['id']; ?>" data-UUID="descoffre<?php echo $offres[$j]['id']; ?>" id="ckeditor"><?php echo $offres[$j]['description']; ?></textarea>
                                                                </div>
                                                                <div class="modal-footer bg-light">
                                                                    <button type="button" onclick="sendPost('navRap<?=$i?>');" class="btn btn-success btn-block"
                                                                        data-dismiss="modal"><strong>Fermer</strong> (sauvegarde les modifications)</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><input type="text" name="offresPrix<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo $offres[$j]['prix']; ?>" /></td>
                                                <td>
                                                <select class="form-control" name="offresCategorie<?php echo $offres[$j]['id']; ?>">
                                                        <?php $k = 0; while($k < count($categories)) { 

                                                             echo '<option value="' .$categories[$k]['id']. '" '.($categories[$k]['id'] == $offres[$j]['categorie'] ? 'selected' : '').'>' .$categories[$k]['titre']. '</option>'; $k++;
                                                        } ?>
                                                        </select>
                                                </td>
                                                <td><input type="number" name="nbre_vente<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo $offres[$j]['nbre_vente']; ?>" /></td>
                                                <td><input type="number" name="offresOrdre<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo $offres[$j]['ordre']; ?>" /></td>
                                                <td data-boutique-switchsupp >
                                                    <label class="switch">
                                                        <input type="checkbox" value="true" id="suppr<?php echo $offres[$j]['id']; ?>" name="suppr<?php echo $offres[$j]['id']; ?>">
                                                        <span class="slider round"></span>
                                                    </label>

                                                </td>
                                                <td><a class="btn btn-success" data-toggle="modal"  data-target="#OffreAction<?php echo $offres[$j]['id']; ?>">Modifier</a></td>
                                                <input type="hidden" name="offresId<?php echo $offres[$j]['id']; ?>" value="<?php echo $offres[$j]['id']; ?>" />
                                            </tr>
                                            <?php } }?>
                                        </tbody>
                                    </table>
                                    <script>initPost("navRap<?=$i?>", "admin.php?action=editBoutique", function(data) { if(data) { boutiqueCheck(); } } );</script>
                                    <button type="submit" class="btn btn-success w-100" style="margin-top:10px;" onClick="sendPost('navRap<?=$i?>');">Envoyer!</button>
                                    <?php for($j = 1;$j <= count($offres);$j++) { ?>
                                    <div class="modal fade" id="OffreAction<?php echo $offres[$j]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="Modal-<?php echo $offres[$j]['id']; ?>" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content" >
                                                <div class="modal-header bg-light">
                                                    <h5 class="modal-title" id="Modal-<?php echo $offres[$j]['id']; ?>"><?php echo $offres[$j]['nom']; ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body bg-light" >

                                                    <div id="new-edit-<?php echo $offres[$j]['id']; ?>">

                                                            <label class="control-label">Nombre de ventes possibles par joueur <small>(-1 si aucune limite, max 9999)</small></label><br>
                                                            <input class="form-control" type="number" name="max_vente<?php echo $offres[$j]['id']; ?>" value="<?php echo $offres[$j]['max_vente']; ?>" min="-1" max="9999" required />

                                                            <label class="control-label">Dépendance de l'offre (devra avoir acheter les offres suivante avant celle-ci)</label>
                                                            <input type="text"  value="<?php echo isset($offres[$j]['evo']) ? $offres[$j]['evo'] : ''; ?>" id="dep-tag<?=$j.$offres[$j]['id']?>" name="dep<?php echo $offres[$j]['id']; ?>"  data-role="tagsinput">
                                                            <select style="margin-top:10px;" onfocus="this.selectedIndex = -1;" class="form-control" onchange="$('#dep-tag<?=$j.$offres[$j]['id']?>').tagsinput('add', { 'value': parseInt(this.value.split('|')[0]) , 'text': this.value.split('|')[1]});">
                                                                <?php for($z = 1;$z <= count($offres);$z++) { if($offres[$z]['id'] != $offres[$j]['id']) { ?>
                                                                    <option value="<?php echo $offres[$z]['id']; ?>|<?php echo $offres[$z]['nom']; ?>"><?php echo $offres[$z]['nom']; ?></option>
                                                                <?php } }?> 
                                                            </select>
                                                            <?php if(isset($offres[$j]['evo'])) { ?> 
                                                                <script>
                                                                    $(document).ready(function() { <?php
                                                                        $tp = explode(",",$offres[$j]['evo']);
                                                                        foreach($tp as $value)
                                                                        {
                                                                            echo "$('#dep-tag".$j.$offres[$j]['id']."').tagsinput('add', { 'value': ".$value." ,'text':'".$offresByGet[$value]."' });";
                                                                        } ?> 
                                                                    });
                                                                </script>
                                                            <?php } ?> 
                                                    </div>
                                                    <script>loopChild(get("new-edit-<?php echo $offres[$j]['id']; ?>"),"navRap<?=$i?>");</script>
                                                    <hr/>
                                                    <div id="new-action-<?php echo $offres[$j]['id']; ?>">
                                                        <h5 style="margin-top:10px;">Configurer les actions:</h4>
                                                        <label class="control-label">Type d'action <small>Utilisez {PLAYER} pour la variable joueur</small></select>
                                                        <select class="form-control" name="methode" onchange="
                                                            switch(parseInt(this.value)) {
                                                                case 0:
                                                                    hide('grade-<?php echo $offres[$j]['id']; ?>');
                                                                    hide('gradesite-<?php echo $offres[$j]['id']; ?>');
                                                                    show('valeur-<?php echo $offres[$j]['id']; ?>');
                                                                    break;
                                                                case 1:
                                                                    hide('grade-<?php echo $offres[$j]['id']; ?>');
                                                                    hide('gradesite-<?php echo $offres[$j]['id']; ?>');
                                                                    show('valeur-<?php echo $offres[$j]['id']; ?>');
                                                                    break;
                                                                case 2:
                                                                    show('grade-<?php echo $offres[$j]['id']; ?>');
                                                                    hide('gradesite-<?php echo $offres[$j]['id']; ?>');
                                                                    show('valeur-<?php echo $offres[$j]['id']; ?>');
                                                                    break;
                                                                case 3:
                                                                    hide('grade-<?php echo $offres[$j]['id']; ?>');
                                                                    hide('gradesite-<?php echo $offres[$j]['id']; ?>');
                                                                    show('valeur-<?php echo $offres[$j]['id']; ?>');
                                                                    break;
                                                                case 4:
                                                                    hide('grade-<?php echo $offres[$j]['id']; ?>');
                                                                    hide('gradesite-<?php echo $offres[$j]['id']; ?>');
                                                                    show('valeur-<?php echo $offres[$j]['id']; ?>');
                                                                    break;
                                                                case 5:
                                                                    hide('grade-<?php echo $offres[$j]['id']; ?>');
                                                                    hide('gradesite-<?php echo $offres[$j]['id']; ?>');
                                                                    show('valeur-<?php echo $offres[$j]['id']; ?>');
                                                                    break;
                                                                case 6:
                                                                    hide('grade-<?php echo $offres[$j]['id']; ?>');
                                                                    show('gradesite-<?php echo $offres[$j]['id']; ?>');
                                                                    show('valeur-<?php echo $offres[$j]['id']; ?>');
                                                                    break;
                                                                default:
                                                                    console.log('nany');

                                                            }


                                                        ">
                                                            <option value="0" >Commande(sans /)</option>
                                                            <option value="1">Message Serveur</option>
                                                            <option value="2" >Changer de grade (serveur)</option>
                                                            <option value="3">Give un item</option>
                                                            <option value="4" >Envoyer de l'argent iConomy</option>
                                                            <option value="5">Give d'xp</option>
                                                            <option value="6" >Changer de grade (site)</option>
                                                        </select>

                                                        <div id="grade-<?php echo $offres[$j]['id']; ?>" style="display:none;">
                                                            <label class="control-label">Durée du grade</label>
                                                            <select class="form-control" name="duree">
                                                                <option value="1">1 mois</option>
                                                                <option value="2">2 mois</option>
                                                                <option value="3">3 mois</option>
                                                                <option value="6">6 mois</option>
                                                                <option value="12">1 an</option>
                                                                <option value="18">1 an et demi</option>
                                                                <option value="24">2 ans</option>
                                                                <option value="0">A vie</option>
                                                            </select>
                                                        </div>
                                                        <div id="gradesite-<?php echo $offres[$j]['id']; ?>" style="display:none;">
                                                            <label class="control-label">Grade Site</label>
                                                              <?php $itemps = $i;?>
                                                            <select class="form-control" name="grade_site">
                                                                    <option value="0">Joueur</option>
                                                                    <?php  for($i = 0; $i < count($idGrade); $i++) {  ?>
                                                                            <option value="<?php echo $idGrade[$i]['id']; ?>"><?= $idGrade[$z]['Grade']?></option>
                                                                    <?php }?>
                                                                    <option value="1">Créateur</option>
                                                            </select>
                                                            <?php $i = $itemps;?>
                                                        </div>
                                                        <div id="valeur-<?php echo $offres[$j]['id']; ?>">
                                                            <label class="control-label">Valeur de l'action (nom du grade, montant, message ...) / commande</label>
                                                            <input type="text" class="form-control" name="valeur" placeholder="Exemple: pex user {PLAYER} group set chevalier" />
                                                        </div>
                                                        <input type="hidden" name="id_offre" value="<?php echo $offres[$j]['id']; ?>" />
                                                    </div>
                                                    <script>initPost("new-action-<?php echo $offres[$j]['id']; ?>", "admin.php?action=creerAction");</script>
                                                    <button type="button" onclick="sendPost('new-action-<?php echo $offres[$j]['id']; ?>', function() { boutiqueActionUpdate('<?php echo $offres[$j]['id']; ?>'); });" class="btn btn-secondary w-100">Envoyer!</button>

                                                     <button type="button" style="margin-top:15px;" onclick="SwitchDisplay(get('allaction-<?php echo $offres[$j]['id']; ?>'))" class="btn btn-danger w-100">Editer actions</button>

                                                
                                                    <div class="row" style="display:none;"  id="allaction-<?php echo $offres[$j]['id']; ?>">
                                                        <?php if(!empty($actions)) { for($k = 0;$k < count($actions);$k++) {
                                                            if($actions[$k]['id_offre'] == $offres[$j]['id']) {?>
                  
                                                                <div class="col-md-12 col-lg-5" style="margin-top:10px;">
                                                                    <?php if($actions[$k]['methode'] == 6){?>
                                                                    <select class="form-control" name="commandeValeur-<?php echo $actions[$k]['id']; ?>">
                                                                        <option value="0" <?php if($actions[$k]['grade'] == 0) echo 'selected'; ?>> Joueur </option>
                                                                        <?php  for($i = 0; $i < count($idGrade); $i++) {  ?>
                                                                                <option value="<?php echo $idGrade[$i]['id']; ?>" <?php if($actions[$k]['grade'] == $idGrade[$i]['id']) echo 'selected';?>><?= $idGrade[$z]['Grade']?></option>
                                                                        <?php }?>
                                                                        <option value="1" <?php if($actions[$k]['grade'] == 1) echo 'selected'; ?>>Créateur</option>
                                                                    </select>
                                                                    <?php } else {?>
                                                                    <input name="commandeValeur-<?php echo $actions[$k]['id']; ?>" class="form-control" value="<?php echo $actions[$k]['commande_valeur']; ?>"/>
                                                                    <?php }?>
                                                                </div>
                                                                <div class="col-md-12 col-lg-5" style="margin-top:10px;">
                                                                    <select class="form-control" name="methode-<?php echo $actions[$k]['id']; ?>">
                                                                        <option value="<?php echo $actions[$k]['methode']; ?>"><?php echo $actions[$k]['methodeTxt']; ?></option><?php
                                                                            if($actions[$k]['methode'] != 0) echo '<option value="0">Commande(sans /)</option>';
                                                                            if($actions[$k]['methode'] != 1) echo '<option value="1">Message Serveur</option>';
                                                                            if($actions[$k]['methode'] != 2) echo '<option value="2">Changer de grade</option>';
                                                                            if($actions[$k]['methode'] != 3) echo '<option value="3">Give un item</option>';
                                                                            if($actions[$k]['methode'] != 4) echo '<option value="4">Envoyer de l\'argent iConomy</option>';
                                                                            if($actions[$k]['methode'] != 5) echo '<option value="5">Give d\'xp</option>'; 
                                                                            if($actions[$k]['methode'] != 6) echo '<option value="6">Grade site</option>'; ?>
                                                                    </select>
                                                                </div>
                                                                
                                                                <div class="col-md-12 col-lg-2" style="margin-top:10px;">
                                                                     <button type="button" style="width:100%"onclick="sendDirectPost('admin.php?action=supprAction&id=<?php echo $actions[$k]['id']; ?>', function() {
                                                                            hide('allaction-<?php echo $offres[$j]['id']; ?>');
                                                                     });" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                                                </div>
                                                        <?php } } } ?>
                                                    </div>
                                   
                                                
                                                    <script>initPost("allaction-<?php echo $offres[$j]['id']; ?>", "admin.php?action=editerAction");</script>
                                                    <div class="modal-footer bg-light" style="padding-top:20px;">
                                                            <button type="button" style="margin-top:15px;" onclick="sendPost('navRap<?=$i?>');sendPost('allaction-<?php echo $offres[$j]['id']; ?>');" data-dismiss="modal" aria-label="Close" class="btn btn-primary w-100">Valider les changements</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php } ?>

                                </div>
                            </div>
                        <?php }?>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php } ?>
</br>
</div>
<?php } ?>
