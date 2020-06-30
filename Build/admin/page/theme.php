<div class="cmw-page-content-header"><strong>Théme</strong> - Gérez vos thèmes & fond d'écran de votre site</div>



<div class="row">

    <?php if(!Permission::getInstance()->verifPerm('PermsPanel', 'theme', 'actions', 'editTheme') AND !Permission::getInstance()->verifPerm('PermsPanel', 'theme', 'actions', 'editBackground') AND !Permission::getInstance()->verifPerm('PermsPanel', 'theme', 'actions', 'editTypeBackground')) { ?>

    <div class="alert alert-danger">
       <strong>Vous avez aucune permission pour accéder aux thèmes.</strong>
   </div>


   <?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'theme', 'actions', 'editTheme')) { ?>

   <div class="col-xs-12 col-md-4 text-center" style="height: 400px">
      <div class="panel panel-default cmw-panel">
          <div class="panel-heading cmw-panel-header">
                <h3 class="panel-title"><strong>Choisissez votre thème</strong></h3>
            </div>
            <div class="panel-body">
               <div class="alert alert-success" style="height: 100px;">
                     <strong>Si vous souhaitez modifier un thème, modifiez une copie de l'original en créant un nouveau thème. Cela vous évitera de perdre votre thème lors d'une mise à jour !</strong>
                 </div>
                 <form method="POST" action="?&action=editTheme">
                     <h3>Choisir un thème</h3>
                     <div class="col-md-12">
                          <label class="control-label">Thèmes</label>
                          <select class="form-control text-center" name="theme">
                            <option value="<?php echo $_Serveur_['General']['theme']; ?>"><?php echo $_Serveur_['General']['theme']; ?></option>
                            <?php foreach($themes as $element){ if($element != 'upload' AND $element != $_Serveur_['General']['theme'] AND $element != '..' AND $element != 'smileys') { ?>
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
              <div class="row">
                  <div class="col-md-12" style="margin-top: 5px;">
                    <input type="submit" class="btn btn-success" value="Valider les changements" />
                  </div>
              </div>
            </form>
          </div>
        </div>
    </div>

<?php
 } if(Permission::getInstance()->verifPerm('PermsPanel', 'theme', 'actions', 'editBackground')) { ?>

<div class="col-xs-12 col-md-4 text-center" style="height: 400px">
  <div class="panel panel-default cmw-panel">
      <div class="panel-heading cmw-panel-header">
          <h3 class="panel-title"><strong>Choisissez le fond d'écran</strong></h3>
      </div>
      <div class="panel-body">
        <div class="alert alert-success" style="height: 100px;">
           <strong>Si vous voulez mettre une image, l'image doit être en 1920*1080 minimum pour s'adapter aux écrans et pour avoir une qualité optimale ! Vous pouvez aussi mettre une petite image qui se répètera !</strong>
       </div>
       <form method="POST" action="?&action=postBG" enctype="multipart/form-data">
          <h3>Choisir une image</h3>
          <div class="col-md-12">
             <label class="control-label">Image</label>
             <input type="file" name="img">
         </div>
         <div class="row">
            <div class="col-md-12" style="margin-top: 5px;">
             <input type="submit" class="btn btn-success" value="Valider les changements" />
            </div>
          </div>
    </form>
  </div>
</div>
</div>

<?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'theme', 'actions', 'editTypeBackground')) { ?>

<div class="col-xs-12 col-md-4 text-center" style="height: 400px">
  <div class="panel panel-default cmw-panel">
    <div class="panel-heading cmw-panel-header">
        <h3 class="panel-title"><strong>Choisissez le type de fond d'écran</strong></h3>
    </div>
    <div class="panel-body">
      <div class="alert alert-success" style="height: 100px;">
       <strong>Choisissez si vous préférez utiliser une grande image en fond de site ou une répétition de petites images !</strong>
    </div>
    <form method="POST" action="?&action=typeBG">
        <h3>Choisir le type</h3>
      <div class="col-md-6">
         <label class="control-label">Image sans répétition, taille conseillée: min 1920*1080</label>
         <input type="radio" name="bgType" value="0" <?php if($lecture['General']['bgType'] == 0) echo 'checked'; ?>>
     </div>
     <div class="col-md-6">
         <label class="control-label">Image en répétition, taille conseillée infèrieure à 100*100</label>
         <input type="radio" name="bgType" value="1" <?php if($lecture['General']['bgType'] == 1) echo 'checked'; ?>>
     </div>
     <hr>
     <div class="row">
        <div class="col-md-12" style="margin-top: 5px;">
            <input type="submit" class="btn btn-success" value="Valider les changements" />
          </div>
     </div>
    </form>
  </div>
</div>
</div>
<?php } if(Permission::getInstance()->verifPerm('PermsPanel', 'theme', 'actions', 'editTheme')) { ?>

<div class="col-xs-12 col-md-4 text-center" style="height: 400px">
	<div class="panel panel-default cmw-panel">
		<div class="panel-heading cmw-panel-header">
			<h3 class="panel-title"><strong>Couleur du thème</strong></h3>
		</div>
		<div class="panel-body">
			<h3>Choisir vos couleurs</h3>
			<form method="POST" action="?&action=themeColor" class="row">
				<div class="col-sm-6">
					<h5>Theme</h5>
					<?php $lecture = new Lire('modele/config/config.yml');
						$lecture = $lecture->GetTableau()?>
					<label>Couleur principale</label><br>
					<input type="color" name='color_theme_main'<?php if(isset($lecture["color"]["theme"]["main"])) echo ' value="'.$lecture["color"]["theme"]["main"].'"'?>><br><br>
					<label>Couleur lors du survol</label><br>
					<input type="color" name='color_theme_hover'<?php if(isset($lecture["color"]["theme"]["hover"])) echo ' value="'.$lecture["color"]["theme"]["hover"].'"'?>><br><br>
					<label>Couleur lors du clic</label><br>
					<input type="color" name='color_theme_focus'<?php if(isset($lecture["color"]["theme"]["focus"])) echo ' value="'.$lecture["color"]["theme"]["focus"].'"'?>><br><br>
				</div>
				<div class="col-sm-6">
					<h5>Panel</h5>
					<?php $lecture = new Lire('modele/config/config.yml');
						$lecture = $lecture->GetTableau()?>
					<label>Couleur principale</label><br>
					<input type="color" name='color_panel_main'<?php if(isset($lecture["color"]["panel"]["main"])) echo ' value="'.$lecture["color"]["panel"]["main"].'"'?>><br><br>
					<label>Couleur lors du survol</label><br>
					<input type="color" name='color_panel_hover'<?php if(isset($lecture["color"]["panel"]["hover"])) echo ' value="'.$lecture["color"]["panel"]["hover"].'"'?>><br><br>
					<label>Couleur lors du clic</label><br>
					<input type="color" name='color_panel_focus'<?php if(isset($lecture["color"]["panel"]["focus"])) echo ' value="'.$lecture["color"]["panel"]["focus"].'"'?>><br><br>
				</div>
				<input type="submit" class="btn btn-success" value="Valider les changements">
			</form>
		</div>
	</div>
</div>
<?php }
if(Permission::getInstance()->verifPerm('PermsPanel', 'theme', 'actions', 'editTheme')) {
  include('theme/'.$_Serveur_['General']['theme'].'/config/configAdminVue.php'); 
}?>
</div>