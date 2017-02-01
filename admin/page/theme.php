<!-- Page Heading -->
<div class="row">
	<div class="col-lg-12">
		<h1 class="page-header"> Themes
            <small>Gestionnaire des Themes</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a data-toggle="collapse" data-parent="#adminPanel" href="#informations">Informations</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Themes
            </li>
        </ol>
        <?php if($_Joueur_['rang'] != 1 AND ($_PGrades_['PermsPanel']['theme']['actions']['editTheme'] == false AND $_PGrades_['PermsPanel']['theme']['actions']['editBackground'] == false AND $_PGrades_['PermsPanel']['theme']['actions']['editTypeBackground'] == false)) { ?>
        	<div class="col-lg-6 col-lg-offset-3 text-center">
        		<div class="alert alert-danger">
        			<strong>Vous avez aucune permission pour accéder aux thèmes.</strong>
        		</div>
        	</div>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['theme']['actions']['editTheme'] == true) { ?>
        	<div class="col-lg-6 col-lg-offset-3 text-center">
        	    <div class="row">
        	    	<div class="alert alert-success">
        	    		<strong>Si vous souhaitez modifier un thème, modifiez une copie de l'original en créant un nouveau thème. Cela vous évitera de perdre votre thème lors d'une mise à jours !</strong>
        	    	</div>
        	    </div>
        	    <div class="row">
        		    <h3>Choisissez votre thème</h3>
        		</div>
        	</div>
        	<form method="POST" action="?&action=editTheme">
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-6 col-lg-offset-3">
                            	<h3>Choisir un thème</h3>
                            	<div class="row">
                            		<label class="control-label">Thèmes</label>
                            		<select class="form-control text-center" name="theme">
				                        <option value="<?php echo $lecture['General']['theme']; ?>"><?php echo $lecture['General']['theme']; ?></option>
				                        <?php foreach($themes as $element){ if($element != 'upload' AND $element != $lecture['General']['theme'] AND $element != '..') { ?>
				                        <option value="<?php echo $element; ?>"><?php echo $element; ?></option><?php } } ?>
			                        </select>
                            	</div>
                            	<?php if($themesOptions != null) { ?>
                            		<div class="row">
                            		    <label class="control-label">Option du thème</label>
                            		    <select class="form-control" name="themeOption">
				                            <option value="<?php echo $lecture['General']['themeOption']; ?>"><?php echo $lecture['General']['themeOption']; ?></option>
				                            <?php foreach($themesOptions as $element){ if($element != $lecture['General']['themeOption']) { ?>
				                            <option value="<?php echo $element; ?>"><?php echo $element; ?></option><?php } } ?>
			                            </select>
                            	    </div>
                            	<?php } ?>
                            	<hr>
                            	<div class="row">
                            		<input type="submit" class="btn btn-success" value="Valider les changements" />
                            	</div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['theme']['actions']['editBackground'] == true) { ?>
            <div class="col-lg-6 col-lg-offset-3 text-center">
        	    <div class="row">
        		    <div class="alert alert-success">
        			    <strong>Si vous voulez mettre une image, l'image doit être en 1920*1080 minimum pour s'adapater aux ecran et pour avoir une qualité optimal ! Vous pouvez aussi mettre une petite image qui se répettera !</strong>
        		    </div>
        	    </div>
        	    <div class="row">
        		    <h3>Choisissez le fond d'écran de votre site</h3>
        	    </div>
            </div>
            <form method="POST" action="?&action=postBG" enctype="multipart/form-data">
                <div class="col-lg-6 col-lg-offset-3 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <div class="col-lg-6 col-lg-offset-3">
                                <h3>Choisir une image</h3>
                                <div class="row">
                            	    <label class="control-label">Image</label>
                            	    <input type="file" name="img">
                                </div>
                                <hr>
                                <div class="row">
                            	    <input type="submit" class="btn btn-success" value="Valider les changements" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php }
        if($_Joueur_['rang'] == 1 OR $_PGrades_['PermsPanel']['theme']['actions']['editTypeBackground'] == true) { ?>
        	<div class="col-lg-6 col-lg-offset-3 text-center">
        	    <div class="row">
        		    <div class="alert alert-success">
        			    <strong>Choisissez si vous préférez utiliser une grande image en fond de site ou une répétition de petits images !</strong>
        		    </div>
        	    </div>
        	    <div class="row">
        		    <h3>Choisissez le type de fond d'écran</h3>
        	    </div>
            </div>
            <form method="POST" action="?&action=typeBG">
            	<div class="col-lg-6 col-lg-offset-3 text-center">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <h3>Choisir le type</h3>
                            <div class="row">
                            	<label class="control-label">Image sans répétition, taille conseillée: min 1920*1080</label>
                            	<input type="radio" name="bgType" value="0" <?php if($lecture['General']['bgType'] == 0) echo 'checked'; ?>>
                            </div>
                            <div class="row">
                            	<label class="control-label">Image en répétition, taille conseillée infèrieure à 100*100</label>
                            	<input type="radio" name="bgType" value="1" <?php if($lecture['General']['bgType'] == 1) echo 'checked'; ?>>
                            </div>
                            <hr>
                            <div class="row">
                            	<input type="submit" class="btn btn-success" value="Valider les changements" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php } ?>
	</div>
</div>
<!-- /.row -->