<div class="cmw-page-content-header"><strong>Slider & Miniature</strong> - Gérez vos sliders & miniatures de votre site</div>

<div class="row">
    <div class="alert alert-success">
        <strong>Ici configurez l'accueil de votre site, la vitrine de votre serveur, ne négligez jamais cette page, ajoutez de belles images, des sliders ou encore des liens de navigation rapide le plus ergonomiquement possible!</strong>
    </div>
    <div class="col-xs-12 col-md-6 text-center">
        <?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'uploadSlider') AND !Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'editSlider') && !Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'uploadMiniature') AND !Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'editMiniature')) { ?>

        
        <div class="alert alert-danger">
            <strong>Vous avez aucune permission pour accéder aux réglagles de l'accueil.</strong>
        </div>

        <?php }
        if(Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'uploadSlider') OR Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'editSlider')) { ?>

        <h2>Slider</h2>

        <?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'uploadSlider')) { ?>

        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Uploader un slider</strong></h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="?&action=postSlider" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-7">
                            <input type="file" name="img">
                            <p class="help-block">Image slider (1400 x 500)</p>
                        </div>
                        <div class="form-group col-md-5">
                            <input type="submit" class="btn btn-success">
                        </div>
                    </div>
                </form>

        <?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'editSlider')) { ?>


        <h3>Configuration de votre slider</h3>
                <form method="POST" action="?&action=changeSlider">
                        
                        <label class="control-label">Choisissez votre slider</label>
                        <select class="form-control text-center" name="image">
                            <option value="<?php echo $lectureAccueil['Slider']['image']; ?>"><?php echo $lectureAccueil['Slider']['image']; ?></option>
                            <?php for($j = 2;$j < count($imagesSlider);$j++) {
                                if($lectureAccueil['Slider']['image'] != $imagesSlider[$j])  echo '<option value="' .$imagesSlider[$j]. '">' .$imagesSlider[$j]. '</option>';
                            } ?>
                        </select>
                            <input style="margin-top: 5px;" type="submit" class="btn btn-success" value="Modifier le slider"/>
                        
                    </form>
                </div>
            </div>
        </div>

    <?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'uploadMiniature') OR Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'editMiniature')) { ?>

    <div class="col-xs-12 col-md-6 text-center">
        <h2>Miniature</h2>

        <?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'uploadMiniature')) { ?>

        <div class="panel panel-default cmw-panel">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Uploader une miniature</strong></h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="?&action=postNavRap" enctype="multipart/form-data">
                    <div class="form-group col-md-7">
                        <input type="file" name="img">
                        <p class="help-block">Image miniature (400 x 160)</p>
                    </div>
                    <div class="form-group col-md-5">
                        <input type="submit" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>

        <?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'editMiniature')) { ?>

        <div class="panel panel-default">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Ajouter une miniature</strong></h3>
            </div>
            <div class="panel-body">
                <form method="POST" action="?&action=addRapNav">
					<h3>Miniature #<?= count($lectureAccueil['Infos']) + 1 ?></h3>
					<div class="form-group">
						<label>Message</label>
						<textarea class="form-control" placeholder="Petit message qui se situera en dessous de l'image ^^" rows="3" name="message"></textarea>
					</div>
					<div class="row">
						<div class="col-sm-9">
							<label>Image</label>
							<select class="form-control" name="image">
							<?php for($j = 2;$j < count($images);$j++) { ?>
								<option value="<?php echo $images[$j]; ?>"><?php echo $images[$j]; ?></option>
							<?php } ?>        
							</select>
						</div>
						<div class="col-sm-3">
							<label>Ordre</label>
							<input type="number" name="ordre" class="form-control" value="<?= count($lectureAccueil['Infos']) + 1 ?>" required>
						</div>
					</div>
							
					<label>Nom de la page (Option 1)</label>
					<select name="page" class="form-control">
						<option value="#">-- Page --</option>
						<option value="boutique">Boutique</option>
						<option value="support">Support</option>
						<option value="voter">Voter</option>
						<option value="tokens">Jetons</option>
                        <option value="forum">Forum</option>
                        <?php $j = 0;
                        while($j < count($pages)) { ?>
                        <option value="<?php echo $pages[$j]; ?>"><?php echo $pages[$j]; ?></option>
                        <?php $j++; } ?>
					</select>
					<label>Adresse du lien (Option 2)</label>
					<input type="text" class="form-control" name="lien" />
					<h3>Choisissez quel mode de redirection vous souhaitez</h3>
					<label>
						<input type="radio" name="typeLien" value="page">
						Option 1: Je souhaite rediriger vers une page existante
					</label><br>
					<label>
						<input type="radio" name="typeLien" value="lien">
						Option 2: Je souhaite rediriger vers un lien personnalisé
					</label><br>
					<input type="submit" class="btn btn-warning" value="Ajouter la miniature"/>
				</form>
			</div>
		</div>
	
	<div class="panel panel-default">
            <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Modifier une miniature</strong></h3>
            </div>
            <div class="panel-body">
                <?php if(!empty($lectureAccueil['Infos']))
                {
                    ?>
                <form method="POST" action="?&action=editRapNav">
                    <ul class="nav nav-tabs">
					<?php for($i = 1;$i < count($lectureAccueil['Infos']) + 1;$i++) {?>
						<li <?php if($i == 1) echo 'class="active"'; ?>><a href="#navRap<?=$i?>" data-toggle="tab">Miniature #<?=$i?></a></li>
					<?php }?>
					</ul>
                    
					<div class="tab-content">
					<?php for($i = 1;$i < count($lectureAccueil['Infos']) + 1;$i++) {?>
						<div class="tab-pane well<?php if($i == 1) echo ' active'?>" id="navRap<?=$i?>">
							<h3>Miniature #<?=$i?></h3>
                            <a style="float: right;" href="?action=supprMini&id=<?=$i;?>" class="btn btn-danger">Supprimer</a>
							<div class="row">
								<img class="col-md-4 thumbnail" src="theme/upload/navRap/<?php echo $lectureAccueil['Infos'][$i]['image']; ?>"/>
								<div class="col-md-8">
									<div class="form-group">
										<label>Message</label>
										<textarea class="form-control" placeholder="Petit message qui se situera en dessous de l'image ^^" rows="3" name="message<?=$i?>"><?php echo $lectureAccueil['Infos'][$i]['message']; ?></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-9">
									<label>Image</label>
									<select class="form-control" name="image<?=$i?>">
									<?php for($j = 2;$j < count($images);$j++) { ?>
									<option value="<?php echo $images[$j]; ?>"<?php if($images[$j] == $lectureAccueil['Infos'][$i]['image']) echo " selected"?>><?php echo $images[$j]; ?></option>
									<?php } ?>       
									</select>
								</div>
								<div class="col-sm-3">
									<label>Ordre</label>
									<input type="number" name="ordre<?=$i?>" class="form-control" value="<?=$i?>" required>
								</div>
							</div>
							
							
							<label>Nom de la page (Option 1)</label>
							<select name="page<?=$i?>" class="form-control">
							<?php if($typeNavRap[$i] == 1) {
								echo '<option value="'. $pageActive[$i] .'">'. $pageActive[$i] .'</option>';
							} else {
								echo '<option value="#">-- Page --</option>';
							} ?>
								<option value="boutique">Boutique</option>
								<option value="support">Support</option>
                                <option value="voter">Voter</option>
                                <option value="tokens">Jetons</option>
                                <option value="forum">Forum</option>
                                <?php $j = 0;
                                while($j < count($pages)) { ?>
                                <option value="<?php echo $pages[$j]; ?>"><?php echo $pages[$j]; ?></option>
                                <?php $j++; } ?>
							</select>
							<label>Adresse du lien (Option 2)</label>
							<input type="text" class="form-control" name="lien<?=$i?>" value="<?php if($typeNavRap[$i] == 2) echo $lectureAccueil['Infos'][$i]['lien']; ?>" placeholder="http://minecraft.net/"/>
							<h3>Choisissez quel mode de redirection vous souhaitez</h3>
							<label>
							<input type="radio" name="typeLien<?=$i?>" value="page" <?php if($typeNavRap[$i] == 1) echo 'checked'; ?>>
							Option 1: Je souhaite rediriger vers une page existante
							</label><br>
							<label>
							<input type="radio" name="typeLien<?=$i?>" value="lien" <?php if($typeNavRap[$i] == 2) echo 'checked'; ?>>
							Option 2: Je souhaite rediriger vers un lien personnalisé
							</label><br>
						</div>
					<?php } ?>
                        <input type="submit" class="btn btn-warning" value="Modifier la miniature"/>
					</div>
				</form>
                <?php 
            }
            ?>
			</div>
		</div>
	</div>
        </div>

        <?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'editMiniature') AND Permission::getInstance()->verifPerm('PermsPanel', 'home', 'actions', 'addSlider')) { ?>

        <div class="modal fade" id="newSlider" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="gridSystemModalLabel">Créer un slider</h4>
                    </div>
                    <div class="modal-body">
                        <div class="col-lg-offset-3 text-center">
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <label>Message de l'image</label>
                                        <input type="text" class="form-control" name="message"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Choisissez une image <small>(les images se trouvent dans theme/upload/img/slider/</small></label>
                                        <select class="form-control" name="image">
                                            <?php for($j = 2;$j < count($imagesSlider);$j++) { ?>
                                            <option value="<?php echo $imagesSlider[$j]; ?>"><?php echo $imagesSlider[$j]; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <input type="submit" class="btn btn-default" value="Ajouter une image au slider">
                                </div>
                            </div>
                        </div>
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
                </div>
            </div>
        </div>
        <?php } ?>
    </div>