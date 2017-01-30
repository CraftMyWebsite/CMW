<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
    	<h1 class="page-header"> Boutique
    	    <small>Gestionnaire Boutique</small>
    	</h1>
    	<ol class="breadcrumb">
    		<li>
                <i class="fa fa-dashboard"></i>  <a data-toggle="collapse" data-parent="#adminPanel" href="#informations">Informations</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Boutique
            </li>
    	</ol>
    	<hr>
    	<?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['shop']['actions']['addCategorie'] == false AND $_PGrades_['PermsPanel']['shop']['actions']['addOffre'] == false AND $_PGrades_['PermsPanel']['shop']['actions']['editCategorieOffre'] == false)) { ?>
    		<div class="col-lg-6 col-lg-offset-3 text-center">
    			<div class="alert alert-danger">
    				<strong>Vous avez aucune permission pour accéder aux réglages de la boutique.</strong>
    			</div>
    		</div>
    	<?php } else { ?>
    		<div class="col-lg-6 col-lg-offset-3 text-center">
    			<div class="alert alert-success">
    				<strong>Sur cette section, créez des catégories d'achats boutiques, choisissez le/les serveur(s) d'action, créez vos offres et attribuez des actions(commandes) à vos offres. Réglez toute la partie "Boutique In-Game", pour ce qui est de l'achat de jetons(monnaie de la boutique), veuillez vous reporter à la section "payement"</strong>
    			</div>
    		</div>
    	<?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['actions']['addCategorie'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <h3>Créer une catégorie</h3>
                <div class="alert alert-success">
                    <strong>Avant de créez une catégorie sachez d'abord à quoi servent ces catégories, en effet en plus de permettre de ne pas tout mettre en vrac et d'avoir un minimum d'organisation, les catégories vous permettent de gérer le multiserveur! Vous avez trois choix pour le serveur d'action d'une catégorie: tous les serveurs(la commande est envoyée sur tous les serveurs), le serveur où le joueur est en ligne(par exemple pour un give d'item) ou un serveur spécifique que vous choisissez à l'avance. L'ordre de la catégorie est l'ordre d'affichage, il ne sert qu'à titre d'organisation.</strong>
                </div>
            </div>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <form action="?&action=creerCategorie" method="POST">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="form-group col-lg-6">
                                <label>Titre de la catégorie</label>
                                <input type="text" class="form-control" name="titre" placeholder="ex: Grades pas chers !">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Ordre d'affichage</label>
                                <input type="number" class="form-control" name="ordre" value="<?php echo $categorieNum; ?>" placeholder="L'ordre dans lequel va s'afficher la catégorie !"> 
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Connexion In-Game</label>
                                <select name="connection"class="form-control">
                                    <option value="0">Désactivé</option>
                                    <option value="1">Activé</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Serveurs d'action</label>
                                <select name="serveur" class="form-control">
                                    <option value="-1">Tous</option>
                                    <option value="-2">Au choix (Le joueur se connecte sur le serveur voulu)</option>
                                    <?php for($i = 0; $i < count($lecture['Json']); $i++) { ?>
                                    <option value="<?php echo $i; ?>"><?php echo $lecture['Json'][$i]['nom']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-lg-12">
                                <label>Description de la catégorie</label>
                                <textarea class="form-control" name="message"></textarea>
                            </div>
                            <hr>
                            <div class="form-group col-lg-12">
                                <button class="btn btn-success" type="submit">Créer la catégorie !</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['actions']['addOffre'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <h3>Créer une offre</h3>
                <div class="alert alert-success">
                    <strong>Après avoir créé une catégorie, vous pouvez y insérer une offre. L'offre est dans un première temps composée d'un titre, d'un message(ou image) et appartiens à une catégorie, vous pourrez par la suite attribuer à une offre une "action"(=commande). Pour mettre une image, rien de plus simple, vous pouvez le faire via le code suivant: </strong></br><strong><?php echo htmlspecialchars('<img src="http://lien_vers_mon_image.fr/" alt="Image Boutique" />'); ?></strong>
                </div>
            </div>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <form action="?&action=creerOffre" method="POST">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="form-group col-lg-6">
                                <label>Titre de l'offre</label>
                                <input type="text" class="form-control" name="nom" placeholder="ex: 64 x Diamants">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Description</label>
                                <input type="text" class="form-control" name="description" placeholder="ex: <img src=... />"> 
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Prix</label>
                                <input type="number" class="form-control" name="prix">
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Catégorie</label>
                                <select name="categorie" class="form-control">
                                    <?php $k = 0;
                                    while($k < count($categories)) { ?>
                                        <option value="<?php echo $categories[$k]['id']; ?>"><?php echo $categories[$k]['titre']; ?></option>
                                    <?php $k++; } ?>
                                </select>
                            </div>
                            <hr>
                            <div class="form-group col-lg-12">
                                <input class="btn btn-success" type="submit" value="Créer l'offre !"/>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['shop']['actions']['editCategorieOffre'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
                <h3>Edition des offres/catégories</h3>
                <div class="alert alert-success">
                    <strong>Une fois votre offre créée, vous pouvez la modifier mais avant tout lui ajouter une action, pour cela cliquez sur le bouton "action" de l'offre à modifier, la fenêtre qui s'ouvre vous propose différents types d'actions, ainsi que la "Valeur de l'action / Commande" qu'il faut y attribuer. Vous pouvez très bien ajouter plusieurs actions à votre offre, par exemple faire une offre qui ajoute le joueur à un grade, envoie un message public et lui donne 15 diamants est tout à fait possible.</strong>
                </div>
            </div>
            <div class="col-lg-12 text-center">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <div class="col-lg-12">
                            <ul class="nav nav-tabs">
                                <?php $i = 0;
                                while($i < count($categories)) { ?>
                                    <li <?php if($i == 0) echo 'class="active"'; ?>><a href="#categoriesSwitch<?php echo $categories[$i]['id']; ?>" data-toggle="tab"><?php echo $categories[$i]['titre']; ?></a></li>
                                <?php $i++; } ?>
                                <div class="col-lg-13 text-center">
                                    <div class="tab-content well">
                                        <?php $i = 0;
                                        while($i < count($categories)) { ?>
                                            <div class="tab-pane<?php if($i == 0) echo ' active'; ?>" id="categoriesSwitch<?php echo $categories[$i]['id']; ?>">
                                                <form method="POST" action="?&action=boutique">
                                                    <input type="hidden" name="categorie" class="form-control" value="<?php echo $categories[$i]['id']; ?>" />
                                                    <h3>Categories <a href="?action=supprCategorie&id=<?php echo $categories[$i]['id']; ?>" class="btn btn-danger">supprimer la catégorie</a></h3>
                                                    <div class="row">
                                                    <div class="form-group col-lg-6">
                                                        <label>Nom de la catégorie</label>
                                                        <input name="categorieNom" class="form-control" value="<?php echo $categories[$i]['titre']; ?>" />
                                                    </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Informations</label>
                                                        <textarea class="form-control" name="categorieInfo" class="col-sm-12"><?php echo $categories[$i]['message']; ?></textarea>
                                                    </div>
                                                    <h3>Offres</h3>
                                                    <table class="table">
                                                        <tr>
                                                            <th>Nom</th>
                                                            <th>Description</th>
                                                            <th>Prix</th>
                                                            <th>catégorie</th>
                                                            <th>Ordre</th>
                                                            <th>Supprimer</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        <?php $j = 0;
                                                        while($j < count($offres)) {
                                                            if($offres[$j]['categorie'] == $categories[$i]['id']) { ?>
                                                                <tr>
                                                                    <td><input type="text" name="offresNom<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo $offres[$j]['nom']; ?>" /></td>
                                                                    <td><input type="text" name="offresDescription<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo htmlspecialchars($offres[$j]['description']); ?>" /></td>
                                                                    <td><input type="text" name="offresPrix<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo $offres[$j]['prix']; ?>" /></td>
                                                                    <td>
                                                                        <select class="form-control" name="offresCategorie<?php echo $offres[$j]['id']; ?>">
                                                                            <option value="<?php echo $offres[$j]['categorie']; ?>"><?php echo $offres[$j]['categorie']; ?></option>
                                                                            <?php $k = 0; while($k < count($categories)) { 
                                                                                if($categories[$k]['titre'] != $offres[$j]['categorie']) echo '<option value="' .$categories[$k]['id']. '">' .$categories[$k]['titre']. '</option>'; $k++; } ?>
                                                                        </select>
                                                                    </td>
                                                                    <td><input type="number" name="offresOrdre<?php echo $offres[$j]['id']; ?>" class="form-control" value="<?php echo $offres[$j]['ordre']; ?>" /></td>
                                                                    <td><input type="checkbox" name="suppr<?php echo $offres[$j]['id']; ?>" /></td>
                                                                    <td><a class="btn btn-success" data-toggle="modal" data-target="#OffreAction<?php echo $offres[$j]['id']; ?>">Modifier</a></td>
                                                                    <input type="hidden" name="offresId<?php echo $offres[$j]['id']; ?>" value="<?php echo $offres[$j]['id']; ?>" />
                                                                </tr>
                                                            <?php }
                                                           $j++;
                                                        } ?>
                                                    </table>
                                                    <hr>
                                                    <button class="btn btn-success" type="submit">Valider mes changements</button>
                                                </form>
                                            </div>
                                        <?php $i++;
                                        } ?>
                                    </div>
                                    <?php $j = 0;
                                    while($j < count($offres)) { ?>
                                        <div class="modal fade" id="OffreAction<?php echo $offres[$j]['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <h4 class="modal-title" id="gridSystemModalLabel">Commandes <?php echo $offres[$j]['nom']; ?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <center>Utilisez {PLAYER} pour la variable joueur</center>
                                                        <form method="POST" action="?&action=creerAction">
                                                            <div class="col-lg-offset-3 text-center">
                                                                <div class="row">
                                                                    <div class="col-lg-8">
                                                                        <div class="form-group">
                                                                            <label>Methode</label>
                                                                            <select class="form-control" name="methode">
                                                                                <option value="0">Commande(sans /)</option>
                                                                                <option value="1">Message Serveur</option>
                                                                                <option value="2">Changer de grade</option>
                                                                                <option value="3">Give un item</option>
                                                                                <option value="4">Envoyer de l'argent iConomy</option>
                                                                                <option value="5">Give d'xp</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Durée <small>Pour les grades uniquement !</small></label>
                                                                            <select class="form-control" name="duree">
                                                                                <option value="1">1 mois</option>
                                                                                <option value="2">2 mois</option>
                                                                                <option value="3">3 mois</option>
                                                                                <option value="5">6 mois</option>
                                                                                <option value="12">1 an</option>
                                                                                <option value="18">1 an et demi</option>
                                                                                <option value="24">2 ans</option>
                                                                                <option value="0">A vie</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-12">
                                                                            <label>Valeur de l'action / commande</label>
                                                                            <input type="text" class="form-control" name="valeur" placeholder="Exemple: pex user {PLAYER} group set chevalier" />
                                                                        </div>
                                                                        <input type="hidden" name="id_offre" value="<?php echo $offres[$j]['id']; ?>" />
                                                                        <hr>
                                                                        <div class="form-group col-md-12">
                                                                            <input type="submit" class="btn btn-primary" value="Ajouter la commande"/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <?php $k = 0; ?>
                                                        <form class="form-inline" role="form" method="post" action="?&action=editerAction">
                                                        <?php while($k < count($actions)) {
                                                            if($actions[$k]['id_offre'] == $offres[$j]['id']) { ?>
                                                                <div class="form-group">
                                                                    <input name="commandeValeur-<?php echo $actions[$k]['id']; ?>" class="form-control" value="<?php echo $actions[$k]['commande_valeur']; ?>"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <select class="form-control" name="methode-<?php echo $actions[$k]['id']; ?>">
                                                                        <option value="<?php echo $actions[$k]['methode']; ?>"><?php echo $actions[$k]['methodeTxt']; 
                                                                        if($actions[$k]['methode'] != 0) echo '<option value="0">Commande(sans /)</option>';
                                                                        if($actions[$k]['methode'] != 1) echo '<option value="1">Message Serveur</option>';
                                                                        if($actions[$k]['methode'] != 2) echo '<option value="2">Changer de grade</option>';
                                                                        if($actions[$k]['methode'] != 3) echo '<option value="3">Give un item</option>';
                                                                        if($actions[$k]['methode'] != 4) echo '<option value="4">Envoyer de l\'argent iConomy</option>';
                                                                        if($actions[$k]['methode'] != 5) echo '<option value="5">Give d\'xp</option>'; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <a href="?action=supprAction&id=<?php echo $actions[$k]['id']; ?>" class="btn btn-danger">Supprimer</a>
                                                                </div>
                                                            <?php }
                                                        $k++;
                                                        } ?>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="form-group col-md-12">
                                                                <input type="submit" value="Valider les changements" class="btn btn-warning form-control"/>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="col-lg-offset-3 text-center">
                                                            <div class="row">
                                                                <div class="col-lg-8">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                                    <?php $j++; 
                                    } ?>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<!-- /.row -->